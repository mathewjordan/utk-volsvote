<?php

namespace UTKCalendar\Calendar\App;

use UTKCalendar\Calendar\Calendar;

class Data
{

    function __construct()
    {

        add_action('wp_ajax_utk_calendar_department_id_action', [__CLASS__, 'utk_calendar_department_id_handler']);
        add_action('wp_ajax_utk_calendar_department_id_update_action', [__CLASS__, 'utk_calendar_department_id_update_handler']);

    }

    public static function utk_calendar_data($department_id)
    {

        $timestamp = get_site_option('utk_calendar_timestamp');

        /*
         * quick check of calendar timestamp
         */

        $time = time();
        $update_interval = 21600; // six hours
        $update_checkpoint = $time - $update_interval;

        if ( $timestamp < $update_checkpoint) :

            /*
            * the following should be set in plugin admin and pulled by get_option()
            */

            if ($department_id === false) {
                $department_id = 'all';
            }

            /*
            * set json endpoint
            */

            $endpoint = Calendar::ENDPOINT_URL . '/api/2/events?group_id=' . $department_id . '&days=365';

            /*
            * get data
            */

            $json = file_get_contents($endpoint);
            $result = json_decode($json);

            update_site_option( 'utk_calendar_timestamp', $time );
            update_site_option( 'utk_calendar_data', $result );

        else :

            $result = get_site_option('utk_calendar_data');

        endif;

        return $result;

    }

    public static function utk_calendar_more_url($department_id)
    {

        $timestamp = get_site_option('utk_calendar_url_timestamp');

        /*
         * quick check of calendar timestamp
         */

        $time = time();
        $update_interval = 21600; // six hours
        $update_checkpoint = $time - $update_interval;

        if ( $timestamp < $update_checkpoint) :

            /*
            * the following should be set in plugin admin and pulled by get_option()
            */

            $endpoint = Calendar::ENDPOINT_URL . '/api/2/departments/' . $department_id;

            /*
            * get data
            */

            $json = file_get_contents($endpoint);
            $result = json_decode($json);
            $more_url = $result->department->localist_url;

            update_site_option( 'utk_calendar_url_timestamp', $time );
            update_site_option( 'utk_calendar_url_data', $more_url );

        else :

            $more_url = get_site_option('utk_calendar_url_data');

        endif;

        return $more_url;
    }

    /*
     * ajax query on.click() for lookup
     */

    public static function utk_calendar_department_id_handler()
    {

        /*
         * set json endpoint
         */

        $endpoint = Calendar::ENDPOINT_URL . '/api/2/departments?page=' . $_POST['page'];
        $department_id = get_site_option('utk_calendar_department_id');

        $json = file_get_contents($endpoint);
        $result_page = json_decode($json);

        /*
         * build results of current page
         */

        $output = '<table width="100%" class="wp-list-table widefat fixed striped sites">';

        foreach ($result_page->departments as $k => $d) :

            if ($department_id == $d->department->id) {
                $styling = "font-weight:700";
                $label = "Current";
            } else {
                $styling = "font-weight:400";
                $label = "Select";
            }

            $output .= '<tr>';
            $output .= '<td><a href="' . $d->department->localist_url . '" target="_blank">' . $d->department->name . '</a></td>';
            $output .= '<td width="50"><strong>' . $d->department->id . '</strong></td>';
            $output .= '<td width="50"><a class="utk-calendar-id-set"  data-department-id="' . $d->department->id . '" href="#" style="' . $styling . '">' . $label .'</a></td>';
            $output .= '</tr>';
        endforeach;

        $output .= '</table>';

        /*
         *  cycle paging
         */
        $p = 1;

        $output .= '<ul class="utk-calendar-paging">';

        while ($p <= $result_page->page->total) :

            if ($p == $_POST['page']) :
                $output .= '<li><strong>' . $p . '</strong></li>';

            else :
                $output .= '<li><a class="utk-calendar-page-lookup" data-page="' . $p .'" href="#' . $p . '">' . $p . '</a></li>';

            endif;

            $p++;

        endwhile;

        $output .= '</ul>';

        print $output;

        wp_die();

    }

    public static function utk_calendar_department_id_update_handler()
    {

        $department_id =  $_POST['id'];

        update_site_option('utk_calendar_department_id', $department_id);

        print ' <strong><span class="dashicons dashicons-yes" style="font-size:30px; color: #46B450;"></span> &nbsp; Updated</strong>';

        wp_die();

    }
}