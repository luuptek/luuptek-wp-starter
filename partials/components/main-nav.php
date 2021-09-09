<nav class="main-nav">
	<div class="main-nav__container">
		<a class="main-nav__brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( UTILS()->get_image_uri() . '/logo.svg' ); ?>" class="main-nav__nav-logo" alt="Logo"/>
		</a>
		<button class="main-nav__mobile-menu-toggler hamburger hamburger--elastic" type="button" data-toggle="collapse" data-target="#mainNav"
		        aria-label="<?php esc_html_e( 'Valikko', 'luuptek_wp_base' ); ?>" aria-controls="navigation"
		        aria-expanded="false">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
		</button>

		<div class="main-nav__main-menu-wrapper collapse" id="mainNav">
			<ul class="main-nav__main-menu">
				<?php luuptek_wp_base_main_menu(); ?>
				<?php get_template_part( 'partials/components/lang-selector' ); ?>
			</ul>
		</div>
	</div>
</nav>
