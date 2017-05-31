<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'products' => [		'title' => 'Продукты',		'created_at' => 'Time',		'fields' => [			'title' => 'Наименование',			'description' => 'Описание',			'price-original' => 'Цена',			'price-sale' => 'Цена по акции',			'category' => 'Категория',			'status' => 'Статус',			'amount' => 'Количество',			'popular' => 'Популярный',			'photos' => 'Фотографии',			'specifications' => 'Характеристики',		],	],
		'category' => [		'title' => 'Категории',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'description' => 'Описание',		],	],
		'specification' => [		'title' => 'Характеристики',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'value-text' => 'Текстовое значение',			'value-number' => 'Числовое значение',		],	],
	'qa_create' => 'Crear',
	'qa_save' => 'Guardar',
	'qa_edit' => 'Editar',
	'qa_view' => 'Ver',
	'qa_update' => 'Actualizar',
	'qa_list' => 'Listar',
	'qa_no_entries_in_table' => 'Sin valores en la tabla',
	'custom_controller_index' => 'Índice del controlador personalizado (index).',
	'qa_logout' => 'Salir',
	'qa_add_new' => 'Agregar',
	'qa_are_you_sure' => 'Estás seguro?',
	'qa_back_to_list' => 'Regresar a la lista?',
	'qa_dashboard' => 'Tablero',
	'qa_delete' => 'Eliminar',
	'quickadmin_title' => 'Windy project',
];