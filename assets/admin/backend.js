(function admin() {
    wp.domReady(function() {

        /**
         * Examples to remove / customise the blocks..
         */
        wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
        wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
        wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );

        wp.blocks.registerBlockStyle( 'core/button', {
            name: 'default',
            label: 'Default',
            isDefault: true,
        });

        wp.blocks.registerBlockStyle( 'core/button', {
            name: 'full-width',
            label: 'Full Width',
        } );

    });
}());
