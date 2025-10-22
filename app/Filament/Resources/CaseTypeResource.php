<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseTypeResource\Pages;
use App\Filament\Resources\CaseTypeResource\RelationManagers;
use App\Models\CaseType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaseTypeResource extends Resource
{
    protected static ?string $model = CaseType::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 20;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.case.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.case.type.resource_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.case.type.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.case.type.label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('admin.case.type.name'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.case.type.name')),
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
            'index' => Pages\ListCaseTypes::route('/'),
            'create' => Pages\CreateCaseType::route('/create'),
            'edit' => Pages\EditCaseType::route('/{record}/edit'),
        ];
    }
}
