/*-------------------------------------------
	Alert
-------------------------------------------*/

Site.modules.Alert = (function($, Site) {

	var $alert;
	var $alertClose;
	var $alertTime;
	var cookieName;

	function init() {
		if ($(".alert").length) {
			$alert = $(".alert");
			$alertClose = $(".alert_close");
			$alertTime = $alert.data("time");
			cookieName = "alert-cookie";

			if ($.cookie(cookieName) === $alertTime) {
				hideAlert();
			} else {
				showAlert();
			}

			resizeAlert();
			bindUI();
		}
	}

	function bindUI() {
		$alertClose.on("click", function() {
			setCookie();
			hideAlert();
		});

		Site.onResize.push(resizeAlert);
	}

	function resizeAlert() {
		if($alert.hasClass("show_alert")) {
			$(".header").css("top", $(".alert").innerHeight());
			$(".page_feature").css("padding-top", $(".alert").innerHeight());
		} else {
			$(".header").css("top", "");
			$(".page_feature").css("padding-top", "");
		}
	}

	function setCookie() {
		$.cookie(cookieName, $alertTime);
	}

	function showAlert() {
		$alert.addClass("show_alert");
		$(".header").css("top", $(".alert").innerHeight());
		$(".page_feature").css("padding-top", $(".alert").innerHeight());
	}

	function hideAlert() {
		$alert.removeClass("show_alert");
		$(".header").css("top", "");
		$(".page_feature").css("padding-top", "");
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
