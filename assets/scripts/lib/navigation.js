import $ from "jquery";

import { toggleAria } from "./toggleStates";

/**
 * Navigation related functions
 */

const mainNav = $("#mainNav");

const toggleBurger = () => {
    $(".main-nav__mobile-menu-toggler").on("click", e => {
        e.preventDefault();
        const target = $(e.currentTarget);
        toggleAria(target, "aria-expanded");
        $("button.hamburger").toggleClass("is-active");
        mainNav.toggle();
    });
};

const toggleMainNavSubMenus = () => {
    $(".main-nav__sub-menu-toggler").on("click", e => {
        e.preventDefault();
        const target = $(e.target);
        const closestLi = target.closest("li.dropdown");
        closestLi.toggleClass("main-nav-dropdown-open");
        toggleAria(target, "aria-expanded");
    });
};

export const themeNavigation = () => {
    toggleBurger();
    toggleMainNavSubMenus();
};
