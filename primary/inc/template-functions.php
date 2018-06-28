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

	// Page Class
	if (is_page()) {
		$classes[] = 'page_layout_default';
		if (has_post_thumbnail()) {
			$classes[] = 'page_theme_image';
		} else {
			$classes[] = 'page_theme_default';
		}
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

/**
 * Get Template from acf fc
 *
 * @param acf fc
 * important_now, news_events
 */
function tric_get_template_part($acf_fc) {
	switch ($acf_fc) {
		case 'important_now':

			get_template_part( 'inc/full-width-components/template', 'now' );
			break;

		case 'news_events':

			get_template_part( 'inc/full-width-components/template', 'mix' );
			break;

		default:
			# code...
			break;
	}
}

/**
 * Print Full-Width Components
 *
 * @param acf full-width_components
 */
function tric_the_full_width_components($acf_fwc) {

	if ($acf_fwc) {
		foreach ($acf_fwc as $acf_fc) {
			tric_get_template_part($acf_fc['acf_fc_layout']);
		}
	}

}