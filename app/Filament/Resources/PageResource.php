<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\Models\Language;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation_group.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.page.label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.page.label');
    }

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(1)->schema([
                Forms\Components\TextInput::make('slug')
                    ->label(__('admin.page.slug'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Repeater::make('translations')
                    ->relationship()
                    ->label(__('admin.page.language'))
                    ->itemLabel(__('admin.actions.create') . __('admin.page.language'))
                    ->schema([
                        Forms\Components\Select::make('language_id')
                            ->label(__('admin.page.language'))
                            ->options(Language::active()->pluck('name', 'id'))
                            ->required(),

                        Forms\Components\TextInput::make('name')
                            ->label(__('admin.page.page_name'))
                            ->required()
                            ->maxLength(255),
                    ])
                    ->minItems(1)
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')->label(__('admin.page.slug')),

                Tables\Columns\TextColumn::make('languages')
                    ->label(__('admin.page.languages'))
                    ->getStateUsing(fn(Page $record) => implode(', ', $record->translations->map(fn($t) => $t->language->name)->toArray())
                    ),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('translations.language');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
