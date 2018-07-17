<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Trinity_College
 */

?>

	</div><!-- #content -->

	<!-- footer_id = [footer-primary, footer-info, footer-social] -->
	<footer class="footer" id="footer" itemscope itemtype="http://schema.org/WPFooter">
		<div class="footer_ribbon">
			<div class="fs-row">
				<div class="fs-cell">
					<div class="footer_ribbon_inner">
						<div class="footer_ribbon_group">
							<div class="logo logo_footer logo_icon" itemscope itemtype="http://schema.org/Organization">
							    <a class="logo_link" itemprop="url" href="<?php echo home_url( '/' ) ?>">
							        <span class="logo_link_label">Trinity College</span>
							        <span class="logo_link_icon">
							            <svg class="icon icon_logo">
							                <use xlink:href="<?php tric_icon('logo') ?>"></use>
							            </svg>
							        </span>
							    </a>
							    <meta content="<?php echo get_template_directory_uri() ?>/images/logo-schema.png" itemprop="logo">
							</div><!--.logo_footer-->

							<div class="footer_address" itemscope itemtype="http://schema.org/PostalAddress">
							    <a class="footer_address_link" href="https://www.google.com/maps/place/300+Summit+St,+Hartford,+CT+06106/data=!4m2!3m1!1s0x89e6533b575037eb:0xae1c576e17982be3?sa=X&ved=0ahUKEwjrhPqIyr_bAhUDxVkKHesqBlgQ8gEIJjAA" target="_blank">
							        <span class="footer_address_name" itemprop="name">Trinity College</span>
							        <span class="footer_address_street" itemprop="streetAddress">300 Summit Street, </span>
							        <span class="footer_address_city" itemprop="addressLocality">Hartford</span>
							        <span class="footer_address_state" itemprop="addressRegion">CT</span>
							        <span class="footer_address_zip" itemprop="postalCode">06106</span>
							    </a>
							    <a class="footer_address_phone" itemprop="telephone" href="tel:(860) 297-2000">
							        <span class="footer_address_label">(860) 297-2000</span>
							    </a>
							</div><!--.footer_address-->
						</div>
						<div class="footer_ribbon_group">
							<div class="social_nav social_nav_base" itemscope itemtype="http://schema.org/Organization">
							    <link itemprop="url" href="//http://www.trincoll.edu/Pages/default.aspx">
							    <div class="social_nav_header">
							        <h2 class="social_nav_title">Social Navigation</h2>
							    </div>
							    <div class="social_nav_list">
							    	<?php foreach (tric_navigation('footer-social') as $object): ?>
							    		<?php if (tric_social_filter($object->title)): ?>
									        <div class="social_nav_item">
									            <a class="social_nav_link" href="<?php echo esc_url($object->url) ?>" target="_blank" itemprop="sameAs">
									                <span class="social_nav_icon">
									                    <svg class="icon icon_<?php echo $object->title ?>">
									                        <use xlink:href="<?php tric_icon($object->title) ?>"></use>
									                    </svg>
									                </span>
									                <span class="social_nav_label"><?php echo $object->title ?></span>
									            </a>
									        </div>
										<?php endif ?>
							    	<?php endforeach ?>
							    </div>
							</div><!--.social_nav-->

							<div class="quick_nav_wrapper">
								<header class="quick_nav_header">
									<h2 class="quick_nav_title">Information For</h2>
								</header>
								<nav class="quick_nav" aria-label="" itemscope itemtype="http://schema.org/SiteNavigationElement">
								    <div class="quick_nav_list" role="navigation">
								    	<?php foreach (tric_navigation('footer-info') as $object): ?>
									        <div class="quick_nav_item">
									            <a class="quick_nav_link" href="<?php echo esc_url($object->url) ?>" itemprop="url">
									                <span class="quick_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
									            </a>
									        </div>
								        <?php endforeach ?>
								    </div>
								</nav>
							</div><!--.quick_nav_wrapper-->

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_sole">
			<div class="fs-row">
				<div class="fs-cell">
					<nav class="footer_nav" aria-label="Footer Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					    <div class="footer_nav_header">
					        <h2 class="footer_nav_title">Footer Navigation</h2>
					    </div>
					    <div class="footer_nav_list" role="navigation">
					    	<?php foreach (tric_navigation('footer-primary') as $object): ?>
						        <div class="footer_nav_item">
						            <a class="footer_nav_link" href="<?php echo esc_url($object->url) ?>" itemprop="url">
						                <span class="footer_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
						            </a>
						        </div>
					    	<?php endforeach ?>
					    </div>
					</nav>
				</div>
			</div>
		</div>
	</footer><!-- #footer -->
</div><!-- #page -->

<div class="js-mobile-sidebar mobile_sidebar" id="mobile_sidebar" tabindex="-1">

	<div class="site_search site_search_sm" id="site_search_sm" itemscope itemtype="http://schema.org/WebSite" role="search">
	    <meta itemprop="url" content="<?php echo home_url( '/' ) ?>">
	    <form class="site_search_form" itemprop="potentialAction" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	        <meta itemprop="target" content="<?php echo home_url( '/' ) ?>?s=<?php the_search_query(); ?>">
	        <label class="site_search_label" for="search_term_string_sm">Search</label>
	        <input aria-live="polite" class="site_search_input" itemprop="query-input" type="search" id="search_term_string_sm" name="s" value="<?php the_search_query(); ?>" placeholder="Search by keyword">
	        <button class="site_search_button" type="submit" title="submit" aria-label="submit">
	            <span class="site_search_button_label">Submit Search Query</span>
	            <span class="site_search_button_icon">
	                <svg class="icon icon_search">
	                    <use xlink:href="<?php tric_icon('search') ?>"></use>
	                </svg>
	            </span>
	        </button>
	    </form>
	</div><!--.site_search-->

	<nav class="js-main-nav js-main-nav-sm main_nav main_nav_sm" aria-label="Mobile Site Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
   		<?php $args = array(
			'menu' 			=> 'nested-pages',
			'items_wrap' 	=> '<div id="%1$s" class="main_nav_list" role="navigation">%3$s</div>',
			'container'		=> false,
			'menu_class' 	=> 'nav navbar-nav',
			'walker'		=> new tric_walker_nav_menu()
		);
		wp_nav_menu( $args  ); ?>
	</nav><!--nav .js-main-nav-->

	<nav class="secondary_nav secondary_nav_sm" aria-label="Mobile Secondary Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
	    <div class="secondary_nav_header">
	        <h2 class="secondary_nav_title">Mobile Secondary Navigation</h2>
	    </div>
	    <div class="secondary_nav_list" role="navigation">
	        <?php foreach (tric_navigation('secondary') as $object): ?>
	        	<div class="secondary_nav_item">
	        	    <a class="secondary_nav_link arrow_right" href="<?php echo esc_url($object->url) ?>" itemprop="url">
	        	        <span class="secondary_nav_link_icon">
	        	            <svg class="icon icon_arrow_right">
	        	                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
	        	            </svg>
	        	        </span>
	        	        <span class="secondary_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
	        	    </a>
	        	</div>
	        <?php endforeach; ?>
	    </div>
	</nav><!--.secondary_nav-->

</div>

<?php wp_footer(); ?>

</body>
</html>

<script>
(function() {
    var cx = "<?php the_field('google_cse_id'); ?>";
    if(cx.trim() === ""){
    	cx = "011737558837375720776:mbfrjmyam1g";
    }
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>