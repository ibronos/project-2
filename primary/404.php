<?php
/**
 * Template Name: 404
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Trinity_College
 */

get_header();

$args = [
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => '404.php'
];
$pages 	= get_posts( $args );
$post 	= $pages[0];

if ($post):
    setup_postdata( $post );  ?>
    <div class="page_feature"></div>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="page_header">
            <?php if (get_field('header_image')): ?>
                <div class="js-background page_background" data-background-options='{"source": {
                    "0px": "<?php the_field('header_image') ?>",
                    "500px": "<?php the_field('header_image') ?>",
                    "980px": "<?php the_field('header_image') ?>",
                    "1220px": "<?php the_field('header_image') ?>"
                }}'></div>
            <?php endif ?>
            <div class="page_header_inner">
                <div class="fs-row">
                    <!-- Main Content -->
                     <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
                        <div class="page_header_body">
                            <h1 class="page_title"><?php the_field('page_title') ?></h1>
                            <p class="page_intro"><?php the_field('introduction_paragraph') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search_field_block">
                <div class="fs-row">
                    <div class="fs-cell fs-xl-10 fs-all-justify-center">
                        <div class="search_field_inner">

                        	<?php if (get_field('google_cse_id')): ?>
	                		 	<div class="site_search site_search_results" id="site_search_results" itemscope itemtype="http://schema.org/WebSite" role="search">
	                        		<div class="fs-row">
	                        			<div class="fs-cell">
	                        				<script>
	                        					(function() {
	                        						var cx = "<?php the_field('google_cse_id') ?>"
	                        						var gcse = document.createElement('script');
	                        						gcse.type = 'text/javascript';
	                        						gcse.async = true;
	                        						gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	                        						var s = document.getElementsByTagName('script')[0];
	                        						s.parentNode.insertBefore(gcse, s);
	                        					})();
	                        				</script>
	                        				<div class="gcse-search"></div>
	                        				<noscript>
	                        					<div class="typography">
	                        						<p>The site search requires a JavaScript enabled browser. You can also search the site using <a href="//www.google.com/#q=site:{{vars.domain}}">Google</a>.</p>
	                        					</div>
	                        				</noscript>
	                        			</div>
	                        		</div>
	                        	</div>
                        	<?php else: ?>
	                            <div class="site_search site_search_results" id="site_search_results" itemscope itemtype="http://schema.org/WebSite" role="search">
	                                <meta itemprop="url" content="http://http://www.trincoll.edu/Pages/default.aspx">
	                                <form class="site_search_form" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	                                    <meta itemprop="target" content="<?php echo esc_url( home_url( '/' )) ?>?s=<?php the_search_query() ?>">
	                                    <label class="site_search_label" for="search_term_string_results">Search</label>
	                                    <input aria-live="polite" class="site_search_input" itemprop="query-input" type="search" id="search_term_string_results" name="s" placeholder="Search">
	                                    <button class="site_search_button" type="submit" title="submit" aria-label="submit">
	                                        <span class="site_search_button_label">submit</span>
	                                        <span class="site_search_button_icon">
	                                            <svg class="icon icon_search">
	                                                <use xlink:href="<?php tric_icon('search') ?>"></use>
	                                            </svg>
	                                        </span>
	                                    </button>
	                                </form>
	                            </div><!-- .site_search -->
                        	<?php endif ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="basic_list">
                <div class="fs-row">
                    <div class="fs-cell fs-xl-10 fs-all-justify-center">
                        <nav class="basic_list_nav">
                            <?php foreach (get_field('links') as $link): ?>
                                <a class="basic_list_link" href="<?php echo $link['url'] ?>">
                                    <span class="basic_list_link_label"><?php echo $link['title'] ?></span>
                                    <span class="basic_list_link_icon" aria-hidden="true">
                                        <svg class="icon icon_arrow_right">
                                            <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
                                        </svg>
                                    </span>
                                </a>
                            <?php endforeach ?>
                        </nav>
                    </div>
                </div>
            </div><!-- .basic_list -->

        </div><!-- .page_header -->

        <!-- .content -->
        <div class="page_content">
            <div class="fs-row"></div>
            <div class="full_width_callouts">

            </div><!--.full_width_callouts -->
        </div><!--.page_content-->
    </div><!-- #post-<?php the_ID(); ?> -->
<?php endif ?>
<?php wp_reset_postdata() ?>

<?php get_footer() ?>
