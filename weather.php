<?php
/**
 * Plugin Name: Weather Plugin
 * Plugin URI: https://your-plugin-url.com/
 * Description: This is a weather plugin using OpenWeatherMap API.
 * @package WeatherPlugin
 * @version 1.0
 * @author Fabian Häfliger
 * Author URI: https://author-website.com/
 * License: GPL2
 */

// Directories and Paths
$plugin_dir_path = plugin_dir_path(__FILE__);

// Includes
require_once $plugin_dir_path . 'install.php';
require_once $plugin_dir_path . 'settings.php';
require_once $plugin_dir_path . 'shortcodes.php';
require_once $plugin_dir_path . 'frontend.php';
require_once $plugin_dir_path . 'api.php';

// Hooks
register_activation_hook(__FILE__, 'weather_create_data_table');