<?php

namespace App\Filament\Resources\HomeSectionResource\HomeSectionManager;

use App\Models\HomeSection;
use App\Services\ImageProcessingService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaManager extends HomeSectionManager
{
    public static function getId(): string
    {
        return 'media';
    }

    public function formSchema(): array
    {

        return [
            TextInput::make('data.title')
                ->label(__('admin.home_section.media.title'))
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

        if (!empty($data['data']['images'])) {
            $optimizedImages = [];

            foreach ($data['data']['images'] as $image) {
                if ($image instanceof TemporaryUploadedFile) {
                    $optimized = $imageProcessingService->processTemporaryFile($image, 'home_sections/media');

                    if ($optimized) {
                        $optimizedImages[] = $optimized;

                        if (isset($data['data']['images'])) {
                            Storage::disk('public')->delete($data['data']['images']);
                        }
                    }
                } else {
                    $optimizedImages[] = $image;
                }
            }

            $data['data']['images'] = $optimizedImages;
        }

        return $data;
    }
}
