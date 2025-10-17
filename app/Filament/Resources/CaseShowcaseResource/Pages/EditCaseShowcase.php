<?php

namespace App\Filament\Resources\CaseShowcaseResource\Pages;

use App\Filament\Resources\CaseShowcaseResource;
use App\Services\ImageProcessingService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditCaseShowcase extends EditRecord
{
    protected static string $resource = CaseShowcaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $imageService = app(ImageProcessingService::class);

        if (!empty($data['content_components']['logo'] ?? null)) {
            if ($data['content_components']['logo'] instanceof TemporaryUploadedFile) {
                $optimizedLogo = $imageService->processTemporaryFile($data['content_components']['logo'], 'case_showcases');
                if ($optimizedLogo) {
                    if (!empty($this->record->content_components['logo'])) {
                        Storage::disk('public')->delete($this->record->content_components['logo']);
                    }
                    $data['content_components']['logo'] = $optimizedLogo;
                }
            }
        }

        if (!empty($data['content_components']['image'] ?? null)) {
            if ($data['content_components']['image'] instanceof TemporaryUploadedFile) {
                $optimizedImage = $imageService->processTemporaryFile($data['content_components']['image'], 'case_showcases');
                if ($optimizedImage) {
                    if (!empty($this->record->content_components['image'])) {
                        Storage::disk('public')->delete($this->record->content_components['image']);
                    }
                    $data['content_components']['image'] = $optimizedImage;
                }
            }
        }

        if (!empty($data['content_components']['carousel'] ?? null)) {
            foreach ($data['content_components']['carousel'] as $key => $file) {
                if ($file instanceof TemporaryUploadedFile) {
                    $optimizedCarousel = $imageService->processTemporaryFile($file, 'case_showcases');
                    if ($optimizedCarousel) {
                        $oldPath = $this->record->content_components['carousel'][$key] ?? null;
                        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                        $data['content_components']['carousel'][$key] = $optimizedCarousel;
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
