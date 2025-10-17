<?php

namespace App\Filament\Resources\PageContentResource\Pages;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ComponentTransformer
{
    public static function transform(string $type, array $dataBlock, string $lang, string $slug): ?array
    {
        return match ($type) {
            'section_heading' => self::sectionHeading($dataBlock, $lang),
            'hero' => self::hero($dataBlock, $lang),
            'richtext' => self::richtext($dataBlock, $lang),
            'image' => self::image($dataBlock, $slug),
            'carousel' => self::carousel($dataBlock, $slug, $type),
            'slider' => self::slider($dataBlock, $lang, $slug, $type),
            'custom_table' => self::customTable($dataBlock, $lang),
            'alternating_layout' => self::alternatingLayout($dataBlock, $lang, $slug),
            'zigzag_layout', 'grid_two_col_layout', 'grid_two_col_card',
            'grid_three_col_layout', 'grid_three_col_card', 'grid_four_col_card', 'grid_five_col_card',
            'service_card', 'stack_card', 'list_card', 'chat_card' => self::cardLayouts($dataBlock, $lang),
            'step_card' => self::stepCard($dataBlock, $lang),
            'notice_card' => self::noticeCard($dataBlock, $lang),
            'intro_card' => self::introCard($dataBlock, $lang),
            'number_card' => self::numberCard($dataBlock, $lang),
            'facility_card' => self::facilityCard($dataBlock, $lang),
            'image_three_col_card' => self::imageThreeColCard($dataBlock, $lang, $slug),
            'icon_list_block' => self::iconListBlock($dataBlock, $slug, $lang),
            default => null,
        };
    }

    protected static function sectionHeading(array $data, string $lang): ?array
    {
        $key = 'title_' . $lang;
        return !empty($data[$key]) ? ['title' => $data[$key]] : null;
    }

    protected static function hero(array $data, string $lang): ?array
    {
        $titleKey = 'title_' . $lang;
        if (empty($data[$titleKey])) {
            return null;
        }
        $subtitleKey = 'subtitle_' . $lang;
        $descriptionKey = 'description_' . $lang;

        return [
            'title' => $data[$titleKey],
            'subtitle' => $data[$subtitleKey] ?? null,
            'description' => $data[$descriptionKey] ?? null,
        ];
    }

    protected static function richtext(array $data, string $lang): ?array
    {
        $key = 'content_' . $lang;
        return !empty($data[$key]) ? ['content' => $data[$key]] : null;
    }

    protected static function image(array $data, string $slug): ?array
    {
        if (empty($data['path'])) {
            return null;
        }

        $originalPath = $data['path'];
        $newPath = 'settings/' . $slug . '/' . basename($originalPath);

        if (Storage::disk('public')->exists($originalPath) && $originalPath !== $newPath) {
            Storage::disk('public')->move($originalPath, $newPath);
        }

        return ['path' => $newPath];
    }

    protected static function carousel(array $data, string $slug, string $type): ?array
    {
        if (empty($data['images']) || !is_array($data['images'])) {
            return null;
        }

        $newImages = [];
        foreach ($data['images'] as $originalPath) {
            $newPath = 'settings/' . $slug . '/' . $type . '/' . basename($originalPath);
            if (Storage::disk('public')->exists($originalPath) && $originalPath !== $newPath) {
                Storage::disk('public')->move($originalPath, $newPath);
            }
            $newImages[] = $newPath;
        }

        return ['images' => $newImages];
    }

    protected static function slider(array $data, string $lang, string $slug, string $type): ?array
    {
        if (empty($data['slides']) || !is_array($data['slides'])) {
            return null;
        }

        $newSlides = [];

        foreach ($data['slides'] as $slide) {
            $originalPath = $slide['image'] ?? null;
            $newImagePath = null;

            if ($originalPath) {
                $newImagePath = 'settings/' . $slug . '/' . $type . '/' . basename($originalPath);
                if (Storage::disk('public')->exists($originalPath) && $originalPath !== $newImagePath) {
                    Storage::disk('public')->move($originalPath, $newImagePath);
                }
            }

            $newSlides[] = [
                'image' => $newImagePath,
                'title' => $slide['title_' . $lang] ?? null,
                'button_text' => $slide['button_text_' . $lang] ?? null,
                'button_link' => $slide['button_link'],
            ];
        }

        $newSlides = array_values(array_filter($newSlides, fn($i) => !empty($i['title'])));

        return !empty($newSlides) ? ['slides' => $newSlides] : null;
    }

    protected static function customTable(array $data, string $lang): ?array
    {
        $columnCount = $data['column_count_' . $lang] ?? 0;

        $columns = [];
        for ($i = 0; $i < $columnCount; $i++) {
            $columns[] = $data['columns'][$i]['name_' . $lang] ?? '';
        }

        $rows = [];
        $rowsData = $data['rows_' . $lang] ?? [];
        foreach ($rowsData as $row) {
            $rowCells = [];
            for ($i = 0; $i < $columnCount; $i++) {
                $cellValues = $row["cell_{$i}_" . $lang] ?? [];
                $values = array_map(fn($v) => $v['value'] ?? '', $cellValues);
                $rowCells[] = $values;
            }
            $rows[] = $rowCells;
        }

        return [
            'table_color' => $data['table_color'] ?? null,
            'columns' => $columns,
            'rows' => $rows,
        ];
    }

    protected static function alternatingLayout(array $data, string $lang, string $slug): ?array
    {
        if (empty($data['blocks']) || !is_array($data['blocks'])) {
            return null;
        }

        $newBlocks = [];

        foreach ($data['blocks'] as $item) {
            $originalPath = $item['image'] ?? null;
            $newImagePath = null;

            if ($originalPath) {
                $newImagePath = 'settings/' . $slug . '/alternating/' . basename($originalPath);
                if (Storage::disk('public')->exists($originalPath) && $originalPath !== $newImagePath) {
                    Storage::disk('public')->move($originalPath, $newImagePath);
                }
            }

            $newBlocks[] = [
                'image' => $newImagePath,
                'badge_color' => $item['badge_color'] ?? null,
                'badge_text' => $item['badge_text_' . $lang] ?? null,
                'title' => $item['title_' . $lang] ?? null,
                'description' => $item['description_' . $lang] ?? null,
                'checklist_items' => $item['checklist_items_' . $lang] ?? null,
            ];
        }

        $newBlocks = array_values(array_filter($newBlocks, fn($i) => !empty($i['title'])));

        return !empty($newBlocks) ? ['blocks' => $newBlocks] : null;
    }

    protected static function cardLayouts(array $data, string $lang): ?array
    {
        $sectionTitle = $data['section_title_' . $lang] ?? null;
        $cards = $data['cards'] ?? [];

        $newCards = [];

        foreach ($cards as $cardItem) {
            $icon = $cardItem['icon'] ?? '';
            $title = $cardItem['title_' . $lang] ?? null;
            $description = $cardItem['description_' . $lang] ?? null;

            if (!empty($title)) {
                $newCards[] = [
                    'icon' => $icon,
                    'title' => $title,
                    'description' => $description,
                ];
            }
        }

        return !empty($newCards) ? [
            'section_title' => $sectionTitle,
            'cards' => $newCards,
        ] : null;
    }

    protected static function stepCard(array $data, string $lang): ?array
    {
        $titleKey = 'title_' . $lang;
        $descKey = 'description_' . $lang;
        $stepsKey = 'steps_' . $lang;

        $steps = collect($data[$stepsKey] ?? [])
            ->pluck('step')
            ->filter()
            ->values()
            ->all();

        if (empty($data[$titleKey]) && empty($steps)) {
            return null;
        }

        return [
            'title' => $data[$titleKey] ?? null,
            'description' => $data[$descKey] ?? null,
            'steps' => $steps,
            'title_color' => $data['title_color'] ?? null,
        ];
    }

    protected static function noticeCard(array $data, string $lang): ?array
    {
        $titleKey = 'title_' . $lang;
        $contentKey = 'content_' . $lang;

        if (empty($data[$titleKey])) {
            return null;
        }

        return [
            'color' => $data['color'] ?? 'blue',
            'title' => $data[$titleKey],
            'content' => $data[$contentKey] ?? null,
        ];
    }

    protected static function introCard(array $data, string $lang): ?array
    {
        $sectionTitle = $data['section_title_' . $lang] ?? null;
        $titleKey = 'title_' . $lang;
        $contentKey = 'content_' . $lang;

        if (empty($data[$titleKey])) {
            return null;
        }

        return [
            'section_title' => $sectionTitle,
            'icon' => $data['icon'] ?? '',
            'title' => $data[$titleKey],
            'content' => $data[$contentKey] ?? null,
        ];
    }

    protected static function numberCard(array $data, string $lang): ?array
    {
        $cards = $data['cards'] ?? [];

        $newCards = [];

        foreach ($cards as $cardItem) {
            $number = $cardItem['number'] ?? '';
            $title = $cardItem['title_' . $lang] ?? null;
            $description = $cardItem['description_' . $lang] ?? null;

            if (!empty($title)) {
                $newCards[] = [
                    'number' => $number,
                    'title' => $title,
                    'description' => $description,
                ];
            }
        }

        return !empty($newCards) ? ['cards' => $newCards,] : null;
    }

    protected static function facilityCard(array $data, string $lang): ?array
    {
        $cardColor = $data['card_color'] ?? null;
        $cards = $data['cards'] ?? [];

        $newCards = [];

        foreach ($cards as $cardItem) {
            $title = $cardItem['title_' . $lang] ?? null;
            $items = $cardItem['items_' . $lang] ?? null;

            if (!empty($title)) {
                $newCards[] = [
                    'title' => $title,
                    'items' => $items,
                ];
            }
        }

        return !empty($newCards) ? [
            'card_color' => $cardColor,
            'cards' => $newCards,
        ] : null;
    }

    protected static function imageThreeColCard(array $data, string $lang, string $slug): ?array
    {
        $sectionTitle = $data['section_title_' . $lang] ?? null;
        $cards = $data['cards'] ?? [];

        $newCards = [];

        foreach ($cards as $card) {
            $originalPath = $card['image'] ?? null;
            $newPath = null;

            if ($originalPath) {
                $newPath = 'settings/' . $slug . '/image-three-col-card/' . basename($originalPath);

                if (Storage::disk('public')->exists($originalPath) && $originalPath !== $newPath) {
                    Storage::disk('public')->move($originalPath, $newPath);
                }
            }

            $title = $card['title_' . $lang] ?? null;
            $description = $card['description_' . $lang] ?? null;

            if (!empty($title) && $newPath) {
                $newCards[] = [
                    'image' => $newPath,
                    'title' => $title,
                    'description' => $description,
                ];
            }
        }

        return !empty($newCards) ? [
            'section_title' => $sectionTitle,
            'cards' => $newCards,
        ] : null;
    }

    protected static function iconListBlock(array $data, string $slug, string $lang): ?array
    {
        $sectionTitle = $data['section_title_' . $lang] ?? null;

        if (empty($data['image'])) {
            return null;
        }

        $originalPath = $data['image'];
        $newPath = 'settings/' . $slug . '/' . basename($originalPath);
        if (Storage::disk('public')->exists($originalPath) && $originalPath !== $newPath) {
            Storage::disk('public')->move($originalPath, $newPath);
        }

        $imageLink = $data['image_link'] ?? null;

        $items = $data['items'] ?? [];

        $newItems = [];

        foreach ($items as $item) {
            $icon = $item['icon'] ?? null;
            $description = $item['description_' . $lang] ?? null;
            $text_link = $item['text_link'] ?? null;

            if (!empty($description)) {
                $newItems[] = [
                    'icon' => $icon,
                    'description' => $description,
                    'text_link' => $text_link,
                ];
            }
        }

        return !empty($newItems) ? [
            'section_title' => $sectionTitle,
            'image' => $newPath,
            'image_link' => $imageLink,
            'items' => $newItems,
        ] : null;
    }
}
