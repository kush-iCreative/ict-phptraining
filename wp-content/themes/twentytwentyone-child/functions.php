<?php
/**
 * Enqueue parent and child theme styles for Twenty Twenty-One
 */
function twentytwentyone_child_enqueue_styles() {
    // The handle used by the parent theme is 'twenty-twenty-one-style'
    $parent_handle = 'twentytwentyone'; 

    // Enqueue the parent theme's stylesheet
    wp_enqueue_style( $parent_handle, get_template_directory_uri() . '/style.css' );

    // Enqueue the child theme's stylesheet, making it dependent on the parent
    wp_enqueue_style( 'twentytwentyone-child', 
        get_stylesheet_uri(), 
        array( $parent_handle ), 
        wp_get_theme()->get('Version') 
    );
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/custom.css');
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_child_enqueue_styles' );
