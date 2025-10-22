<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 5;

//    public static function getNavigationGroup(): ?string
//    {
//        return __('admin.navigation_group.label');
//    }

    public static function getNavigationLabel(): string
    {
        return __('admin.review.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.review.review');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.review.resource_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.review.client_info'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('admin.review.name'))
                            ->maxLength(255)
                            ->required(),

                        TextInput::make('title')
                            ->label(__('admin.review.title'))
                            ->maxLength(255)
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('admin.review.review'))
                    ->schema([
                        Select::make('stars')
                            ->label(__('admin.review.stars'))
                            ->options([
                                5 => '★★★★★ (5)',
                                4 => '★★★★ (4)',
                                3 => '★★★ (3)',
                                2 => '★★ (2)',
                                1 => '★ (1)',
                            ])
                            ->default(5)
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

                        TextInput::make('video_url')
                            ->label(__('admin.review.video_url'))
                            ->placeholder('https://www.youtube.com/watch?v=xxxxx')
                            ->url()
                            ->maxLength(255)
                            ->nullable(),

                        Textarea::make('comment')
                            ->label(__('admin.review.comment'))
                            ->rows(10)
                            ->maxLength(2000)
                            ->nullable()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label(__('admin.common.attributes.thumbnail')),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.review.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.review.title')),

                Tables\Columns\TextColumn::make('stars')
                    ->label(__('admin.review.stars'))
                    ->sortable()
                    ->formatStateUsing(fn($state) => '<span class="text-yellow-400">' . str_repeat('★', intval($state)) . str_repeat('☆', 5 - intval($state)) . '</span>')
                    ->html(),
                
                Tables\Columns\TextColumn::make('video_url')
                    ->label(__('admin.review.video_url'))
                    ->url(fn($record) => $record->video_url, true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.common.attributes.created_at'))
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
