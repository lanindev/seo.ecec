<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $type = $data['type'] ?? null;

        $data['value_text'] = $type === 'text' ? $data['value'] : null;
        $data['value_richtext'] = $type === 'richtext' ? $data['value'] : null;
        $data['value_image'] = $type === 'image' ? $data['value'] : null;

        if (isset($data['key'])) {
            $data['key'] = Str::after($data['key'], '.');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return SettingResource::formatData($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
