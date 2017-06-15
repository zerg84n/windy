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
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'role' => 'Role',
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