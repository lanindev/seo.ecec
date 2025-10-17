<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoSectionResource\Pages;
use App\Filament\Resources\SeoSectionResource\RelationManagers;
use App\Models\SeoSection;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeoSectionResource extends Resource
{
    protected static ?string $model = SeoSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?int $navigationSort = 7;

//    public static function getNavigationGroup(): ?string
//    {
//        return __('admin.seo_section.resource');
//    }

    public static function getNavigationLabel(): string
    {
        return __('admin.seo_section.resource');
    }

    public static function getModelLabel(): string
    {
        return __('admin.seo_section.resource');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')
                    ->label(__('admin.common.attributes.key'))
                    ->required(),

                TextInput::make('name')
                    ->label(__('admin.seo_section.name'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('admin.seo_section.name')),
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
            'index' => Pages\ListSeoSections::route('/'),
            'create' => Pages\CreateSeoSection::route('/create'),
            'edit' => Pages\EditSeoSection::route('/{record}/edit'),
        ];
    }
}
