<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 31;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.post.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.post.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.post.resource_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.post.resource_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('admin.post.title'))
                    ->required(),

                Select::make('category_id')
                    ->label(__('admin.post_category.label'))
                    ->options(PostCategory::pluck('name', 'id'))
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label(__('admin.post_category.name'))
                            ->required(),

                        TextInput::make('slug')
                            ->label(__('admin.page.slug'))
                            ->required()
                            ->unique(PostCategory::class, 'slug', ignoreRecord: true),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return PostCategory::firstOrCreate([
                            'name' => $data['name'],
                        ])->getKey();
                    })
                    ->searchable(false)
                    ->native(false)
                    ->required(),

                FileUpload::make('thumbnail')
                    ->label(__('admin.common.attributes.thumbnail'))
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->openable()
                    ->previewable()
                    ->columnSpanFull()
                    ->storeFiles(false),

                Grid::make(1)
                    ->schema([
                        self::contentComponentBuilder(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.post.title'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('admin.post_category.name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.attributes.created_at'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.common.attributes.updated_at'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function contentComponentBuilder(): \Filament\Forms\Components\Builder
    {
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
                Block::make('richtext')
                    ->label(__('admin.page_content.content_text'))
                    ->schema([
                        RichEditor::make('content')
                            ->label(__('admin.page_content.content_text'))
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->maxLength(100000)
                            ->required(),
                    ]),

                Block::make('image')
                    ->label(__('admin.page_content.image'))
                    ->schema([
                        FileUpload::make('path')
                            ->label(__('admin.page_content.image'))
                            ->acceptedFileTypes(['image/*'])
                            ->disk('public')
                            ->openable()
                            ->previewable()
                            ->required()
                            ->storeFiles(false),
                    ]),

            ]);
    }
}
