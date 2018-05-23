/*-------------------------------------------
	Gallery
-------------------------------------------*/

Site.modules.Gallery = (function($, Site) {

	function init() {
		if ($(".media_gallery").length) {
			bindUI();
			switchCaptions();
		}
	}

	function bindUI() {
		$(".media_gallery_inner, .media_gallery_trigger").on("click", function() {
			$("body").addClass("fs-navigation-lock");
		});

		$(".media_gallery_close").on("click", function() {
			$("body").removeClass("fs-navigation-lock");
		});

		$(".media_gallery_body_inner").on("scroll", function() {
			switchCaptions();
		});
	}

	function switchCaptions() {
		$(".media_gallery_item").each(function() {
			var d = $(this)[0].getBoundingClientRect();

			if(d.top < $(window).innerHeight() / 2 && d.bottom > $(window).innerHeight() / 2) {
				$(this).addClass("in-view");
				$(".media_gallery_item_sticker").eq($(this).index()).addClass("current");
			} else {
				$(this).removeClass("in-view");
				$(".media_gallery_item_sticker").eq($(this).index()).removeClass("current");
			}
		});
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
