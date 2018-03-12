<?php

return [
	
	'user-management' => [
		'title' => 'Управление пользователями',
		'created_at' => 'Время',
		'fields' => [
		],
	],
	
	'roles' => [
		'title' => 'Роли',
		'created_at' => 'Время',
		'fields' => [
			'title' => 'Название',
		],
	],
	
	'users' => [
		'title' => 'Users',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Имя',
			'email' => 'Email',
			'password' => 'Пароль',
			'role' => 'Роль',
			'remember-token' => 'Remember token',
		],
	],
	
	'products' => [
		'title' => 'Продукты',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Наименование',
			'description' => 'Описание',
			'price-original' => 'Цена',
			'price-sale' => 'Цена по акции',
			'category' => 'Категория',
			'status' => 'Статус',
			'amount' => 'Количество',
			'popular' => 'Популярный',
			'photos' => 'Фотографии',
			'specifications' => 'Характеристики',
		],
	],
	
	'category' => [
		'title' => 'Категории',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Название',
			'description' => 'Описание',
		],
	],
	
	'specification' => [
		'title' => 'Характеристики',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Название',
			'value-text' => 'Текстовое значение',
			'value-number' => 'Числовое значение',
		],
	],
	'menu' => [
		'title' => 'Меню',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Название',
		],
	],
	
	'item' => [
		'title' => 'Пункты Меню',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Название',
			'url' => 'Url',
			'menus' => 'Menus',
		],
	],
	
	'news' => [
		'title' => 'Новости',
		'created_at' => 'Время',
		'fields' => [
			'title' => 'Заголовок',
			'short' => 'Коротко',
			'full-text' => 'Полный текст',
			'photos' => 'Изображения',
		],
	],
    'banners' => [
		'title' => 'Слайдеры',
		'created_at' => 'Время',
		'fields' => [
			'title' => 'Заголовок',
			
			'photos' => 'Изображения',
		],
	],
        'pages' => [
                    'title' => 'Страницы',
                    'created_at' => 'Время',
                    'fields' => [
                            'title' => 'Заголовок',
                            'alias' => 'алиас в url',
                            'full-text' => 'Текст',
                            'photos' => 'Изображения',
                    ],
            ],
    'reviews' => [
		'title' => 'Отзывы',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Имя',
			'email' => 'Email',
			'score' => 'Оценка',
			'text' => 'Отзыв',
			'published' => 'Опубликовано',
			'item' => 'Товар',
			'session-id' => 'Session id',
		],
        ],
    'order' => [
		'title' => 'Заказы',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Контактное лицо',
			'email' => 'Email',
			'phone' => 'Телефон',
			'delivery' => 'Доставка',
			'address' => 'Адрес',
			'time' => 'Удобное время',
			'payment-type' => 'Способ оплаты',
			'is-ur' => 'Юридическое лицо',
			'attachment' => 'Реквизиты в файле',
			'ur-name' => 'Название организации',
			'ur-inn' => 'ИНН',
			'ur-nls' => 'Номер лицевого счета',
			'status' => 'Статус',
		],
	],
    'brands' => [
		'title' => 'Производители',
		'created_at' => 'Time',
		'fields' => [
			'title' => 'Название',
			'slug' => 'Slug',
		],
	],
    'filters' => [
		'title' => ' Фильтры',
		'created_at' => 'Time',
		'fields' => [
			'query' => 'Запрос',
			'slug' => 'Slug',
		],
	],
	'qa_create' => 'Создание',
	'qa_save' => 'Сохранить',
	'qa_edit' => 'Редактировать',
	'qa_view' => 'Просмотр',
	'qa_update' => 'Обновить',
	'qa_list' => 'Список',
	'qa_no_entries_in_table' => 'Нет записей',
	'custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Выйти',
	'qa_add_new' => 'Добавить',
	'qa_are_you_sure' => 'Вы уверены?',
	'qa_back_to_list' => 'К списку',
	'qa_dashboard' => 'Рабочий стол',
	'qa_delete' => 'Удалить',
	'quickadmin_title' => 'Windy project',
];