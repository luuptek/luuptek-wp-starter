(function(){var t=document.getElementById("polyfills").dataset.polyfill,e=!0;try{eval("async function() {}")}catch(t){e=!1}if(!e){var a=document.createElement("script");a.src=t,a.type="text/javascript",a.async=!1,document.getElementsByTagName("script")[0].parentNode.appendChild(a)}})();