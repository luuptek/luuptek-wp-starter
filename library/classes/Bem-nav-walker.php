<?php

class BEM_Nav_Walker extends Walker_Nav_Menu {
	protected $name;
	protected $sub_menu_toggles;

	public function __construct( $name, $sub_menu_toggles = true ) {
		$this->name             = $name;
		$this->sub_menu_toggles = $sub_menu_toggles;
	}

	/**
	 * Start lvl
	 */
	public function start_lvl( &$output, $depth = 0, $args = [] ) {
		$tn = $this->get_tn( $args );
		$t  = $tn['t'];
		$n  = $tn['n'];

		$indent = str_repeat( $t, $depth );

		$menu_class = $args->menu_class;

		$parent_lvl = $depth + 1;
		$child_lvl  = $parent_lvl + 1;

		$icon      = '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" fill-rule="evenodd" >
  <path d="M9.40625 0L10 .65625 5 6 0 .65625.59375 0 5 4.6875z"/>
</svg>';
		$menu_name = $this->name;

		if ( $this->sub_menu_toggles ) {
			$aria_label = pll_esc_html__( 'Avaa alavalikko' );
			$output     .= "{$n}{$indent}<button class=\"{$menu_class}-lvl-{$parent_lvl}__sub-menu-toggle sub-menu-toggle\" data-${menu_name}-toggle=\"sub-menu\" aria-label=\"${aria_label}\" aria-expanded=\"false\">${icon}</button>{$n}";
		}

		$output .= "{$n}{$indent}<ul class=\"{$menu_class}-lvl-{$child_lvl} {$menu_class}-lvl\">{$n}";
	}

	/**
	 * End lvl
	 */
	public function end_lvl( &$output, $depth = 0, $args = [] ) {
		$tn = $this->get_tn( $args );
		$t  = $tn['t'];
		$n  = $tn['n'];

		$indent = str_repeat( $t, $depth );
		$output .= "{$indent}</ul>{$n}";
	}

	/**
	 * Start el
	 */
	public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
		$tn = $this->get_tn( $args );
		$t  = $tn['t'];
		$n  = $tn['n'];

		$indent = str_repeat( $t, $depth );
		$lvl    = $depth + 1;

		// Set classes
		$el_classes  = $this->get_el_classes( $item, $depth, $args );
		$class_names = implode( ' ', $el_classes );
		$class_names = $class_names ? 'class="' . esc_attr( $class_names ) . '"' : '';

		// Set attributes
		$atts           = [];
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $item->xfn;
		}
		$atts['href'] = ! empty( $item->url ) ? $item->url : '';

		$attributes = '';

		foreach ( $atts as $attr => $value ) {
			if ( empty( $value ) ) {
				continue;
			}

			$value      = ( 'href' == $attr ) ? esc_url( $value ) : esc_attr( $value );
			$attributes .= ' ' . $attr . '="' . $value . '"';
		}

		// Generate output
		$description = ! empty( $item->description ) ? "<span class=\"{$args->menu_class}__description\">" . esc_html( $item->description ) . '</span>' : '';

		$output      .= $indent . '<li ' . $class_names . '>';
		$output      .= $args->before;
		$output      .= '<a class="' . $args->menu_class . '-lvl-' . $lvl . '__link" ' . $attributes . '>';
		$output      .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $description . $args->link_after;
		$output      .= '</a>';

		$output .= $args->after;
	}

	/**
	 * End el
	 */
	public function end_el( &$output, $item, $depth = 0, $args = [] ) {
		$tn = $this->get_tn( $args );
		$t  = $tn['t'];
		$n  = $tn['n'];

		$output .= "</li>{$n}";
	}

	/**
	 * Get el classes
	 */
	public function get_el_classes( $item, $depth = 0, $args = [] ) {
		$lvl = $depth + 1;

		$classes = [];

		// Example: primary-nav-lvl-1
		$base_class = $args->menu_class . '-lvl-' . $lvl;

		$classes[] = $base_class . '__item';

		if ( $item->current ) {
			$classes[] = $base_class . '__item--current';
		}

		if ( in_array( 'menu-item-has-children', (array) $item->classes ) ) {
			$classes[] = $base_class . '__item--has-children';
			$classes[] = $args->menu_class . '__item--has-children';
		}

		$ancestors = get_post_ancestors( get_the_ID() );
		if ( in_array( intval( $item->object_id ), $ancestors, true ) ) {
			$classes[] = $base_class . '__item--ancestor';
		}

		$current_parent = wp_get_post_parent_id( get_the_ID() );
		if ( intval( $item->object_id ) === $current_parent ) {
			$classes[] = $base_class . '__item--parent';
		}

		// Other examples, uncomment if needed

		/*if ( $depth ) {
			$classes[] = $base_class . '__item--child';
		}*/

		/*if ( $item->object_id ) {
			$classes[] = $base_class . '__item--id-' . $item->object_id;;
		}*/

		// Add custom classes to item.
		foreach ( $item->classes as $class_name ) {

			// Do not add WPs default classes.
			if ( false !== strpos( $class_name, 'menu-' ) ) {
				continue;
			}

			$classes[] = $class_name;
		}

		return $classes;
	}

	/**
	 * Get tn array
	 */
	public function get_tn( $args ) {
		$result = [];

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$result['t'] = '';
			$result['n'] = '';
		} else {
			$result['t'] = "\t";
			$result['n'] = "\n";
		}

		return $result;
	}

}
