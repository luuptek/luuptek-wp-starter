<?php

if ( ! function_exists( 'pll_current_language' ) ) {
	return;
}


$translations = pll_the_languages( array( 'raw' => 1 ) );

foreach ( $translations as $translation ) {
	if ( pll_current_language() === $translation['slug'] ) {
		?>
		<li class="nav-item menu-item-has-children dropdown">
			<a title="Palvelut" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
			   class="dropdown-toggle nav-link nav-link__lang-link">
				<?php echo $translation['name'] ?>
			</a>
			<ul class="dropdown-menu dropdown-menu--navigation">
				<?php
				foreach ( $translations as $translation ) {
					if ( pll_current_language() !== $translation['slug'] ) {
						?>
						<li class="nav-item">
							<a href="<?php echo esc_url( $translation['url'] ); ?>"
							   class="dropdown-item dropdown-item__lang-item">
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
