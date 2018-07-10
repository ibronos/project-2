<?php
/**
 *  Homepage - People item
 */
?>

<!-- <?php echo $item ?> -->
<div class="spotlight_takeover_item spotlight_takeover_item_<?php echo $count ?> theme_<?php echo $theme[$i] ?>
	<?php echo $acf_item['has_links'] ? 'layout_pair' : 'layout_fill' ?>">
    <button class="js-swap spotlight_takeover_item_close" data-swap-target="spotlight_takeover_item_<?php echo $count ?>" data-swap-group="spotlight_takeover" title="close spotlight takeover">
        <span class="spotlight_takeover_item_close_icon">
            <svg class="icon icon_close">
                <use xlink:href="<?php tric_icon('close') ?>"></use>
            </svg>
        </span>
    </button>
    <div class="spotlight_takeover_intro">
        <div class="spotlight_takeover_intro_inner">
            <div class="js-background spotlight_takeover_intro_background" data-background-options='{"source": {
            "740px": "<?php echo $acf_item['has_links'] ? $acf_item['button_image'] : $acf_item['portrait_image']?>",
            "980px": "<?php echo $acf_item['has_links'] ? $acf_item['button_image'] : $acf_item['portrait_image']?>"}}'>
            </div>
            <header class="spotlight_takeover_intro_header">
            	<h3 class="spotlight_takeover_intro_label"><?php echo $item ?></h3>
            	<h4 class="spotlight_takeover_intro_title"><?php echo $acf_item['title'] ?></h4>
            </header>
        </div>
        <?php if ($acf_item['has_links']): ?>
        	<div class="spotlight_takeover_intro_body">
        	    <?php foreach ($acf_item['links'] as $links): ?>
        	    	<a class="spotlight_takeover_intro_link" href="<?php echo esc_url($links['url']) ?>">
        	    	    <span class="spotlight_takeover_intro_link_label"><?php echo $links['title'] ?></span>
        	    	    <span class="spotlight_takeover_intro_link_icon" aria-hidden="true">
        	    	        <svg class="icon icon_arrow_right">
        	    	            <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
        	    	        </svg>
        	    	    </span>
        	    	</a>
        	    <?php endforeach ?>
        	</div>
        <?php endif ?>
    </div>

    <div class="spotlight_takeover_content">
    	<?php foreach ($acf_item['stories'] as $post): ?>
    		<?php setup_postdata( $post ) ?>

    		<?php if (get_field('type') == 'quote' || get_field('type') == 'story'): ?>
    			<div class="quote_item">
    				<figure class="quote_item_figure">
    					<picture class="quote_item_picture">
    						<source media="(min-width: 740px)" srcset="<?php the_field('image') ?>" />
    						<source media="(min-width: 0px)" srcset="<?php the_field('image') ?>" />
    						<img class="quote_item_image" src="<?php the_field('image') ?>" alt="">
    					</picture>

    					<?php if (get_field('type') == 'quote'): ?>
	    					<span class="quote_item_mark">
		                        <span class="quote_item_mark_icon">
		                            <svg class="icon icon_quote">
		                                <use xlink:href="<?php tric_icon('quote') ?>"></use>
		                            </svg>
		                        </span>
		                    </span>
		                    <figcaption class="quote_item_figcaption">
		                        <div class="quote_item_figcaption_inner">
		                            <span class="quote_item_mini_mark">
		                                <svg class="icon icon_quote">
		                                    <use xlink:href="<?php tric_icon('quote') ?>"></use>
		                                </svg>
		                            </span>
		                            <div class="quote_item_content"><?php the_field('quotes') ?></div>
		                            <div class="quote_item_mini_details">
		                                <span class="quote_item_mini_label"><?php the_field('quote_author') ?></span>
		                                <span class="quote_item_mini_year"><?php the_field('graduation_year') ?></span>
		                            </div>
		                        </div>
		                    </figcaption>
	                	<?php endif ?>

    				</figure>
    				<div class="quote_item_body">
    					<header class="quote_item_header">
    						<h3 class="quote_item_title"><?php (get_field('type') == 'quote')  ? the_field('quote_author') : the_title() ?></h3>
    						<div class="quote_item_details">
    							<span class="quote_item_label"><?php the_field('subtitle') ?></span>
    							<span class="quote_item_year"><?php the_field('graduation_year') ?></span>
    						</div>
    					</header>
    					<?php //var_dump($post) ?>
    					<div class="quote_item_caption"><?php tric_bulrb_autofill() ?></div>
    					<a class="quote_item_link" href="<?php the_field('link_url') ?>">
    						<span class="quote_item_link_label"><?php the_field('link_title') ?></span>
    						<span class="quote_item_link_icon" aria-hidden="true">
    							<svg class="icon icon_arrow_right">
    								<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
    							</svg>
    						</span>
    					</a>
    				</div>
    			</div>
    		<?php endif ?>

    		<?php if (get_field('type') == 'video'): ?>
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
    		<?php endif ?>

    	<?php endforeach ?>
    	<?php wp_reset_postdata() ?>

    </div>


</div>