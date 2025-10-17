<?php

namespace App\Filament\Resources\SeoSectionResource\SeoSectionManager;

use App\Models\SeoSection;
use App\Services\ImageProcessingService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class BannerManager extends SeoSectionManager
{
    public static function getId(): string
    {
        return 'banner';
    }

    public function formSchema(): array
    {

        return [
            Grid::make(2)->schema([
                Textarea::make('data.title')
                    ->label(__('admin.home_section.banner.title'))
                    ->rows(2)
                    ->required()
                    ->maxLength(20),

                Textarea::make('data.subtitle')
                    ->label(__('admin.home_section.banner.subtitle'))
                    ->rows(2)
                    ->required()
                    ->maxLength(40),
            ]),


            Grid::make(3)
                ->schema([
                    TextInput::make('data.button1_text')
                        ->label(__('admin.page_content.button_text'))
                        ->required()
                        ->maxLength(50),

                    Select::make('data.button1_color')
                        ->label(__('admin.page_content.button_color'))
                        ->options([
                            'red' => __('admin.common.attributes.colors.red'),
                            'yellow' => __('admin.common.attributes.colors.yellow'),
                            'green' => __('admin.common.attributes.colors.green'),
                            'sky' => __('admin.common.attributes.colors.blue'),
                            'purple' => __('admin.common.attributes.colors.purple'),
                            'gray' => __('admin.common.attributes.colors.gray'),
                        ])
                        ->required(),

                    TextInput::make('data.button1_link')
                        ->label(__('admin.page_content.button_link'))
                        ->required(),
                ]),

            Grid::make(3)
                ->schema([
                    TextInput::make('data.button2_text')
                        ->label(__('admin.page_content.button_text'))
                        ->required()
                        ->maxLength(50),

                    Select::make('data.button2_color')
                        ->label(__('admin.page_content.button_color'))
                        ->options([
                            'red' => __('admin.common.attributes.colors.red'),
                            'yellow' => __('admin.common.attributes.colors.yellow'),
                            'green' => __('admin.common.attributes.colors.green'),
                            'sky' => __('admin.common.attributes.colors.blue'),
                            'purple' => __('admin.common.attributes.colors.purple'),
                            'gray' => __('admin.common.attributes.colors.gray'),
                        ])
                        ->required(),

                    TextInput::make('data.button2_link')
                        ->label(__('admin.page_content.button_link'))
                        ->required(),
                ]),

            FileUpload::make('data.image')
                ->label(__('admin.home_section.banner.image'))
                ->acceptedFileTypes(['image/*'])
                ->disk('public')
                ->openable()
                ->previewable()
                ->required()
                ->columnSpanFull()
                ->storeFiles(false),
        ];
    }

    public function mutateFormDataBeforeSave(SeoSection $section, array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);
        if (isset($data['data']['image']) && $data['data']['image'] instanceof TemporaryUploadedFile) {
            $optimized = $imageProcessingService->processTemporaryFile($data['data']['image'], 'seo_sections/banner');

            if ($optimized) {
                if (isset($data['data']['image'])) {
                    Storage::disk('public')->delete($data['data']['image']);
                }
                $data['data']['image'] = $optimized;
            }

        }

        return $data;
    }
}
