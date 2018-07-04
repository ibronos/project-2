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
	global $post;

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

	// Page & Singular Class
	if (is_page() || is_singular()) {
		$classes[] = 'page_layout_default';
		if (has_post_thumbnail()) {
			$classes[] = 'page_theme_image';
		} else {
			$classes[] = 'page_theme_default';
		}
	}

	// 404
	if (is_404()) {
		$classes[] = 'page_layout_default';
		$postslist = get_posts( array( 'post_type' => 'acf-field-group' ));
		foreach ($postslist as $post404) {
			if ($post404->post_title == '404') {
				$pageIdarr 	= unserialize($post404->post_content);
				$pageId 	= $pageIdarr['location'][0][0]['value'];
		     	$meta 		= get_post_meta($pageId);
				if ($meta['header_image'][0]) {
					$classes[] = 'page_theme_image';
					$classes[] = 'page_layout_cover';
				} else {
					$classes[] = 'page_theme_default';
				}
			}
		}
		wp_reset_postdata();
	}

	if (is_archive()) {
		$classes[] = 'page_layout_default';
		$classes[] = 'page_theme_sky';
		$classes[] = 'page_theme_default';
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
function tric_get_template_part($acf_fc, $type) {
	switch ($acf_fc) {
		case 'important_now':

			get_template_part( 'inc/'.$type.'/template', 'now' );
			break;

		case 'news_events':

			get_template_part( 'inc/'.$type.'/template', 'mix' );
			break;

		case 'related_news':

			get_template_part( 'inc/'.$type.'/template', 'news' );
			break;

		case 'media_gallery':

			get_template_part( 'inc/'.$type.'/template', 'gallery' );
			break;

		case 'contact_information':

			get_template_part( 'inc/'.$type.'/template', 'contact-card' );
			break;

		case 'story':

			get_template_part( 'inc/'.$type.'/template', 'story' );
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
			tric_get_template_part($acf_fc['acf_fc_layout'], 'full-width-components');
		}
	}

}

/**
 * Print In-Content Components
 *
 * @param acf in-content_components
 */
function tric_the_in_content_components($acf_fwc) {

	if ($acf_fwc) {
		foreach ($acf_fwc as $acf_fc) {
			tric_get_template_part($acf_fc['acf_fc_layout'], 'in-content-components');
		}
	}

}