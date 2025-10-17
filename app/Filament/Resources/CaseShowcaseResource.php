<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseShowcaseResource\Pages;
use App\Filament\Resources\CaseShowcaseResource\RelationManagers;
use App\Models\CaseShowcase;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaseShowcaseResource extends Resource
{
    protected static ?string $model = CaseShowcase::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.case.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.case_showcase.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.case_showcase.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.case_showcase.resource_label');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->orderByDesc('created_at');
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('admin.case_showcase.name'))
                    ->required(),

                Section::make(__('admin.common.attributes.content'))
                    ->schema([
                        ColorPicker::make('content_components.color')
                            ->label(__('admin.case_showcase.content.color'))->columns(1),

                        FileUpload::make('content_components.logo')
                            ->label(__('admin.case_showcase.content.case_logo'))
                            ->acceptedFileTypes(['image/*'])
                            ->disk('public')
                            ->openable()
                            ->previewable()
                            ->required()
                            ->storeFiles(false)
                            ->image(),

                        FileUpload::make('content_components.image')
                            ->label(__('admin.common.attributes.image'))
                            ->acceptedFileTypes(['image/*'])
                            ->disk('public')
                            ->openable()
                            ->previewable()
                            ->required()
                            ->storeFiles(false),

                        FileUpload::make('content_components.carousel')
                            ->label(__('admin.common.attributes.images'))
                            ->acceptedFileTypes(['image/*'])
                            ->disk('public')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->openable()
                            ->previewable()
                            ->required()
                            ->storeFiles(false),

                        Grid::make(3)->schema([
                            Textarea::make('content_components.client_intro')
                                ->label(__('admin.case_showcase.content.client_intro'))
                                ->rows(4),

                            Textarea::make('content_components.solution')
                                ->label(__('admin.case_showcase.content.solution'))
                                ->rows(4),

                            Textarea::make('content_components.result')
                                ->label('成效')
                                ->rows(4),
                        ]),

                        Repeater::make('content_components.statistics')
                            ->label(__('admin.case_showcase.content.statistics_display'))
                            ->schema([
                                TextInput::make('number')
                                    ->label(__('admin.case_showcase.content.statistics.number'))
                                    ->numeric(),

                                TextInput::make('unit')
                                    ->label(__('admin.case_showcase.content.statistics.unit')),

                                TextInput::make('label')
                                    ->label(__('admin.case_showcase.content.statistics.label')),
                            ])
                            ->columns(3)
                            ->minItems(0)
                            ->maxItems(2),

                        Section::make(__('admin.page_content.button'))
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('content_components.button.text')
                                            ->label(__('admin.page_content.button_text')),

                                        TextInput::make('content_components.button.url')
                                            ->label(__('admin.page_content.button_link'))
                                            ->url(),
                                    ]),
                            ])

                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.case_showcase.name'))
                    ->sortable()
                    ->searchable(),

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
            'index' => Pages\ListCaseShowcases::route('/'),
            'create' => Pages\CreateCaseShowcase::route('/create'),
            'edit' => Pages\EditCaseShowcase::route('/{record}/edit'),
        ];
    }
}
