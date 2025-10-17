<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\CaseModel;
use App\Models\MediaArticle;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [
            Actions\CreateAction::make(),
        ];

        if (!app()->isProduction()) {
            $actions[] = Actions\Action::make('clearTmp')
                ->label('清理暫存')
                ->color('warning')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    if (Storage::disk('local')->exists('livewire-tmp')) {
                        Storage::disk('local')->deleteDirectory('livewire-tmp');
                        Storage::disk('local')->makeDirectory('livewire-tmp');
                    }

                    Notification::make()
                        ->title('暫存已清理')
                        ->success()
                        ->send();
                });

            $actions[] = Actions\Action::make('clearAll')
                ->label('一鍵清除')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    CaseModel::truncate();
                    MediaArticle::truncate();

                    if (Storage::disk('public')->exists('cases')) {
                        Storage::disk('public')->deleteDirectory('cases');
                    }

                    if (Storage::disk('public')->exists('media_articles')) {
                        Storage::disk('public')->deleteDirectory('media_articles');
                    }

                    if (Storage::disk('local')->exists('livewire-tmp')) {
                        Storage::disk('local')->deleteDirectory('livewire-tmp');
                    }

                    Notification::make()
                        ->title('已清除所有資料與暫存')
                        ->success()
                        ->send();
                });
        }

        return $actions;
    }
}
