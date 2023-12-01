<?php
/*
Plugin Name: Internship Countdown Widget
Description: Display a countdown widget shortcode for upcoming internship deadlines.
Version: 1.0
Author: noor fatima
*/

// Activation hook callback
function internship_countdown_activate() {
    // Actions to perform on activation
}

// Deactivation hook callback
function internship_countdown_deactivate() {
    // Actions to perform on deactivation
}

// Activation Hook
register_activation_hook(__FILE__, 'internship_countdown_activate');

// Deactivation Hook
register_deactivation_hook(__FILE__, 'internship_countdown_deactivate');

// Enqueue scripts and styles
function internship_countdown_enqueue_scripts() {
    // Enqueue jQuery for countdown functionality
    wp_enqueue_script('jquery');

    $plugin_path = plugin_dir_url(__FILE__);

    //denfine version variable according to file updatio time
    $js_ver = filemtime(plugin_dir_path(__FILE__).'js/countdown.js');
    $style_ver = filemtime(plugin_dir_path(__FILE__).'css/style.css');

    // Enqueue countdown script with File System API
    wp_enqueue_script('countdown-script', $plugin_path . 'js/countdown.js', array('jquery'), $js_ver, true);

    // Enqueue custom styles with File System API
    wp_enqueue_style('countdown-style', $plugin_path . 'css/style.css', '' ,$style_ver);
}

add_action('wp_enqueue_scripts', 'internship_countdown_enqueue_scripts');

// Shortcode to display the countdown widget with a specific deadline
function internship_countdown_shortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'deadline' => '2023-12-30 23:59:59', // Default deadline
    ), $atts);

    // Get the stored deadline from the widget or use the default
    $widget_instance = get_option('widget_internship_countdown_widget');
    $stored_deadline = !empty($widget_instance[1]['deadline']) ? $widget_instance[1]['deadline'] : '';

    // Use the stored deadline if available, otherwise, use the shortcode attribute
    $deadline = !empty($stored_deadline) ? $stored_deadline : $atts['deadline'];

    ob_start(); // Start output buffering
    ?>

    <div class="internship-countdown-widget" data-deadline="<?php echo esc_attr($deadline); ?>"></div>
   


    <?php
    $output = ob_get_clean(); // Get the buffered output and clean the buffer
    return $output;
}

// Register the shortcode
add_shortcode('internship_countdown', 'internship_countdown_shortcode');


