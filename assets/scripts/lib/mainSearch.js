import $ from "jquery";

export const mainSearchTogglers = () => {
    const openBtn = $(".open-main-search");
    const closeBtn = $(".close-main-search");
    const body = $("body");
    const mainSearchInput = $("#s");
    const mainNavLogo = $(".main-nav__nav-logo");

    openBtn.on("click", (e) => {
        e.preventDefault();
        body.addClass("main-search-opened");
        mainSearchInput.focus();
    });

    closeBtn.on("click", (e) => {
        e.preventDefault();
        body.removeClass("main-search-opened");
        mainNavLogo.focus();
    });
};
