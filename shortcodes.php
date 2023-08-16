<?php

/**
 * Callback function for the 'weather-zip-code' shortcode.
 * Fetches and displays weather data based on the provided zip code.
 *
 * @param array $atts Shortcode attributes.
 * @return string Weather data output.
 * @since 1.0.0
 */
function weather_zip_shortcode_callback($atts) {
    // Default values for shortcode attributes
    $defaults = array(
        'zip-code' => '1000'
    );

    // Parse the shortcode attributes
    $attributes = shortcode_atts($defaults, $atts, 'weather-zip-code');

    // Sanitize the zip code value
    $sanitized_zip = sanitize_text_field($attributes['zip-code']);

    // Fetch weather data and return
    return weather_fetch_weather_data($sanitized_zip);
}

add_shortcode('weather-zip-code', 'weather_zip_shortcode_callback');
