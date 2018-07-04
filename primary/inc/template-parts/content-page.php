<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

?>
<div class="page_feature"></div>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page_header">
		<?php if (has_post_thumbnail()): ?>
			<div class="js-background page_background" data-background-options='{"source": {
				"0px": "<?php the_post_thumbnail_url() ?>",
				"500px": "<?php the_post_thumbnail_url() ?>",
				"980px": "<?php the_post_thumbnail_url() ?>",
				"1220px": "<?php the_post_thumbnail_url() ?>"
			}}'></div>
		<?php endif ?>
		<div class="page_header_inner">
			<div class="fs-row">
				<!-- Main Content -->
				 <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
					<div class="page_header_body">
						<h1 class="page_title"><?php the_title() ?></h1>
						<?php get_template_part( 'inc/partials/navigation', 'sub' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .page_header -->

	<!-- .content -->
	<div class="page_content">
		<div class="fs-row">
			<div class="fs-cell fs-lg-11 fs-xl-9 fs-xl-push-1 content_wrapper">
				<main class="main_content" id="main_content" itemprop="mainContentOfPage">
					<div class="typography"><?php the_content() ?></div>
					<div class="in_content_callouts">
						<?php
							if (get_field('in-content_components')) {
								tric_the_in_content_components(get_field('in-content_components'));
							}
						?>
					</div>
				</main>
			</div>
		</div>
		<div class="full_width_callouts">
		<?php
			if (get_field('full-width_components')) {
				tric_the_full_width_components(get_field('full-width_components'));
			}
		?>
		</div><!--.full_width_callouts -->
	</div><!--.page_content-->

</div><!-- #post-<?php the_ID(); ?> -->
