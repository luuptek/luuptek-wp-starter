// import external dependencies
import $ from "jquery";
//import 'bootstrap';
//import 'fastclick';

// Slick available..
//import 'slick-carousel';

// import local dependencies
import Router from "./util/router";
import common from "./routes/Common";
import home from "./routes/Home";

/**
 *
 * @type {Router}
 */
const router = new Router({
    // All pages
    common,
    // Home specific
    home,
});

// Load Events
$(document).ready(() => router.loadEvents());
