<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaArticleResource\Pages;
use App\Filament\Resources\MediaArticleResource\RelationManagers;
use App\Models\MediaArticle;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaArticleResource extends Resource
{
    protected static ?string $model = MediaArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 6;

//    public static function getNavigationGroup(): ?string
//    {
//        return __('admin.media_article.label');
//    }

    public static function getNavigationLabel(): string
    {
        return __('admin.media_article.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.media_article.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.media_article.resource_label');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->orderByDesc('created_at');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('admin.common.attributes.title'))
                    ->required(),

                FileUpload::make('thumbnail')
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
                    ->label(__('admin.common.attributes.title'))
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
            'index' => Pages\ListMediaArticles::route('/'),
            'create' => Pages\CreateMediaArticle::route('/create'),
            'edit' => Pages\EditMediaArticle::route('/{record}/edit'),
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
