$(document).ready(function () {

	// SCROLL NAV
	// $(function () {
	// 	$(window).scroll(function () {
	// 		if ($(this).scrollTop() > 100) {
	// 			$('.navbar-menu').addClass("custom-nav-blue");
	// 			$(".navbar-menu").removeClass("custom-nav-white");
	// 		} else {
	// 			$('.navbar-menu').addClass("custom-nav-white");
	// 			$(".navbar-menu").removeClass("custom-nav-blue");
	// 		}
	// 	});
	// });

	$('a[href*="#"]')
		.not('[href="#"]')
		.not('[href="#0"]')
		.click(function (e) {
			$('html,body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60,
			}, 500);
			$("a").not($(this)).removeClass("active");
			$(this).toggleClass("active");
			e.preventDefault();
		});

	$(window).scroll(function () {
		var scrollDistance = $(window).scrollTop() + 62;
		$('.main-pp').each(function (i) {
			if ($(this).position().top <= scrollDistance) {
				$('.menu-custom a.active').removeClass('active');
				$('.menu-custom a').eq(i).addClass('active');
			}
		});
	});

	function sizePictures() {
		$('.pictures-property').each(function () {
			var WSize;
			var HSize;
			WSize = $(this).width();
			HSize = $(this).height();
			PWSize = $(this).parent().width();

			if (PWSize > 330) {
				$(this).css('width', '100%');
				$(this).css('height', 'auto');
				$(this).parent().hover(function () {
					$(this).children('.pictures-property').css('width', '115%')
				}, function () {
					$(this).children('.pictures-property').css('width', '100%')
				}
				);
			} else if (WSize > HSize) {
				$(this).css('height', '100%');
				$(this).css('width', 'auto');

				$(this).parent().hover(function () {
					$(this).children('.pictures-property').css('height', '115%')
				}, function () {
					$(this).children('.pictures-property').css('height', '100%')
				}
				);
			} else if (WSize < HSize) {
				$(this).css('width', '100%');
				$(this).css('height', 'auto');
				$(this).parent().hover(function () {
					$(this).children('.pictures-property').css('width', '115%')
				}, function () {
					$(this).children('.pictures-property').css('width', '100%')
				}
				);
			} else if (WSize = HSize) {
				$(this).css('width', '100%');
				$(this).css('height', '100%');
				$(this).parent().hover(function () {
					$(this).children('.pictures-property').css('width', '115%');
					$(this).children('.pictures-property').css('height', '115%');
				}, function () {
					$(this).children('.pictures-property').css('width', '100%');
					$(this).children('.pictures-property').css('height', '100%')
				}
				);
			};
		});
	}

	sizePictures();
	$(window).resize(function () {
		windowWidht = $(this).width();
		console.log(windowWidht);
		sizePictures();
	});

	$(function () {
		$('input[name=client_name],input[name=client_last] ').alpha({
			allowNewline: false,
			maxLength: 32
		});

		$('input[name=client_phon]').numeric({
			allowPlus: false,
			allowMinus: false,
			allowThouSep: false,
			allowDecSep: false,
			allowLeadingSpaces: false,
			maxDigits: 8,
			maxDecimalPlaces: NaN,
			maxPreDecimalPlaces: NaN,
			max: NaN,
			min: NaN
		});

		$('input[name=client_addr]').alphanum({
			allowNewline: false,
			allow: '.,()-',
			maxLength: 199
		});

		$('input[name=client_mail]').alphanum({
			allowNewline: false,
			allowSpace: false,
			allowOtherCharSets: false,
			allow: '@_-.',
			maxLength: 299
		});

		$('textarea[name=client_text]').alphanum({
			allowNewline: true,
			allow: '.,$:;()-@_-',
			maxLength: 1499
		});
	});

});