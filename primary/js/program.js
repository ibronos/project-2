(function($, settings) {
	"use strict";
	$(document).ready(function() {

		function reset_term(type) {
			if (type == 'tax') {
				// radio
				$('.fs-checkbox-radio').removeClass("fs-checkbox-checked");
				$('#view_all_programs').attr("checked", true);
				$('input[name="spotlight_takeover"][id="view_all_programs"]').parent().parent().addClass("fs-checkbox-checked");
				//select
				$('select.spotlight_takeover_mini_select').val(0);
			} else if (type == 'search') {
				$('input#search_by_keyword').val('');
				$('input#search_by_keyword_mini').val('');
			}
		}

		//Filter By Search
		$('body').on('keyup', 'input#search_by_keyword, input#search_by_keyword_mini', function(e) {
			var key 		= $('input#search_by_keyword').val().length;
			var key_mini 	= $('input#search_by_keyword_mini').val().length;

			reset_term('tax');

			if (key >= 3 || key_mini >= 3) {

				if (key_mini >= 3) var skey = '#search_by_keyword_mini';
				else var skey = '#search_by_keyword';

				$('#spotlight_takeover_content_default').hide();
				$('#spotlight_takeover_content_js').show();
			    $.ajax({
			        url: settings.ajaxurl,
			        type: 'post',
	                data: {
	                	action: 'data_fetch',
	                	type: 'search',
	                	keyword: $(skey).val()
	                },
	                success: function(data) {
	                    $('#datafetch').html( data );
	                }
			    });
			} else {
		    	$('#spotlight_takeover_content_default').show();
		    	$('#spotlight_takeover_content_js').hide();
		    }
		});

		//Filter By Taxonomy Radio
		$('body').on('click', 'input#submit', function(e) {
		    e.preventDefault();
		    var st          = $('input[name="spotlight_takeover"]:checked');
		    var st_value    = st[0].value;

		   	reset_term('search');

		    if (st.length > 0 && st_value != 0) {
		        $('#spotlight_takeover_content_default').hide();
		        $('#spotlight_takeover_content_js').show();
		        $.ajax({
		            url: settings.ajaxurl,
		            type: 'post',
		            data: {
		                action: 'data_fetch',
		                type: 'taxonomy',
		                keyword: st_value
		            },
		            success: function(data) {
		                $('#datafetch').html( data );
		            }
		        });
		    } else {
		        $('#spotlight_takeover_content_default').show();
		        $('#spotlight_takeover_content_js').hide();
		    }
		});

		//Filter By Taxonomy Select (mobile)
		$('body').on('change', 'select.spotlight_takeover_mini_select', function(e) {
		    var st_value    = $('select.spotlight_takeover_mini_select option:selected').val()

		   	$('input#search_by_keyword').val('');
		    $('input#search_by_keyword_mini').val('');

		    if (st_value != 0) {
		        $('#spotlight_takeover_content_default').hide();
		        $('#spotlight_takeover_content_js').show();
		        $.ajax({
		            url: settings.ajaxurl,
		            type: 'post',
		            data: {
		                action: 'data_fetch',
		                type: 'taxonomy',
		                keyword: st_value
		            },
		            success: function(data) {
		                $('#datafetch').html( data );
		            }
		        });
		    } else {
		        $('#spotlight_takeover_content_default').show();
		        $('#spotlight_takeover_content_js').hide();
		    }
		});

	});
})(jQuery, search_by_keyword);