<?php
/**
 * Template For in content component  - topic row
 */
if ($acf_fc['acf_fc_layout'] == 'topic_rows') {
	$acf = $acf_fc;
}
?>

<div class="topic_block">
	<div class="topic_items">
		<?php foreach ($acf['rows'] as $topic_rows) : ?>
			<article class="topic_item">
				<div class="topic_item_inner">
					<figure class="topic_figure">
						<?php if (isset($topic_rows['image'])) { ?>
							<a class="topic_figure_link" target="_blank" href="<?php echo esc_url($topic_rows['link_url']) ?>">
								<img class="topic_image" src="<?php echo $topic_rows['image'];?>" alt="image">
							</a>
						<?php } ?>

					</figure>
					<div class="topic_wrapper">
						<header class="topic_header">
							<h3 class="topic_title">
								<a class="topic_title_link" target="_blank" href="<?php echo esc_url($topic_rows['link_url']) ?>">
									<?php echo $topic_rows['title'];?>
								</a>
						    </h3>
						</header>
						<div class="topic_body">
							<div class="topic_caption">
								<p><?php echo $topic_rows['blurb'];?></p>
							</div>
						</div>
						<footer class="topic_footer">
							<a class="topic_link" target="_blank" href="<?php echo esc_url($topic_rows['link_url']) ?>">
								<span class="topic_link_label"><?php echo $topic_rows['link_title'] ?></span>
								<span class="topic_link_icon" aria-hidden="true">
									<svg class="icon icon_arrow_right">
						                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
						            </svg>
								</span>
							</a>
						</footer>
					</div>
				</div>
			</article>
		<?php endforeach ?>
	</div>
</div>
