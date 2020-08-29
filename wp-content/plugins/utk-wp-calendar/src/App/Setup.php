<?php

namespace UTKCalendar\Calendar\App;

use UTKCalendar\Calendar\Calendar;
use UTKCalendar\Calendar\App\Listing;

class Setup
{

    /**
     * Setup constructor.
     */

    function __construct()
    {


        /*
         * enqueue frontend
         */

        add_action('wp_enqueue_scripts', function () {

            wp_enqueue_style(
                'utk_calendar/utk_calendar.css',
                $GLOBALS['utk_calendar_path'] . 'assets/css/utk-calendar.css',
                false,
                null
            );

        });


        /*
         * enqueue admin
         */

        add_action( 'admin_enqueue_scripts', function () {

            wp_enqueue_script (
                'utk_calendar/utk_calendar_admin.js',
                $GLOBALS['utk_calendar_path'] . 'src/App/scripts/utk-calendar-ajax.js',
                false,
                null,
                true
            );

        });


        /*
         * admin stylesheet additions
         */

        add_action( 'admin_head', function () {

            $output = '
            <style>
            
                .utk-calendar-paging {
                    margin: 0;
                    padding: 0;
                    display: flex;
                    margin-top: 1rem;
                    justify-content: center;
                }
                
                .utk-calendar-paging li {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }
                
                .utk-calendar-paging li a, 
                .utk-calendar-paging li a:visited,
                .utk-calendar-paging li a:focus,
                .utk-calendar-paging li a:hover,
                .utk-calendar-paging strong {
                    display: block;
                    padding: 3px 5px;
                    text-decoration: none;
                }
                
            </style>
            ';

            print $output;

        });

        /*
         * if gutenberg is present, do gutenberg things
         */

        if (function_exists('register_block_type')) :

            add_action( 'admin_init', [__CLASS__, 'utk_calendar_gutenberg_block'] );

        endif;

    }

    function utk_calendar_gutenberg_block() {

        wp_enqueue_script(
            'utk-calendar-gutenberg/listing',
            $GLOBALS['utk_calendar_path'] . 'src/App/scripts/utk-calendar-gutenberg.js',
            [
                'wp-blocks',
                'wp-element',
                'wp-editor'
            ],
            null,
            true
        );

        register_block_type(
            'utk-calendar-gutenberg/listing',
            [
                'editor_script' => 'utk-calendar-gutenberg/listing',
                'render_callback' => [__CLASS__, 'utk_calendar_gutenberg_callback']
            ]
        );

    }

    function utk_calendar_gutenberg_callback () {

        return Listing::utk_calendar_render(array(), 'gutenberg');

    }

}