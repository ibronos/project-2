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
function tric_breadcrumbs_part($label, $loop, $id, $parent) {

	$frontpage_id = get_option( 'page_on_front' );

	$siblings = get_pages(array(
		'exclude' 	=> [$id, $frontpage_id],
		'parent' 	=> $parent,
		'post_type' => 'page'
	));

	$br = '<div class="breadcrumb_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
		    <button class="js-swap breadcrumb_name_switch breadcrumb_name" itemprop="name" data-swap-target=".breadcrumb_dropdown_'.$loop.'">
		        <span class="breadcrumb_name_label">'.$label.'</span>
		        <span class="breadcrumb_name_icon">
		            <svg class="icon icon_expand">
		                <use xlink:href="'.tric_icon('expand', false).'"></use>
		            </svg>
		        </span>
		    </button>
		    <meta itemprop="position" content="'.($loop + 1).'">';

		    if ($siblings) {
		    	$br .= '<nav class="breadcrumb_dropdown breadcrumb_dropdown_'.$loop.'">';
		    		foreach ($siblings as $sibling) {
		    			$br .= '<a class="breadcrumb_dropdown_item" href="'.$sibling->guid.'">'.$sibling->post_title.'</a>';
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
		            		$loop = 1;
		            		if (is_page() && !$post->post_parent) {
			            		echo tric_breadcrumbs_part($post->post_title, $loop, $post->ID, $post->post_parent);

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
		            		}  ?>

		            	</div>
		            </div> <!-- .breadcrumb_nav -->

	            </div>
	        </div>
	    </div>
	</div>
 <?php endif ?>