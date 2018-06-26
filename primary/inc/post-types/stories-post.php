<?php

// ====================================REGISTER CUSTOM POST=====================================
add_action( 'init', 'stories_init' );
/**
 * Register a product post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function stories_init() {
	$labels = array(
		'name'               => _x( 'Stories', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Stories', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Stories', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Stories', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Stories', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Stories', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Stories', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Stories', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Stories', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Stories', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Stories', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Stories:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Stories found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Stories found in Trash.', 'your-plugin-textdomain' )
		
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'stories' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'stories_post', $args );
}


// ============================TAXONOMY====================================
// ============================TAXONOMY====================================
function stories_type(){

    //set the name of the taxonomy
    $taxonomy = 'stories-type';
    //set the post types for the taxonomy
    $object_type = 'stories_post';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'Type',
        'singular_name'      => 'Type',
        'search_items'       => 'Search Type',
        'all_items'          => 'All Type',
        'parent_item'        => 'Parent Type',
        'parent_item_colon'  => 'Parent Type:',
        'update_item'        => 'Update Type',
        'edit_item'          => 'Edit Type',
        'add_new_item'       => 'Add New Type', 
        'new_item_name'      => 'New Type Name',
        'menu_name'          => 'Stories Types'
    );
    
    //define arguments to be used 
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'stories-type')
    );
    
    //call the register_taxonomy function
    register_taxonomy($taxonomy, $object_type, $args); 
}
add_action('init','stories_type');

?>