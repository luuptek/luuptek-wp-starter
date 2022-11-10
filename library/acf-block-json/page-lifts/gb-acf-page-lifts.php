<?php

/**
 * Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

$block_title   = get_field( 'title' );
$title_level   = ! empty( get_field( 'heading_level' ) ) ? get_field( 'heading_level' ) : 'h1';
$what_to_show  = get_field( 'what_to_show' );
$post_parent   = get_field( 'post_parent' );
$post_count    = ! empty( get_field( 'post_count' ) ) ? get_field( 'post_count' ) : - 1;
$defined_posts = get_field( 'defined_posts' );

$query_args = [
	'post_type'      => 'page',
	'posts_per_page' => $post_count,
	'order'          => 'ASC',
	'orderby'        => 'menu_order',
];

if ( 'post_parent' === $what_to_show ) {
	$another_args = [
		'post_parent' => $post_parent,
	];
}

if ( 'define' === $what_to_show ) {
	$another_args = [
		'post__in' => $defined_posts,
	];
}

$query_args = wp_parse_args( $another_args, $query_args );

$block_id = 'gb-page-lifts-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_names = [
	'gb-page-lifts',
	'gb-page-lifts-' . $block['id'],
];

if ( ! empty( $block['className'] ) ) {
	$class_names[] = $block['className'];
}

if ( $title_level === 'h1' ) {
	$class_names[] = 'gb-page-lifts--no-top-padding';
}

if ( ! empty( $block['align'] ) ) {
	$class_names[] = 'align' . $block['align'];
}

if ( ! empty( $block['backgroundColor'] ) ) {
	$class_names[] = 'has-background';
	$class_names[] = 'has-' . $block['backgroundColor'] . '-background-color';
}

if ( ! empty( $block['textColor'] ) ) {
	$class_names[] = 'has-text-color';
	$class_names[] = 'has-' . $block['textColor'] . '-color';
}

?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
	<div class="gb-page-lifts__container">
		<?php if ( $title_level === 'h1' ) : ?>
			<h1 class="gb-page-lifts__title gb-page-lifts__title--h1">
				<?php echo esc_html( $block_title ); ?>
			</h1>
		<?php else : ?>
			<h2 class="gb-page-lifts__title">
				<?php echo esc_html( $block_title ); ?>
			</h2>
		<?php endif; ?>
		<div class="gb-page-lifts__row">
			<?php
			$query = new WP_Query( $query_args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();

					$block_args = [
						'url'      => get_the_permalink(),
						'title'    => get_the_title(),
						'image_id' => has_post_thumbnail() ? get_post_thumbnail_id() : null,
					];

					get_template_part( 'partials/blocks/b-page-lift', '', $block_args );
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
