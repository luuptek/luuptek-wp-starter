<?php

if ( ! is_array( $args ) ) {
	return;
}

$btn_title  = $args['title'];
$btn_link   = $args['url'];
$btn_target = $args['target'];

?>

<div class="wp-block-button is-style-fill">
	<a class="wp-block-button__link" href="<?php echo esc_url( $btn_link ); ?>"
	   target="<?php echo esc_attr( $btn_target ); ?>">
		<?php echo esc_html( $btn_title ); ?>
	</a>
</div>
