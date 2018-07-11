<?php
/**
 * Template For Full Width Components - News and Event
 */
if ($acf_fc['acf_fc_layout'] == 'news_events') {
	$acf = $acf_fc;
}
?>

<div class="mix">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="mix_inner">

				<div class="mix_news">
					<header class="mix_news_header">
						<a class="mix_news_link" href="#">
						    <span class="mix_news_link_label">View All News</span>
						    <span class="mix_news_link_icon" aria-hidden="true">
						        <svg class="icon icon_arrow_right">
						        	<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
						        </svg>
						    </span>
						</a>
						<h2 class="mix_news_title"><?php echo $acf['news_title'] ?></h2>
					</header>
					<article class="mix_news_item">
						<?php $posts = $acf['news_article'] ?>
						<?php if ($posts): ?>
							<?php foreach( $posts as $post): ?>
								<?php setup_postdata($post); ?>
								<figure class="mix_news_item_figure">
									<a class="mix_news_item_figure_link" href="#">
										<img class="mix_news_item_image" src="<?php the_field('header_image') ?>" alt="image">
									</a>
								</figure>
								<div class="mix_news_item_body">
									<header class="mix_news_item_header">
										<h3 class="mix_news_item_title">
											<a class="mix_news_item_title_link" href="<?php the_permalink(); ?>">
											    <span class="mix_news_item_title_link_label"><?php the_title(); ?></span>
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
							<?php endforeach ?>
							<?php wp_reset_postdata(); ?>
						<?php endif ?>
					</article>
				</div><!-- .mix_news -->

				<div class="mix_events">
					<header class="mix_events_header">
						<a class="mix_events_link" href="#">
						    <span class="mix_events_link_label">View All Events</span>
						    <span class="mix_events_link_icon" aria-hidden="true">
						        <svg class="icon icon_arrow_right">
						            <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
						        </svg>
						    </span>
						</a>
						<h2 class="mix_events_title"><?php echo $acf['events_title'] ?></h2>
					</header>
					<div class="mix_events_items">
						<?php $posts = $acf['events'] ?>
						<?php if ($posts): ?>
							<?php foreach( $posts as $post): ?>
								<?php setup_postdata($post); ?>
								<div class="mix_event">
									<time class="mix_event_date">
										<span class="mix_event_day"><?php the_time('j') ?></span>
										<span class="mix_event_month_year"><?php the_time('M Y') ?></span>
									</time>
									<div class="mix_event_body">
										<h3 class="mix_event_title">
											<a class="mix_event_title_link" href="<?php the_permalink() ?>">
											    <span class="mix_event_title_link_label"><?php the_title() ?></span>
											    <span class="mix_event_title_link_icon" aria-hidden="true">
											    	<svg class="icon icon_arrow_right">
											    		<use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
											    	</svg>
											    </span>
											</a>
										</h3>
										<div class="mix_event_details">
											<?php //if (location): ?>
												<div class="mix_event_detail">
													<span class="mix_event_detail_icon">
			                                            <svg class="icon icon_marker">
			                                            	<use xlink:href="<?php tric_icon('marker') ?>"></use>
			                                            </svg>
                                        			</span>
													<span class="mix_event_detail_label"><?php the_content(); ?></span>
												</div>
											<?php //endif ?>
											<?php //if (time): ?>
												<div class="mix_event_detail">
													<span class="mix_event_detail_icon">
														<svg class="icon icon_clock">
			                                            	<use xlink:href="<?php tric_icon('clock') ?>"></use>
			                                            </svg></span>
													<time class="mix_event_detail_label"><?php the_time('g:i a') ?> - <?php the_time('g:i a') ?></time>
												</div>
											<?php //endif ?>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							<?php wp_reset_postdata(); ?>
						<?php endif ?>
					</div>
				</div> <!-- .mix_events -->

			</div>
		</div>
	</div>
</div>