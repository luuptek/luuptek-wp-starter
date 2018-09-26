<?php

namespace LuuptekWP;

use Walker_Nav_Menu;

/**
 * Custom Navigation Walker that uses BEM naming convention.
 *
 * Uses the following classes:
 *
 * $prefix__item
 * $prefix__item--has-children
 * $prefix__item--current-ancestor
 * $prefix__item--current-parent
 * $prefix__item--current
 * $prefix__link
 * $prefix__submenu
 *
 * If sublink naming is set to true, $prefix_submenu items have the following classes:
 *
 * $prefix__subitem
 * $prefix__subitem--has-children
 * $prefix__subitem--current-ancestor
 * $prefix__subitem--current-parent
 * $prefix__subitem--current
 * $prefix__sublink
 *
 * Use this from the wp_nav_menu walker parameter like this:
 *
 *        'walker' => new Walker_Nav_Menu( 'prefix', 'use_sublink' )
 *
 * @param string $prefix  Prefix for the HTML list.
 * @param string $sublink (Optional) Should the HTML list use sublink naming.
 *
 * @uses Walker_Nav_Menu
 */
class WP_navwalker extends Walker_Nav_Menu {

    private $custom_prefix;

    private $sublink_naming;

    /**
     * Setup the prefix and sublink naming for this walker.
     */
    function __construct( $prefix = null, $sublink = true ) {
        $this->custom_prefix  = ( isset( $prefix ) ) ? esc_attr( $prefix ) : 'menu';
        $this->sublink_naming = ( isset( $sublink ) && 'use_sublink' == $sublink ) ? true : false;
    }

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     */
    public function start_lvl( &$output, $depth = 0, $args = [] ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"{$this->custom_prefix}__submenu dropdown\">\n";
    }

    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     */
    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } elseif ( strcasecmp( $item->attr_title, 'label' ) == 0 ) {
            $output .= $indent . '<li role="presentation"><label>' . esc_attr( $item->title ) . '</label>';
        } else {

            // Setup classes
            $classes = null;

            // Find custom CSS classes added in admin
            if ( ! empty( $item->classes[0] ) ) {
                foreach ( $item->classes as $class ) {
                    if ( 'menu-item' != $class ) {
                        $classes[] = $class;
                    } else {
                        break;
                    }
                }
            }

            if ( ( false == $this->sublink_naming ) || ( true == $this->sublink_naming && 0 == $item->menu_item_parent ) ) {

                // Item
                $classes[] = "{$this->custom_prefix}__item";

                // Has children
                if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__item--has-children has-dropdown";
                }

                // Current item
                if ( in_array( 'current-menu-item', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__item--current active";
                }

                // Current ancestor
                if ( in_array( 'current-menu-ancestor', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__item--current-ancestor";
                }

                // Current parent
                if ( in_array( 'current-menu-parent', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__item--current-parent";
                }

                // Home link
                if ( in_array( 'menu-item-home', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__item--home";
                }

            } else {

                // Item
                $classes[] = "{$this->custom_prefix}__subitem";

                // Has children
                if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__subitem--has-children has-dropdown";
                }

                // Current item
                if ( in_array( 'current-menu-item', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__subitem--current";
                }

                // Current ancestor
                if ( in_array( 'current-menu-ancestor', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__subitem--current-ancestor";
                }

                // Current parent
                if ( in_array( 'current-menu-parent', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__subitem--current-parent";
                }

                // Home link
                if ( in_array( 'menu-item-home', $item->classes ) ) {
                    $classes[] = "{$this->custom_prefix}__subitem--home";
                }
            }

            /**
             * Filter the CSS class(es) applied to a menu item's <li>.
             *
             * @since 3.0.0
             *
             * @see   wp_nav_menu()
             */
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            /**
             * Filter the ID applied to a menu item's <li>.
             *
             * @since 3.0.1
             *
             * @see   wp_nav_menu()
             */
            $output .= $indent . '<li' . $class_names . '>';

            $atts           = [];
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target ) ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
            $atts['href']   = ! empty( $item->url ) ? $item->url : '';

            /**
             * Filter the HTML attributes applied to a menu item's <a>.
             *
             * @since 3.6.0
             *
             * @see   wp_nav_menu()
             */
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            // Add link class
            if ( ( false == $this->sublink_naming ) || ( true == $this->sublink_naming && 0 == $item->menu_item_parent ) ) {
                $item_output .= '<a class="' . $this->custom_prefix . '__link" ' . $attributes . '>';
            } else {
                $item_output .= '<a class="' . $this->custom_prefix . '__sublink" ' . $attributes . '>';
            }

            /** This filter is documented in wp-includes/post-template.php */
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title,
                    $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            /**
             * Filter a menu item's starting output.
             *
             * The menu item's starting output only includes $args->before, the opening <a>,
             * the menu item's title, the closing </a>, and $args->after. Currently, there is
             * no filter for modifying the opening and closing <li> for a menu item.
             *
             * @since 3.0.0
             *
             * @see   wp_nav_menu()
             */
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}
