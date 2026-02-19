<?php
// die('Functions file is working!');
function change_howdy_text($translated_text, $text, $domain)
{
    // Only change it if it matches our text AND our theme's domain
    if ('my-theme' === $domain && 'offers' === $text) {
        return 'Greetings';
    }
    return $translated_text;
}
add_filter('gettext', 'change_howdy_text', 10, 3);

function my_theme_enqueue_assets()
{
    // Enqueue CSS from the /css folder
    wp_enqueue_style(
        'my-custom-css',
        get_template_directory_uri() . '/css/custom.css',
        array(),
        '1.0'
    );

    // Enqueue JS from the /js folder
    wp_enqueue_script(
        'my-custom-js',
        get_template_directory_uri() . '/js/custom.js',
        array(),
        '1.0',
        true // Load in footer for better performance
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets', 10);

function create_movie_taxonomies() {
    // Labels for the GUI
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'parent_item'       => __( 'Parent Genre' ),
        'parent_item_colon' => __( 'Parent Genre:' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'      => true, // true = like Categories (checkboxes), false = like Tags
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true, // Shows the column in the Movies list table
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
        'show_in_rest'      => true, // Essential for the Gutenberg editor
    );

    // Register it to the 'movies' post type
    register_taxonomy( 'movie_genre', array( 'movies' ), $args );
}
add_action( 'init', 'create_movie_taxonomies' );


function create_custom_post_type()
{
    register_post_type(
        'movies',
        array(
            'labels' => array(
                'name' => __('Movies'),
                'singular_name' => __('Movie')
            ),
            'public'      => true,
            'has_archive' => true,
            'taxonomies' => array('movie_genre'), // Add this line to your current register_post_type array

            // 'hierarchical' => true,
            'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
            'show_in_rest' => true, // Enables the Gutenberg editor
        )
    );
}
add_action('init', 'create_custom_post_type');

function register_my_theme_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Navigation Menu', 'my-custom-theme' ),
            // You can register more menus here if needed
            'footer-menu' => __( 'Footer Menu', 'my-custom-theme' ),
        )
    );
}
add_action( 'init', 'register_my_theme_menus' );

/*
function include_movies_in_search($query) {
    
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'page', 'movies'));
    }
    return $query;
}
add_filter('pre_get_posts', 'include_movies_in_search');
*/

function search_only_movies($query) {
    
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $query->set('post_type', 'movies');
    }
    return $query;
}
add_filter('pre_get_posts', 'search_only_movies');


/* function wporg_custom_post_type() {
	register_post_type('wporg_product',
		array(
			'labels'      => array(
				'name'          => __( 'Products', 'textdomain' ),
				'singular_name' => __( 'Product', 'textdomain' ),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array( 'slug' => 'products' ), // my custom slug
		)
	);
}
add_action('init', 'wporg_custom_post_type'); */


