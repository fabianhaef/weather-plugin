<?php

/**
 * Fetches weather data from the OpenWeatherMap API based on the provided zip code.
 *
 * @param string $zipcode The zip code for which weather data should be fetched.
 * @return object Weather data object on success or an object with error message on failure.
 */
function fetch_weather_from_api($zipcode) {
    $api_key = get_option('api_key');
    $url = "https://api.openweathermap.org/data/2.5/weather?zip={$zipcode},CH&appid={$api_key}&units=metric";

    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        $error_obj = new stdClass();
        $error_obj->error = 'Error: ' . $response->get_error_message();
        return $error_obj;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->cod) && $data->cod != 200) {
        $error_obj = new stdClass();
        $error_obj->error = 'API Error: ' . $data->message;
        return $error_obj;
    }

    return $data;
}


/**
 * Generates the HTML representation of the weather data.
 *
 * @param object $data The weather data array.
 * @return string HTML representation of the weather data.
 */
function generate_weather_html($data) {
    $temperature = $data->main->temp;
    $pressure = $data->main->pressure;
    $humidity = $data->main->humidity;
    $sunrise = date('H:i', $data->sys->sunrise);
    $sunset = date('H:i', $data->sys->sunset);

    return '
    <div class="weather">
        <div class="weather__data">
            <div class="title">Temperatur</div> 
            <div class="value">' . $temperature . '°C</div> 
        </div>
        <div class="weather__data">
            <div class="title">Luftdruck</div> 
            <div class="value">' . $pressure . ' hPa</div> 
        </div>
        <div class="weather__data">
            <div class="title">Luftfeuchtigkeit</div> 
            <div class="value">' . $humidity . '%</div> 
        </div>
        <div class="weather__data">
            <div class="title">Sonnenaufgang | Sonnenuntergang</div> 
            <div class="value">' . $sunrise . ' | '. $sunset . '</div> 
        </div>    
    </div>';
}

/**
 * Fetches weather data based on the provided zip code.
 * Retrieves cached data from the database if available and less than 10 minutes old.
 *
 * @param string $zipcode The zip code for which weather data should be fetched.
 * @return string HTML representation or error message.
 */
function weather_fetch_weather_data($zipcode) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'weather_data';

    $last_entry = $wpdb->get_row("SELECT * FROM $table_name ORDER BY timestamp DESC LIMIT 1");
    $current_time = current_time('timestamp');

    if ($last_entry && (strtotime($last_entry->timestamp) > ($current_time - 600)) && $last_entry->zip_code == $zipcode) {
        $data = json_decode($last_entry->weather_data);
    } else {
        $data = fetch_weather_from_api($zipcode);

        if (isset($data['error'])) {
            return $data['error'];
        }

        $wpdb->insert(
            $table_name,
            array(
                'timestamp' => current_time('mysql'),
                'zip_code' => $zipcode,
                'weather_data' => json_encode($data)
            )
        );
    }

    return $data ? generate_weather_html($data) : 'Failed to fetch weather data. Please try again.<br>';
}
