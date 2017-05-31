<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'products' => [		'title' => 'Продукты',		'created_at' => 'Time',		'fields' => [			'title' => 'Наименование',			'description' => 'Описание',			'price-original' => 'Цена',			'price-sale' => 'Цена по акции',			'category' => 'Категория',			'status' => 'Статус',			'amount' => 'Количество',			'popular' => 'Популярный',			'photos' => 'Фотографии',			'specifications' => 'Характеристики',		],	],
		'category' => [		'title' => 'Категории',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'description' => 'Описание',		],	],
		'specification' => [		'title' => 'Характеристики',		'created_at' => 'Time',		'fields' => [			'title' => 'Название',			'value-text' => 'Текстовое значение',			'value-number' => 'Числовое значение',		],	],
	'qa_create' => 'Criar',
	'qa_save' => 'Salvar',
	'qa_edit' => 'Editar',
	'qa_view' => 'Visualizar',
	'qa_update' => 'Atualizar',
	'qa_list' => 'Listar',
	'qa_no_entries_in_table' => 'Sem entradas na tabela',
	'custom_controller_index' => 'Índice de Controller personalizado.',
	'qa_logout' => 'Sair',
	'qa_add_new' => 'Novo',
	'qa_are_you_sure' => 'Tem certeza?',
	'qa_back_to_list' => 'Voltar',
	'qa_dashboard' => 'Painel',
	'qa_delete' => 'Excluir',
	'quickadmin_title' => 'Windy project',
];