<?php

namespace App\Filament\Resources\SeoSectionResource\SeoSectionManager;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class IssuesManager extends SeoSectionManager
{
    public static function getId(): string
    {
        return 'issues';
    }

    public function formSchema(): array
    {
        $cards = [];

        for ($i = 1; $i <= 4; $i++) {
            $cards[] = Card::make()
                ->schema([
                    Grid::make(3)
                        ->columns(3)
                        ->schema([
                            TextInput::make("data.cards.{$i}.icon")
                                ->label(__('admin.page_content.icon_class'))
                                ->maxLength(255),

                            TextInput::make("data.cards.{$i}.title")
                                ->label(__('admin.page_content.title'))
                                ->maxLength(255),

                            Textarea::make("data.cards.{$i}.description")
                                ->label(__('admin.page_content.description'))
                                ->rows(2),
                        ])
                ]);
        }


        return [
            TextInput::make('data.title')
                ->label(__('admin.page_content.section_title'))
                ->required()
                ->minLength(10)
                ->maxLength(30),

            ...$cards,
        ];
    }
}
