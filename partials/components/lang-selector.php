<?php

if ( ! is_plugin_active( 'polylang-pro/polylang.php' ) && ! is_plugin_active( 'polylang/polylang.php' ) ) {
	return;
}


$translations = pll_the_languages( array( 'raw' => 1 ) );

if ( count( $translations ) === 0 ) {
	return;
}

foreach ( $translations as $translation ) {
	if ( pll_current_language() === $translation['slug'] ) {
		?>
		<li class="primary-menu-lvl-1__item primary-menu-lvl-1__item--has-children primary-menu__item--has-children ">
			<a href="#" class="primary-menu-lvl-1__link">
				<?php echo strtoupper( esc_html( pll_current_language( 'slug' ) ) ); ?>
			</a>
			<button class="primary-menu-lvl-1__sub-menu-toggle sub-menu-toggle" aria-haspopup="menu"
			        aria-label="Change the language" data-primary-menu-toggle="sub-menu"
			        lang="en"
			        aria-expanded="false">
				<?php Utils()->the_svg( 'icons/arrow-down' ); ?>
			</button>
			<ul class="primary-menu-lvl-2 primary-menu-lvl">
				<?php
				foreach ( $translations as $translation ) {
					if ( pll_current_language() !== $translation['slug'] ) {
						?>
						<li class="primary-menu-lvl-2__item">
							<a href="<?php echo esc_url( $translation['url'] ); ?>"
							   lang="<?php echo esc_attr( $translation['slug'] ); ?>" class="primary-menu-lvl-2__link">
								<?php echo esc_html( $translation['name'] ); ?>
							</a>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</li>
		<?php
	}
}
