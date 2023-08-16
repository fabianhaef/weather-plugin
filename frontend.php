<?php

/**
 * Enqueues the weather plugin styles.
 *
 * @since 1.0.0
 */
function weather_enqueue_styles() {
    $style_url = plugins_url('assets/css/weatherStyles.css', __FILE__);
    wp_enqueue_style('weather-styles', $style_url);
}

add_action('wp_enqueue_scripts', 'weather_enqueue_styles');
