<?php
/**
 * Weather Plugin Main File
 *
 * Fetches weather data using zip code via OpenWeatherMap API.
 * 
 * @package WeatherPlugin
 * @version 1.0
 * @author Fabian Häfliger
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