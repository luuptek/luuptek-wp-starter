<?php

if ( ! function_exists( 'pll_current_language' ) ) {
	return;
}


$translations = pll_the_languages( array( 'raw' => 1 ) );

if ( count( $translations ) === 0 ) {
	return;
}

foreach ( $translations as $translation ) {
	if ( pll_current_language() === $translation['slug'] ) {
		?>
		<li class="menu-item menu-item-has-children dropdown nav-item nav-item--level-1">
			<a href="#" class="nav-link nav-link--lang-switch nav-link--level-1">
				<?php echo esc_html( pll_current_language( 'slug' ) ); ?>
				<button class="main-nav__sub-menu-toggler" aria-haspopup="menu" aria-label="Change the language"
				        lang="en"
				        aria-expanded="false">
					+
				</button>
			</a>
			<ul class="main-nav__dropdown main-nav__dropdown-menu--level-1">
				<?php
				foreach ( $translations as $translation ) {
					if ( pll_current_language() !== $translation['slug'] ) {
						?>
						<li class="menu-item nav-item nav-item--level-2">
							<a href="<?php echo esc_url( $translation['url'] ); ?>"
							   lang="<?php echo esc_attr( $translation['slug'] ); ?>" class="dropdown-item--level-2">
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
