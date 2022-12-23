import { mainSearchTogglers } from "../lib/mainSearch";
import { themeAccessibility } from "../lib/accessiblity";
import { themeNavigation } from "../lib/navigation";

export default {
  init() {

	  // Main search
	  mainSearchTogglers();

	  // Accessibility
	  themeAccessibility();

	  //Navigation
	  themeNavigation();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
