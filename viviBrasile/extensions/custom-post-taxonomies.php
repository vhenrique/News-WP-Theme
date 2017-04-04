<?php 
// Platform
	add_action( 'init', 'create_custom_tax_platform');
	function create_custom_tax_platform() {
		$singular_label = 'status';
		$labels = array(
			'name'					=> _x( 'Platform', 'taxonomy general name' ),
			'singular_name'			=> _x( ucfirst($singular_label), 'taxonomy singular name' ),
			'search_items'			=> __( 'Search' ),
			'all_items'				=> __( 'All' ),
			'edit_item'				=> __( 'Edit' ),
			'update_item'			=> __( 'Update' ),
			'add_new_item'			=> __( 'New ' ) . strtolower($singular_label),
			'new_item_name'			=> __( 'New ' ) . strtolower($singular_label),
			'menu_name'				=> __( 'Platform' )
		);
		$args = array(
			'hierarchical'			=> true,
			'labels'				=> $labels,
			'show_ui'				=> true,
			'show_admin_column'		=> true,
			'capability_type'     	=> 'post',
			'query_var'				=> true,
			'rewrite'				=> array( 'slug' => 'platform' ),
			'has_archive'			=> false,
			'exclude_from_search'	=> true
		);
		register_taxonomy( 'projects', $args );
	}

	// Custom icon for default WordPress Category
	function add_post_category_columns( $columns ){
	    array_unshift($columns, 'color');
	    return $columns;
	}
	add_filter('manage_edit-category_columns', 'add_post_category_columns');

	function add_post_category_column_content( $value, $content, $term_id ){
		global $themePrefix;
		$content = '<h1 '.get_termColor( $term_id, 'background' ).'><br /></h1>';

	    return $content;
	}
	add_filter('manage_category_custom_column', 'add_post_category_column_content', 10 , 3);
?>