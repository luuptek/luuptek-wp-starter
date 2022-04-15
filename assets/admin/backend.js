wp.domReady(() => {

	/**
	 * Add full width style button
	 */

	/**
	 * Get rid of all GB variations
	 */
	wp.blocks.unregisterBlockStyle("core/pullquote", [
		"default",
		"solid-color"
	]);

	wp.blocks.unregisterBlockStyle("core/quote", ["default", "large"]);

	wp.blocks.unregisterBlockStyle("core/button", [
		"default",
		"outline",
		"squared",
		"fill"
	]);

});
