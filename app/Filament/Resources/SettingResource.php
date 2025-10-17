<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    public static function getModelLabel(): string
    {
        return __('admin.settings.label');
    }

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    public static function getNavigationLabel(): string
    {
        return __('admin.settings.navigation_label');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.settings.navigation_group');
    }

    protected static ?int $navigationSort = 99;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('key')
                    ->label(__('admin.common.attributes.key'))
                    ->unique(ignoreRecord: true)
                    ->dehydrateStateUsing(fn($state, $get) => strtolower($get('group')) . '.' . trim($state))
                    ->afterStateHydrated(fn(\Filament\Forms\Set $set, $state) => $set('key', Str::after($state, '.')))
                    ->required(),

                Select::make('type')
                    ->label(__('admin.common.attributes.type'))
                    ->options([
                        'text' => __('admin.common.attributes.text'),
                        'content' => __('admin.common.attributes.content'),
                        'richtext' => __('admin.common.attributes.richtext'),
                        'image' => __('admin.common.attributes.image'),
                    ])
                    ->required()
                    ->live()
                    ->reactive(),

                TextInput::make('display_name')
                    ->label(__('admin.settings.display_name'))
                    ->required(),

                Select::make('group')
                    ->label(__('admin.groups.label'))
                    ->options([
                        'Site' => __('admin.groups.site'),
                        'Admin' => __('admin.groups.admin'),
                    ])
                    ->required(),

                Group::make([
                    TextInput::make('value_text')
                        ->label(__('admin.common.attributes.value'))
                        ->visible(fn(Forms\Get $get) => $get('type') === 'text'),

                    Textarea::make('value_content')
                        ->label(__('admin.common.attributes.content'))
                        ->visible(fn(Forms\Get $get) => $get('type') === 'content')
                        ->maxLength(1000)
                        ->rows(2),

                    RichEditor::make('value_richtext')
                        ->label(__('admin.common.attributes.value'))
                        ->visible(fn(Forms\Get $get) => $get('type') === 'richtext'),

                    FileUpload::make('value_image')
                        ->label(__('admin.common.attributes.image'))
                        ->placeholder(__('admin.common.file_upload_placeholder'))
                        ->directory('settings/tmp')
                        ->disk('public')
                        ->openable()
                        ->previewable()
                        ->visible(fn(Forms\Get $get) => $get('type') === 'image'),
                ])
                    ->columns(1),

            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                TextColumn::make('display_name')
                    ->label(__('admin.settings.display_name')),

//                TextColumn::make('key')
//                    ->label(__('admin.common.attributes.key')),

                TextColumn::make('value')
                    ->label(__('admin.common.attributes.value'))
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->type === 'image' && $state) {
                            return view('filament.admin.setting_image_preview', [
                                'src' => $state,
                            ])->render();
                        }
                        return Str::limit(strip_tags($state), 30);
                    })
                    ->html()
                    ->wrap(),

                TextColumn::make('type')
                    ->label(__('admin.common.attributes.type'))
                    ->badge()
                    ->color('info'),

                TextColumn::make('group')
                    ->label(__('admin.groups.label'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Site' => 'primary',
                        'Admin' => 'danger',
                    }),
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
            ->defaultSort('group');
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

    public static function formatData(array $data): array
    {
        if (!str_starts_with($data['key'], strtolower($data['group']) . '.')) {
            $data['key'] = strtolower($data['group']) . '.' . trim($data['key']);
        }

        if ($data['type'] === 'image' && isset($data['value_image'])) {
            $pureKey = Str::after($data['key'], '.');
            $extension = pathinfo($data['value_image'], PATHINFO_EXTENSION);
            $filename = $pureKey . '.' . $extension;

            \Storage::disk('public')->move(
                $data['value_image'],
                'settings/' . $filename
            );

            $data['value_image'] = 'settings/' . $filename;
        }

        $data['value'] = match ($data['type']) {
            'text' => $data['value_text'] ?? null,
            'content' => $data['value_content'] ?? null,
            'richtext' => $data['value_richtext'] ?? null,
            'image' => $data['value_image'] ?? null,
            default => null,
        };

        unset($data['value_text'], $data['value_content'], $data['value_richtext'], $data['value_image']);

        return $data;
    }
}
