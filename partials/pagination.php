<?php
the_posts_pagination( array(
	'mid_size'  => 3,
	'prev_text' => __( '<i class="fa fa-angle-double-left" aria-hidden="true"></i>', TEXT_DOMAIN ),
	'next_text' => __( '<i class="fa fa-angle-double-right" aria-hidden="true"></i>', TEXT_DOMAIN ),
) );