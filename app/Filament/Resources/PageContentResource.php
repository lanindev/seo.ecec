<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageContentResource\Pages;
use App\Filament\Resources\PageContentResource\Pages\ComponentTransformer;
use App\Filament\Resources\PageContentResource\RelationManagers;
use App\Models\Language;
use App\Models\Page;
use App\Models\PageContent;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PageContentResource extends Resource
{
    protected static ?string $model = PageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv';

    protected static ?int $navigationSort = 3;

//    public static function getNavigationGroup(): ?string
//    {
//        return __('admin.navigation_group.label');
//    }

    public static function getNavigationLabel(): string
    {
        return __('admin.page_content.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.page_content.resource_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.page_content.resource_label');
    }

//    protected static bool $shouldRegisterNavigation = false;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Grid::make(1)
                ->schema([
                    Select::make('page_id')
                        ->label(__('admin.page.label'))
                        ->options(function () {
                            $locale = App::getLocale();
                            return Page::with('translations')
                                ->get()
                                ->mapWithKeys(function ($page) use ($locale) {
                                    $translation = $page->translations->firstWhere('language.code', $locale);
                                    $label = $page->slug;

                                    if ($translation?->name) {
                                        $label .= ' — ' . $translation->name;
                                    }

                                    return [$page->id => $label];
                                });
                        })
                        ->required(),

                    self::contentComponentBuilder(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return PageContent::query()
                    ->with(['page.translations.language'])
                    ->firstPerPage();
            })
            ->columns([
                Tables\Columns\TextColumn::make('page.slug')
                    ->label(__('admin.page.slug')),

                Tables\Columns\TextColumn::make('page.language_codes')
                    ->label(__('admin.page.label'))
                    ->getStateUsing(function ($record) {
                        $page = $record->page()->with('translations.language')->first();
                        if (!$page) {
                            return '-';
                        }

                        $names = $page->translations
                            ->map(fn($t) => $t->language ? $t->language->name : '??')
                            ->unique()
                            ->all();

                        return implode("<br>", $names);
                    })
                    ->html(),

                Tables\Columns\TextColumn::make('page.translation_names')
                    ->label(__('admin.page.language'))
                    ->getStateUsing(function ($record) {
                        $page = $record->page()->with('translations.language')->first();
                        if (!$page) {
                            return '-';
                        }

                        $names = $page->translations
                            ->map(fn($t) => $t->name)
                            ->filter()
                            ->all();

                        return implode("<br>", $names);
                    })
                    ->html(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageContents::route('/'),
            'create' => Pages\CreatePageContent::route('/create'),
            'edit' => Pages\EditPageContent::route('/{record}/edit'),
        ];
    }

    public static function contentComponentBuilder(): \Filament\Forms\Components\Builder
    {
        $languages = Language::active();

        return \Filament\Forms\Components\Builder::make('content_components')
            ->label(__('admin.page_content.content'))
            ->collapsible()
            ->reorderable()
            ->addAction(fn($action) => $action
                ->label(__('admin.page_content.add_content_component'))
                ->icon('heroicon-o-plus')
                ->extraAttributes([
                    'style' => 'font-size: 1rem; line-height: 1.5rem;',
                    'class' => 'text-md px-6 py-3 ',
                ]))
            ->blocks([
                Block::make('section_heading')
                    ->label(__('admin.page_content.section_heading'))
                    ->schema([
                        Grid::make($languages->count())
                            ->schema(
                                $languages->map(fn($language) => TextInput::make('title_' . $language->code)
                                    ->label($language->name)
                                    ->maxLength(255)
                                    ->required()
                                )->toArray()
                            )
                    ]),

                Block::make('hero')
                    ->label(__('admin.page_content.hero.title'))
                    ->schema([
                        Grid::make()->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('title_' . $language->code)
                                            ->label(__('admin.page_content.hero.main_title'))
                                            ->maxLength(255)
                                            ->required(),
                                        TextInput::make('subtitle_' . $language->code)
                                            ->label(__('admin.page_content.hero.subtitle'))
                                            ->maxLength(255),
                                        Textarea::make('description_' . $language->code)
                                            ->label(__('admin.page_content.description'))
                                            ->rows(3),
                                    ])
                                )->toArray()
                            )
                    ]),

                Block::make('richtext')
                    ->label(__('admin.page_content.paragraph'))
                    ->schema([
                        Grid::make($languages->count())
                            ->schema(
                                $languages->map(fn($language) => RichEditor::make('content_' . $language->code)
                                    ->label($language->name)
                                    ->toolbarButtons([
                                        'bold', 'bulletList', 'h2', 'h3', 'italic',
                                        'orderedList', 'redo', 'strike', 'underline', 'undo',
                                    ])
                                    ->maxLength(100000)
                                )->toArray()
                            ),
                    ]),

                Block::make('image')
                    ->label(__('admin.page_content.image'))
                    ->schema([
                        FileUpload::make('path')
                            ->label(__('admin.page_content.image'))
                            ->placeholder(__('admin.common.file_upload_placeholder'))
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->directory('settings/tmp')
                            ->disk('public')
//                            ->imageEditor()
                            ->openable()
                            ->previewable()
                            ->required(),
                    ]),

                Block::make('carousel')
                    ->label(__('admin.page_content.carousel'))
                    ->schema([
                        FileUpload::make('images')
                            ->label(__('admin.page_content.carousel_images'))
                            ->placeholder(__('admin.common.file_upload_placeholder'))
                            ->directory('settings/carousel')
                            ->disk('public')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->openable()
                            ->previewable()
                            ->required(),
                    ]),

                Block::make('slider')
                    ->label(__('admin.page_content.slider'))
                    ->schema([
                        Repeater::make('slides')
                            ->label(__('admin.page_content.slider'))
                            ->reorderable()
                            ->collapsible()
                            ->schema([
                                FileUpload::make('image')
                                    ->label(__('admin.page_content.image'))
                                    ->placeholder(__('admin.common.file_upload_placeholder'))
                                    ->directory('settings/slider')
                                    ->disk('public')
                                    ->openable()
                                    ->previewable()
                                    ->required(),

                                Grid::make()
                                    ->columns($languages->count())
                                    ->schema(
                                        $languages->map(fn($language) => Fieldset::make($language->name)
                                            ->columnSpan(1)
                                            ->columns(1)
                                            ->schema([
                                                TextInput::make('title_' . $language->code)
                                                    ->label(__('admin.page_content.title'))
                                                    ->maxLength(255),

                                                TextInput::make('button_text_' . $language->code)
                                                    ->label(__('admin.page_content.button_text'))
                                                    ->maxLength(255),
                                            ])
                                        )->toArray()
                                    ),

                                Textarea::make('button_link')
                                    ->label(__('admin.page_content.button_link'))
                                    ->rows(2)
                                    ->maxLength(1000),
                            ])
                    ]),

                Block::make('custom_table')
                    ->label(__('admin.page_content.custom_table.label'))
                    ->schema([
                        Select::make('table_color')
                            ->label(__('admin.page_content.custom_table.color'))
                            ->options([
                                'red' => __('admin.common.attributes.colors.red'),
                                'yellow' => __('admin.common.attributes.colors.yellow'),
                                'green' => __('admin.common.attributes.colors.green'),
                                'sky' => __('admin.common.attributes.colors.blue'),
                                'purple' => __('admin.common.attributes.colors.purple'),
                                'gray' => __('admin.common.attributes.colors.gray'),
                            ])
                            ->required(),

                        Grid::make()
                            ->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        Section::make(__('admin.page_content.custom_table.add'))
                                            ->schema([
                                                TextInput::make('column_count_' . $language->code)
                                                    ->label(__('admin.page_content.custom_table.column_count'))
                                                    ->numeric()
                                                    ->default(3)
                                                    ->minValue(1)
                                                    ->maxValue(12)
                                                    ->required()
                                                    ->reactive(),

                                                Grid::make()
                                                    ->columns(3)
                                                    ->schema(fn(callable $get) => [
                                                        ...collect(range(0, ($get('column_count_' . $language->code) ?? 1) - 1))
                                                            ->map(fn($i) => TextInput::make("columns.$i.name_" . $language->code)
                                                                ->label(__('admin.page_content.custom_table.column_label', ['col' => chr(65 + $i)]))
                                                                ->validationAttribute(__('admin.page_content.custom_table.column_label', ['col' => chr(65 + $i)]))
                                                                ->required(),
                                                            )
                                                            ->toArray(),

                                                        Repeater::make('rows_' . $language->code)
                                                            ->label(__('admin.page_content.custom_table.row'))
                                                            ->itemLabel(function ($uuid, $component) {
                                                                $keys = array_keys($component->getState());
                                                                $index = array_search($uuid, $keys);
                                                                return __('admin.page_content.custom_table.row_label', ['index' => $index + 1]);
                                                            })
                                                            ->schema(fn(callable $get) => [
                                                                Grid::make()
                                                                    ->columns(3)
                                                                    ->schema(
                                                                        collect(range(0, ($get('column_count_' . $language->code) ?? 1) - 1))
                                                                            ->map(fn($i) => Repeater::make("cell_{$i}_" . $language->code)
                                                                                ->label(__('admin.page_content.custom_table.cell_label', ['col' => chr(65 + $i)]))
                                                                                ->schema([
                                                                                    TextInput::make('value')
                                                                                        ->label(__('admin.page_content.custom_table.cell_value')),
                                                                                ])
                                                                                ->addActionLabel(__('admin.page_content.custom_table.add_value'))
                                                                                ->minItems(1)
                                                                            )
                                                                            ->toArray()
                                                                    )
                                                            ])
                                                            ->columns(1)
                                                            ->columnSpanFull()
                                                            ->collapsible()
                                                            ->reorderable()
                                                            ->required(),
                                                    ])
                                            ]),
                                    ])
                                )->toArray()
                            ),
                    ]),

                Block::make('alternating_layout')
                    ->label(__('admin.page_content.alternating_layout.label'))
                    ->schema([
                        Repeater::make('blocks')
                            ->label(__('admin.page_content.content'))
                            ->reorderable()
                            ->collapsible()
                            ->schema([
                                FileUpload::make('image')
                                    ->label(__('admin.page_content.image'))
                                    ->placeholder(__('admin.common.file_upload_placeholder'))
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                    ->directory('settings/tmp')
                                    ->disk('public')
//                                    ->imageEditor()
                                    ->openable()
                                    ->previewable()
                                    ->required(),

                                Select::make('badge_color')
                                    ->label(__('admin.page_content.alternating_layout.badge_color'))
                                    ->options([
                                        'red' => __('admin.common.attributes.colors.red'),
                                        'yellow' => __('admin.common.attributes.colors.yellow'),
                                        'green' => __('admin.common.attributes.colors.green'),
                                        'sky' => __('admin.common.attributes.colors.blue'),
                                        'purple' => __('admin.common.attributes.colors.purple'),
                                        'gray' => __('admin.common.attributes.colors.gray'),
                                    ])
                                    ->required(),

                                Grid::make()
                                    ->columns($languages->count())
                                    ->schema(
                                        $languages->map(fn($language) => Fieldset::make($language->name)
                                            ->columnSpan(1)
                                            ->columns(1)
                                            ->schema([
                                                TextInput::make('badge_text_' . $language->code)
                                                    ->label(__('admin.page_content.alternating_layout.badge_text'))
                                                    ->required()
                                                    ->maxLength(50),

                                                TextInput::make('title_' . $language->code)
                                                    ->label(__('admin.page_content.title'))
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('description_' . $language->code)
                                                    ->label(__('admin.page_content.description'))
                                                    ->rows(4)
                                                    ->maxLength(1000),

                                                Textarea::make('checklist_items_' . $language->code)
                                                    ->label(__('admin.page_content.alternating_layout.checklist') . " (" . __('admin.page_content.semicolon_separated') . ")")
                                                    ->placeholder(__('admin.page_content.semicolon_separated'))
                                                    ->rows(2)
                                                    ->maxLength(1000)

                                            ])
                                        )->toArray()
                                    )

                            ])
                    ]),

                self::makeCardBlock('zigzag_layout'),
                self::makeCardBlock('grid_two_col_layout'),
                self::makeCardBlock('grid_two_col_card'),
                self::makeCardBlock('grid_three_col_layout'),
                self::makeCardBlock('grid_three_col_card'),
                self::makeCardBlock('grid_four_col_card'),
                self::makeCardBlock('grid_five_col_card'),
                self::makeCardBlock('service_card'),
                self::makeCardBlock('stack_card'),
                self::makeCardBlock('list_card'),
                self::makeCardBlock('chat_card'),

                Block::make('step_card')
                    ->label(__('admin.page_content.step_card.label'))
                    ->schema([
                        Select::make('title_color')
                            ->label(__('admin.page_content.step_card.title_color'))
                            ->options([
                                'red' => __('admin.common.attributes.colors.red'),
                                'yellow' => __('admin.common.attributes.colors.yellow'),
                                'green' => __('admin.common.attributes.colors.green'),
                                'sky' => __('admin.common.attributes.colors.blue'),
                                'purple' => __('admin.common.attributes.colors.purple'),
                                'gray' => __('admin.common.attributes.colors.gray'),
                            ])
                            ->required(),

                        Grid::make()
                            ->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('title_' . $language->code)
                                            ->label(__('admin.page_content.title'))
                                            ->required()
                                            ->maxLength(255),

                                        Textarea::make('description_' . $language->code)
                                            ->label(__('admin.page_content.description'))
                                            ->rows(3)
                                            ->maxLength(1000),

                                        Repeater::make('steps_' . $language->code)
                                            ->label(__('admin.page_content.step_card.steps'))
                                            ->schema([
                                                Textarea::make('step')
                                                    ->label("")
                                                    ->maxLength(1000)
                                                    ->rows(2),
                                            ])
                                            ->addActionLabel(__('admin.page_content.step_card.add_step'))
                                            ->reorderable()
                                            ->itemLabel(function ($uuid, $component) {
                                                $keys = array_keys($component->getState());
                                                $index = array_search($uuid, $keys);
                                                return __('admin.page_content.step_card.step') . " " . ($index + 1);
                                            }),
                                    ])
                                )->toArray()
                            ),
                    ]),

                Block::make('notice_card')
                    ->label(__('admin.page_content.notice_card.label'))
                    ->schema([
                        Select::make('color')
                            ->label(__('admin.page_content.notice_card.color'))
                            ->options([
                                'red' => __('admin.common.attributes.colors.red'),
                                'yellow' => __('admin.common.attributes.colors.yellow'),
                                'green' => __('admin.common.attributes.colors.green'),
                                'sky' => __('admin.common.attributes.colors.blue'),
                                'purple' => __('admin.common.attributes.colors.purple'),
                                'gray' => __('admin.common.attributes.colors.gray'),
                            ])
                            ->required(),

                        Grid::make()->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('title_' . $language->code)
                                            ->label(__('admin.page_content.title'))
                                            ->maxLength(255)
                                            ->required(),
                                        Textarea::make('content_' . $language->code)
                                            ->label(__('admin.page_content.content'))
                                            ->rows(2),
                                    ])
                                )->toArray()
                            )
                    ]),

                Block::make('intro_card')
                    ->label(__('admin.page_content.intro_card'))
                    ->schema([
                        Grid::make()
                            ->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('section_title_' . $language->code)
                                            ->label(__('admin.page_content.section_title'))
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                )->toArray()
                            ),

                        TextInput::make('icon')
                            ->label(__('admin.page_content.icon_class')),

                        Grid::make()->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('title_' . $language->code)
                                            ->label(__('admin.page_content.title'))
                                            ->maxLength(255)
                                            ->required(),
                                        Textarea::make('content_' . $language->code)
                                            ->label(__('admin.page_content.content'))
                                            ->rows(4),
                                    ])
                                )->toArray()
                            ),
                    ]),

                Block::make('number_card')
                    ->label(__('admin.page_content.number_card'))
                    ->schema([
                        Repeater::make('cards')
                            ->label(__('admin.page_content.number_card'))
                            ->itemLabel(function ($uuid, $component) {
                                $keys = array_keys($component->getState());
                                $index = array_search($uuid, $keys);
                                return __('admin.page_content.number_card') . ($index + 1);
                            })
                            ->reorderable()
                            ->collapsible()
                            ->columns(2)
                            ->addActionLabel(__('admin.page_content.add_card'))
                            ->schema([
                                TextInput::make('number')
                                    ->label(__('admin.common.attributes.value'))
                                    ->numeric()
                                    ->required(),

                                Grid::make()
                                    ->columns($languages->count())
                                    ->schema(
                                        $languages->map(fn($language) => Fieldset::make($language->name)
                                            ->columnSpan(1)
                                            ->columns(1)
                                            ->schema([
                                                TextInput::make('title_' . $language->code)
                                                    ->label(__('admin.page_content.title'))
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('description_' . $language->code)
                                                    ->label(__('admin.page_content.description'))
                                                    ->rows(3)
                                                    ->maxLength(1000),
                                            ])
                                        )->toArray()
                                    ),
                            ])
                    ]),

                Block::make('facility_card')
                    ->label(__('admin.page_content.facility_card.label'))
                    ->schema([
                        Select::make('card_color')
                            ->label(__('admin.page_content.facility_card.color'))
                            ->options([
                                'red' => __('admin.common.attributes.colors.red'),
                                'yellow' => __('admin.common.attributes.colors.yellow'),
                                'green' => __('admin.common.attributes.colors.green'),
                                'sky' => __('admin.common.attributes.colors.blue'),
                                'purple' => __('admin.common.attributes.colors.purple'),
                                'gray' => __('admin.common.attributes.colors.gray'),
                            ])
                            ->required(),

                        Repeater::make('cards')
                            ->label(__('admin.page_content.number_card'))
                            ->itemLabel(function ($uuid, $component) {
                                $keys = array_keys($component->getState());
                                $index = array_search($uuid, $keys);
                                return __('admin.page_content.number_card') . ($index + 1);
                            })
                            ->reorderable()
                            ->collapsible()
                            ->columns(2)
                            ->addActionLabel(__('admin.page_content.add_card'))
                            ->schema([
                                Grid::make()
                                    ->columns($languages->count())
                                    ->schema(
                                        $languages->map(fn($language) => Fieldset::make($language->name)
                                            ->columnSpan(1)
                                            ->columns(1)
                                            ->schema([
                                                TextInput::make('title_' . $language->code)
                                                    ->label(__('admin.page_content.title'))
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('items_' . $language->code)
                                                    ->label(__('admin.page_content.facility_card.items'))
                                                    ->rows(3)
                                                    ->maxLength(1000),
                                            ])
                                        )->toArray()
                                    ),
                            ]),
                    ]),

                Block::make('image_three_col_card')
                    ->label(__('admin.page_content.image_three_col_card'))
                    ->schema([
                        Grid::make()
                            ->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => TextInput::make('section_title_' . $language->code)
                                    ->label(__('admin.page_content.section_title') . ' - ' . $language->name)
                                    ->maxLength(255)
                                    ->required()
                                )->toArray()
                            ),

                        Repeater::make('cards')
                            ->label(__('admin.page_content.image_three_col_card'))
                            ->reorderable()
                            ->collapsible()
                            ->addActionLabel(__('admin.page_content.add_card'))
                            ->schema([
                                FileUpload::make('image')
                                    ->label(__('admin.page_content.image'))
                                    ->placeholder(__('admin.common.file_upload_placeholder'))
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                    ->directory('settings/tmp')
                                    ->disk('public')
                                    ->openable()
                                    ->previewable()
                                    ->required(),

                                Grid::make()
                                    ->columns($languages->count())
                                    ->schema(
                                        $languages->map(fn($language) => Fieldset::make($language->name)
                                            ->columnSpan(1)
                                            ->columns(1)
                                            ->schema([
                                                TextInput::make('title_' . $language->code)
                                                    ->label(__('admin.page_content.title'))
                                                    ->required()
                                                    ->maxLength(255),

                                                Textarea::make('description_' . $language->code)
                                                    ->label(__('admin.page_content.description'))
                                                    ->rows(3)
                                                    ->maxLength(1000),
                                            ])
                                        )->toArray()
                                    ),

                            ]),
                    ]),

                Block::make('icon_list_block')
                    ->label(__('admin.page_content.icon_list_block.label'))
                    ->schema([
                        Grid::make()
                            ->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('section_title_' . $language->code)
                                            ->label(__('admin.page_content.section_title'))
                                            ->maxLength(255)
                                            ->required(),
                                    ])
                                )->toArray()
                            ),

                        FileUpload::make('image')
                            ->label(__('admin.page_content.image'))
                            ->placeholder(__('admin.common.file_upload_placeholder'))
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->directory('settings/tmp')
                            ->disk('public')
//                                    ->imageEditor()
                            ->openable()
                            ->previewable()
                            ->required(),

                        Textarea::make('image_link')
                            ->label(__('admin.page_content.icon_list_block.image_link'))
                            ->rows(3)
                            ->maxLength(1000),

                        Repeater::make('items')
                            ->label(__('admin.page_content.item'))
                            ->reorderable()
                            ->collapsible()
                            ->schema([
                                TextInput::make('icon')
                                    ->label(__('admin.page_content.icon_class')),

                                Grid::make()
                                    ->columns($languages->count())
                                    ->schema(
                                        $languages->map(fn($language) => Fieldset::make($language->name)
                                            ->columnSpan(1)
                                            ->columns(1)
                                            ->schema([
                                                Textarea::make('description_' . $language->code)
                                                    ->label(__('admin.page_content.text'))
                                                    ->rows(2)
                                                    ->maxLength(1000)
                                            ])
                                        )->toArray()
                                    ),

                                Textarea::make('text_link')
                                    ->label(__('admin.page_content.icon_list_block.text_link'))
                                    ->rows(2)
                                    ->maxLength(1000),
                            ])
                    ]),
            ]);
    }

    private static function makeCardBlock(string $blockName): Block
    {
        $languages = Language::active();
        $labelKey = $blockName;

        return Block::make($blockName)
            ->label(__('admin.page_content.' . $labelKey))
            ->schema([
                Grid::make()
                    ->columns($languages->count())
                    ->schema(
                        $languages->map(fn($language) => Fieldset::make($language->name)
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                TextInput::make('section_title_' . $language->code)
                                    ->label(__('admin.page_content.section_title'))
                                    ->required()
                                    ->maxLength(255),
                            ])
                        )->toArray()
                    ),

                Repeater::make('cards')
                    ->label(__('admin.page_content.' . $labelKey))
                    ->itemLabel(function ($uuid, $component) use ($labelKey) {
                        $keys = array_keys($component->getState());
                        $index = array_search($uuid, $keys);
                        return __('admin.page_content.' . $labelKey) . ($index + 1);
                    })
                    ->reorderable()
                    ->collapsible()
                    ->columns(2)
                    ->addActionLabel(__('admin.page_content.add_card'))
                    ->schema([
                        TextInput::make('icon')
                            ->label(__('admin.page_content.icon_class'))
                            ->maxLength(255),

                        Grid::make()
                            ->columns($languages->count())
                            ->schema(
                                $languages->map(fn($language) => Fieldset::make($language->name)
                                    ->columnSpan(1)
                                    ->columns(1)
                                    ->schema([
                                        TextInput::make('title_' . $language->code)
                                            ->label(__('admin.page_content.title'))
                                            ->required()
                                            ->maxLength(255),

                                        Textarea::make('description_' . $language->code)
                                            ->label(__('admin.page_content.description'))
                                            ->rows(3)
                                            ->maxLength(1000),
                                    ])
                                )->toArray()
                            ),
                    ])
            ]);
    }

    public static function savePageContent(array $data): ?PageContent
    {
        $pageId = $data['page_id'];
        $components = $data['content_components'] ?? [];

        $languages = Language::active();

        $firstRecord = null;

        $page = Page::find($pageId);
        $slug = $page?->slug ?? 'unknown';

        foreach ($languages as $language) {
            $languageComponents = [];

            foreach ($components as $component) {
                $type = $component['type'] ?? null;
                $dataBlock = $component['data'] ?? [];

                $lang = $language->code;

                $blockData = ComponentTransformer::transform($type, $dataBlock, $lang, $slug);

                if (is_null($blockData)) {
                    continue;
                }

                $languageComponents[] = [
                    'type' => $type,
                    'data' => $blockData,
                ];
            }

            if (empty($languageComponents)) {
                continue;
            }

            $record = PageContent::updateOrCreate(
                [
                    'page_id' => $pageId,
                    'language_id' => $language->id,
                ],
                [
                    'content_components' => $languageComponents,
                ]
            );

            if (!$firstRecord) {
                $firstRecord = $record;
            }
        }

        return $firstRecord;
    }
}
