<?php
/**
 * Template Breadcrumb
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */
?>
<?php
function tric_breadcrumbs_part($label, $loop, $id = '', $parent = '') {
	global $post;

    $frontpage_id = get_option( 'page_on_front' );
    $siblings = [];

    if ($id !== '' && $parent !== '') {
        $siblings = get_pages(array(
            'exclude'   => [$id, $frontpage_id],
            'parent'    => $parent,
            'post_type' => 'page'
        ));
    }

    $br = '<div class="breadcrumb_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">';
    		if (!empty($siblings)) {
            $br .= '<button class="js-swap breadcrumb_name_switch breadcrumb_name" itemprop="name" data-swap-target=".breadcrumb_dropdown_'.$loop.'">
                <span class="breadcrumb_name_label">'.$label.'</span>';
            	$br .= '<span class="breadcrumb_name_icon">
            	    <svg class="icon icon_expand">
            	        <use xlink:href="'.tric_icon('expand', false).'"></use>
            	    </svg>
            	</span>';
            } else {
            	$no_sibling_page = get_page($id);
            	$br .= '<button class="breadcrumb_name_switch breadcrumb_name" itemprop="name" data-swap-target=".breadcrumb_dropdown_'.$loop.'">';
            	$br .= (isset($post) && $post->ID != $id) ?
            	'<a href="'.get_permalink($no_sibling_page->ID).'" class="breadcrumb_name_label">'.$label.'</a>' :
            	'<span class="breadcrumb_name_label">'.$label.'</span>';
            }
            $br .= '</button>
            <meta itemprop="position" content="'.($loop + 1).'">';

            if (!empty($siblings)) {
                $br .= '<nav class="breadcrumb_dropdown breadcrumb_dropdown_'.$loop.'">';
                    $br .= '<span class="breadcrumb_dropdown_item">'.$label.'</span>';
                    foreach ($siblings as $sibling) {
                        if(empty(get_post_meta($sibling->ID,'_np_nav_status')) || get_post_meta($sibling->ID,'_np_nav_status')[0] != 'hide'){
                            $br .= '<a class="breadcrumb_dropdown_item" href="'.get_permalink($sibling->ID).'">'.$sibling->post_title.'</a>';
                        }
                    }
                $br .= '</nav>';
            }
    $br .= '</div>';
    return $br;
}
?>

<?php if (!is_home() && !is_front_page() || is_paged()): ?>
    <div class="breadcrumb_nav_wrapper">
        <div class="fs-row">
            <div class="fs-cell fs-xl-10 fs-xl-push-1">
                <div class="breadcrumb_nav_inner">

                    <div class="breadcrumb_nav">
                        <div class="breadcrumb_list" itemscope itemtype="http://schema.org/BreadcrumbList">

                            <div class="breadcrumb_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                                <a class="breadcrumb_link" href="<?php echo home_url( '/' ) ?>" itemprop="item">
                                    <span class="breadcrumb_name" itemprop="name">
                                        <span class="breadcrumb_name_icon">
                                            <svg class="icon icon_home">
                                                <use xlink:href="<?php tric_icon('home') ?>"></use>
                                            </svg>
                                        </span>
                                        <span class="breadcrumb_name_label_hide">Home</span>
                                    </span>
                                </a>
                                <meta itemprop="position" content="1">
                            </div>

                            <?php

                            /**
                            * Show different breadcrumb base on page type
                            */

                            $loop = 1;
                            // on root page
                            if (is_page() && !$post->post_parent) {
                                echo tric_breadcrumbs_part($post->post_title, $loop, $post->ID, $post->post_parent);

                            // on child page
                            } elseif ((is_page() && $post->post_parent)) {
                                $loop = 1;
                                $parent_id = $post->post_parent;
                                $current_page = $post;
                                $breadcrumbs = array();

                                while ($parent_id) {
                                    $page = get_page($parent_id);
                                    $breadcrumbs[] = tric_breadcrumbs_part(get_the_title($page->ID), $loop, $page->ID, $page->post_parent);
                                    $parent_id = $page->post_parent;
                                    $loop++;
                                }

                                $breadcrumbs = array_reverse($breadcrumbs);
                                foreach ($breadcrumbs as $crumb) {
                                    echo $crumb;
                                }
                                echo tric_breadcrumbs_part(get_the_title(), $loop, $current_page->ID, $current_page->post_parent);

                            // on single custom post type news_post
                            } elseif (is_singular( 'news_post' )) {
                                echo tric_breadcrumbs_part('News', 1);
                                echo tric_breadcrumbs_part(get_the_title(), 2);

                            // on archive
                            } elseif (is_archive()) {
                                $cpt = get_queried_object();
                                echo tric_breadcrumbs_part($cpt->label, 1);

                            // on 404
                            } elseif (is_404()) {
                                $cpt = get_queried_object();
                                echo tric_breadcrumbs_part('404', 1);

                            // on search
                            } elseif (is_search()) {
                                $cpt = get_queried_object();
                                echo tric_breadcrumbs_part('Search', 1);
                            }

                             ?>

                        </div>
                    </div> <!-- .breadcrumb_nav -->

                </div>
            </div>
        </div>
    </div>
 <?php endif ?>
