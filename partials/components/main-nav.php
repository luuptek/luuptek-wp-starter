<nav class="main-nav">
	<div class="main-nav__container">
		<a class="main-nav__brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"
		   aria-label="<?php echo esc_attr( pll__( 'Etusivulle' ) ); ?>">
			<img src="<?php echo esc_url( UTILS()->get_image_uri() . '/logo.svg' ); ?>" class="main-nav__nav-logo"
			     alt="Logo"/>
		</a>

		<button class="main-nav__mobile-menu-toggler hamburger hamburger--elastic" type="button"
		        aria-label="<?php echo esc_attr( pll__( 'Mobiilivalikon avaaja ja sulkija' ) ); ?>"
		        aria-controls="mainNav"
		        aria-expanded="false">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
		</button>

		<div class="main-nav__main-menu-wrapper" id="mainNav">
			<?php
			if ( has_nav_menu( 'top_nav' ) ) :
				?>
				<ul class="primary-menu-lvl-1"
				    aria-label="<?php pll_esc_html_e( 'Päävalikko' ); ?>"
				    role="menu">
					<?php
					wp_nav_menu(
						[
							'theme_location' => 'top_nav',
							'menu_class'     => 'primary-menu',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 3,
							'walker'         => new BEM_Nav_Walker( 'primary-menu' ),
						]
					);
					?>
					<?php get_template_part( 'partials/components/lang-selector' ); ?>
				</ul>
			<?php
			endif;
			?>
		</div>
		<button class="main-nav__search open-main-search" type="button"
		        aria-label="<?php esc_html_e( 'Avaa haku', 'luuptek_wp_base' ); ?>">
			<?php Utils()->the_svg( 'icons/search' ); ?>
		</button>
	</div>
</nav>
