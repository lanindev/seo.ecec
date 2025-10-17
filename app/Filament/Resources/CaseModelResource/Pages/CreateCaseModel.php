<?php

namespace App\Filament\Resources\CaseModelResource\Pages;

use App\Filament\Resources\CaseModelResource;
use App\Services\ImageProcessingService;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateCaseModel extends CreateRecord
{
    protected static string $resource = CaseModelResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof TemporaryUploadedFile) {
            $data['thumbnail'] = $imageProcessingService->processTemporaryFile($data['thumbnail'], 'cases');
        }

        if (!empty($data['content_components'])) {
            foreach ($data['content_components'] as &$block) {
                if ($block['type'] === 'image' && isset($block['data']['path']) && $block['data']['path'] instanceof TemporaryUploadedFile) {
                    $block['data']['path'] = $imageProcessingService->processTemporaryFile($block['data']['path'], 'cases', $data['id'] ?? null);
                }
            }
        }

        return $data;
    }
}
