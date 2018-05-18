/*-------------------------------------------
	Spotlight
-------------------------------------------*/

Site.modules.Spotlight = (function($, Site) {

	function init() {
		if ($(".spotlight").length) {
			$(".spotlight_takeover_option").checkbox();
			$("body").addClass("spotlight-takeover-slow");
			bindUI();
			resizeSpotlight();
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

			$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
				enter: function() {
					$("html, body").animate({
						scrollTop: $(".spotlight").innerHeight()
					}, 500);

					var takeoverDelay = setTimeout(function() {
						$("body").removeClass("spotlight-takeover-slow");
					}, 500);
				},
				leave: function() {}
			});
		});

		$(".spotlight_takeover_item_close").on("click", function() {
			$("body").removeClass("fs-navigation-lock spotlight-lock");
			
			var takeoverDelay = setTimeout(function() {
				$("body").addClass("spotlight-takeover-slow");
			}, 500);
		});

		$(".spotlight_video_trigger").on("click", updateVideo);

		Site.onResize.push(resizeSpotlight);
	}

	function resizeSpotlight() {
		$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
			enter: function() {
				$(".spotlight_body").css("margin-bottom", $(".spotlight_items").innerHeight());
			},
			leave: function() {
				$(".spotlight_body").css("margin-bottom", "");
			}
		});
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
