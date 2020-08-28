export default {
  init() {
    // JavaScript to be fired on all pages

      $('#mainNav').on('show.bs.collapse hide.bs.collapse', () => {
          $('button.hamburger').toggleClass('is-active');
      });

	  /**
	   * Mobile menu handler
	   */
	  $('.mobile-sub-menu-toggler').on('click', (e) => {
		  e.preventDefault();
		  const target = $(e.target);

		  const closestLi = target.closest('li.dropdown');

		  closestLi.toggleClass('open');
	  });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
