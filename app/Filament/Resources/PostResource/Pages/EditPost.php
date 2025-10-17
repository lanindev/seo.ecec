<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Services\ImageProcessingService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof TemporaryUploadedFile) {
            $optimizedThumbnail = $imageProcessingService->processTemporaryFile($data['thumbnail'], 'posts');

            if ($optimizedThumbnail) {
                if ($this->record->thumbnail) {
                    Storage::disk('public')->delete($this->record->thumbnail);
                }
                $data['thumbnail'] = $optimizedThumbnail;
            }
        }

        if (!empty($data['content_components'])) {
            foreach ($data['content_components'] as &$block) {
                if ($block['type'] === 'image' && isset($block['data']['path'])) {
                    $newPath = $block['data']['path'];

                    if ($newPath instanceof TemporaryUploadedFile) {
                        $optimizedPath = $imageProcessingService->processTemporaryFile($newPath, 'posts');

                        if ($optimizedPath) {
                            if (isset($block['data']['path_old'])) {
                                Storage::disk('public')->delete($block['data']['path_old']);
                            }
                            $block['data']['path'] = $optimizedPath;
                        }
                    }
                }
            }
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
