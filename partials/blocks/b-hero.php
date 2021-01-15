<?php

$args = [
	'image_id'    => get_field( 'hero_bg_image' ),
	'title'       => get_field( 'hero_title' ),
	'description' => get_field( 'hero_description' ),
	'button'      => get_field( 'hero_button' ),
];

// No render if no title
if ( empty( $args['title'] ) ) {
	return;
}

$class_names = [
	'b-hero',
];

$args = [
	'image_id'    => get_field( 'hero_bg_image' ),
	'title'       => get_field( 'hero_title' ),
	'description' => get_field( 'hero_description' ),
	'button'      => get_field( 'hero_button' ),
];

?>

<div class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
	<?php

	// Lets read these values here, needed for copy/paste if carousel needed
	$hero_title  = $args['title'];
	$description = $args['description'];
	$image_id    = $args['image_id'];
	$button      = $args['button'];
	$image_url   = wp_get_attachment_image_url( $image_id, 'hero_slide' );

	?>
	<div class="b-hero-content-wrapper" style="background-image: url('<?php echo esc_url( $image_url ); ?>')">
		<div class="b-hero__inner-container">
			<?php if ( ! empty( $hero_title ) ) : ?>
				<h1 class="b-hero__title">
					<?php echo esc_html( $hero_title ); ?>
				</h1>
				<?php if ( ! empty( $description ) ) : ?>
					<p class="b-hero__description">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif; ?>
				<?php get_template_part( 'partials/blocks/b-button', '', $button ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
