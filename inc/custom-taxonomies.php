<?php
/**
 * Custom taxonomies for use with this theme
 *
 *
 * @package marmalade-theme
 */

 // Register Custom Taxonomy
 function project_category_custom_taxonomy() {

 	$labels = array(
 		'name'                       => _x( 'Project Categories', 'Taxonomy General Name', 'marmalade' ),
 		'singular_name'              => _x( 'Project Category', 'Taxonomy Singular Name', 'marmalade' ),
 		'menu_name'                  => __( 'Project Category', 'marmalade' ),
 		'all_items'                  => __( 'All Project Categories', 'marmalade' ),
 		'parent_item'                => __( 'Parent Project Category', 'marmalade' ),
 		'parent_item_colon'          => __( 'Parent Project Category:', 'marmalade' ),
 		'new_item_name'              => __( 'New Project Category', 'marmalade' ),
 		'add_new_item'               => __( 'Add New Project Category', 'marmalade' ),
 		'edit_item'                  => __( 'Edit Project Category', 'marmalade' ),
 		'update_item'                => __( 'Update Project Category', 'marmalade' ),
 		'view_item'                  => __( 'View Project Category', 'marmalade' ),
 		'separate_items_with_commas' => __( 'Separate Project Categories with commas', 'marmalade' ),
 		'add_or_remove_items'        => __( 'Add or remove Project Categories', 'marmalade' ),
 		'choose_from_most_used'      => __( 'Choose from the most used', 'marmalade' ),
 		'popular_items'              => __( 'Popular Project Categories', 'marmalade' ),
 		'search_items'               => __( 'Search Project Categories', 'marmalade' ),
 		'not_found'                  => __( 'Not Found', 'marmalade' ),
 		'no_terms'                   => __( 'No Project Categories', 'marmalade' ),
 		'items_list'                 => __( 'Project Categories list', 'marmalade' ),
 		'items_list_navigation'      => __( 'Project Categories list navigation', 'marmalade' ),
 	);
 	$args = array(
 		'labels'                     => $labels,
 		'hierarchical'               => true,
 		'public'                     => true,
 		'show_ui'                    => true,
 		'show_admin_column'          => true,
 		'show_in_nav_menus'          => false,
    'show_tagcloud'              => false,
    'rewrite'                    => false
 	);
 	register_taxonomy( 'project_category', array( 'project' ), $args );

 }
 add_action( 'init', 'project_category_custom_taxonomy', 0 );
