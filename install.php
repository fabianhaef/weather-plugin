<?php

/**
 * Creates the weather data table in the WordPress database.
 *
 * @since 1.0.0
 * @global wpdb $wpdb WordPress database abstraction object.
 */
function weather_create_data_table() {
    global $wpdb;

    // Set table name
    $table_name = $wpdb->prefix . 'weather_data';

    // Define charset for the table
    $charset_collate = $wpdb->get_charset_collate();

    // Define SQL query for creating table
    $sql = "
    CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        timestamp datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        weather_data text NOT NULL,
        zip_code varchar(10) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;
    ";

    // Include WordPress upgrade functions and create or update table
    if (!function_exists('dbDelta')) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }
    dbDelta($sql);
}
