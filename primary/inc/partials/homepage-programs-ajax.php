
<?php
	global $post;

	$item = 'programs';
	$keyword = esc_attr( $_POST['keyword'] );
	$type = esc_attr( $_POST['type'] );

	if ($type == 'search') {
		$args = array(
			'posts_per_page' 	=> -1,
			's' 				=> $keyword,
			'post_type'		 	=> 'programs_post',
			'orderby' 			=> 'title',
			'order' 			=> 'ASC'
		);
		$keyword = 'Keyword: '.$keyword;
	} else {
        $args = array(
            'posts_per_page'    => -1,
            'post_type'         => 'programs_post',
            'orderby'           => 'title',
            'order'             => 'ASC',
            'tax_query'         => array(
            array(
                'taxonomy'  => 'areas-of-study',
                'field'     => 'slug',
                'terms'     => $keyword,
            ),
        ));
	}

	$programs_post = new WP_Query($args);
?>

<div class="spotlight_takeover_details">
	<div class="spotlight_takeover_detail">
		<span class="spotlight_takeover_detail_label">Viewing/<strong class="spotlight_takeover_detail_title"><?php echo $keyword ?></strong></span>
	</div>
	<div class="spotlight_takeover_result"><?php echo $programs_post->post_count ?></div>
</div>

<?php if ($programs_post->post_count): ?>

	<?php foreach ($programs_post->posts as $post): ?>
		<?php setup_postdata( $post ) ?>
		<?php $t_types = wp_get_post_terms($post->ID, 'areas-of-study', array("fields" => "all")); ?>
		<article class="program <?php foreach($t_types as $key => $value){echo $value->slug.' ';} ?>">
			<?php if (get_field('video_url')): ?>
				<div class="video_item">
					<figure class="video_item_figure">
						<picture class="video_item_picture">
							<source media="(min-width: 740px)" srcset="<?php the_field('image') ?>" />
							<source media="(min-width: 0px)" srcset="<?php the_field('image') ?>" />
							<img class="video_item_image" src="<?php the_field('image') ?>" alt="">
						</picture>
						<button class="video_item_video" title="play video" data-url="<?php echo tric_video_support::render_video(get_field('video_url')) ?>">
							<span class="video_item_video_hint">
								<span class="video_item_video_hint_icon_bubble">
									<span class="video_item_video_hint_icon">
										<svg class="icon icon_play">
											<use xlink:href="<?php tric_icon('play') ?>"></use>
										</svg>
									</span>
								</span>
								<span class="video_item_video_hint_label">Watch the Video</span>
							</span>
						</button>
					</figure>
					<div class="video_item_body">
						<header class="video_item_header">
							<h3 class="video_item_title"><?php the_title() ?></h3>
						</header>
					</div>
				</div>
			<?php else: ?>
				<picture class="program_picture">
					<source media="(min-width: 740px)" srcset="<?php the_field('image') ?>" />
					<source media="(min-width: 0px)" srcset="<?php the_field('image') ?>" />
					<img class="program_image" src="<?php the_field('image') ?>" alt="">
				</picture>
				<div class="program_body">
					<header class="program_header">
						<h3 class="program_title">
							<a class="program_title_link" target="_blank" href="<?php the_field('link') ?>">
								<span class="program_title_link_label"><?php the_title() ?></span>
								<span class="program_title_link_icon" aria-hidden="true">
									<svg class="icon icon_arrow_right">
										<use xlink:href="<?php echo tric_icon('arrow_right') ?>"></use>
									</svg>
								</span>
							</a>
						</h3>
						<div class="program_details">
							<span class="program_label">Degree(s) Offered</span>
							<span class="program_degrees">
								<?php foreach (get_field('degrees_offered') as $i => $degrees_offered): ?>
									<span class="program_degree">
										<?php echo ($i > 0) ? ',' : '' ?>
										<?php echo $degrees_offered ?>
									</span>
								<?php endforeach ?>
							</span>
						</div>
					</header>
					<div class="program_caption"><?php the_field('blurb') ?></div>
					<a class="program_link" target="_blank" href="<?php the_field('link') ?>">
						<span class="program_link_label">Learn More</span>
						<span class="program_link_icon" aria-hidden="true">
							<svg class="icon icon_arrow_right">
								<use xlink:href="<?php echo tric_icon('arrow_right') ?>"></use>
							</svg>
						</span>
					</a>
				</div>
			<?php endif ?>
		</article>
	<?php endforeach ?>
	<?php wp_reset_postdata() ?>

<?php else: ?>
	<div class="program_caption">No Results Found. Please Try Again.</div>
<?php endif ?>
