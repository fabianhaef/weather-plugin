# Weather Plugin for WordPress
Fetch and display weather data based on zip codes using the OpenWeatherMap API.

**Version:** 1.0

**Author:** Fabian Häfliger

## Description
This WordPress plugin allows users to fetch and display weather data for specific zip codes via shortcodes. The data is retrieved from the OpenWeatherMap API and is cached in the database to minimize unnecessary external requests.

## Features
Fetch weather data using OpenWeatherMap API based on zip codes.
Caches weather data in the database for 10 minutes to reduce external calls.
Display weather data including temperature, pressure, humidity, sunrise, and sunset.
Manage API key through the WordPress admin settings.

## Installation
Upload the `weather-plugin` directory to the `/wp-content/plugins/` directory.
Activate the plugin through the 'Plugins' menu in WordPress.
Visit the plugin settings page to add your OpenWeatherMap API key.
Usage
After installing and activating the plugin, and providing your API key, you can use the following shortcode to display weather data based on a zip code:

`[weather-zip-code zip-code="YOUR_ZIP_CODE"]``

Replace YOUR_ZIP_CODE with the desired zip code.

## Frequently Asked Questions

**Q: Where can I get an API key for OpenWeatherMap?**
A: You can sign up and generate an API key on the OpenWeatherMap website.

**Q: How often is the weather data updated?**
A: The plugin caches the weather data for 10 minutes to reduce the number of external requests. After 10 minutes, the plugin will fetch fresh data from the API.

## Changelog

**1.0** Initial release.
