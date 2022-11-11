<?php

/**
 * The main Header template
 *
 * @package Luuptek WP-Base
 */

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>

	<meta charset="<?php echo get_bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<!-- ============================================================ -->
	<?php wp_head(); ?>
	<!-- ============================================================ -->

</head>

<body <?php body_class(); ?>>
<a href="#content-start" class="skip-to-content">
	<?php echo pll_esc_html__( 'Hyppää sisältöön' ); ?>
</a>
<?php do_action( 'luuptek_wp_base_after_body' ); ?>
<?php get_template_part( 'partials/components/main-nav' ); ?>
<div id="content-start">
