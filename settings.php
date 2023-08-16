<?php

/**
 * Adds the Weather Plugin options page to the WordPress admin menu.
 *
 * @since 1.0.0
 */
add_action('admin_menu', 'weather_plugin_menu');
function weather_plugin_menu() {
    add_options_page('Weather Plugin Options', 'Weather Plugin', 'manage_options', 'weather', 'weather_plugin_options_display');
}

/**
 * Displays the Weather Plugin options page content.
 *
 * @since 1.0.0
 */
function weather_plugin_options_display() {
    $api_key_value = esc_attr(get_option('api_key'));
    ?>
    <div class="wrap">
        <h2>My Plugin Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('weather-settings-group'); ?>
            <?php do_settings_sections('weather'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php echo esc_html__('API Key', 'weather-plugin-textdomain'); ?></th>
                    <td><input type="text" name="api_key" value="<?php echo $api_key_value; ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Registers the Weather Plugin settings.
 *
 * @since 1.0.0
 */
add_action('admin_init', 'weather_plugin_settings_init');
function weather_plugin_settings_init() {
    register_setting('weather-settings-group', 'api_key');
    add_settings_field('api_key', 'API Key', 'weather_display_api_key_field_callback', 'weather', 'section_name');
}

/**
 * Display callback for the API Key setting field.
 *
 * @since 1.0.0
 */
function weather_display_api_key_field_callback() {
    $api_key_value = esc_attr(get_option('api_key'));
    echo '<input type="text" name="api_key" value="' . $api_key_value . '" />';
}
