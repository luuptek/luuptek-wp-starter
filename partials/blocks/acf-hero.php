<?php

/**
 * Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_id = 'gb-hero-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_names = [
	'gb-hero',
	'gb-hero-' . $block['id'],
];

if ( ! empty( $block['className'] ) ) {
	$class_names[] = $block['className'];
}

if ( ! empty( $block['align'] ) ) {
	$class_names[] = 'align' . $block['align'];
}

$args = [
	'image_id'    => get_field( 'bg_image' ),
	'title'       => get_field( 'title' ),
	'description' => get_field( 'description' ),
	'button'      => get_field( 'button' ),
];

?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
	<?php get_template_part( 'partials/sections/s-hero', '', $args ); ?>
</div>
