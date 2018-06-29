<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

get_header();
?>

<div class="page_content">
	<div class="full_width_callouts">

		<?php get_template_part( 'inc/template-parts/content', 'archive' ); ?>

	</div><!--.full_width_callouts -->
</div><!--.page_content-->

<?php get_footer(); ?>
