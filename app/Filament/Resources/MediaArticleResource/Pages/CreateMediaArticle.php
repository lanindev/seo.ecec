<?php

namespace App\Filament\Resources\MediaArticleResource\Pages;

use App\Filament\Resources\MediaArticleResource;
use App\Services\ImageProcessingService;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateMediaArticle extends CreateRecord
{
    protected static string $resource = MediaArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof TemporaryUploadedFile) {
            $data['thumbnail'] = $imageProcessingService->processTemporaryFile($data['thumbnail'], 'media_articles');
        }

        if (!empty($data['content_components'])) {
            foreach ($data['content_components'] as &$block) {
                if ($block['type'] === 'image' && isset($block['data']['path']) && $block['data']['path'] instanceof TemporaryUploadedFile) {
                    $block['data']['path'] = $imageProcessingService->processTemporaryFile($block['data']['path'], 'media_articles', $data['id'] ?? null);
                }
            }
        }

        return $data;
    }
}
