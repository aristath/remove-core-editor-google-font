<?php
/**
 * Plugin Name: Remove Core Editor Google Font
 * Plugin URI: https://github.com/aristath/no-core-gfonts
 * Description: Removes Core Google Fonts from the WordPress editor.
 * Requires at least: 5.5
 * Requires PHP: 5.6
 * Version: 1.0
 * Author: Ari Stathopoulos
 * Text Domain: no-editor-core-gfont
 *
 */

add_filter( 'wp_default_styles', function( $styles ) {

    // The style handle.
    $style_id = 'wp-editor-font';

    // Remove style.
    unset( $styles->registered[ $style_id ] );

    // Loop dependencies and remove the defined style handle from other styles.
    foreach ( $styles->registered as $key => $style_val ) {

        // The dependencies.
        $deps      = $style_val->deps;
        $style_pos = array_search( $style_id, $deps );
        
        // If the style-handle was located as a dependency, remove it.
        if ( false !== $style_pos ) {
            unset( $deps[ $style_pos ] );
            $styles->registered[ $key ]->deps = $deps;
        }
    }

    return $styles;
}, 999 );