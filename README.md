# perch2fullcalendar
Files to use Perch with FullCalendar

ok, I'm new at this. but here goes...

Here are the steps to be able to display Perch data in FullCalendar. 

First go to http://fullcalendar.io/download/ and download FullCallendar. Put the contents of the download in a directory at the root level named 'fullcalendar'

In my set of files, there's a folder called 'add to perch templates'. You will want to add the the event.html file to  perch/templates/events/(see note) and the files in /content to /perch/templates/content. Add the contents of /layouts to /perch/templates/layouts.

There are 2 site files, calendar.php and event.php. Add them to the root directory and visit /calendar.php in a browser to get Perch to set up it's Recurring Events content area. 

Go to the Perch admin, and add a Recurring Event to the Calendar page. You need to do this because I'm not very good at php the script will error if there isn't at least one recurring event in that Perch region.

Add some events to the Perch Events app.

Revisit the /calendar.php page and you should see both your recurring events and your Perch Events app events sharing the same calendar space.

This implementation is intended to get you started and not a complete solution... For instance, you'll see that I have hardcoded the time zone to be New York...

Anyway, this technique is working pretty well for me on several sites. It supports recurring events within a date range (as long as the recurrance is by weekday in this instance) start and end times, and multi-day events.


NOTE: if you are adding to an existing site, you may want to look through the fields I've added to the event.html template and add them to your existing event.html template. The fields you may need are:
<perch:events id="show_date_range" type="radio" label="Date Range" options="Show date range, Don’t show, This is an all day event (don't show time)" default="Don’t show" />
<perch:events id="dtend" type="date" label="End Date" format="c" time="false" help="Optional. Only used if ‘Show date range’ or ‘This is an all day event’ are selected. Displayed as: ‘Date through End Date’" />
<perch:events id="program_duration" label="Duration" encode="false" suppress="true" size="s" help="Optional. ie: ‘Enter the length of the event in hours (ie 6.5 for an event that starts at 8:30 and goes to 3pm." />

Good luck! Monty
