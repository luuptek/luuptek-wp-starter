<?php

/**
 * Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$block_title   = get_field( 'title' );
$what_to_show  = get_field( 'what_to_show' );
$post_count    = get_field( 'post_count' );
$defined_posts = get_field( 'defined_posts' );

$query_args = [
	'post_type'     => 'post',
	'posts_per_page' => ! empty( $post_count ) ? $post_count : 10,
	'order'         => 'DESC',
	'orderby'       => 'date',
];

if ( 'define' === $what_to_show ) {
	$query_args = [
		'post_type' => 'post',
		'post__in'  => $defined_posts,
		'order'     => 'DESC',
		'orderby'   => 'post_date',
	];
}

$block_id = 'gb-latest-posts-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

$class_names = [
	'gb-latest-posts',
	'gb-latest-posts-' . $block['id'],
];

if ( ! empty( $block['className'] ) ) {
	$class_names[] = $block['className'];
}

if ( ! empty( $block['align'] ) ) {
	$class_names[] = 'align' . $block['align'];
}

?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
	<div class="container">
		<h2 class="gb-latest-posts__title">
			<?php echo esc_html( $block_title ); ?>
		</h2>
		<div class="gb-latest-posts__row">
			<?php
			$query = new WP_Query( $query_args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$args = [
						'title'    => get_the_title(),
						'url'      => get_the_permalink(),
						'image_id' => get_post_thumbnail_id( get_the_ID() ),
						'excerpt'  => get_the_excerpt(),
						'date'     => get_the_date(),
					];

					get_template_part( 'partials/components/post-lift', '', $args );
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
