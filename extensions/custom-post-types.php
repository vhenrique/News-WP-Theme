<?php

// News
	add_action('init', 'magazine_register');
	function magazine_register(){
		$singular_label = 'revista';
		$labels = array(
			'name'					=> 'Revista',
			'singular_name'			=> $singular_label,
			'add_new'				=> 'Nova ' . $singular_label,
			'add_new_item'			=> 'Nova  ' . $singular_label,
			'edit_item'				=> 'Editar ' . $singular_label,
			'new_item'				=> 'Nova ' . $singular_label,
			'view_item'				=> 'Ver ' . $singular_label,
			'search_items'			=> 'Buscar ' . $singular_label,
			'not_found'				=> 'Não encontrado',
			'not_found_in_trash'	=> 'Não encontrado na lixeira',
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-welcome-widgets-menus',
			'hierarchical'			=> true,
			'menu_position'			=> 3,
			'has_archive'			=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'taxonomies'			=> array( 'category' )
		);
		register_post_type( 'revista', $args );
	}
?>