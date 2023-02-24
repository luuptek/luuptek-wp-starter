(function() {
    var url = document.getElementById("polyfills").dataset.polyfill;

    var isModern = true;

    try {
        eval("async function() {}");
    } catch (error) {
        isModern = false;
    }

    // Any other tests
    // if (![].flatMap) {
    //     isModern = false;
    // }

    if (isModern) {
        return;
    }

    var s = document.createElement("script");
    s.src = url;
    s.type = "text/javascript";
    s.async = false;
    document.getElementsByTagName("script")[0].parentNode.appendChild(s);
})();
