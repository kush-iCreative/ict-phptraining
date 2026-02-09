<?php
if ( ! defined('ABSPATH') ) {
  exit;
}

/* THEME SETUP */
function feane_theme_setup() {
  register_nav_menus(array(
    'primary_menu' => 'Primary Menu'
  ));

  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'feane_theme_setup');

/* CSS & JS */
function feane_assets() {

  /* CSS */
  wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css');
  wp_enqueue_style('fontawesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
  wp_enqueue_style('main-style', get_template_directory_uri().'/assets/css/style.css');
  wp_enqueue_style('responsive', get_template_directory_uri().'/assets/css/responsive.css');

  /* JS */
  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.js', array('jquery'), null, true);
  wp_enqueue_script('custom-js', get_template_directory_uri().'/assets/js/custom.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'feane_assets');


function register_movies_cpt() {

  register_post_type('movies', array(
    'labels' => array(
      'name'          => 'Movies',
      'singular_name' => 'Movie',
      'add_new_item'  => 'Add New Movie',
    ),
    'public'        => true,
    'has_archive'  => false,
    'menu_icon'    => 'dashicons-video-alt2',
    'supports'     => array('title', 'editor', 'excerpt', 'thumbnail'),
  ));

}
add_action('init', 'register_movies_cpt');
function load_fontawesome() {
  wp_enqueue_style(
    'font-awesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
  );
}
add_action('wp_enqueue_scripts', 'load_fontawesome');


function get_first_image_from_content() {
  global $post;

  if ( empty($post->post_content) ) {
    return false;
  }

  preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->post_content, $image);

  if (isset($image['src'])) {
    return $image['src'];
  }

  return false;
}
