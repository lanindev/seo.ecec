<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Services\ImageProcessingService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditReview extends EditRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        if (isset($data['cover']) && $data['cover'] instanceof TemporaryUploadedFile) {
            $optimizedCover = $imageProcessingService->processTemporaryFile($data['cover'], 'reviews');

            if ($optimizedCover) {
                if ($this->record->cover) {
                    Storage::disk('public')->delete($this->record->cover);
                }
                $data['cover'] = $optimizedCover;
            }
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
