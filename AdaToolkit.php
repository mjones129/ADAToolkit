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
    wp_enqueue_script('ada-toolkit-js', plugin_dir_url(__FILE__) . 'ada-toolkit.js', array('jquery'), '1.0', true);
    wp_enqueue_style('ada-toolkit-css', plugin_dir_url(__FILE__) . 'ada-toolkit.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'ada_toolkit_enqueue_scripts');
