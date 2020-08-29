<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require ('vendor/autoload.php');

function run_utk_calendar() {
    $plugin = new UTKCalendar\Calendar\Calendar();
    $plugin->run();
}

run_utk_calendar();
