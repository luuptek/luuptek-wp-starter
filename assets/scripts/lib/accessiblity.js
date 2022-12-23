/**
 * All accessibility related functions
 */
import $ from "jquery";

const body = $('body');

const escCloser = () => {
	$(document).keyup(e => {
		// escape key maps to keycode `27`
		if (e.keyCode === 27) {
			$('.main-nav__main-menu').find('.main-nav-dropdown-open').removeClass('main-nav-dropdown-open');

			// If search open, focus on search button after closing search
			if(body.hasClass('main-search-opened')) {
				$('.main-nav__search').focus();
				body.removeClass('main-search-opened');
			}
		}
	});
};

export const themeAccessibility = () => {
	escCloser();
};
