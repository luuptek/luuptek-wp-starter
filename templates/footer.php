<?php

/**
 * The main footer-template
 *
 * @package Luuptek WP-Base
 */

?>

<footer>
    <div class="container">
        <div class="row">
			<?php

			$footer_widgets = [ 'footer-1', 'footer-2' ];

			foreach ( $footer_widgets as $footer_widget ) {
				if ( is_active_sidebar( $footer_widget ) ) {
					dynamic_sidebar( $footer_widget );
				}
			}
			?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

