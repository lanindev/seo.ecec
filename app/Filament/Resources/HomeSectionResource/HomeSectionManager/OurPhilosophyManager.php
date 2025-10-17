<?php

namespace App\Filament\Resources\HomeSectionResource\HomeSectionManager;

use App\Models\HomeSection;
use App\Services\ImageProcessingService;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class OurPhilosophyManager extends HomeSectionManager
{
    public static function getId(): string
    {
        return 'our_philosophy';
    }

    public function formSchema(): array
    {
        return [
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
                ->maxItems(3)
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


            Grid::make(3)
                ->schema([
                    TextInput::make('data.button_icon')
                        ->label(__('admin.page_content.icon_class'))
                        ->required(),

                    TextInput::make('data.button_text')
                        ->label(__('admin.page_content.button_text'))
                        ->required()
                        ->maxLength(50),

                    TextInput::make('data.button_link')
                        ->label(__('admin.page_content.button_link'))
                        ->required(),
                ]),
        ];
    }
}
