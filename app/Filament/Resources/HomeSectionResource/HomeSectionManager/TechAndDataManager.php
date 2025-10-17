<?php

namespace App\Filament\Resources\HomeSectionResource\HomeSectionManager;

use App\Models\HomeSection;
use App\Services\ImageProcessingService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class TechAndDataManager extends HomeSectionManager
{
    public static function getId(): string
    {
        return 'tech_and_data';
    }

    public function formSchema(): array
    {

        return [
            Textarea::make('data.title')
                ->label(__('admin.page_content.section_title'))
                ->required()
                ->minLength(10)
                ->maxLength(30),

            FileUpload::make('data.images')
                ->label(__('admin.common.attributes.images'))
                ->acceptedFileTypes(['image/*'])
                ->disk('public')
                ->multiple()
                ->reorderable()
                ->image()
                ->openable()
                ->previewable()
                ->required()
                ->storeFiles(false),
        ];
    }

    public function mutateFormDataBeforeSave(HomeSection $section, array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);

        $optimizedImages = [];

        if (!empty($data['data']['images'])) {
            foreach ($data['data']['images'] as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $optimized = $imageProcessingService->processTemporaryFile($image, 'home_sections/tech_and_data');

                    if ($optimized) {
                        $optimizedImages[] = $optimized;
                    }
                } else {
                    $optimizedImages[] = $image;
                }
            }

            if (!empty($section->data['images'])) {
                $imagesToDelete = array_diff($section->data['images'], $optimizedImages);

                foreach ($imagesToDelete as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            $data['data']['images'] = $optimizedImages;
        }

        return $data;
    }

}
