<?php
$post_lift_title     = $args['title'];
$post_lift_excerpt   = $args['excerpt'];
$post_lift_image_id  = $args['image_id'];
$post_lift_date      = $args['date'];
$post_lift_url       = $args['url'];
$post_lift_image_url = get_the_post_thumbnail_url( get_the_ID(), 'article_lift' );
$image_alt           = get_the_post_thumbnail_caption();
$aria_label          = esc_html__( 'Lue lisää:', 'luuptek_wp_base' ) . ' ' . $post_lift_title;
?>
<div class="post-lift-item">
	<div class="post-lift-item__content">
		<a href="<?php echo esc_url( $post_lift_url ); ?>" class="post-lift-item__link"
		   aria-label="<?php echo esc_attr( $aria_label ); ?>">
			<?php
			if ( ! empty( $post_lift_image_id ) ) {
				echo wp_get_attachment_image( $post_lift_image_id, 'article_lift', false, [ 'class' => 'post-lift-item__image' ] );
			}
			?>
			<div class="post-lift-item__text-content ">
				<h3 class="post-lift-item__title">
					<?php echo esc_html( $post_lift_title ); ?>
				</h3>
				<?php if ( ! empty( $post_lift_excerpt ) ) : ?>
					<p class="post-lift-item__excerpt">
						<?php echo esc_html( $post_lift_excerpt ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $post_lift_date ) ) : ?>
					<p class="post-lift-item__date">
						<?php echo esc_html( $post_lift_date ); ?>
					</p>
				<?php endif; ?>
			</div>
		</a>
	</div>
</div>
