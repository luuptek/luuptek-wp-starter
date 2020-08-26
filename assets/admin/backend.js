wp.domReady(() => {

	/**
	 * Add full width style button
	 */
	wp.blocks.registerBlockStyle('core/button', {
		name: 'full-width',
		label: 'Full Width',
	});

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

});
