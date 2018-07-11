<?php
/**
 * Template For Full Width Components - Story
 *
 */


if ($acf_fc['acf_fc_layout'] == 'story') {
	$acf = $acf_fc;
}

if ($acf['stories_post_type'][0]):
	$post = $acf['stories_post_type'][0];
	setup_postdata( $post ); ?>

	<div class="story">
		<div class="js-background story_background" data-background-options='{"source": {
		"0px": "<?php the_field('image') ?>",
		"740px": "<?php the_field('image') ?>",
		"980px": "<?php the_field('image') ?>"
		}, "lazy": true, "lazyEdge": "100"}'></div>
		<div class="fs-row">
			<div class="fs-cell fs-xl-11 fs-xl-push-1">
				<div class="story_inner">

					<?php if (get_field('type') == 'quote'): ?>
						<blockquote class="story_quote">
							<div class="story_quote_inner">
								<span class="story_quote_icon">
									<svg class="icon icon_quote">
										<use xlink:href="<?php tric_icon('quote') ?>"></use>
									</svg>
								</span>
								<div class="story_quote_body">
									<p><?php the_field('quotes') ?></p>
								</div>
								<cite class="story_quote_cite">
									<span class="story_quote_cite_name"><?php the_field('quote_author') ?></span>
									<span class="story_quote_cite_label"><?php the_field('graduation_year') ?></span>
								</cite>
							</div>
						</blockquote>
					<?php endif ?>

					<div class="story_detail">
						<header class="story_detail_header">
							<span class="story_detail_label"><?php the_field('subtitle') ?></span>
							<h2 class="story_detail_title"><?php the_title() ?></h2>
						</header>
						<div class="story_detail_caption">
							<?php tric_bulrb_autofill() ?>
						</div>
						<footer class="story_detail_footer">

							<?php if (get_field('link_url')): ?>
								<a class="story_detail_link" href="<?php the_field('link_url') ?>">
									<span class="story_detail_link_label"><?php the_field('link_title') ?></span>
									<span class="story_detail_link_icon" aria-hidden="true">
										<svg class="icon icon_arrow_right">
											<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
										</svg>
									</span>
								</a>
							<?php endif ?>

							<?php if (get_field('type') == 'video'): ?>
								<a class="js-lightbox story_detail_video" href="<?php echo tric_video_support::render_video(get_field('video_url')) ?>">
									<span class="story_detail_video_button">
										<span class="story_detail_video_button_icon">
											<svg class="icon icon_play">
												<use xlink:href="<?php tric_icon('play') ?>"></use>
											</svg>
										</span>
									</span>
									<span class="story_detail_video_label">Watch the Video</span>
								</a>
							<?php endif ?>
						</footer>
					</div><!-- .story_detail -->

				</div>
			</div>
		</div>
	</div>
	<?php wp_reset_postdata(); ?>

<?php endif ?>