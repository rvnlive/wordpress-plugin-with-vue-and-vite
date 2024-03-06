<?php
/*
Plugin Name: My Vue Plugin
Description: A plugin integrating a Vue 3 application with WordPress.
Version: 1.0
Author: Your Name
*/

// Prevents direct file access by ensuring the script is executed within the WordPress context, enhancing security.
defined('ABSPATH') or die('No script kiddies please!');

// Enqueue Vue app's scripts and styles
function enqueue_scripts() {
    wp_enqueue_script('my-vue-app-js', plugin_dir_url(__FILE__) . 'dist/assets/index.js', array(), '1.0.0', true);
    wp_enqueue_style('my-vue-app-css', plugin_dir_url(__FILE__) . 'dist/assets/index.css', array(), '1.0.0');
}

// Add a top-level admin menu for the Vue plugin (left sidebar)
function add_admin_menu() {
    add_menu_page(
        'My Vue Plugin',              // Page title
        'Vue Plugin',                 // Menu title
        'manage_options',             // Capability required
        'my-vue-plugin',              // Menu slug
        'page_html',                  // Function to display the page content
        100                           // Position
    );
}

// Callback to output the content of the Vue plugin's admin page
function page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    echo '<div class="wrap">';
    echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
    echo '<div id="app"></div>'; // Vue app will mount here
    echo '</div>';

    // Enqueue the Vue app scripts and styles specifically for this admin page
    enqueue_scripts();
}

// Style the wordpress menu for the Vue plugin
function admin_styles() {
    wp_enqueue_style('my-vue-plugin-admin-styles', plugin_dir_url(__FILE__) . 'admin-style/admin-style.css');
}




// Include additional PHP files for API endpoints and helper functions
// require_once plugin_dir_path(__FILE__) . 'includes/api-endpoints.php'; // Uncomment if needed
// require_once plugin_dir_path(__FILE__) . 'includes/helper-functions.php'; // Uncomment if needed

// Hooks
add_action('wp_enqueue_scripts', 'enqueue_scripts');
add_action('admin_menu', 'add_admin_menu');
add_action('admin_enqueue_scripts', 'admin_styles');
?>
