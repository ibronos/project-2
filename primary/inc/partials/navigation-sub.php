<?php
/**
 * Template page sub navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

$childs = get_pages( array(
	'child_of' 		=> get_the_ID(),
	'sort_column' 	=> 'menu_order',
	'sort_order' 	=> 'asc',
	'hierarchical' 	=> 0,
	'parent' 		=> get_the_ID()
));
?>

<?php if ($childs): ?>
	<nav class="sub_nav " aria-label="<?php the_title() ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<div class="sub_nav_header">
			<h2 class="sub_nav_title"><?php the_title() ?></h2>
		</div>
		<button class="js-swap js-sub-nav-handle sub_nav_handle" data-swap-target=".sub_nav_list" data-swap-title="<?php the_title() ?>" aria-haspopup="true" aria-expanded="false">
			<span class="sub_nav_handle_label"><?php the_title() ?></span>
			<span class="sub_nav_handle_icon sub_nav_handle_icon_open">
				<svg class="icon icon_caret_down">
					<use xlink:href="<?php tric_icon('caret_down') ?>"></use>
				</svg>
			</span>
		</button>
		<div class="js-sub-nav-list sub_nav_list">
			<?php foreach ($childs as $child): ?>
				<div class="sub_nav_item">
					<a class="sub_nav_link" href="<?php echo $child->guid ?>" itemprop="url">
						<span class="sub_nav_link_label" itemprop="name"><?php echo $child->post_title ?></span>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	</nav><!-- .sub_nav -->
<?php endif ?>