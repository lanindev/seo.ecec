<?php

namespace App\Filament\Resources\HomeSectionResource\HomeSectionManager;

use App\Models\HomeSection;
use App\Services\ImageProcessingService;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class SeoManager extends HomeSectionManager
{
    public static function getId(): string
    {
        return 'seo';
    }

    public function formSchema(): array
    {
        return [
            TextInput::make('data.title')
                ->label(__('admin.page_content.section_title'))
                ->required()
                ->maxLength(20),

            TextInput::make('data.subtitle')
                ->label(__('admin.page_content.subtitle'))
                ->required()
                ->maxLength(40),

            Repeater::make('data.cards')
                ->label(__('admin.page_content.content'))
                ->itemLabel(function ($uuid, $component) {
                    $keys = array_keys($component->getState());
                    $index = array_search($uuid, $keys);
                    return __('admin.common.attributes.card') . ($index + 1);
                })
                ->reorderable()
                ->collapsible()
                ->addActionLabel(__('admin.page_content.add_card'))
                ->maxItems(4)
                ->schema([
                    TextInput::make('icon')
                        ->label(__('admin.page_content.icon_class'))
                        ->required(),

                    TextInput::make('title')
                        ->label(__('admin.page_content.title'))
                        ->maxLength(10)
                        ->required(),

                    Textarea::make('content')
                        ->label(__('admin.page_content.content'))
                        ->rows(3)
                        ->required(),
                ]),

            TextInput::make('data.remark')
                ->label(__('admin.common.attributes.remark'))
                ->required()
                ->maxLength(40),


            Grid::make(2)
                ->schema([
                    TextInput::make('data.button_text')
                        ->label(__('admin.page_content.button_text'))
                        ->required()
                        ->maxLength(50),

                    TextInput::make('data.button_link')
                        ->label(__('admin.page_content.button_link'))
                        ->required(),
                ]),

            Fieldset::make(__('admin.home_section.seo.right_card'))
                ->schema([
                    TextInput::make('data.right_card_title')
                        ->label(__('admin.page_content.title'))
                        ->required()
                        ->maxLength(20),
                    Textarea::make('data.right_card_subtitle')
                        ->label(__('admin.page_content.subtitle'))
                        ->required()
                        ->maxLength(20),
                    FileUpload::make('data.right_card_image')
                        ->label(__('admin.page_content.image'))
                        ->acceptedFileTypes(['image/*'])
                        ->disk('public')
                        ->openable()
                        ->previewable()
                        ->required()
                        ->columnSpanFull()
                        ->storeFiles(false),
                ])
                ->columns(1),
        ];
    }

    public function mutateFormDataBeforeSave(HomeSection $section, array $data): array
    {
        $imageProcessingService = app(ImageProcessingService::class);
        if (isset($data['data']['right_card_image']) && $data['data']['right_card_image'] instanceof TemporaryUploadedFile) {
            $optimized = $imageProcessingService->processTemporaryFile($data['data']['right_card_image'], 'home_sections/seo');

            if ($optimized) {
                if (isset($data['data']['right_card_image'])) {
                    Storage::disk('public')->delete($data['data']['right_card_image']);
                }
                $data['data']['right_card_image'] = $optimized;
            }

        }

        return $data;
    }
}
