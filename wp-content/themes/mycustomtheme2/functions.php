<?php
if (! defined('ABSPATH')) {
  exit;
}
/*custom header and footer menu */
function feane_theme_setup()
{
  register_nav_menus(array(
    'primary_menu' => 'Primary Menu'
  ));

  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'feane_theme_setup');


function custom_footer_menu_register()
{
  register_nav_menu('custom-footer-links', __('Custom Footer Links Menu Location'));
}
add_action('init', 'custom_footer_menu_register');

/*import css and js */
function feane_assets()
{


  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
  wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css');
  wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css');


  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), null, true);
  wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'feane_assets');

/*register new custom type */
function register_movies_cpt()
{

  register_post_type('movies', array(
    'labels' => array(
      'name'          => 'Movies',
      'singular_name' => 'Movie',
      'add_new_item'  => 'Add New Movie',
    ),
    'public'        => true,
    'has_archive'  => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'menu_icon'    => 'dashicons-video-alt2',
    'supports'     => array('title', 'editor', 'excerpt', 'thumbnail'),
  ));
}
add_action('init', 'register_movies_cpt');


/**load fontawesome */
function load_fontawesome()
{
  wp_enqueue_style(
    'font-awesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
  );
}
add_action('wp_enqueue_scripts', 'load_fontawesome');


/**custom footer widgets  */
function custom_theme_footer_widgets_init()
{
  $footer_columns = array('1', '2', '3');

  foreach ($footer_columns as $col) {
    register_sidebar(array(
      'name'          => "Footer Column $col",
      'id'            => "footer-col-$col",
      'before_widget' => '<div class="footer-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ));
  }
}
add_action('widgets_init', 'custom_theme_footer_widgets_init');



 // woocommerce add checkout custom field
// 1. Display the field
add_action('woocommerce_after_checkout_billing_form', 'render_permanent_address_field');
function render_permanent_address_field($checkout)
{
  woocommerce_form_field('my_custom_address_id', array(
    'type'          => 'text',
    'label'         => __('Permanent Address'),
    'placeholder'   => __('Enter address here...'),
    'required'      => true,
  ), $checkout->get_value('my_custom_address_id'));
}

// 2. The "Guaranteed" Save (Works for both   )
add_action('woocommerce_checkout_create_order', 'force_save_custom_field', 10, 2);
function force_save_custom_field($order)
{
  if (isset($_POST['my_custom_address_id'])) {

    $order->update_meta_data('_permanent_address', sanitize_text_field($_POST['my_custom_address_id']));
  }
}


add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_field_in_admin', 10, 1);

function display_custom_field_in_admin($order)
{
  $address = $order->get_meta('_permanent_address');
  if ($address) {
    echo '<p><strong>' . __('Permanent Address') . '</strong>: ' . $address . '</p>';
  }
}


/* custom message with shortcode
function my_custom_banner_shortcode()
{
  return '<div class="custom-banner">Check out our new custom theme features!</div>';
}

add_shortcode('my_banner', 'my_custom_banner_shortcode');
*/
/**create shortcode and show posttype */
function custom_post_type_shortcode_listing( $atts ) {
    ob_start();
    
    $atts = shortcode_atts( array(
        'type'           => 'movies', 
        'posts_per_page' => 3,
        'order'          => 'DESC',
    ), $atts, 'custom_post_list' );

    $args = array(
        'post_type'      => $atts['type'],
        'posts_per_page' => $atts['posts_per_page'],
        'order'          => $atts['order'],
        'orderby'        => $atts['orderby'],
        'post_status'    => 'publish',
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        echo '<div class="movie-container">';
        while ( $query->have_posts() ) : $query->the_post();
            echo '<div class="movie-item" style="margin-bottom: 20px; display:inline-block ;padding:10px;"> ';

            echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';

             // Fetch and display the featured image if it exists
            if ( has_post_thumbnail() ) {
                echo '<div class="movie-thumbnail">';
                echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_post_thumbnail( get_the_ID(), 'medium' ) . '</a>';
                echo '</div>';
            }

            
            echo '</div>';
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo 'Sorry, no posts were found for this post type.';
    }

    return ob_get_clean();
}
add_shortcode( 'custom_post_list', 'custom_post_type_shortcode_listing' );



// add custom menu option 


/*Add option into apperance */
function mytheme_options_page() {
    add_theme_page(
        'My Theme Options',          // Page title
        'Theme Options',             // Menu title
        'manage_options',            // Capability required
        'mytheme-options',           // Menu slug
        'mytheme_options_page_html'  // Callback function
    );
}
add_action( 'admin_menu', 'mytheme_options_page' ,10);


/*Ui part */
function mytheme_options_page_html() {
    // Check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    // show error/success messages
    settings_errors( 'mytheme_options_group' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'mytheme_options_group' );//generate hidden security tokes so wordpress knows the request is legitimate
            // Automatically loops through every section and field you register
            do_settings_sections( 'mytheme-options' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

function mytheme_register_settings() {
    register_setting( 'mytheme_options_group', 'mytheme_footer_text', 'sanitize_text_field' );
      
     register_setting( 'mytheme_options_group', 'mytheme_social_link', 'esc_url_raw' ); // Use esc_url_raw for links

    add_settings_section(
        'mytheme_section_general', // Section ID
        'General Settings',        // Section title
        'mytheme_section_general_callback', // Section callback
        'mytheme-options'          // Page slug
    );

   add_settings_field(
        'mytheme_footer_text_field', // Field ID
        'Footer Text',               // Field title
        'mytheme_footer_text_field_callback', 
        'mytheme-options',           // Page slug
        'mytheme_section_general'    // Section ID
    );

        // NEW: Add the second field to the same section
    add_settings_field(
        'mytheme_social_link_field',   // Unique ID
        'Social Media Link',           // Label
        'mytheme_social_link_callback', // Callback function below
        'mytheme-options',             // Page slug
        'mytheme_section_general'      // Section ID
    );
}
add_action( 'admin_init', 'mytheme_register_settings',20 );


function mytheme_social_link_callback() {
    // Get the value of the new setting
    $link = get_option( 'mytheme_social_link' );
    ?>
    <input type="url" name="mytheme_social_link" value="<?php echo esc_url( $link ); ?>" class="regular-text">
    <p class="description">Enter your full Twitter or Facebook URL.</p>
    <?php
}


function mytheme_section_general_callback() {
    echo '<p>Enter general theme settings below.</p>';
}

function mytheme_footer_text_field_callback() {
    $setting = get_option( 'mytheme_footer_text' ); //get value from db
    ?>
    <input type="text" name="mytheme_footer_text" value="<?php echo esc_attr( $setting ); ?>">
    
    <?php
}


