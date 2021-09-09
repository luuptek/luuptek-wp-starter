import { toggleAria } from "../lib/toggleStates"
export default {
  init() {
    // JavaScript to be fired on all pages

      $('#mainNav').on('show.bs.collapse hide.bs.collapse', () => {
          $('button.hamburger').toggleClass('is-active');
      });

	  /**
	   * Mobile menu handler
	   */
	  $('.main-nav__sub-menu-toggler').on('click', (e) => {
		  e.preventDefault();
		  const target = $(e.target);
		  const closestLi = target.closest('li.dropdown');
		  closestLi.toggleClass('main-nav-dropdown-open');
		  toggleAria(target, 'aria-expanded');
	  });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
