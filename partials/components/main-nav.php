<nav class="navbar navbar-expand-xl navbar-dark main-nav">
	<div class="container">
		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( UTILS()->get_image_uri() . '/logo.svg' ); ?>" class="nav-logo" alt="Logo"/>
		</a>
		<button class="hamburger hamburger--elastic" type="button" data-toggle="collapse" data-target="#mainNav"
		        aria-label="<?php esc_html_e( 'Näytä tai piilota valikko', 'luuptek_wp_base' ); ?>" aria-controls="navigation"
		        aria-expanded="false">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
		</button>

		<div class="collapse navbar-collapse" id="mainNav">
			<ul class="navbar-nav ml-auto">
				<?php luuptek_wp_base_main_menu(); ?>
				<?php get_template_part( 'partials/components/lang-selector' ); ?>
			</ul>
		</div>
	</div>
</nav>
