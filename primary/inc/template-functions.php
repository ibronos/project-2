<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Trinity_College
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tric_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_front_page() ) {
		$classes[] = 'page_layout_home';
	}

	$classes[] = 'fs-grid';

	return $classes;
}
add_filter( 'body_class', 'tric_body_classes' );

/**
 * Get nav object
 *
 * @param string nav id.
 * @return object.
 */
function tric_navigation($nav_id) {
	$id = get_nav_menu_locations()[$nav_id];
	$objects = wp_get_nav_menu_items($id);

	return $objects;
}

/**
 * Social media permitted
 *
 * @param string social media slug
 * @return boolean.
 */
function tric_social_filter($soc_slug) {
	$permitted = ['facebook', 'twitter', 'youtube', 'linkedin', 'instagram', 'flickr'];
	$return = in_array($soc_slug, $permitted);

	return $return;
}

/**
 * Print Icon
 *
 * @param icon id
 */
function tric_icon($icon_id, $echoed = TRUE) {
	if ($echoed) {
		echo get_template_directory_uri()."/images/icons.svg#".$icon_id;
	} else {
		return get_template_directory_uri()."/images/icons.svg#".$icon_id;
	}

}