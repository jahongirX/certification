<?php
return [

    'frontend' => 'http://f.qabul',
    'backend' => 'http://b.qabul',

    'images_dir' => '/frontend/web/uploads/images/',
    'images_url' => '/uploads/images/',

    'uploads_dir' => '/frontend/web/uploads/',
    'uploads_url' => '/uploads/',

    'large_image' => [
        'width' => 1900,
        'height' => 1080
    ],
    'medium_image'  => [
        'width' => 300,
        'height' => 0
    ],
    'small_image'  => [
        'width' => 100,
        'height' => 100
    ],

    'slider_limit'   => 5,
    'services_limit' => 8,
    'services_category_limit' => 3,

    'main_language' => 'ru',
    'main_lang' => [
        'abb' => 'ru',
        'name' => 'Русский'
    ],
    'main_language_id' => 2,
    'lang_id' => 2,

    'pagination' => 10,

    'menu_types' => [
        0 => 'Главное',
        1 => 'Меню в футере',
    ],

    'faq_cat' => [
        0 => 'Неактивный',
        1 => 'FAQ',
        2 => 'Центральный аппарат'
    ],

    'ad_cat' => [
        1 => 'Боковое',
    ],

    'banner_cat' => [
        0 => 'Главное',
        1 => 'Боковое',
        2 => 'Нижний колонтитул-1',
        3 => 'Нижний колонтитул-2',
        4 => 'Нижний колонтитул-3'
    ],

    'person_type' => [
        0 => 'Physical',
        1 => 'Legal'
    ],

    'month' => [
        'uz' => [ 1 => 'Yanvar', 2 => 'Fevral', 3 => 'Mart', 4 => 'Aprel', 5 => 'May', 6 => 'Iyun', 7 => 'Iyul', 8 => 'Avgust', 9 => 'Sentyabr', 10 => 'Oktyabr', 11 => 'Noyabr', 12 => 'Dekabr'],
        'ru' => [ 1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'],
        'en' => [ 1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'],
    ],
    'genders' => [
        'uz' => [
            0 => 'Ayol',
            1 => 'Erkak'
        ],
        'ru' => [
            0 => 'Женьшина',
            1 => 'Мужчина'
        ],
        'en' => [
            0 => 'Female',
            1 => 'Male'
        ]
    ],
    'reception_type' => [
        'uz' => [
            0 => 'Taklif',
            1 => 'Ariza',
            2 => 'Shikoyat',
            3 => 'Murojaatnoma'
        ],
        'ru' => [
            0 => 'Предложение',
            1 => 'Заявление',
            2 => 'Жалоба',
            3 => 'Обращение'
        ],
        'en' => [
            0 => 'Prediction',
            1 => 'Attachment',
            2 => 'Complaint',
            3 => 'Appeal'
        ],
    ],
    'reception_status' => [
        'uz' => [
            0 => 'Yangi',
            1 => 'Jarayonda',
            2 => 'Qayta ishlandi',
            3 => 'Rad etildi'
        ],
        'ru' => [
            0 => 'Новый',
            1 => 'В стадии обработки',
            2 => 'Обработано',
            3 => 'Отказано'
        ],
        'en' => [
            0 => 'New',
            1 => 'On process',
            2 => 'Answered',
            3 => 'Declaimed'
        ],
    ]
];
