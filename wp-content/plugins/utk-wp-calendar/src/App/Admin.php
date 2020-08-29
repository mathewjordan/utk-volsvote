<?php

namespace UTKCalendar\Calendar\App;

use UTKCalendar\Calendar\Calendar;

class Admin
{

    /**
     * Admin constructor.
     */

    function __construct()
    {

        if (is_multisite()) {
            add_action('network_admin_menu', [__CLASS__, 'utk_calendar_setup_menus']);
            add_action('network_admin_edit_utkcalendaraction', [__CLASS__, 'utk_calendar_action']);
        } else {
            add_action('admin_menu', [__CLASS__, 'utk_calendar_setup_menus']);
            add_action('admin_action_utkcalendaraction', [__CLASS__, 'utk_calendar_action']);
        }

    }

    public static function utk_calendar_setup_menus()
    {
        add_menu_page(
            'UT Knoxville Event Calendar',
            'Event Calendar',
            'manage_options',
            'utk-calendar',
            function () {
                self::utk_calendar_page_admin();
            },
            'dashicons-calendar',
            80
        );
    }

    public static function utk_calendar_page_admin()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // add settings
        if (isset($_GET['settings-updated'])) {
            add_settings_error('wporg_messages', 'wporg_message', __('Settings Saved', 'wporg'), 'updated');
        }

        echo '
        <div class="wrap">
        <h1 class="title">University of Tennessee Event Calendar</h1>
        ';

            echo '
            <div class="welcome-panel">
                <div class="welcome-panel-content">
                    <h2 style="margin-bottom: 1rem;">About</h2>
                    <p class="about-description">This plugin adds functionality to pull upcoming events by Department ID into your WordPress site. If Department ID is not set, all upcoming events will be available. Events are ordered by default ascending into the future.</p>
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="' . Calendar::ENDPOINT_URL . '" target="_blank">'  . Calendar::ENDPOINT_DISPLAY . '</a></li>
                        <li><a href="https://developer.localist.com/doc/api" target="_blank">API Documentation</a></li>
                    </ul>
                </div>
            </div>
            ';

            echo '
            <form id="utk_calendar_page_admin" method="post" action="edit.php?action=utkcalendaraction" style="margin: 2rem 23px;">';

            wp_nonce_field('utk-calendar-validate');

            $theme_style = self::utk_calendar_page_admin_style();
            $figure_rendering= self::utk_calendar_page_admin_figure();

            echo '
                <h2 class="title">Calendar Options</h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="utk_calendar_style">Theme Style</label></th>
                        <td>
                            <div style="margin: 0.5rem 0">
                                <input id="utk_calendar_style_thehill_modern" type="radio" name="utk_calendar_style" value="thehill_modern" ' . checked($theme_style == 'thehill_modern', true, false) . ' />
                                <label for="utk_calendar_style_thehill_modern">
                                    <span>The Hill - Modern <strong>(Recommended)</strong></span>
                                </label>
                            </div>
                            <div style="margin-bottom: 0.5rem">
                                <input id="utk_calendar_style_thehill_legacy" type="radio" name="utk_calendar_style" value="thehill_legacy" ' . checked($theme_style == 'thehill_legacy', true, false) . ' />
                                <label for="utk_calendar_style_thehill_legacy">
                                    <span>The Hill - Legacy</span>
                                </label>
                            </div>
                            <div style="margin-bottom: 1rem">
                                <input id="utk_calendar_style_ut_libraries" type="radio" name="utk_calendar_style" value="ut_libraries" ' . checked($theme_style == 'ut_libraries', true, false) . ' />
                                <label for="utk_calendar_style_ut_libraries">
                                    <span>UT Libraries</span>
                                </label>
                            </div>
                            <p class="description">Theme styling accounts for differences in font sizing and margin spacing between various themes. Select the best option for the theme you are currently running.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="utk_calendar_figure">Figure Rendering</label></th>
                        <td>
                            <div style="margin: 0.5rem 0">
                                <input id="utk_calendar_figure_text" type="radio" name="utk_calendar_figure" value="text" ' . checked($figure_rendering == 'text', true, false) . ' />
                                <label for="utk_calendar_figure_text">
                                    <span>Text</span>
                                </label>
                            </div>
                            <div style="margin-bottom: 0.5rem">
                                <input id="utk_calendar_figure_svg" type="radio" name="utk_calendar_figure" value="svg" ' . checked($figure_rendering == 'svg', true, false) . ' />
                                <label for="utk_calendar_figure_svg">
                                    <span>SVG <strong>(Experimental)</strong></span>
                                </label>
                            </div>
                            <p class="description">Rendering of the date block aligned left of the event details. The default representation of the date is text. An experimental mode is currently available in beta for SVG representation of dates in an orange block.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="utk_calendar_heading">Heading</label></th>
                        <td>
                            <input name="utk_calendar_heading" class="regular-text" type="text" id="utk_calendar_heading" value="' . self::utk_calendar_page_admin_heading() . '" placeholder="Ex: Upcoming Events" />
                            <p class="description">Display heading to appear above listing.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="utk_calendar_department_id">Department ID</label></th>
                        <td>
                            <input name="utk_calendar_department_id" class="regular-text" type="text" id="utk_calendar_department_id" value="' . esc_attr(get_site_option('utk_calendar_department_id')) . '" /><span id="utk_calendar_department_id_feedback"></span>
                            <p class="description">If not set, all events from ' . Calendar::ENDPOINT_DISPLAY . ' will pull into the event listing.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="utk_calendar_number">Events to List</label></th>
                        <td>
                            <select name="utk_calendar_number" class="regular-text" type="text" id="utk_calendar_number">' . self::utk_calendar_page_admin_number_select() . '</select>
                            <p class="description">Number of future events to display.</p>
                        </td>
                    </tr>
                </table>';

                submit_button();

        echo '</form>';

        echo '
                <div class="welcome-panel">
                    <div class="welcome-panel-content">
                        <h2 class="title" style="margin-top: 0">Find Department ID</h2>
                        <div class="utk-calendar-lookup-wrapper">
                            <div id="utk-calendar-lookup" style="margin: 1rem 0 2rem;">
                                <button id="utk-calendar-lookup-init" class="button action">Browse Departments</button>
                            </div>
                        </div>
                    </div>
                </div>
                ';

        echo '
            <div class="welcome-panel">
                <div class="welcome-panel-content">
                    <h2 class="title" style="margin-bottom: 1rem;">User Guide</h2>
                    <p class="about-description">How to integrate your Events into WordPress.</p>
                    <div class="welcome-panel-column-container">
                        <div class="welcome-panel-column">
                            <h3>Add Shortcode</h3>
                            <p style="padding-right: 2rem">Add the shortcode below to any post, page or widget to populate according to the set Calendar Options. </p>
                            <p class="description">Basic Usage</p>
                            <textarea class="code" readonly="readonly" rows="2" style="width: 90%;">[utk_calendar]</textarea>
                        </div>
                        <div class="welcome-panel-column">
                            <h3>Shortcode Overrides</h3>
                            <p style="padding-right: 2rem">There might be cases where multiple shortcodes are required on one WP instance. In that case, attributes can be sent to override some set Calendar Options. </p>
                            <h4>Examples</h4>
                            <ul>
                                <li>
                                    <p class="description"> Overrides <strong>Department ID</strong>.</p>
                                    <textarea class="code" readonly="readonly" rows="4" style="width: 90%;">[utk_calendar id="17658"]</textarea>
                                </li>
                                <li>
                                    <p class="description">Overrides <strong>Heading</strong>, <strong>Department ID</strong> and the number count of <strong>Events to List</strong>.</p>
                                    <textarea class="code" readonly="readonly" rows="4" style="width: 90%;">[utk_calendar heading="Sample Heading" id="14177" count="5"]</textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="welcome-panel-column welcome-panel-last">
                            <h3>Gutenberg Support</h3>
                            <p>If Gutenberg support is available, events can also be rendered from the <em>Layout Elements</em> section as a Gutenberg block. </p>
                            <p><strong>Note:</strong> Overrides cannot be set from this method. However, you can render a shortcode via Gutenberg.</p>
                        </div>
                    </div>
                </div>
            </div>
            ';

    echo '</div>';

    }

    function utk_calendar_page_admin_number_select()
    {
        /*
         * get hardcoded constants
         */

        // limit number of options in select
        $default_event_select_max = Calendar::DEFAULT_EVENT_SELECT_MAX;

        // set default value
        $default_event_number = self::utk_calendar_page_admin_number();

        /*
         * loop
         */

        $i = 0;
        $output = null;

        while ($i < $default_event_select_max) :

            $i++;

            /*
             * render selected if available
             */

            if ($default_event_number == $i) :
                $selected = 'selected';

            else :
                $selected = null;

            endif;

            $output .= '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';

        endwhile;

        return $output;

    }

    /*
     *  handle submission admin page
     */

    function utk_calendar_action()
    {

        check_admin_referer('utk-calendar-validate'); // Nonce security check

        update_site_option('utk_calendar_style', sanitize_html_class($_POST['utk_calendar_style']));
        update_site_option('utk_calendar_figure', sanitize_html_class($_POST['utk_calendar_figure']));
        update_site_option('utk_calendar_heading', sanitize_text_field($_POST['utk_calendar_heading']));
        update_site_option('utk_calendar_department_id', sanitize_text_field($_POST['utk_calendar_department_id']));
        update_site_option('utk_calendar_number', sanitize_text_field($_POST['utk_calendar_number']));

        if (is_multisite()) {

            wp_redirect(
                add_query_arg(
                    [
                        'page' => 'utk-calendar',
                        'updated' => true
                    ],
                    network_admin_url('admin.php')
                )
            );

        } else {

            wp_redirect(
                add_query_arg(
                    [
                        'page' => 'utk-calendar',
                        'updated' => true
                    ],
                    admin_url('admin.php')
                )
            );
        }

        exit;

    }

    /*
     * get option values or set defaults
     */

    public static function utk_calendar_page_admin_heading()
    {

        $default_heading = Calendar::DEFAULT_HEADING;

        $heading = esc_attr(get_site_option('utk_calendar_heading'));

        if ($heading == false) :
            add_site_option('utk_calendar_heading', sanitize_text_field($default_heading));
            $heading = $default_heading;

        endif;

        return $heading;

    }

    public static function utk_calendar_page_admin_style()
    {

        $default_style = Calendar::DEFAULT_STYLE;

        $style = esc_attr(get_site_option('utk_calendar_style'));

        if ($style == false) :
            add_site_option('utk_calendar_style', sanitize_html_class($default_style));
            $style = $default_style;

        endif;

        return $style;

    }

    public static function utk_calendar_page_admin_figure()
    {

        $default_figure = Calendar::DEFAULT_FIGURE;

        $figure = esc_attr(get_site_option('utk_calendar_figure'));

        if ($figure == false) :
            add_site_option('utk_calendar_figure', sanitize_html_class($default_figure));
            $figure = $default_figure;

        endif;

        return $figure;

    }

    public static function utk_calendar_page_admin_number()
    {

        $default_number = Calendar::DEFAULT_EVENT_NUMBER;

        $number = esc_attr(get_site_option('utk_calendar_number'));

        if ($number == false) :
            add_site_option('utk_calendar_number', sanitize_text_field($default_number));
            $number = $default_number;

        endif;

        return $number;

    }

}