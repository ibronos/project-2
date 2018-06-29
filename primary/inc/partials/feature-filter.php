<?php
/**
 * Template for Filter Feature
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

$term_tax 	= get_terms( array(
    'taxonomy' => 'news-category' ,
    'hide_empty' => false,
) );

?>

	<div class="filter">
		<div class="fs-row">
			<div class="fs-cell fs-xl-10 fs-all-justify-center">
				<div class="filter_inner">
					<div class="input_wrapper filter_search_input_wrapper">
						<form method="get" name="searchform">
							<input class="input_field filter_search_input_field" type="text" id="search_by_keyword" placeholder="Search by keyword" name="fsearch" />
						</form>
						<label class="input_label filter_search_input_label">Search by keyword</label>
					</div>
					<div class="fs-dropdown-wrapper filter_options_dropdown_wrapper">
						<form method="get" name="filterform">
							<select class="js-dropdown dropdown_field filter_options_dropdown_select" id="filter_by_category_dropdown" name="fcat" onchange="this.form.submit()">
								<option value="0">Filter by Category</option>

								<?php foreach ($term_tax as $term): ?>
									<option value="<?php echo $term->slug;?>"><?php echo $term->name;?></option>
								<?php endforeach ?>

							</select>
						</form>
						<label class="dropdown_label filter_options_dropdown_label" for="filter_by_category_dropdown">Filter by Category</label>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .filter -->
