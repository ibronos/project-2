<?php
/**
 * Template For Full Width Components - Related News
 */

if ($acf_fc['acf_fc_layout'] == 'related_news') {
	$acf = $acf_fc['related_news_category'];
}

$args = array(
	'post_type' 	=> 'news_post',
	'numberposts' 	=> 3,
	'tax_query' 	=> array(
		array(
			'taxonomy' => $acf->taxonomy,
			'field' => 'id',
			'terms' => $acf->term_taxonomy_id
		)
	)
);
$posts 		= get_posts( $args );
$post_len 	= count($posts);
?>

<div class="related_news layout_<?php echo $post_len ?>">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="related_news_inner">

				<header class="related_news_header">
					<a class="related_news_link" href="<?php echo get_site_url() . '/news' ?>">
						<span class="related_news_link_label">View All News</span>
						<span class="related_news_link_icon" aria-hidden="true">
							<svg class="icon icon_arrow_right">
								<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
							</svg>
						</span>
					</a>
					<h2 class="related_news_title">Related Articles</h2>
				</header>

				<?php if ($post_len == 3): ?>
				<div class="js-carousel related_news_items" data-carousel-options='{
					"contained": false,
					"controls": false,
					"matchHeight": true,
					"show": {
						"740px": 2,
						"980px": 3
					}
				}'>
				<?php elseif ($post_len == 2): ?>
				<div class="js-carousel related_news_items" data-carousel-options='{
					"contained": false,
					"controls": false,
					"matchHeight": true,
					"show": {
						"740px": 2
					}
				}'>
				<?php else: ?>
				<div class="related_news_items">
				<?php endif ?>

					<?php foreach ($posts as $i => $post): ?>
						<?php setup_postdata( $post ); ?>
						<div class="related_news_item">
							<article class="mix_news_item">
								<?php if ($post_len == 1): ?>
									<a class="related_news_item_background_link" href="<?php the_permalink() ?>">
										<div class="js-background related_news_item_background" data-background-options='{"source": {
										"0px": "<?php echo the_field('list_image') ?>"}}'></div>
									</a>
								<?php endif ?>
								<figure class="mix_news_item_figure">
									<a class="mix_news_item_figure_link" href="<?php the_permalink() ?>">
										<img class="mix_news_item_image" src="<?php echo the_field('list_image') ?>" alt="image">
									</a>
								</figure>
								<div class="mix_news_item_body">
									<header class="mix_news_item_header">
										<h3 class="mix_news_item_title">
											<a class="mix_news_item_title_link" href="<?php the_permalink() ?>">
												<span class="mix_news_item_title_link_label"><?php the_title() ?></span>
												<span class="mix_news_item_title_link_icon" aria-hidden="true">
													<svg class="icon icon_arrow_right">
														<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
													</svg>
												</span>
											</a>
										</h3>
									</header>
									<div class="mix_news_item_caption"><?php tric_bulrb_autofill() ?></div>
								</div>
							</article>
						</div>
					<?php endforeach ?>
					<?php wp_reset_postdata();?>

				</div>
			</div>
		</div>
	</div>
</div>