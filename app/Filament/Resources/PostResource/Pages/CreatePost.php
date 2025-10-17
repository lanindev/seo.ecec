<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Services\ImageProcessingService;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof TemporaryUploadedFile) {
            $data['thumbnail'] = $imageProcessingService->processTemporaryFile($data['thumbnail'], 'posts');
        }

        if (!empty($data['content_components'])) {
            foreach ($data['content_components'] as &$block) {
                if ($block['type'] === 'image' && isset($block['data']['path']) && $block['data']['path'] instanceof TemporaryUploadedFile) {
                    $block['data']['path'] = $imageProcessingService->processTemporaryFile($block['data']['path'], 'posts', $data['id'] ?? null);
                }
            }
        }
        
        $data['published_at'] = now();

        return $data;
    }
}
