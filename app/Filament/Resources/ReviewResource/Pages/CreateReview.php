<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Services\ImageProcessingService;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateReview extends CreateRecord
{
    protected static string $resource = ReviewResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        if (isset($data['cover']) && $data['cover'] instanceof TemporaryUploadedFile) {
            $data['cover'] = $imageProcessingService->processTemporaryFile($data['cover'], 'reviews');
        }

        return $data;
    }
}
