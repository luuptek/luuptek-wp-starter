// Load stable ES features. The .browserslistrc config will automatically modify
// this as required
import "core-js/stable";

// Minimal polyfill for window.fetch
import fetch from "unfetch";

// Alternative more complete polyfill
// import { fetch } from "whatwg-fetch";

// Apply only if native version is missing
if (!window.fetch) {
    window.fetch = fetch;
}
