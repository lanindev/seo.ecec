<?php

namespace App\Filament\Resources\PageContentResource\Pages;

use App\Filament\Resources\PageContentResource;
use App\Models\Language;
use App\Models\Page;
use App\Models\PageContent;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreatePageContent extends CreateRecord
{
    protected static string $resource = PageContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return [];
    }

    public function create(bool $another = false): void
    {
        $data = $this->form->getState();

        $firstRecord = PageContentResource::savePageContent($data);

        $this->record = $firstRecord;

        Notification::make()
            ->title(__('filament-panels::resources/pages/create-record.notifications.created.title'))
            ->success()
            ->send();

        if (!$another) {
            $this->redirect($this->getRedirectUrl());
        } else {
            $this->form->fill();
        }
    }
}
