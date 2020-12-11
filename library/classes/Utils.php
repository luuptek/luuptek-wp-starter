<?php

namespace LuuptekWP;

class Utils {

	/**
	 * Get custom CPTs
	 *
	 * @return array
	 */
	public function get_custom_post_types() {
		return get_post_types(
			[
				'public'   => true,
				'_builtin' => false,
			]
		);
	}

	/**
	 * Get first category-item
	 *
	 * @param string $taxonomy Taxonomy name
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
	 * @param string $taxonomy Taxonomy name
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
	 * @param string $taxonomy Taxonomy name
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
	 * @param string $size Thumbnail size
	 *
	 * @return array|false
	 */
	public function get_default_image( $size = 'full' ) {
		$image_id = ! empty( get_option( 'options_luuptek_wp_base_default_image_id' ) ) ? get_option( 'options_luuptek_wp_base_default_image_id' ) : null;

		return wp_get_attachment_image_src( $image_id, $size )[0];
	}

	/**
	 * Echoes svg directly from images-folder (as inline)
	 *
	 * @param string $file_name Name of the svg without .svg
	 */
	function the_svg( $file_name ) {
		readfile( asset_uri( 'images' ) . '/' . $file_name . '.svg' );
	}

	/**
	 * Get first paragraph from text content.
	 *
	 * @param string $text Text of the paragraph
	 *
	 * @return string
	 */
	public function get_first_paragraph( $text ) {
		$str = wpautop( $text );
		$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
		$str = strip_tags( $str, '<a><strong><em>' );
		$str = preg_replace( '/\[.*\]\s*/', '', $str );

		return '<p>' . $str . '</p>';
	}

	/**
	 * Retrive post thumbnail (featured image) if defined,
	 * if not, retrieve default post image that's defined in theme settings
	 *
	 * @param string $size Post thumbnail size
	 * @param int $postId ID of the post
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
	 * @param int $post_id ID of the post
	 * @param string $name What to return (name/slug)
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
	 */
	function get_social_media_links() {
		$social_medias = [ 'facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'github' ];

		foreach ( $social_medias as $social_media ) {
			$field  = 'options_luuptek_wp_base_contact_details_' . $social_media . '_url';
			$option = get_option( $field );

			if ( ! empty( $option ) ) {
				?>
				<li>
					<a href="<?php echo esc_url( $option ); ?>" target="_blank">
						<?php Utils()->the_svg('icons/' . $social_media . '-square'); ?>
					</a>
				</li>
				<?php
			}
		}
	}
}
