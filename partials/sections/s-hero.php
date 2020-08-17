<?php

$hero_title  = $args['title'];
$description = $args['description'];
$image_id    = $args['image_id'];
$button      = $args['button'];
$image_url   = wp_get_attachment_image_url( $image_id, 'full' );

?>
<div class="gb-hero-content-wrapper" style="background-image: url('<?php echo esc_url( $image_url ); ?>')">
	<div class="gb-hero__inner-container">
		<?php if ( ! empty( $hero_title ) ) : ?>
			<h1 class="gb-hero__title">
				<?php echo esc_html( $hero_title ); ?>
			</h1>
			<?php if ( ! empty( $description ) ) : ?>
				<p class="gb-hero__description">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
			<?php get_template_part( 'partials/blocks/b-button', '', $button ); ?>
		<?php endif; ?>
	</div>
</div>

