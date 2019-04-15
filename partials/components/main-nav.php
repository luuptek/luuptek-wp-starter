<nav class="navbar navbar-expand-xl navbar-dark main-nav">
    <div class="container">
        <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>">
            <img src="<?php echo UTILS()->get_image_uri() . '/logo.svg' ?>" class="nav-logo" alt="Logo"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="<?php _e( 'Toggle navigation', TEXT_DOMAIN ); ?>">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto">
				<?php luuptek_wp_base_main_menu(); ?>
            </ul>
        </div>
    </div>
</nav>