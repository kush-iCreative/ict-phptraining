<?php
// 1. Register the Top-Level Menu
add_action('admin_menu', 'mfp_Add_Top_Level_Menu');

function mfp_Add_Top_Level_Menu() {
    add_menu_page(
        'Repeater Settings',     // Page title
        'Product Annotation',       // Menu title (Shows in sidebar)
        'manage_options',        // Capability
        'pa-repeater-slug',     // Slug
        'product_repeater_page_html',// Callback function
        'dashicons-feedback'  ,// Icon (optional)
        25
    );
}

// 2. Register Settings to save the data
add_action('admin_init', 'pa_register_settings');

function pa_register_settings() {
    // This allows WordPress to handle the $_POST data automatically
     register_setting(
        'pa-settings-group', 
        'pa_repeater_data', 
        array(
            'sanitize_callback' => 'mfp_filter_empty_rows' // The name of our cleaning function
        )
    );
}
function mfp_filter_empty_rows($input) {
    // If it's not an array, just return it as is
    if (!is_array($input)) {
        return $input;
    }

    // This filters the array
    $cleaned_input = array_filter($input, function($row) {
        // Return TRUE only if text is not empty OR number is not empty
        // If both are empty, this row returns FALSE and is deleted from the array
        return (!empty($row['product_title']) || !empty($row['product_price']));
    });

    // Reset the keys to 0, 1, 2... so there are no gaps
    return array_values($cleaned_input);
}


function product_repeater_page_html() {
    include( plugin_dir_path( __FILE__ ) . 'pa-first-acp-page.php' );
}

// shortcode for value 

add_shortcode('show_my_repeater', 'pa_display_repeater_shortcode');

function pa_display_repeater_shortcode() {
    $data = get_option('pa_repeater_data', []);
    if (empty($data)) return 'No data found.';

    $output = '<ul>';
    foreach ($data as $row) {
        $output .= '<li>' . esc_html($row['product_title']) . ': ' . esc_html($row['product_price']) . '</li>';
    } 
    $output .= '</ul>';
    
    return $output;
}
