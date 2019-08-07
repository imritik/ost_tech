jQuery(function( $ ) {
	'use strict';

	var $window = $(window);
	var $html = $('html');
	var $body = $('body');

	/* -----------------------------------------
	Responsive Menus Init with mmenu
	----------------------------------------- */
	var $mainNav   = $( '.navigation-main' );
	var $mobileNav = $( '#mobilemenu' );

	$mainNav.clone().removeAttr( 'id' ).removeClass().appendTo( $mobileNav );
	$mobileNav.find( 'li' ).removeAttr( 'id' );

	$mobileNav.mmenu({
		offCanvas: {
			position: "top",
			zposition: "front"
		},
		autoHeight: true,
		navbars: [
			{
				position: "top",
				content: [
					"prev",
					"title",
					"close"
				]
			}
		]
	});

	/* -----------------------------------------
	Sidebar / Searchform Drawer Toggle
	----------------------------------------- */
	var $sidebarTrigger = $('.sidebar-wrap-trigger');
	var $sidebarDismiss = $('.sidebar-wrap-dismiss');
	var $sidebarWrap = $('.sidebar-wrap');

	var $searchFormTrigger = $('.form-filter-trigger');
	var $searchFormDismiss = $('.form-filter-dismiss');
	var $searchForm = $('.form-filter');

	function isSidebarVisible() {
		return $sidebarWrap.hasClass('sidebar-wrap-visible');
	}

	function dismissSidebar(e) {
		if (e) {
			e.preventDefault();
		}
		$sidebarWrap.removeClass('sidebar-wrap-visible');
		$html.removeClass('mm-blocking mm-front');
	}

	function displaySidebar(e) {
		if (e) {
			e.preventDefault();
		}
		$sidebarWrap.addClass('sidebar-wrap-visible');
		$html.addClass('mm-blocking mm-front')
	}

	function isSearchFormVisible() {
		return $searchForm.hasClass('form-filter-visible');
	}

	function dismissSearchForm(e) {
		if (e) {
			e.preventDefault();
		}
		$searchForm.removeClass('form-filter-visible');
		$html.removeClass('mm-blocking mm-front')
	}

	function displaySearchForm(e) {
		if (e) {
			e.preventDefault();
		}
		$searchForm.addClass('form-filter-visible');
		$html.addClass('mm-blocking mm-front')
	}

	$sidebarTrigger.on('click', displaySidebar);
	$sidebarDismiss.on('click', dismissSidebar);

	$searchFormTrigger.on('click', displaySearchForm);
	$searchFormDismiss.on('click', dismissSearchForm);

	/* Event propagations */
	$(document).on('keydown', function (e) {
		e = e || window.e;
		if (
			e.keyCode === 27
			&& (isSidebarVisible() && isSearchFormVisible())
		) {
			dismissSidebar();
			dismissSearchForm();
		}
	});

	$body
		.on('click', function () {
			if (isSidebarVisible()) {
				dismissSidebar();
			}

			if (isSearchFormVisible()) {
				dismissSearchForm();
			}
		})
		.find('.sidebar-wrap-trigger, .sidebar-wrap, .form-filter-trigger, .form-filter')
		.on('click', function (e) {
			e.stopPropagation();
		});

	/* -----------------------------------------
	Responsive Videos with fitVids
	----------------------------------------- */
	$body.fitVids();

	/* -----------------------------------------
	Image Lightbox
	----------------------------------------- */
	$( '.ci-lightbox' ).magnificPopup({
		type: 'image',
		mainClass: 'mfp-with-zoom',
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true
		}
	} );
	
	$window.on( 'load', function() {
		/* -----------------------------------------
		Custom Scrollbar
		----------------------------------------- */
		if ($window.width() > 768 && $sidebarWrap.hasClass('sidebar-fixed-default')) {
			$sidebarWrap.find('.sidebar').mCustomScrollbar({
				theme: 'minimal-dark'
			});
		}

		/* -----------------------------------------
		MatchHeight
		----------------------------------------- */
		$( '.row-equal' ).find( '[class^="col"]' ).matchHeight();
	});

});
