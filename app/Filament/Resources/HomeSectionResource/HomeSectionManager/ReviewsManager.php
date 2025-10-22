<?php

namespace App\Filament\Resources\HomeSectionResource\HomeSectionManager;

use App\Models\HomeSection;
use App\Services\ImageProcessingService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class ReviewsManager extends HomeSectionManager
{
    public static function getId(): string
    {
        return 'reviews';
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
        ];
    }
}
