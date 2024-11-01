<?php

// Register Custom Post Type
function themeregion_companion_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'themeregion-companion' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'themeregion-companion' ),
		'menu_name'             => __( 'Portfolio', 'themeregion-companion' ),
		'name_admin_bar'        => __( 'Portfolio', 'themeregion-companion' ),
		'archives'              => __( 'Item Archives', 'themeregion-companion' ),
		'attributes'            => __( 'Item Attributes', 'themeregion-companion' ),
		'parent_item_colon'     => __( 'Parent Item:', 'themeregion-companion' ),
		'all_items'             => __( 'All Items', 'themeregion-companion' ),
		'add_new_item'          => __( 'Add New Item', 'themeregion-companion' ),
		'add_new'               => __( 'Add New', 'themeregion-companion' ),
		'new_item'              => __( 'New Item', 'themeregion-companion' ),
		'edit_item'             => __( 'Edit Item', 'themeregion-companion' ),
		'update_item'           => __( 'Update Item', 'themeregion-companion' ),
		'view_item'             => __( 'View Item', 'themeregion-companion' ),
		'view_items'            => __( 'View Items', 'themeregion-companion' ),
		'search_items'          => __( 'Search Item', 'themeregion-companion' ),
		'not_found'             => __( 'Not found', 'themeregion-companion' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'themeregion-companion' ),
		'featured_image'        => __( 'Featured Image', 'themeregion-companion' ),
		'set_featured_image'    => __( 'Set featured image', 'themeregion-companion' ),
		'remove_featured_image' => __( 'Remove featured image', 'themeregion-companion' ),
		'use_featured_image'    => __( 'Use as featured image', 'themeregion-companion' ),
		'insert_into_item'      => __( 'Insert into item', 'themeregion-companion' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'themeregion-companion' ),
		'items_list'            => __( 'Items list', 'themeregion-companion' ),
		'items_list_navigation' => __( 'Items list navigation', 'themeregion-companion' ),
		'filter_items_list'     => __( 'Filter items list', 'themeregion-companion' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'themeregion-companion' ),
		'description'           => __( 'Work type or case study for themeregion themes', 'themeregion-companion' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'folio', $args );

}
add_action( 'init', 'themeregion_companion_post_type', 0 );

// Register Custom Taxonomy
function themeregion_companion_taxonomy() {

	$folio_cat_labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'themeregion-companion' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'themeregion-companion' ),
		'menu_name'                  => __( 'Category', 'themeregion-companion' ),
		'all_items'                  => __( 'All Items', 'themeregion-companion' ),
		'parent_item'                => __( 'Parent Item', 'themeregion-companion' ),
		'parent_item_colon'          => __( 'Parent Item:', 'themeregion-companion' ),
		'new_item_name'              => __( 'New Item Name', 'themeregion-companion' ),
		'add_new_item'               => __( 'Add New Item', 'themeregion-companion' ),
		'edit_item'                  => __( 'Edit Item', 'themeregion-companion' ),
		'update_item'                => __( 'Update Item', 'themeregion-companion' ),
		'view_item'                  => __( 'View Item', 'themeregion-companion' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'themeregion-companion' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'themeregion-companion' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'themeregion-companion' ),
		'popular_items'              => __( 'Popular Items', 'themeregion-companion' ),
		'search_items'               => __( 'Search Items', 'themeregion-companion' ),
		'not_found'                  => __( 'Not Found', 'themeregion-companion' ),
		'no_terms'                   => __( 'No items', 'themeregion-companion' ),
		'items_list'                 => __( 'Items list', 'themeregion-companion' ),
		'items_list_navigation'      => __( 'Items list navigation', 'themeregion-companion' ),
	);
	$folio_cat_args = array(
		'labels'                     => $folio_cat_labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'          	 => true,
	);
	register_taxonomy( 'folio_category', array( 'folio' ), $folio_cat_args );

	$folio_tag_labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'themeregion-companion' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'themeregion-companion' ),
		'menu_name'                  => __( 'Tags', 'themeregion-companion' ),
		'all_items'                  => __( 'All Items', 'themeregion-companion' ),
		'parent_item'                => __( 'Parent Item', 'themeregion-companion' ),
		'parent_item_colon'          => __( 'Parent Item:', 'themeregion-companion' ),
		'new_item_name'              => __( 'New Item Name', 'themeregion-companion' ),
		'add_new_item'               => __( 'Add New Item', 'themeregion-companion' ),
		'edit_item'                  => __( 'Edit Item', 'themeregion-companion' ),
		'update_item'                => __( 'Update Item', 'themeregion-companion' ),
		'view_item'                  => __( 'View Item', 'themeregion-companion' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'themeregion-companion' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'themeregion-companion' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'themeregion-companion' ),
		'popular_items'              => __( 'Popular Items', 'themeregion-companion' ),
		'search_items'               => __( 'Search Items', 'themeregion-companion' ),
		'not_found'                  => __( 'Not Found', 'themeregion-companion' ),
		'no_terms'                   => __( 'No items', 'themeregion-companion' ),
		'items_list'                 => __( 'Items list', 'themeregion-companion' ),
		'items_list_navigation'      => __( 'Items list navigation', 'themeregion-companion' ),
	);
	$folio_tag_args = array(
		'labels'                     => $folio_tag_labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'folio_tag', array( 'folio' ), $folio_tag_args );

}
add_action( 'init', 'themeregion_companion_taxonomy', 0 );