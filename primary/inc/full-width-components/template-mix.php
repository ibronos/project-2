<?php
/**
 * Template For Full Width Components - News and Event
 */
if ($acf_fc['acf_fc_layout'] == 'news_events') {
	$acf = $acf_fc;
}
$posts = $acf['news_article'];
$posts_event = $acf['events'];
?>

<div class="mix">
	<div class="fs-row">
		<div class="fs-cell">
			<div class="mix_inner">

				<div class="mix_news">
					<header class="mix_news_header">
						<?php if($posts): ?>
							<?php switch_to_blog( $posts['site_id'] ); ?>
							<a class="mix_news_link" href="<?php echo get_post_type_archive_link( 'news_post' ); ?>">
							    <span class="mix_news_link_label">View All News</span>
							    <span class="mix_news_link_icon" aria-hidden="true">
							        <svg class="icon icon_arrow_right">
							        	<use xlink:href="<?php tric_icon('arrow_right'); ?>"></use>
							        </svg>
							    </span>
							</a>
							<?php restore_current_blog(); ?>
					<?php endif; ?>
						<h2 class="mix_news_title"><?php echo $acf['news_title']; ?></h2>
					</header>
					<article class="mix_news_item">
						<?php if ($posts): ?>
							<?php switch_to_blog( $posts['site_id'] ); ?>
							<?php foreach( $posts['selected_posts'] as $post): ?>
								<?php setup_postdata($post); ?>
								<?php if(get_field('header_image')): ?>
								<figure class="mix_news_item_figure">
									<a class="mix_news_item_figure_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
										<img class="mix_news_item_image" src="<?php the_field('header_image'); ?>" alt="image">
									</a>
								</figure>
								<?php endif; ?>
								<div class="mix_news_item_body">
									<header class="mix_news_item_header">
										<h3 class="mix_news_item_title">
											<a class="mix_news_item_title_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
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
							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
							<?php restore_current_blog(); ?>
						<?php endif; ?>
					</article>
				</div><!-- .mix_news -->

				<div class="mix_events">
					<header class="mix_events_header">
						<?php if ($posts_event): ?>
							<?php switch_to_blog( $posts['site_id'] ); ?>
							<a class="mix_events_link" href="<?php echo get_post_type_archive_link( 'events_post' ); ?>">
							    <span class="mix_events_link_label">View All Events</span>
							    <span class="mix_events_link_icon" aria-hidden="true">
							        <svg class="icon icon_arrow_right">
							            <use xlink:href="<?php tric_icon('arrow_right'); ?>"></use>
							        </svg>
							    </span>
							</a>
							<?php restore_current_blog(); ?>
						<?php endif; ?>
						<h2 class="mix_events_title"><?php echo $acf['events_title']; ?></h2>
					</header>
					<div class="mix_events_items">
						<?php if ($posts_event): ?>
							<?php switch_to_blog( $posts['site_id'] ); ?>
							<?php foreach( $posts_event['selected_posts'] as $post): ?>
								<?php setup_postdata($post); ?>
								<div class="mix_event">
									<time class="mix_event_date">
										<span class="mix_event_day"><?php the_time('j'); ?></span>
										<span class="mix_event_month_year"><?php the_time('M Y'); ?></span>
									</time>
									<div class="mix_event_body">
										<h3 class="mix_event_title">
											<a class="mix_event_title_link" href="<?php echo get_the_permalink(get_the_ID()); ?>">
											    <span class="mix_event_title_link_label"><?php the_title(); ?></span>
											    <span class="mix_event_title_link_icon" aria-hidden="true">
											    	<svg class="icon icon_arrow_right">
											    		<use xlink:href="<?php tric_icon('arrow_right'); ?>"></use>
											    	</svg>
											    </span>
											</a>
										</h3>
										<div class="mix_event_details">
											<?php //if (location): ?>
												<div class="mix_event_detail">
													<span class="mix_event_detail_icon">
			                                            <svg class="icon icon_marker">
			                                            	<use xlink:href="<?php tric_icon('marker'); ?>"></use>
			                                            </svg>
                                        			</span>
													<span class="mix_event_detail_label"><?php the_content(); ?></span>
												</div>
											<?php //endif ?>
											<?php //if (time): ?>
												<div class="mix_event_detail">
													<span class="mix_event_detail_icon">
														<svg class="icon icon_clock">
			                                            	<use xlink:href="<?php tric_icon('clock'); ?>"></use>
			                                            </svg></span>
													<time class="mix_event_detail_label"><?php the_time('g:i a'); ?> - <?php the_time('g:i a'); ?></time>
												</div>
											<?php //endif ?>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							<?php wp_reset_postdata(); ?>
							<?php restore_current_blog(); ?>
						<?php endif; ?>
					</div>
				</div> <!-- .mix_events -->

			</div>
		</div>
	</div>
</div>