<?php
/**
 *  Homepage - Programs item
 */

$item = 'programs';
$programs_post = get_posts( array(
	'post_type' => 'programs_post'
) );
?>

<!-- Programs -->
<div class="spotlight_takeover_item spotlight_takeover_item_1 theme_sea layout_pair layout_filters">
	<button class="js-swap spotlight_takeover_item_close" data-swap-target="spotlight_takeover_item_1" data-swap-group="spotlight_takeover" title="close spotlight takeover">
		<span class="spotlight_takeover_item_close_icon">
			<svg class="icon icon_close">
				<use xlink:href="<?php tric_icon('close') ?>"></use>
			</svg>
		</span>
	</button>
	<div class="spotlight_takeover_intro">
		<div class="spotlight_takeover_intro_inner">
			<div class="js-background spotlight_takeover_intro_background" data-background-options='{"source": {
			"740px": "<?php echo get_field($item)['image'] ?>",
			"980px": "<?php echo get_field($item)['image'] ?>"
			}}'></div>
			<header class="spotlight_takeover_intro_header">
				<h3 class="spotlight_takeover_intro_label"><?php echo $item ?></h3>
				<h4 class="spotlight_takeover_intro_title"><?php echo get_field($item)['title'] ?></h4>
			</header>
		</div>
		<!-- only program 1-->
		<div class="spotlight_takeover_intro_body">
			<div class="input_wrapper spotlight_takeover_input_wrapper">
				<input class="input_field spotlight_takeover_input_field" type="search" id="search_by_keyword" placeholder="Search by keyword" />
				<label class="input_label spotlight_takeover_input_label">Search by keyword</label>
			</div>
			<div class="spotlight_takeover_filter">
				<span class="spotlight_takeover_filter_label">Filter By Area of Study</span>
				<div class="spotlight_takeover_options">
					<div class="choices_wrapper spotlight_takeover_choices_wrapper">
						<label class="choices_label spotlight_takeover_choices_label" for="view_all_programs">
							<input class="js-radio choices_field spotlight_takeover_choices_field" type="radio" name="spotlight_takeover" id="view_all_programs" value="0">
							<span class="choices_name spotlight_takeover_choices_name">View All Programs</span>
						</label>
						<?php foreach ($program_terms as $program_term): ?>
							<label class="choices_label spotlight_takeover_choices_label" for="<?php echo $program_term->slug ?>">
								<input class="js-radio choices_field spotlight_takeover_choices_field" type="radio" name="spotlight_takeover" id="<?php echo $program_term->slug; ?>" value="<?php echo $program_term->name ?>">
								<span class="choices_name spotlight_takeover_choices_name"><?php echo $program_term->name ?></span>
							</label>
						<?php endforeach ?>
					</div>
				</div>
				<div class="input_wrapper spotlight_takeover_filter_input_wrapper">
					<input class="input_field spotlight_takeover_filter_input_field" type="submit" id="submit" />
					<label class="input_label spotlight_takeover_filter_input_label">Submit</label>
				</div>
			</div>
		</div><!-- only program 1-->
	</div>
	<div class="spotlight_takeover_content">

		<div class="spotlight_takeover_details">
			<div class="spotlight_takeover_detail">
				<span class="spotlight_takeover_detail_label">Viewing/<strong class="spotlight_takeover_detail_title">All Programs</strong></span>
			</div>
			<div class="spotlight_takeover_result"><?php echo count($programs_post); ?></div>
		</div>

		<?php foreach ($programs_post as $post): ?>
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

	</div>
</div>