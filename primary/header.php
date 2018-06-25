<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Trinity_College
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="page_wrapper">
		<header class="header" id="header" itemscope itemtype="http://schema.org/WPHeader">
			<div class="header_ribbon">
				<div class="fs-row">
					<div class="fs-cell">
						<div class="header_ribbon_inner">

							<div class="logo logo_header logo_icon" itemscope itemtype="http://schema.org/Organization">
								<a class="logo_link" itemprop="url" href="<?php echo get_site_url() ?>">
									<span class="logo_link_label">Trinity College</span>
									<span class="logo_link_icon">
										<svg class="icon icon_logo">
											<use xlink:href="<?php tric_icon('logo') ?>"></use>
										</svg>
									</span>
								</a>
								<meta content="<?php echo get_template_directory_uri() ?>/images/logo-schema.png" itemprop="logo">
							</div><!-- .logo -->

							<div class="header_group">

								<nav class="utility_nav utility_nav_lg" aria-label="Utility Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
								    <div class="utility_nav_header">
								        <h2 class="utility_nav_title">Utility Navigation</h2>
								    </div>
								    <div class="utility_nav_list" role="navigation">
								        <?php foreach (tric_navigation('exposed') as $object): ?>
								        	<div class="utility_nav_item">
								        	    <a class="utility_nav_link" href="<?php echo esc_url($object->guid) ?>" itemprop="url">
								        	        <span class="utility_nav_link_label" itemprop="name"><?php echo $object->post_title ?></span>
								        	    </a>
								        	</div>
								        <?php endforeach ?>
								    </div>
								</nav><!-- .utility_nav -->

								<a class="js-swap js-mobile-sidebar-handle mobile_sidebar_handle mobile_sidebar_handle_primary" href="#mobile_sidebar" data-swap-target=".mobile_sidebar" data-swap-linked="mobile_sidebar">
								    <span class="mobile_sidebar_handle_icon mobile_sidebar_handle_icon_open">
								        <svg class="icon icon_menu">
								            <use xlink:href="<?php tric_icon('menu') ?>"></use>
								        </svg>
								    </span>
								    <span class="mobile_sidebar_handle_icon mobile_sidebar_handle_icon_close">
								        <svg class="icon icon_close">
								            <use xlink:href="<?php tric_icon('close') ?>"></use>
								        </svg>
								    </span>
								    <span class="mobile_sidebar_handle_label mobile_sidebar_handle_label_primary">Menu</span>
								</a>
							</div><!-- .header_group -->

						</div>
					</div>
				</div>
			</div>
		</header><!-- #header -->
	<div id="content" class="page_inner">