<?php

/**
 * The main footer-template
 *
 * @package Luuptek WP-Base
 */

?>
</div> <!-- closing #content-start -->
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
	<div class="container">
		<ul class="some-nav">
			<?php
			// Just render these anywhere you want to..
			Utils()->get_social_media_links();
			?>
		</ul>
	</div>
</footer>

<div class="footer-copyrights">
	Copyright
	<svg class="footer-copyright-img" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24"
	     width="24">
		<g>
			<rect fill="none" height="24" width="24" x="0"/>
		</g>
		<g>
			<g>
				<g>
					<path class="fillpath"
						d="M11.88,9.14c1.28,0.06,1.61,1.15,1.63,1.66h1.79c-0.08-1.98-1.49-3.19-3.45-3.19C9.64,7.61,8,9,8,12.14 c0,1.94,0.93,4.24,3.84,4.24c2.22,0,3.41-1.65,3.44-2.95h-1.79c-0.03,0.59-0.45,1.38-1.63,1.44C10.55,14.83,10,13.81,10,12.14 C10,9.25,11.28,9.16,11.88,9.14z M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,20c-4.41,0-8-3.59-8-8 s3.59-8,8-8s8,3.59,8,8S16.41,20,12,20z"/>
				</g>
			</g>
		</g>
	</svg> <?php echo esc_html( get_bloginfo() ) . ' ' . date( 'Y' ); ?> | <?php esc_html_e('Code by', 'luuptek_wp_base'); ?> <a href="https://www.luuptek.fi" target="_blank">Luuptek</a>
</div>

<?php wp_footer(); ?>

</body>
</html>

