<?php
/*
Plugin Name: ADA Toolkit
Description: Adds accessibility features such as a "Skip to main content" button and Dark Mode.
Version: 0.6
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
    if (get_option('ada_toolkit_dark_mode', '0') === '1') {
        wp_enqueue_style('ada-toolkit-dark-mode-css', plugin_dir_url(__FILE__) . 'ada-toolkit-dark-mode.css', array(), '1.0');
        wp_enqueue_script('ada-toolkit-dark-mode-js', plugin_dir_url(__FILE__) . 'ada-toolkit-dark-mode.js', array('jquery'), '1.0', true);
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
        'dashicons-search' // Magnifying glass icon
    );
}
add_action('admin_menu', 'ada_toolkit_add_admin_menu');

// Settings page
function ada_toolkit_settings_page()
{
?>
    <div class="wrap">
        <h1 style="text-align: center;">ADA Toolkit Settings</h1>
        <p style="text-align: center;">Configure the accessibility features provided by the ADA Toolkit plugin. Enable or disable features as needed to improve the accessibility of your website.</p>
        <p style="text-align: center;">These features help in making your website more accessible and compliant with ADA standards:</p>
        <ul style="text-align: center;">
            <li><strong>Skip to main content button:</strong> Helps users with screen readers and keyboard navigation to quickly access the main content.</li>
            <li><strong>Dark Mode:</strong> Provides a high-contrast theme that is easier on the eyes, especially for users with visual impairments.</li>
        </ul>
        <form method="post" action="options.php">
            <?php
            settings_fields('ada_toolkit_settings_group');
            ?>
            <table class="form-table" style="width: 100%; background-color: #f9f9f9; border-collapse: collapse;">
                <tr style="background-color: #e9e9e9;">
                    <th style="padding: 10px; text-align: left;">Feature</th>
                    <th style="padding: 10px; text-align: left;">Enable/Disable</th>
                </tr>
                <?php
                do_settings_sections('ada-toolkit');
                ?>
            </table>
            <?php
            submit_button();
            ?>
        </form>
        <h2 style="text-align: center;">Coming Soon</h2>
        <p style="text-align: center;">Stay tuned for these upcoming features:</p>
        <ul style="text-align: center;">
            <li>Additional accessibility enhancements</li>
            <!-- Add more upcoming features here -->
        </ul>
    </div>
<?php
}

// Register settings
function ada_toolkit_register_settings()
{
    register_setting('ada_toolkit_settings_group', 'ada_toolkit_skip_to_content');
    register_setting('ada_toolkit_settings_group', 'ada_toolkit_dark_mode');

    add_settings_section(
        'ada_toolkit_main_section',
        'Main Settings',
        'ada_toolkit_main_section_callback',
        'ada-toolkit'
    );

    add_settings_field(
        'ada_toolkit_skip_to_content',
        'Enable "Skip to main content" button',
        'ada_toolkit_skip_to_content_callback',
        'ada-toolkit',
        'ada_toolkit_main_section'
    );

    add_settings_field(
        'ada_toolkit_dark_mode',
        'Enable Dark Mode',
        'ada_toolkit_dark_mode_callback',
        'ada-toolkit',
        'ada_toolkit_main_section'
    );
}
add_action('admin_init', 'ada_toolkit_register_settings');

function ada_toolkit_main_section_callback()
{
    echo '<p>Configure the main settings for the ADA Toolkit plugin.</p>';
}

function ada_toolkit_skip_to_content_callback()
{
    $option = get_option('ada_toolkit_skip_to_content', '1');
?>
    <input type="checkbox" name="ada_toolkit_skip_to_content" value="1" <?php checked('1', $option); ?> />
<?php
}

function ada_toolkit_dark_mode_callback()
{
    $option = get_option('ada_toolkit_dark_mode', '0');
?>
    <input type="checkbox" name="ada_toolkit_dark_mode" value="1" <?php checked('1', $option); ?> />
<?php
}
?>