/*-------------------------------------------
	Page
-------------------------------------------*/

Site.modules.Page = (function($, Site) {

	var prev_icon = "caret_left";
	var next_icon = "caret_right";
	var lightboxOptions = {
		theme: "fs-light",
		videoWidth: 1000,
		labels: {
			close: "<span class='fs-lightbox-icon-close'>" + Site.icon("close") + "</span>",
			previous: "<span class='fs-lightbox-icon-previous'>" + Site.icon(prev_icon) + "</span>",
			count: "<span class='fs-lightbox-meta-divider'></span>",
			next: "<span class='fs-lightbox-icon-next'>" + Site.icon(next_icon) + "</span>"
		}
	};

	function init() {
		$(".js-background").on("loaded.background", function() {
			$(this).addClass("fs-background-loaded");
		}).background();
		$(".js-carousel").carousel(carouselPagination($(".js-carousel.base_pagination")));
		$(".js-checkbox, .js-radio").checkbox();
		$(".js-dropdown").dropdown();
		$(".js-equalize").equalize();
		$(".js-lightbox").lightbox(lightboxOptions);
		$(".js-swap").swap();

		$(".js-mobile-sidebar-handle")
			.on("activate.swap", onSidebarSwapActivate)
			.on("deactivate.swap", onSidebarSwapDeactivate);
		$(".js-main-nav-toggle")
			.on("activate.swap", onMainSwapActivate)
			.on("deactivate.swap", onMainSwapDeactivate);
		$(".js-sub-nav-handle")
			.on("activate.swap", onSubSwapActivate)
			.on("deactivate.swap", onSubSwapDeactivate)
			.on("enable.swap", onSubSwapEnable)
			.on("disable.swap", onSubSwapDisable);

		$(window).on("open.lightbox", function() {
			$("body").addClass("fs-navigation-lock fs-mobile-lock");
		}).on("close.lightbox", function() {
			$("body").removeClass("fs-navigation-lock fs-mobile-lock");
		});

		if (/MSIE 10/i.test(navigator.userAgent)) {
			$("html").addClass("is-ie");
		}
		
		if (/MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent)) {
			$("html").addClass("is-ie");
		}
		
		if (/Edge\/\d./i.test(navigator.userAgent)) {
			$("html").addClass("is-ie");
		}

		if($(".news_item_details_block").length) {
			$("body").addClass("theme_news");
		}

		fixIEsvg();
		bindGenericUI();
		responsiveVideo();
		tableOverflow();
		ariaHide($(".js-mobile-sidebar, .js-main-nav-children, .js-sub-nav-list"));

		$(window).on("load", onPageLoad);
		$(document).on("click touchstart", onDocumentClick);

		Site.onScroll.push(scroll);
		Site.onResize.push(resize);
		Site.onRespond.push(respond);
	}

	function fixIEsvg() {
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");

		if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
			$.get(STATIC_ROOT + "images/icons.svg", function(data) {
				var div = document.createElement("div");
				$(div).hide();
				div.innerHTML = new XMLSerializer().serializeToString(data.documentElement);
				document.body.insertBefore(div, document.body.childNodes[0]);

				$("svg use").each(function() {
					var parts = $(this).attr("xlink:href").split("#");
					$(this).attr("xlink:href", "#" + parts[1]);
				});
			});
		}
	}

	function scroll() {
		testBreadcrumb();
	}

	function resize() {
		tableOverflow();
	}

	function respond() {}

	function onPageLoad() {
		$("body").removeClass("preload");
		$(window).trigger("resize");
	}

	function onDocumentClick(e) {
		if ($("body").hasClass("fs-mobile-lock")) {
			if (!$(e.target).closest(".js-mobile-sidebar, .js-mobile-sidebar-handle").length) {
				$(".js-mobile-sidebar-handle").swap("deactivate");
			}
		}

		if (!$(e.target).closest(".breadcrumb_name_switch, .breadcrumb_dropdown").length) {
			$(".breadcrumb_name_switch").swap("deactivate");
		}
	}

	function testBreadcrumb() {
		if($(".page_theme_image").length) {
			if($(".page_header_inner")[0].getBoundingClientRect().top < $(".header").innerHeight() + $(".breadcrumb_nav_wrapper").innerHeight()) {
				$("body").addClass("switch-breadcrumb");
			} else {
				$("body").removeClass("switch-breadcrumb");
			}
		}
	}

	function onScrollTo(e) {
		Site.killEvent(e);

		var $target = $(e.delegateTarget),
				id = $target.attr("href");

		scrollToElement(id);
	}

	function scrollToElement(id) {
		var $to = $(id);

		if ($to.length) {
			var offset = $to.offset();

			scrollToPosition(offset.top);
		}
	}

	function scrollToPosition(top) {
		$("html, body").animate({
			scrollTop: top
		});
	}

	function onToggleClick(e) {
		Site.killEvent(e);

		var $target = $(e.delegateTarget),
				activeClass = "js-toggle-active";

		if ($target.hasClass(activeClass)) {
			$target.removeClass(activeClass);
		} else {
			$target.addClass(activeClass);
		}
	}

	function bindGenericUI() {
		$(".js-main-nav-lg").find("a")
			.focus(function() {
				$(this).addClass("focused").attr("aria-expanded", "true");
				ariaShow($(this).closest(".main_nav_item").find(".js-main-nav-children"));
			})
			.blur(function() {
				$(this).removeClass("focused").attr("aria-expanded", "false");
				ariaHide($(this).closest(".main_nav_item").find(".js-main-nav-children"));
			})
			.hover(function() {
				$(this).attr("aria-expanded", "true");
				ariaShow($(this).closest(".main_nav_item").find(".js-main-nav-children"));
			}, function() {
				$(this).attr("aria-expanded", "false");
				ariaHide($(this).closest(".main_nav_item").find(".js-main-nav-children"));
		});

		$(".js-toggle")
			.not(".js-bound")
			.on("click", ".js-toggle-handle", onToggleClick)
			.addClass("js-bound");

		$(".js-scroll-to")
			.not(".js-bound")
			.on("click", onScrollTo)
			.addClass("js-bound");

		$(".typography table")
			.wrap('<div class="table_wrapper"><div class="table_wrapper_inner"></div></div>');
	}

	function responsiveVideo() {
		$("iframe[src*='vimeo.com'], iframe[src*='youtube.com']", ".typography").each(function() {
			$(this).wrap('<div class="video_frame"></div>');
		});
	}

	function tableOverflow() {
		$(".table_wrapper").each(function() {
			if ($(this).find("table").outerWidth() > $(this).width() + 1) {
				$(this).addClass("table_wrapper_overflow");
			} else {
				$(this).removeClass("table_wrapper_overflow");
			}
		});
	}

	function onSidebarSwapActivate() {
		$("body").addClass("fs-navigation-lock fs-mobile-lock");
		ariaShow($(".js-mobile-sidebar"));
		$(".js-mobile-sidebar").focus();

		$(".alert, .header, .page_inner, .footer").css("padding-right", getScrollbarWidth());
		$(".alert_close").css("right", getScrollbarWidth());
		$(".mobile_sidebar").css("width", "");
		$(".mobile_sidebar").css("right", "");
	}

	function onSidebarSwapDeactivate() {
		$("body").removeClass("fs-navigation-lock fs-mobile-lock");
		ariaHide($(".js-mobile-sidebar"));
		$(".js-mobile-sidebar-handle").focus();

		$(".alert, .header, .page_inner, .footer").css("padding-right", "");
		$(".alert_close").css("right", "");
		$(".mobile_sidebar").css("width", "calc(100% + " + getScrollbarWidth() + "px)");
		$(".mobile_sidebar").css("right", getScrollbarWidth() * -1);
	}

	function onMainSwapActivate() {
		$(this).closest(".main_nav_item")
			.find(".main_nav_link").attr("aria-expanded", "true");
		ariaShow($(this).closest(".main_nav_item").find(".js-main-nav-children"));
	}

	function onMainSwapDeactivate() {
		$(this).closest(".main_nav_item")
			.find(".main_nav_link").attr("aria-expanded", "false");
		ariaHide($(this).closest(".main_nav_item").find(".js-main-nav-children"));
	}

	function onSubSwapActivate() {
		$(this).attr("aria-expanded", "true")
			.find(".sub_nav_handle_label").text("Close");
		ariaShow($(".js-sub-nav-list"));
	}

	function onSubSwapDeactivate() {
		$(this).attr("aria-expanded", "false")
			.find(".sub_nav_handle_label").text($(this).data("swap-title"));
		ariaHide($(".js-sub-nav-list"));
	}

	function onSubSwapEnable() {
		ariaHide($(".js-sub-nav-list"));
	}

	function onSubSwapDisable() {
		ariaShow($(".js-sub-nav-list"));
	}

	function ariaHide($element) {
		$element.attr("aria-hidden", "true").attr("hidden", "");
	}

	function ariaShow($element) {
		$element.attr("aria-hidden", "false").removeAttr("hidden");
	}

	function carouselPagination($element) {
		$element.each(function() {
			var $previous_button = $(this).find(".fs-carousel-control_previous");
			var previous_text = $previous_button.text();
			var $next_button = $(this).find(".fs-carousel-control_next");
			var next_text = $next_button.text();

			$previous_button.html("<span class='fs-carousel-control-icon'>" + Site.icon(prev_icon) + "</span><span class='fs-carousel-control-label'>" + previous_text + "</span>");
			$next_button.html("<span class='fs-carousel-control-icon'>" + Site.icon(next_icon) + "</span><span class='fs-carousel-control-label'>" + next_text + "</span>");
		});
	}

	function getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.width = "100px";
    outer.style.msOverflowStyle = "scrollbar";

    document.body.appendChild(outer);

    var widthNoScroll = outer.offsetWidth;
    // force scrollbars
    outer.style.overflow = "scroll";

    // add innerdiv
    var inner = document.createElement("div");
    inner.style.width = "100%";
    outer.appendChild(inner);

    var widthWithScroll = inner.offsetWidth;

    // remove divs
    outer.parentNode.removeChild(outer);

    return widthNoScroll - widthWithScroll;
	}

	Site.onInit.push(init);

	return {
		ariaHide: ariaHide,
		ariaShow: ariaShow
	};

})(jQuery, Site);
