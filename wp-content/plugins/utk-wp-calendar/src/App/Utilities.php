<?php

namespace UTKCalendar\Calendar\App;

class Utilities
{
    public static function utk_calendar_date($instances)
    {

        date_default_timezone_set('America/New_York');

        $date_data = null;

        foreach ($instances as $i => $instance) :

            $date = $instance->event_instance;

            $start = strtotime($date->start);
//            $end = strtotime($date->end);

            $start_month_abbr = date("M", $start);
            $start_month_num = date("n", $start);
            $start_month_long = date("F", $start);

            $start_day = date("j", $start);
            $start_day_ordinal = date("S", $start);

            if (date("i", $start) == '00') {
                $start_time = date("g", $start);
            } else {
                $start_time = date("g", $start) . ':' . date("i", $start);
            }

            $start_period = date("a", $start);
            $start_dayofweek = date("D", $start);

//            $end_month = date("M", $end);
//            $end_day = date("j", $end);
//            $end_time = date("g", $end) . ':' . date("i", $end);
//            $end_period = date("A", $end);
//            $end_dayofweek = date("D", $end);

            $date_data = [
                'start' => [
                    'month_abbr' => $start_month_abbr,
                    'month_long' => $start_month_long,
                    'month_num' => $start_month_num,
                    'day' => $start_day,
                    'day_ordinal' => $start_day_ordinal,
                    'time' => $start_time,
                    'period' => $start_period,
                    'dayofweek' => $start_dayofweek
                ]
            ];

        endforeach;

        return $date_data;

    }

    public static function utk_calendar_figure($date, $figure) {

        $figure_rendering = null;

        if ($figure === 'text') :

            $figure_rendering .= '  
                <figure class="utk-calendar-event--date">
                    <span class="utk-calendar-event--date--month">' . $date['start']['month_abbr'] . '</span>
                    <span class="utk-calendar-event--date--day">' . $date['start']['day'] . '</span>
                </figure>
            ';

        elseif ($figure === 'svg') :

            $day_format = str_pad($date['start']['day'],2, 0, STR_PAD_LEFT);
            $svg_day_path  = $GLOBALS['utk_calendar_path']  . 'assets/media/utk_cal_' . $day_format .'.svg';

            $month_format = strtolower($date['start']['month_abbr']);
            $svg_month_path  = $GLOBALS['utk_calendar_path']  . 'assets/media/utk_cal_' . $month_format .'.svg';

            $figure_rendering .= '
                <figure class="utk-calendar-event--date-svg">
                    <span class="utk-calendar-event--date-svg--month">
                        ' . self::utk_curl_contents($svg_month_path)  . '
                    </span>
                    <span class="utk-calendar-event--date-svg--day">
                        ' . self::utk_curl_contents($svg_day_path) . '
                    </span>
                </figure>';

        endif;

        return $figure_rendering;

    }

    public static function utk_calendar_aria_label($date, $data) {

        $aria_label = null;

        $aria_label .= $data->title;
        $aria_label .= ' on ';
        $aria_label .= $date['start']['month_abbr'];
        $aria_label .= '. ';
        $aria_label .= $date['start']['day'];
        $aria_label .= ' at ';
        $aria_label .= $date['start']['time'] . $date['start']['period'];
        $aria_label .= ' in ';
        $aria_label .= $data->location_name . ' ' . $data->room_number;

        return $aria_label;
    }

    public static function utk_curl_contents ($file_path)
    {

        /*
         *  primarily for curling SVG content
         */

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $file_path);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $file_contents = curl_exec($ch);
        curl_close($ch);

        return $file_contents;

    }
}