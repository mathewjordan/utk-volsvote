<?php

/*
Plugin Name: University of Tennessee Calendar
Plugin URI: https://github.com/utkdigitalinitiatives/utk_wp_calendar
Description: (Beta) Frontend rendering of data from calendar.utk.edu API endpoint.
Version: 0.3.1
Author: mat@utk.edu
Author URI: https://lib.utk.edu
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

$GLOBALS['utk_calendar_path'] = plugin_dir_url(__FILE__);

require ('vendor/autoload.php');

function run_utk_calendar() {
    $plugin = new UTKCalendar\Calendar\Calendar();
    $plugin->run();
}

run_utk_calendar();
