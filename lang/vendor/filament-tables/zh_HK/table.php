<?php

return [

    'fields' => [

        'bulk_select_page' => [
            'label' => '選擇/取消選擇所有項目以進行批量操作。',
        ],

        'bulk_select_record' => [
            'label' => '選擇/取消選擇項目 :key 以進行批量操作。',
        ],

        'bulk_select_group' => [
            'label' => '選擇/取消選擇組 :title 以進行批量操作。',
        ],

        'search' => [
            'label' => '搜尋',
            'placeholder' => '搜尋',
            'indicator' => '搜尋',
        ],

    ],

    'actions' => [

        'filter' => [
            'label' => '篩選',
        ],

        'open_bulk_actions' => [
            'label' => '打開動作',
        ],

        'toggle_columns' => [
            'label' => '顯示／隱藏直列',
        ],

    ],

    'empty' => [
        'heading' => '未找到資料',

        'description' => '建立 :model 以開始。',
    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => '應用篩選',
            ],

            'remove' => [
                'label' => '移除篩選',
            ],

            'remove_all' => [
                'label' => '移除所有篩選',
                'tooltip' => '移除所有篩選',
            ],

            'reset' => [
                'label' => '重設篩選',
            ],

        ],

        'heading' => '篩選',

        'indicator' => '已啟用的篩選',

        'multi_select' => [
            'placeholder' => '全部',
        ],

        'select' => [
            'placeholder' => '全部',
        ],

        'trashed' => [

            'label' => '已刪除的資料',

            'only_trashed' => '僅顯示已刪除的資料',

            'with_trashed' => '包含已刪除的資料',

            'without_trashed' => '不含已刪除的資料',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => '分組',
                'placeholder' => '全部',
            ],

            'direction' => [

                'label' => '排序',

                'options' => [
                    'asc' => '升序',
                    'desc' => '降序',
                ],

            ],

        ],

    ],

    'reorder_indicator' => '拖曳以重新排序',

    'selection_indicator' => [

        'selected_count' => '已選擇 :count 個項目',

        'actions' => [

            'select_all' => [
                'label' => '選擇全部 :count 項',
            ],

            'deselect_all' => [
                'label' => '取消選擇全部',
            ],

        ],

    ],

];
