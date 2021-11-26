wp.domReady(() => {

	/**
	 * Add full width style button
	 */

	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'responsive-large',
		label: 'Large',
	});

	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'responsive-medium',
		label: 'Medium',
		isDefault: true
	});

	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'responsive-small',
		label: 'Small',
	});

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
