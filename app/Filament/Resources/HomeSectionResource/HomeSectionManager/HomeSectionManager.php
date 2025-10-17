<?php

namespace App\Filament\Resources\HomeSectionResource\HomeSectionManager;

use App\Models\HomeSection;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

abstract class HomeSectionManager
{
    abstract public static function getId(): string;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('admin.home_section.name'))
                    ->required()
                    ->string()
                    ->disabled()
                    ->maxLength(255),

                ...$this->formSchema()
            ])
            ->columns(1);
    }

    abstract protected function formSchema(): array;

    public function mutateFormDataBeforeSave(HomeSection $section, array $data): array
    {
        return $data;
    }
}
