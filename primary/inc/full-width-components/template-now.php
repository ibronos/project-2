<?php
/**
 * Template For Full Width Components - Important Now
 */

$flex_components = get_field('full-width_components');
foreach ($flex_components as $acf_fc) {
	if ($acf_fc['acf_fc_layout'] == 'important_now') {
		$acf = $acf_fc;
	}
}

?>
<div class="now">
	<header class="now_header">
		<div class="fs-row">
			<div class="fs-cell">
				<div class="now_header_inner"> <span class="now_label"><?php echo $acf['title'] ?></span>
					<h2 class="now_title"><?php echo $acf['subtitle'] ?></h2>
				</div>
			</div>
		</div>
	</header>
	<div class="now_inner">
		<div class="fs-row">
			<div class="fs-cell">
				<div class="js-carousel now_items" data-carousel-options='{
					"theme": "base_theme",
					"controls": false,
					"contained": false,
					"maxWidth": "979px"
				}'>
					<?php $sections = $acf['sections'] ?>
					<?php $theme = ['orange', 'sea', 'frog', 'bee'] ?>
					<?php foreach ($sections as $i => $section): ?>
						<div class="now_item theme_<?php echo $theme[$i] ?>">
							<figure class="now_item_figure">
								<picture class="now_item_picture">
									<source media="(min-width: 1220px)" srcset="<?php echo $section['image'] ?>">
									<source media="(min-width: 980px)" srcset="<?php echo $section['image'] ?>">
									<source media="(min-width: 0px)" srcset="<?php echo $section['image'] ?>">
									<img class="now_item_image" src="<?php get_template_directory_uri() ?>images/placeholder.png" alt="">
								</picture>
							</figure>
							<a class="now_body" href="<?php echo esc_url($section['link']) ?>">
								<div class="now_caption">
									<strong><?php echo $section['title'] ?></strong>
									<?php echo $section['description'] ?>
								</div>
								<span class="now_icon">
									<svg class="icon icon_stretcher"><use xlink:href="<?php tric_icon('arrow_right') ?>"></use></svg>
								</span>
							</a>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>