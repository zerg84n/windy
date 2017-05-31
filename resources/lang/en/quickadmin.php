<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'products' => [		'title' => 'Продукты',		'created_at' => 'Time',		'fields' => [			'title' => 'Наименование',			'description' => 'Описание',			'price-original' => 'Цена',			'price-sale' => 'Цена по акции',			'category' => 'Категория',			'status' => 'Статус',			'amount' => 'Количество',			'popular' => 'Популярный',			'photos' => 'Фотографии',			'specifications' => 'Характеристики',		],	],
		'category' => [		'title' => 'Категории',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'description' => 'Описание',		],	],
		'specification' => [		'title' => 'Характеристики',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'value-text' => 'Текстовое значение',			'value-number' => 'Числовое значение',		],	],
	'qa_create' => 'Create',
	'qa_save' => 'Save',
	'qa_edit' => 'Edit',
	'qa_view' => 'View',
	'qa_update' => 'Update',
	'qa_list' => 'List',
	'qa_no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Logout',
	'qa_add_new' => 'Add new',
	'qa_are_you_sure' => 'Are you sure?',
	'qa_back_to_list' => 'Back to list',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Delete',
	'quickadmin_title' => 'Windy project',
];