<?php
/**
 * Template For in content component  - wysiwyg
 */

$flex_components = get_field('in-content_components');

foreach ($flex_components as $acf_fc) {
	if ($acf_fc['acf_fc_layout'] == 'wysiwyg') {
		$acf = $acf_fc;
	}
}
?>

<div class="wysiwyg_block">
   <div class="typography">
   		<?php echo $acf['content'] ?>
    </div>
 </div>