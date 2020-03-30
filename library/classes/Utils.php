<?php

namespace LuuptekWP;

class Utils {

	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @param $nav_id
	 */
	function content_nav( $nav_id ) {
		global $wp_query, $post;

		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

		?>
        <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
            <ul class="pager">
				<?php if ( is_single() ) : ?>
					<?php previous_post_link( '<li class="nav-previous previous">%link</li>',
						'<span class="meta-nav">' . _x( '&larr;', 'Previous post link',
							TEXT_DOMAIN ) . '</span> %title' ); ?>
					<?php next_post_link( '<li class="nav-next next">%link</li>',
						'%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link',
							TEXT_DOMAIN ) . '</span>' ); ?>

				<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
					<?php if ( get_next_posts_link() ) : ?>
                        <li class="nav-previous previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts',
								TEXT_DOMAIN ) ); ?></li>
					<?php endif; ?>
					<?php if ( get_previous_posts_link() ) : ?>
                        <li class="nav-next next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>',
								TEXT_DOMAIN ) ); ?></li>
					<?php endif; ?>
				<?php endif; ?>
            </ul>
        </nav>
		<?php
	}

	/**
	 * Get custom CPTs
	 *
	 * @return array
	 */
	public function get_custom_post_types() {
		return get_post_types( [
			'public'   => true,
			'_builtin' => false
		] );
	}

	/**
	 * Get first category-item
	 *
	 * @param string $taxonomy
	 *
	 * @return mixed
	 */
	public function get_category( $taxonomy = 'category' ) {
		$categories = wp_get_object_terms( get_the_ID(), $taxonomy );

		return ! empty( $categories ) ? wp_get_object_terms( get_the_ID(), $taxonomy )[0] : null;
	}

	/**
	 * Get whole category-hierarchy
	 *
	 * @param string $taxonomy
	 *
	 * @return array
	 */
	public function get_category_hierarchy( $taxonomy = 'category' ) {

		$cats     = [];
		$category = wp_get_object_terms( get_the_ID(), $taxonomy )[0];
		$cat_tree = get_ancestors( $category->term_id, $taxonomy );
		array_push( $cat_tree, $category->term_id );
		asort( $cat_tree );

		foreach ( $cat_tree as $cat ) {
			$cats[] = get_term_by( 'id', $cat, $taxonomy );
		}

		return $cats;
	}

	/**
	 * Get parent-most category
	 *
	 * @param string $taxonomy
	 *
	 * @return mixed
	 */
	public function get_parent_category( $taxonomy = 'category' ) {
		$cats = self::get_category_hierarchy( $taxonomy );

		return $cats[0];
	}

	/**
	 * Get build images uri
	 *
	 * @return string
	 */
	public function get_image_uri() {
		return asset_uri( 'images' );
	}

	/**
	 * Get default image
	 *
	 * @param string $size
	 *
	 * @return array|false
	 */
	public function get_default_image( $size = 'full' ) {
		$image_id = ! empty( get_option( 'options_luuptek_wp_base_default_image_id' ) ) ? get_option( 'options_luuptek_wp_base_default_image_id' ) : null;

		return wp_get_attachment_image_src( $image_id, $size )[0];
	}

	/**
	 * Get first paragraph from text content.
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public function get_first_paragraph( $text ) {
		$str = wpautop( $text );
		$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
		$str = strip_tags( $str, '<a><strong><em>' );
		$str = preg_replace( "/\[.*\]\s*/", "", $str );

		return '<p>' . $str . '</p>';
	}

	/**
	 * Retrive post thumbnail (featured image) if defined,
	 * if not, retrieve default post image that's defined in theme settings
	 *
	 * @param string $size
	 * @param null $postId
	 *
	 * @return false|string
	 */
	public function get_the_featured_image_url( $size = 'full', $postId = null ) {
		$featuredImageUrl = get_the_post_thumbnail_url( $postId, $size );

		if ( $featuredImageUrl ) {
			return $featuredImageUrl;
		} else {
			return $this->get_default_image( $size );
		}
	}

	/**
	 * Return post type name by post id
	 *
	 * @param $post_id
	 * @param string $name (can be set to name or singular_name)
	 *
	 * @return mixed
	 */
	function get_post_type_name_by_post( $post_id, $name = 'name' ) {
		$post_type        = get_post_type( $post_id );
		$post_type_object = get_post_type_object( $post_type );

		return $post_type_object->labels->{$name};
	}

	/**
	 * Echoes some-links
     *
     * You can render these anywhere in the theme you want to..
	 *
	 */
	function get_social_media_links() {
		$social_medias = [ 'facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'github' ];

		foreach ( $social_medias as $social_media ) {
			$field = 'options_luuptek_wp_base_contact_details_' . $social_media . '_url';
			$option = get_option($field);

			if ( ! empty( $option ) ) {
				$faClass = 'fa-' . $social_media . '-square';
				if ( $social_media === 'instagram' || $social_media === 'linkedin' ) {
					$faClass = 'fa-' . $social_media;
				}
				?>
                <li>
                    <a href="<?php echo $option ?>" target="_blank"><em
                                class="fab <?php echo $faClass ?>" aria-hidden="true"></em></a>
                </li>
				<?php
			}
		}
	}
}
