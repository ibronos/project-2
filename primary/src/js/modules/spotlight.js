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

		$(".spotlight_item").on("click", triggerSpotlight);

		$(".spotlight_takeover_item_close").on("click", closeSpotlight);

		$(".spotlight_video_trigger").on("click", updateVideo);

		$(".spotlight_takeover_content").on("scroll", scrollSpotlight);

		Site.onScroll.push(hideSpotlight);
	}

	function triggerSpotlight() {
		var item = $(this);
		
		$("body").addClass("fs-navigation-lock spotlight-lock");

		if ($(item).index() == 0) {
			$("body").addClass("spotlight-active-1");
		}

		$(".video_item_iframe").remove();
	}

	function closeSpotlight() {
		$("body").removeClass("fs-navigation-lock spotlight-lock");
		$("body").removeClass("spotlight-active-1");
	}

	function updateVideo() {
		if (!($(".spotlight_video_trigger").hasClass("paused"))) {
			$(".spotlight_body_background").background("pause");
			$(".spotlight_video_trigger").addClass("paused");
			$(".spotlight_video_label").html("Play Video");
		} else {
			$(".spotlight_body_background").background("play");
			$(".spotlight_video_trigger").removeClass("paused");
			$(".spotlight_video_label").html("Pause Video");
		}
	}

	function hideSpotlight() {
		if ($(".spotlight")[0].getBoundingClientRect().bottom < 0) {
			$(".spotlight").addClass("hide");
		} else {
			$(".spotlight").removeClass("hide");
		}
	}

	function scrollSpotlight() {
		var item = $(this);

		scrollSpotlightProgress(item);
		closeSpotlightScroll(item);
	}

	function scrollSpotlightProgress(item) {
		var progress = Math.floor($(item).scrollTop() / ($(item)[0].scrollHeight - $(item).innerHeight() - 180) * $(item).innerWidth());
		console.log(progress);
		$(item).find(".spotlight_takeover_content_progress").css("width", progress + "px");
	}

	function closeSpotlightScroll(item) {
		if ($(item).closest(".spotlight_takeover_item").hasClass("fs-swap-active")) {
			if ($(item)[0].scrollHeight - $(item).innerHeight() <= $(item).scrollTop()) {
				setTimeout(function() {
					$(item).closest(".spotlight_takeover_item").find(".spotlight_takeover_item_close").trigger("click");
				}, 150);

				setTimeout(function() {
					$(item).scrollTop(0);
				}, 300);
			}
		}
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
