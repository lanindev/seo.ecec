<?php

namespace App\Filament\Resources\CaseShowcaseResource\Pages;

use App\Filament\Resources\CaseShowcaseResource;
use App\Services\ImageProcessingService;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateCaseShowcase extends CreateRecord
{
    protected static string $resource = CaseShowcaseResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $imageService = app(ImageProcessingService::class);

        if (!empty($data['content_components']['logo'] ?? null)) {
            $data['content_components']['logo'] = $imageService->processTemporaryFile(
                $data['content_components']['logo'],
                'case_showcases',
            );
        }

        if (!empty($data['content_components']['image'] ?? null)) {
            $data['content_components']['image'] = $imageService->processTemporaryFile(
                $data['content_components']['image'],
                'case_showcases',
            );
        }

        if (!empty($data['content_components']['carousel'] ?? null)) {
            foreach ($data['content_components']['carousel'] as $key => $file) {
                if ($file instanceof TemporaryUploadedFile) {
                    $data['content_components']['carousel'][$key] = $imageService->processTemporaryFile(
                        $file,
                        'case_showcases'
                    );
                }
            }
        }
        
        return $data;
    }
}
