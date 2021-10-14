<?php
/**
 * Custom post types for use with this theme
 *
 *
 * @package marmalade-theme
 */

 // Register Custom Post Type
 function project_custom_post_type() {

 	$labels = array(
 		'name'                  => _x( 'Projects', 'Post Type General Name', 'marmalade' ),
 		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'marmalade' ),
 		'menu_name'             => __( 'Projects', 'marmalade' ),
 		'name_admin_bar'        => __( 'Project', 'marmalade' ),
 		'archives'              => __( 'Project Archives', 'marmalade' ),
 		'attributes'            => __( 'Project Attributes', 'marmalade' ),
 		'parent_item_colon'     => __( 'Parent Project:', 'marmalade' ),
 		'all_items'             => __( 'All Projects', 'marmalade' ),
 		'add_new_item'          => __( 'Add New Project', 'marmalade' ),
 		'add_new'               => __( 'Add New', 'marmalade' ),
 		'new_item'              => __( 'New Project', 'marmalade' ),
 		'edit_item'             => __( 'Edit Project', 'marmalade' ),
 		'update_item'           => __( 'Update Project', 'marmalade' ),
 		'view_item'             => __( 'View Project', 'marmalade' ),
 		'view_items'            => __( 'View Projects', 'marmalade' ),
 		'search_items'          => __( 'Search Project', 'marmalade' ),
 		'not_found'             => __( 'Not found', 'marmalade' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'marmalade' ),
 		'featured_image'        => __( 'Featured Image', 'marmalade' ),
 		'set_featured_image'    => __( 'Set featured image', 'marmalade' ),
 		'remove_featured_image' => __( 'Remove featured image', 'marmalade' ),
 		'use_featured_image'    => __( 'Use as featured image', 'marmalade' ),
 		'insert_into_item'      => __( 'Insert into Project', 'marmalade' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this Project', 'marmalade' ),
 		'items_list'            => __( 'Projects list', 'marmalade' ),
 		'items_list_navigation' => __( 'Projects list navigation', 'marmalade' ),
 		'filter_items_list'     => __( 'Filter Projects list', 'marmalade' ),
 	);
 	$args = array(
 		'label'                 => __( 'Project', 'marmalade' ),
 		'description'           => __( 'Post Type Description', 'marmalade' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'thumbnail' ),
 		'hierarchical'          => true,
 		'public'                => true,
 		'show_ui'               => true,
 		'show_in_menu'          => true,
 		'menu_position'         => 5,
 		'menu_icon'             => 'dashicons-portfolio',
 		'show_in_admin_bar'     => true,
 		'show_in_nav_menus'     => true,
 		'can_export'            => true,
 		'has_archive'           => true,
 		'exclude_from_search'   => false,
 		'publicly_queryable'    => true,
 		'capability_type'       => 'page',
 	);
 	register_post_type( 'project', $args );

 }
 add_action( 'init', 'project_custom_post_type', 0 );
