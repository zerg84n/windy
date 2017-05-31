<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'products' => [		'title' => 'Продукты',		'created_at' => 'Time',		'fields' => [			'title' => 'Наименование',			'description' => 'Описание',			'price-original' => 'Цена',			'price-sale' => 'Цена по акции',			'category' => 'Категория',			'status' => 'Статус',			'amount' => 'Количество',			'popular' => 'Популярный',			'photos' => 'Фотографии',			'specifications' => 'Характеристики',		],	],
		'category' => [		'title' => 'Категории',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'description' => 'Описание',		],	],
		'specification' => [		'title' => 'Характеристики',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'value-text' => 'Текстовое значение',			'value-number' => 'Числовое значение',		],	],
	'qa_create' => 'Toevoegen',
	'qa_save' => 'Opslaan',
	'qa_edit' => 'Bewerken',
	'qa_view' => 'Bekijken',
	'qa_update' => 'Bijwerken',
	'qa_list' => 'Lijst',
	'qa_no_entries_in_table' => 'Geen inhoud gevonden',
	'custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Logout',
	'qa_add_new' => 'Toevoegen',
	'qa_are_you_sure' => 'Ben je zeker?',
	'qa_back_to_list' => 'Terug naar lijst',
	'qa_dashboard' => 'Boordtabel',
	'qa_delete' => 'Verwijderen',
	'quickadmin_title' => 'Windy project',
];