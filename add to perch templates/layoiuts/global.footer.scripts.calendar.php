<script src='fullcalendar/lib/jquery.min.js'></script>
<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.min.js'></script>
<script>
$(document).ready(function() {
	<?php 	$opts = array('template'=>'_recurring-event-calendar_with_ranges.html'); 
		perch_content_custom('Recurring Events', $opts);
	?>
	$('#calendar').fullCalendar({
		aspectRatio: 1.5,
		theme: true,
		nextDayThreshold: '00:00:00', // 9am
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: false,
		minTime: "8:30:00",
		maxTime: "23:00:00",
		eventSources: [  
		<?php
			$opts = array ('filter'=>'EventDateTime', 'match'=>'gt','value'=>'2015-05-14','skip-template'=>'true');
			$varray1 = perch_events_custom($opts);
			foreach ($varray1 as $key1 => $value1){
		   	if ($varray1[$key1]['show_date_range'] != "Show date range") {
			$start = $varray1[$key1]['eventDateTime'];
			$duration='';
			$duration = $varray1[$key1]['program_duration'];
			$duration_hour = floor($duration);
			$duration_minute = round(60*($duration-$duration_hour));
			$tz = new DateTimeZone('America/New_York');
			$date = new DateTime($start, $tz);
			$date->modify('+'.$duration_hour.' hours +'.$duration_minute.' minutes');
			$endtime = $date->format('c');
			$varray1[$key1]['endtime'] = $endtime; 
			$varray1[$key1]['allday'] = 'false'; 
			} else {
			$varray1[$key1]['allday'] = 'true'; 
			};
			};
		// 	print_r($varray1);
			perch_template('content/_fullcalendar-output.html', $varray1);
		?>
, 
            {
				events: repeatingEvents,
				    className:'recur' 
				    }],
				
				   eventRender: function(event, element) {
				    if (event.ranges)
				    {
				     for (var i in event.ranges)
				     {
				      if (event.start.isAfter(moment(event.ranges[i].start, "YYYY/MM/DD")) && event.end.isBefore(moment(event.ranges[i].end, "YYYY/MM/DD")))
				      {
				          return true;
				      }
				     }
				     return false;
				    }
				   }
				});
			});
</script>
<?php perch_get_javascript(); ?>