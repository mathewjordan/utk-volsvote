<?php

namespace UTKCalendar\Calendar;

use UTKCalendar\Calendar\App;

class Calendar
{

    /*
     * defaults for utk_calendar
     */

    const DEFAULT_STYLE = "thehill_modern";             // Default Style
    const DEFAULT_FIGURE = "text";                      // Default Figure Rendering
    const DEFAULT_HEADING = "Upcoming Events";          // Default Heading
    const DEFAULT_EVENT_SELECT_MAX = 15;                // UI setting for select in Admin
    const DEFAULT_EVENT_NUMBER = 3;                     // Default number to display
    const ENDPOINT_URL = "https://calendar.utk.edu";    // JSON endpoint, likely never to change
    const ENDPOINT_DISPLAY = "calendar.utk.edu";        // For documenting, likely never to change

    /*
     * do the heavy lifting
     */

    public function run()
    {

        new App\Admin();
        new App\Data();
        new App\Setup();
        new App\Listing();

    }

}