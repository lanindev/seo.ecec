<?php

namespace App\Filament\Resources\CaseModelResource\Pages;

use App\Filament\Resources\CaseModelResource;
use App\Services\ImageProcessingService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditCaseModel extends EditRecord
{
    protected static string $resource = CaseModelResource::class;

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
            $optimizedCover = $imageProcessingService->processTemporaryFile($data['cover'], 'cases');

            if ($optimizedCover) {
                if ($this->record->cover) {
                    Storage::disk('public')->delete($this->record->cover);
                }
                $data['cover'] = $optimizedCover;
            }
        }

        if (!empty($data['content_components'])) {
            foreach ($data['content_components'] as &$block) {
                if ($block['type'] === 'image' && isset($block['data']['path'])) {
                    $newPath = $block['data']['path'];

                    if ($newPath instanceof TemporaryUploadedFile) {
                        $optimizedPath = $imageProcessingService->processTemporaryFile($newPath, 'cases');

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
