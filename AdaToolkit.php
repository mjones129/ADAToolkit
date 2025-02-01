<?php
/*
Plugin Name: ADA Toolkit
Description: Adds a "Skip to main content" button when the user hits the Tab key.
Version: 0.5
Author: Adam
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue scripts and styles
function ada_toolkit_enqueue_scripts()
{
    if (get_option('ada_toolkit_skip_to_content', '1') === '1') {
        wp_enqueue_script('ada-toolkit-js', plugin_dir_url(__FILE__) . 'ada-toolkit.js', array('jquery'), '1.0', true);
        wp_enqueue_style('ada-toolkit-css', plugin_dir_url(__FILE__) . 'ada-toolkit.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'ada_toolkit_enqueue_scripts');

// Add admin menu
function ada_toolkit_add_admin_menu()
{
    add_menu_page(
        'ADA Toolkit',
        'ADA Toolkit',
        'manage_options',
        'ada-toolkit',
        'ada_toolkit_settings_page',
        'dashicons-admin-generic'
    );
}
add_action('admin_menu', 'ada_toolkit_add_admin_menu');

// Settings page
function ada_toolkit_settings_page()
{
?>
    <div class="wrap">
        <h1>ADA Toolkit Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ada_toolkit_settings_group');
            do_settings_sections('ada-toolkit');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// Register settings
function ada_toolkit_register_settings()
{
    register_setting('ada_toolkit_settings_group', 'ada_toolkit_skip_to_content');

    add_settings_section(
        'ada_toolkit_main_section',
        'Main Settings',
        null,
        'ada-toolkit'
    );

    add_settings_field(
        'ada_toolkit_skip_to_content',
        'Enable "Skip to main content" button',
        'ada_toolkit_skip_to_content_callback',
        'ada-toolkit',
        'ada_toolkit_main_section'
    );
}
add_action('admin_init', 'ada_toolkit_register_settings');

function ada_toolkit_skip_to_content_callback()
{
    $option = get_option('ada_toolkit_skip_to_content', '1');
?>
    <input type="checkbox" name="ada_toolkit_skip_to_content" value="1" <?php checked('1', $option); ?> />
<?php
}
?>