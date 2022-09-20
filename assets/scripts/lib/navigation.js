import {toggleAria} from "./toggleStates";

/**
 * Navigation related functions
 */

const toggleBurger = () => {
	$('#mainNav').on('show.bs.collapse hide.bs.collapse', () => {
		$('button.hamburger').toggleClass('is-active');
	});
};

const toggleMainNavSubMenus = () => {
	$('.main-nav__sub-menu-toggler').on('click', (e) => {
		e.preventDefault();
		const target = $(e.target);
		const closestLi = target.closest('li.dropdown');
		closestLi.toggleClass('main-nav-dropdown-open');
		toggleAria(target, 'aria-expanded');
	});
};

export const themeNavigation = () => {
	toggleBurger();
	toggleMainNavSubMenus();
};
