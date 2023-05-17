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
        mainNav.toggleClass("main-nav__main-menu-wrapper--show");
    });
};

const subMenuToggler = () => {
    const button = $('button[data-primary-menu-toggle="sub-menu"]');

    button.on("click", (e) => {
        e.preventDefault();
        const target = $(e.currentTarget);
        toggleAria(target, 'aria-expanded');
        const closestLi = target.closest(
            "li.primary-menu__item--has-children"
        );
        closestLi.toggleClass("sub-menu-opened");
    });
};

const escCloser = () => {
    const mainNav = $(".primary-menu-lvl-1");
    const mainNavItem = $(
        ".primary-menu-lvl-1__item.primary-menu__item--has-children"
    );
    $(document).keyup((e) => {
        if (e.keyCode === 27) {
            // escape key maps to keycode `27`
            mainNav.find(".sub-menu-opened").removeClass("sub-menu-opened");
        }
    });

    /**
     * Close submenu if click esc when hovering
     */
    mainNavItem.hover(
        (e) => {
            const target = $(e.target);
            $(document).keyup((e) => {
                if (e.keyCode === 27) {
                    // escape key maps to keycode `27`
                    target
                        .find(".primary-menu-lvl-2")
                        .addClass("primary-menu-lvl-2--hidden");
                }
            });
        },
        () => {
            mainNavItem
                .find(".primary-menu-lvl-2")
                .removeClass("primary-menu-lvl-2--hidden");
        }
    );
};

export const themeNavigation = () => {
    toggleBurger();
    subMenuToggler();
    escCloser();
};
