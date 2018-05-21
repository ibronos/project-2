/*-------------------------------------------
	Spotlight
-------------------------------------------*/

Site.modules.Spotlight = (function($, Site) {

	function init() {
		if ($(".spotlight").length) {
			$(".spotlight_takeover_option").checkbox();
			bindUI();
		}
	}

	function bindUI() {
		$(".spotlight_item").hover(function() {
			$(".spotlight").addClass("interested");
		}, function() {
			$(".spotlight").removeClass("interested");
		});

		$(".spotlight_item").on("click", function() {
			$("body").addClass("fs-navigation-lock spotlight-lock");
		});

		$(".spotlight_takeover_item_close").on("click", function() {
			$("body").removeClass("fs-navigation-lock spotlight-lock");
		});

		$(".spotlight_video_trigger").on("click", updateVideo);
	}

	function updateVideo() {
		if(!($(".spotlight_video_trigger").hasClass("paused"))) {
			$(".spotlight_body_background").background("pause");
			$(".spotlight_video_trigger").addClass("paused");
			$(".spotlight_video_label").html("Play Video");
		} else {
			$(".spotlight_body_background").background("play");
			$(".spotlight_video_trigger").removeClass("paused");
			$(".spotlight_video_label").html("Pause Video");
		}
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
