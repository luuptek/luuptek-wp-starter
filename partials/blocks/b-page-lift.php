<?php

if ( ! is_array( $args ) ) {
	return;
}

$lift_url      = $args['url'];
$lift_title    = $args['title'];
$lift_image_id = ! empty( $args['image_id'] ) ? $args['image_id'] : get_field( 'luuptek_wp_base_default_image_id', 'option' );
$link_label    = is_admin() ? 'Lue lisää' : pll_esc_html__( 'Lue lisää:' ) . ' ' . $lift_title;
?>

<div class="b-page-lift">
	<a href="<?php echo esc_url( $lift_url ); ?>" aria-label="<?php echo esc_attr( $link_label ); ?>"
	   class="b-page-lift__link">
		<figure class="b-page-lift__figure">
			<?php echo wp_get_attachment_image( $lift_image_id, 'square', '', [ 'class' => 'b-page-lift__image' ] ); ?>
			<figcaption class="b-page-lift__figcaption">
				<?php echo esc_html( $lift_title ); ?>
			</figcaption>
		</figure>
	</a>
</div>
