export const toggleAria = (el, ariaLabel) => {
    el.attr(ariaLabel, (i, attr) => {
        return attr === "true" ? "false" : "true";
    });
};

export const toggleTabIndex = (el) => {
    el.attr("tabindex", (i, attr) => {
        return attr === "-1" ? "0" : "-1";
    });
};
