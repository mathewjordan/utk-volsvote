<?php

namespace UTKCalendar\Calendar\App;

class Listing
{

    /**
     * Listing constructor.
     */

    function __construct()
    {

        /*
         *  utk_calendar shortcode
         */

        add_shortcode('utk_calendar', [__CLASS__, 'utk_calendar_render']);

    }

    public static function utk_calendar_wrap($atts)
    {

        /*
        * the following should be set in plugin admin and pulled by get_option()
        */

        $style = Admin::utk_calendar_page_admin_style();
        $figure = Admin::utk_calendar_page_admin_figure();
        $heading = Admin::utk_calendar_page_admin_heading();
        $limit = Admin::utk_calendar_page_admin_number();

        /*
         *  get department_id
         */

        $department_id = get_site_option('utk_calendar_department_id');

        if ($department_id === '' || !isset($department_id)) {
            $department_id = 'all';
        }

        /*
         * check if shortcode attributes are present
         */

        if (isset($atts['heading'])) {
            $heading = sanitize_text_field($atts['heading']);
        }

        if (isset($atts['id'])) {
            $department_id = sanitize_text_field($atts['id']);
        }

        if (isset($atts['count'])) {
            $limit = sanitize_text_field($atts['count']);
        }

        /*
         * get data
         */

        $result = Data::utk_calendar_data($department_id);

        /*
         * begin render
         */

        $output = '<div class="utk-calendar utk-calendar-' . $department_id . ' utk-calendar-style--' . $style . ' utk-calendar-figure--' . $figure .'">';
        $output .= '<div class="utk-calendar--header">';
        $output .= '<h4 class="utk-calendar--header--title">' . $heading . '</h4>';
        $output .= '<a class="utk-calendar--header--url" href="' . Data::utk_calendar_more_url($department_id) . '" rel="noopener" target="_blank">More Events</a>';
        $output .= '</div>';

        $index_break = $limit - 1;

        if (count($result->events) !== 0) :

            $output .= '<ul class="utk-calendar-listing">';

//            $output .= '<span class="utk-calendar-listing--note" style="font-size: 13px; display: block; line-height: 1.47em; margin: 18px 0 0;"><strong>Important:</strong> All events will be held virtually. Event details will be updated.</span>';

            foreach ($result->events as $i => $item) :

                $data = $item->event;
                $output .= self::utk_calendar_listing_instance($data, $figure);

                if ($i == $index_break)
                    break;

            endforeach;

            $output .= '</ul>';

        else :

            $output .= '<p>No upcoming events.</p>';

        endif;

        $output .= '</div>';

        return $output;

    }

    public static function utk_calendar_listing_instance($data, $figure)
    {

        $date = Utilities::utk_calendar_date($data->event_instances);
        $figure_rendering = Utilities::utk_calendar_figure($date, $figure);
        $aria_label = Utilities::utk_calendar_aria_label($date, $data);

        if ($data->recurring) :
            $eventid = $data->id . '-' . $data->event_instances[0]->event_instance->id;
            else:
            $eventid = $data->id;
        endif;

        $instance = '
        <li class="utk-calendar-event" id="utk-calendar-event-' . $eventid . '">
            <a href="' . $data->localist_url . '" rel="noopener" target="_blank" title="' . $data->title . '" aria-label="' . $aria_label .'">'
                . $figure_rendering .
                '<div class="utk-calendar-event--body">
                    <h4 class="utk-calendar-event--title">' . $data->title . '</h4>
                    <div class="utk-calendar-event--time">
                        <figure class="utk-calendar-event--icon">
                            <svg width="47" height="47" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1024 544v448q0 14-9 23t-23 9h-320q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h224v-352q0-14 9-23t23-9h64q14 0 23 9t9 23zm416 352q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
                            </svg>
                        </figure>
                        <span class="utk-calendar-event--time--start">
                            '
                              . $date['start']['month_abbr'] . '. ' . $date['start']['day'] . ' at '
                              . $date['start']['time'] . $date['start']['period'] . ' 
                        </span>
                    </div>';

        if ($data->location_name !== '') :

            $instance .= '
                    <div class="utk-calendar-event--location">
                        <figure class="utk-calendar-event--icon">
                            <svg width="47" height="47" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1152 640q0-106-75-181t-181-75-181 75-75 181 75 181 181 75 181-75 75-181zm256 0q0 109-33 179l-364 774q-16 33-47.5 52t-67.5 19-67.5-19-46.5-52l-365-774q-33-70-33-179 0-212 150-362t362-150 362 150 150 362z"/>
                            </svg>
                        </figure>
                            <span class="utk-calendar-event--location--building">' . $data->location_name . '</span>';

            if ($data->room_number !== '') :
                $instance .= '<span class="utk-calendar-event--location--room"> - ' . $data->room_number . '</span>';
            endif;

            $instance .= '
                    </div>';

        endif;

        $instance .= '
                </div>
            </a>
        </li>
        ';

        return $instance;
    }

    public static function utk_calendar_render($atts, $method = 'shortcode')
    {

        return self::utk_calendar_wrap($atts);

    }

}