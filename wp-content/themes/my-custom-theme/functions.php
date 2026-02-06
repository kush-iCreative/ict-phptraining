<?php
function my_custom_theme_assets()
{
    // CSS FILES
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('nice-select', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css');

    // Replace your old font-awesome line with this one:
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');


    wp_enqueue_style('main-style', get_stylesheet_uri());

    // This loads the style.css inside your CSS folder
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('responsive-style', get_template_directory_uri() . '/css/responsive.css');

    // JS FILES
    wp_enqueue_script('jquery'); // Built-in WordPress jQuery
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com', array('jquery'), null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_theme_assets');


function theme_register_menus()
{
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu'),
    ));
}
add_action('init', 'theme_register_menus');
