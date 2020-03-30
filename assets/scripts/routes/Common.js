export default {
  init() {
    // JavaScript to be fired on all pages

      $('#mainNav').on('show.bs.collapse hide.bs.collapse', () => {
          $('button.hamburger').toggleClass('is-active');
      });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
