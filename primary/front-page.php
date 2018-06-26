<?php get_header(); ?>

<div class="page_feature">
	<div class="spotlight">

		<div class="spotlight_body">
			<div class="js-background spotlight_body_background" data-background-options='{
			"source": {
			<?php if (get_field('video_url')): ?>
				"poster": "<?php the_field('image') ?>",
				"mp4": "<?php the_field('video_url') ?>"
			<?php else: ?>
				"740px": "<?php the_field('image') ?>",
				"0px": "<?php the_field('square_image') ?>"
			<?php endif ?>
			}}'></div>
			<div class="spotlight_body_inner">
			    <div class="fs-row">
			        <div class="fs-cell">
			            <header class="spotlight_header">
			            	<!-- Only show pause/play button when using background video -->
			            	<?php if (get_field('video_url')): ?>
				                <button class="spotlight_video_trigger" title="pause/play background video">
				                    <span class="spotlight_video_icons">
				                        <span class="spotlight_video_icon spotlight_video_icon_pause">
				                            <svg class="icon icon_pause">
				                                <use xlink:href="<?php tric_icon('pause') ?>"></use>
				                            </svg>
				                        </span>
				                        <span class="spotlight_video_icon spotlight_video_icon_play">
				                            <svg class="icon icon_play">
				                                <use xlink:href="<?php tric_icon('play') ?>"></use>
				                            </svg>
				                        </span>
				                    </span>
				                    <span class="spotlight_video_label">Pause Video</span>
				                </button>
			            	<?php endif ?>
			                <h1 class="spotlight_title"><?php the_field('title') ?></h1>
			            </header>
			        </div>
			    </div>
			</div>
		</div><!--.spotlight_body -->

		<div class="js-equalize spotlight_items" data-equalize-options='{"target": ".spotlight_item_title"}'>
			<?php $spotlight_item = ['programs', 'people', 'places', 'pride'] ?>
			<?php foreach ($spotlight_item as $item): ?>
			<div class="js-swap spotlight_item theme_sea" data-swap-target=".spotlight_takeover_item_1" data-swap-group="spotlight_takeover" data-swap-linked="spotlight_takeover_1">
				<div class="js-background spotlight_item_background" data-background-options='{"source": {"0px": "<?php echo get_field($item)['button_image'] ?>"
			}}'></div>
				<div class="spotlight_item_inner">
					<span class="spotlight_item_trigger">
						<span class="spotlight_item_trigger_icon">
							<svg class="icon icon_stretcher"><use xlink:href="<?php tric_icon('stretcher') ?>"></use></svg>
						</span>
					</span>
					<header class="spotlight_item_header">
						<span class="spotlight_item_label"><?php echo $item ?></span>
						<h2 class="spotlight_item_title"><?php echo get_field($item)['title'] ?></h2>
					</header>
				</div>
			</div>
			<?php endforeach ?>
		</div><!--.spotlight_items -->

		<div class="spotlight_items"></div>
	</div>
</div>

<?php get_footer(); ?>