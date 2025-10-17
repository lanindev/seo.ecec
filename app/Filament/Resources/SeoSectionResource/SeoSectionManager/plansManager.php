<?php

namespace App\Filament\Resources\SeoSectionResource\SeoSectionManager;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class PlansManager extends SeoSectionManager
{
    public static function getId(): string
    {
        return 'plans';
    }

    public function formSchema(): array
    {
        return [
            TextInput::make('data.title')
                ->label(__('admin.page_content.section_title'))
                ->required()
                ->minLength(4)
                ->maxLength(30),

            Repeater::make('data.cards')
                ->label(__('admin.page_content.content'))
                ->schema([
                    Card::make()
                        ->schema([
                            Grid::make()
                                ->columns(2)
                                ->schema([
                                    TextInput::make('title')
                                        ->label(__('admin.page_content.title'))
                                        ->required()
                                        ->maxLength(255),

                                    Textarea::make('description')
                                        ->label(__('admin.page_content.description'))
                                        ->rows(2)
                                        ->required(),

                                    TextInput::make('price')
                                        ->label('HK$')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('duration')
                                        ->label('每月期限')
                                        ->numeric()
                                        ->required(),

                                    Textarea::make('items')
                                        ->label(__('admin.page_content.item'))
                                        ->rows(8)
                                        ->placeholder("每行一個項目"),
                                ])
                        ])
                ])
                ->createItemButtonLabel('新增卡片')
                ->columnSpanFull(),
        ];
    }
}
