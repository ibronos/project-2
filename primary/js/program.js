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
				$('input#search_by_keyword').val('').trigger('input');
				$('input#search_by_keyword_mini').val('').trigger('input');
			}
		}

		function initVideo() {
			if ($("#datafetch .video_item_video, #datafetch .quote_item_video").length) {
				$("#datafetch .video_item_video, #datafetch .quote_item_video").on("click", insertVideo);
				$("#datafetch .media_gallery_close").on("click", removeVideos);
			}
		}

		function insertVideo() {
			var video = $(this).data("url");
			$(this).after('<iframe class="video_item_iframe" src="' + video + '?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
		}

		function removeVideos() {
			$("#datafetch .media_gallery_item").each(function() {
				$(this).find("iframe").remove();
			});
		}

		//Close spotlight
		$(".spotlight_takeover_item_close, .spotlight_item").on("click", function(e) {
			reset_term('tax');
			reset_term('search');
		});

		//Filter By Search
		$('body').on('input', 'input#search_by_keyword, input#search_by_keyword_mini', function(e) {
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
	                    initVideo();
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
		                 initVideo();
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
		                 initVideo();
		            }
		        });
		    } else {
		        $('#spotlight_takeover_content_default').show();
		        $('#spotlight_takeover_content_js').hide();
		    }
		});

	});
})(jQuery, search_by_keyword);