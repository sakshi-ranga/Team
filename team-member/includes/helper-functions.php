<?php 
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_658fdbaca935c',
	'title' => 'Team Info',
	'fields' => array(
		array(
			'key' => 'field_658fdbac94c83',
			'label' => 'Email',
			'name' => 'email',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_658fdbd894c84',
			'label' => 'Bio',
			'name' => 'bio',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'team',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'department', array(
	0 => 'team',
	), array(
		'labels' => array(
			'name' => 'departments',
			'singular_name' => 'department',
			'menu_name' => 'departments',
			'all_items' => 'All departments',
			'edit_item' => 'Edit department',
			'view_item' => 'View department',
			'update_item' => 'Update department',
			'add_new_item' => 'Add New department',
			'new_item_name' => 'New department Name',
			'search_items' => 'Search departments',
			'not_found' => 'No departments found',
			'no_terms' => 'No departments',
			'items_list_navigation' => 'departments list navigation',
			'items_list' => 'departments list',
			'back_to_items' => '← Go to departments',
			'item_link' => 'department Link',
			'item_link_description' => 'A link to a department',
		),
		'public' => true,
		'hierarchical' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
	) );
} );

