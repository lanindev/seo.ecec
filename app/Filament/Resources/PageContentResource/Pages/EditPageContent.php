<?php

namespace App\Filament\Resources\PageContentResource\Pages;

use App\Filament\Resources\PageContentResource;
use App\Models\Language;
use App\Models\Page;
use App\Models\PageContent;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPageContent extends EditRecord
{
    protected static string $resource = PageContentResource::class;

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);

        $pageId = $this->record->page_id;
        $languages = Language::active();

        $componentsByLanguage = PageContent::where('page_id', $pageId)
            ->whereIn('language_id', $languages->pluck('id'))
            ->get()
            ->keyBy('language_id');

        $baseComponents = [];

        foreach ($componentsByLanguage as $languageId => $content) {
            foreach ($content->content_components as $index => $component) {
                $type = $component['type'] ?? null;
                $data = $component['data'] ?? [];

                if (!isset($baseComponents[$index])) {
                    $baseComponents[$index] = [
                        'type' => $type,
                        'data' => [],
                    ];
                }

                $code = $languages->firstWhere('id', $languageId)?->code;
                if (!$code) continue;

                switch ($type) {
                    case 'section_heading':
                        if (isset($data['title'])) {
                            $baseComponents[$index]['data']['title_' . $code] = $data['title'];
                        }
                        break;

                    case 'hero':
                        $baseComponents[$index]['data']['title_' . $code] = $data['title'] ?? '';
                        $baseComponents[$index]['data']['subtitle_' . $code] = $data['subtitle'] ?? '';
                        $baseComponents[$index]['data']['description_' . $code] = $data['description'] ?? '';
                        break;

                    case 'richtext':
                        if (isset($data['content'])) {
                            $baseComponents[$index]['data']['content_' . $code] = $data['content'];
                        }
                        break;

                    case 'image':
                        $baseComponents[$index]['data']['path'] = $data['path'] ?? null;
                        break;

                    case 'title':
                        $baseComponents[$index]['data']['text'] = $data['text'] ?? null;
                        break;

                    case 'carousel':
                    case 'slider':
                        foreach ($data['slides'] ?? [] as $i => $item) {
                            $baseComponents[$index]['data']['slides'][$i] ??= [
                                'image' => $item['image'] ?? null,
                            ];
                            $baseComponents[$index]['data']['slides'][$i]['title_' . $code] = $item['title'] ?? null;
                            $baseComponents[$index]['data']['slides'][$i]['button_text_' . $code] = $item['button_text'] ?? null;
                            $baseComponents[$index]['data']['slides'][$i]['button_link'] = $item['button_link'] ?? null;
                        }
                        break;

                    case 'custom_table':
                        $columnCount = count($data['columns'] ?? []);
                        $baseComponents[$index]['data']['column_count_' . $code] = $columnCount;

                        foreach ($data['columns'] as $i => $colName) {
                            $baseComponents[$index]['data']['columns'][$i]["name_" . $code] = $colName;
                        }

                        $rows = $data['rows'] ?? [];
                        $rowsData = [];

                        foreach ($rows as $row) {
                            $rowData = [];

                            for ($i = 0; $i < $columnCount; $i++) {
                                $cellValues = $row[$i] ?? [];
                                $cellRepeater = [];

                                foreach ($cellValues as $value) {
                                    $cellRepeater[] = ['value' => $value];
                                }

                                $rowData["cell_{$i}_" . $code] = $cellRepeater;
                            }

                            $rowsData[] = $rowData;
                        }

                        $baseComponents[$index]['data']['table_color'] = $data['table_color'] ?? null;
                        $baseComponents[$index]['data']['rows_' . $code] = $rowsData;
                        break;

                    case 'alternating_layout':
                        foreach ($data['blocks'] ?? [] as $i => $item) {
                            $baseComponents[$index]['data']['blocks'][$i] ??= [
                                'image' => $item['image'] ?? null,
                                'badge_color' => $item['badge_color'] ?? null,
                            ];
                            $baseComponents[$index]['data']['blocks'][$i]['badge_text_' . $code] = $item['badge_text'] ?? null;
                            $baseComponents[$index]['data']['blocks'][$i]['title_' . $code] = $item['title'] ?? null;
                            $baseComponents[$index]['data']['blocks'][$i]['description_' . $code] = $item['description'] ?? null;
                            $baseComponents[$index]['data']['blocks'][$i]['checklist_items_' . $code] = $item['checklist_items'] ?? null;
                        }
                        break;

                    case 'zigzag_layout':
                    case 'grid_two_col_layout':
                    case 'grid_two_col_card':
                    case 'grid_three_col_layout':
                    case 'grid_three_col_card':
                    case 'grid_four_col_card':
                    case 'grid_five_col_card':
                    case 'service_card':
                    case 'stack_card':
                    case 'list_card':
                    case 'chat_card':
                        $baseComponents[$index]['data']['section_title_' . $code] = $data['section_title'] ?? null;

                        foreach ($data['cards'] ?? [] as $i => $card) {
                            $baseComponents[$index]['data']['cards'][$i]['icon'] = $card['icon'] ?? '';
                            $baseComponents[$index]['data']['cards'][$i]['title_' . $code] = $card['title'] ?? '';
                            $baseComponents[$index]['data']['cards'][$i]['description_' . $code] = $card['description'] ?? '';
                        }
                        break;

                    case 'step_card':
                        $baseComponents[$index]['data']['title_' . $code] = $data['title'] ?? null;
                        $baseComponents[$index]['data']['description_' . $code] = $data['description'] ?? null;
                        $baseComponents[$index]['data']['steps_' . $code] = collect($data['steps'] ?? [])->map(fn($step) => ['step' => $step])->all();
                        $baseComponents[$index]['data']['title_color'] = $data['title_color'] ?? null;
                        break;

                    case 'notice_card':
                        $baseComponents[$index]['data']['color'] = $data['color'] ?? null;
                        $baseComponents[$index]['data']['title_' . $code] = $data['title'] ?? '';
                        $baseComponents[$index]['data']['content_' . $code] = $data['content'] ?? '';
                        break;

                    case 'intro_card':
                        $baseComponents[$index]['data']['section_title_' . $code] = $data['section_title'] ?? null;
                        $baseComponents[$index]['data']['icon'] = $data['icon'] ?? '';
                        $baseComponents[$index]['data']['title_' . $code] = $data['title'] ?? '';
                        $baseComponents[$index]['data']['content_' . $code] = $data['content'] ?? '';
                        break;

                    case 'number_card':
                        foreach ($data['cards'] ?? [] as $i => $card) {
                            $baseComponents[$index]['data']['cards'][$i]['number'] = $card['number'] ?? '';
                            $baseComponents[$index]['data']['cards'][$i]['title_' . $code] = $card['title'] ?? '';
                            $baseComponents[$index]['data']['cards'][$i]['description_' . $code] = $card['description'] ?? '';
                        }
                        break;

                    case 'facility_card':
                        $baseComponents[$index]['data']['card_color'] = $data['card_color'] ?? null;

                        foreach ($data['cards'] ?? [] as $i => $card) {
                            $baseComponents[$index]['data']['cards'][$i]['title_' . $code] = $card['title'] ?? '';
                            $baseComponents[$index]['data']['cards'][$i]['items_' . $code] = $card['items'] ?? '';
                        }
                        break;

                    case 'image_three_col_card':
                        $baseComponents[$index]['data']['section_title_' . $code] = $data['section_title'] ?? null;

                        foreach ($data['cards'] ?? [] as $i => $card) {
                            $baseComponents[$index]['data']['cards'][$i]['image'] = $card['image'] ?? null;
                            $baseComponents[$index]['data']['cards'][$i]['title_' . $code] = $card['title'] ?? '';
                            $baseComponents[$index]['data']['cards'][$i]['description_' . $code] = $card['description'] ?? '';
                        }
                        break;

                    case 'icon_list_block':
                        $baseComponents[$index]['data']['section_title_' . $code] = $data['section_title'] ?? null;
                        $baseComponents[$index]['data']['image'] = $data['image'] ?? null;
                        $baseComponents[$index]['data']['image_link'] = $data['image_link'] ?? null;

                        foreach ($data['items'] ?? [] as $i => $item) {
                            $baseComponents[$index]['data']['items'][$i]['icon'] = $item['icon'] ?? '';
                            $baseComponents[$index]['data']['items'][$i]['description_' . $code] = $item['description'] ?? '';
                            $baseComponents[$index]['data']['items'][$i]['text_link'] = $item['text_link'] ?? '';
                        }
                        break;
                }
            }
        }

        $this->form->fill([
            'page_id' => $this->record->page_id,
            'content_components' => array_values($baseComponents),
        ]);
    }

    protected function getFormSchema(): array
    {
        $languages = Language::active();

        return [
            Select::make('page_id')
                ->label(__('admin.page.label'))
                ->options(function () {
                    $locale = app()->getLocale();
                    return Page::with('translations')
                        ->get()
                        ->mapWithKeys(function ($page) use ($locale) {
                            $translation = $page->translations->firstWhere('language.code', $locale);
                            $label = $page->slug;

                            if ($translation?->name) {
                                $label .= ' — ' . $translation->name;
                            }

                            return [$page->id => $label];
                        });
                })
                ->required()
                ->disabled(),

            PageContentResource::contentComponentBuilder(),
        ];
    }

    public function save(bool $shouldRedirect = true, bool $shouldNotify = true): void
    {
        $data = $this->form->getState();

        PageContentResource::savePageContent($data);

        if ($shouldNotify) {
            Notification::make()
                ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
                ->success()
                ->send();
        }

        if ($shouldRedirect) {
            $this->redirect($this->getRedirectUrl());
        }
    }

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }

}
