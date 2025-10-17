<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseModelResource\Pages;
use App\Filament\Resources\CaseModelResource\RelationManagers;
use App\Models\CaseModel;
use App\Models\CaseType;
use App\Services\ImageProcessingService;
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

class CaseModelResource extends Resource
{
    protected static ?string $model = CaseModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.case.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.case.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.case.case');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.case.resource_label');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->orderByDesc('created_at');
    }

    protected ImageProcessingService $imageProcessingService;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('admin.case.name'))
                    ->required(),

                Select::make('case_type_id')
                    ->label(__('admin.case.type.label'))
                    ->options(CaseType::pluck('name', 'id'))
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label(__('admin.case.type.name'))
                            ->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return CaseType::firstOrCreate([
                            'name' => $data['name'],
                        ])->getKey();
                    })
                    ->searchable(false)
                    ->native(false)
                    ->required(),

                FileUpload::make('cover')
                    ->label(__('admin.common.attributes.thumbnail'))
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->openable()
                    ->previewable()
                    ->required()
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
                    ->label(__('admin.case.name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('caseType.name')
                    ->label(__('admin.case.type.label'))
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
            'index' => Pages\ListCaseModels::route('/'),
            'create' => Pages\CreateCaseModel::route('/create'),
            'edit' => Pages\EditCaseModel::route('/{record}/edit'),
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
