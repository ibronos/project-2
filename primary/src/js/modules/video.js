/*-------------------------------------------
	Module
-------------------------------------------*/

Site.modules.Video = (function($, Site) {

	function init() {
		if ($(".video_item_video").length) {
			bindUI();
		}
	}

	function bindUI() {
		$(".video_item_video").on("click", insertVideo);
	}

	function insertVideo() {
		var video = $(this).data("url");

		$(this).after('<iframe class="video_item_iframe" src="' + video + '?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
