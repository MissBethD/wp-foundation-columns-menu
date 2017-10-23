<?php
namespace Chance;

class Walker_Nav_Menu_Footer extends Walker_Nav_Menu {

    // Set counter; later we'll use it to check for the first parent element
    public static $counter = 0;

    function start_el( &$output, $item, $depth, $args ) {

        global $wp_query;

        if ( ! isset( $this->current_menu ) )
            $this->current_menu = wp_get_nav_menu_object( $args->menu );

        // Set indent for sub-menu items
        $indent = ( $depth > 1 ) ? str_repeat( "\t", $depth - 1 ) : '';

        // Set class values for menu items
        $classes     = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[]   = 'menu-item-' . $item->ID;
        $class_names = $value = '';
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        // Set ID value for menu items
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = ! empty( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        // Check if you are displaying a top-level element to increment counter
        if ( $item->menu_item_parent === '0' ) {
            $this::$counter++;
        }

        if ( $depth === 0 && $this::$counter > 1 ) {
            $output .= $indent . '</li></ul></div><div class="columns small-6 medium-3 large-2"><ul><li' . $id . $value . $class_names .'>';
        }

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output  = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
