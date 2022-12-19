<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;



$calender = new Calendar();
// $calender->useFullDayNames();
// echo $calender->draw(date('2023-01-01'));

// function calendar()
// {
//     # create the calendar object
//     $calendar = new Calendar;

//     # change the weekly start date to "Monday"
//     $calendar->useMondayStartingDate();

//     # or revert to the default "Sunday"
//     $calendar->useSundayStartingDate();

//     # (optional) - if you want to use full day names instead of initials (ie, Sunday instead of S), apply the following:
//     $calendar->useFullDayNames();

//     # to revert to initials, use:
//     $calendar->useInitialDayNames();

//     # add your own table class(es)
//     $calendar->addTableClasses('class-1 class-2 class-3');
//     # or using an array of classes.
//     $calendar->addTableClasses(['class-1', 'class-2', 'class-3']);

//     # (optional) - if you want to hide certain weekdays from the calendar, for example a calendar without weekends, you can use the following methods:
//     $calendar->hideSaturdays();         # This will hide Saturdays
//     $calendar->hideSundays();         # This will hide Sundays
//     $calendar->hideMondays();         # This will hide Mondays
//     $calendar->hideTuesdays();         # This will hide Tuesdays
//     $calendar->hideWednesdays();    # This will hide Wednesdays
//     $calendar->hideThursdays();        # This will hide Thursdays
//     $calendar->hideFridays();        # This will hide Fridays



//     // # finally, to draw a calendar
//     // echo $calendar->draw(date('2023-01-01')); # draw this months calendar


//     # you can also call ->display(), which handles the echo'ing and adding the stylesheet.
//     # draw this months calendar
//     echo $calendar->draw(date('2023-01-01'));
// }
// calendar();
// calendar();
// calendar();