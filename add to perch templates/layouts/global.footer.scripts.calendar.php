<script src='fullcalendar/lib/jquery.min.js'></script>
<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.min.js'></script>
<script>
$(document).ready(function() {
	<?php 	$opts = array('template'=>'_recurring-event-calendar_with_ranges.html'); 
			perch_content_custom('Recurring Events', $opts);
			$opts = array ('skip-template'=>'true');
			$varrayre = perch_events_custom($opts);
			foreach ($varrayre as $key1 => $value1){
		   	
			$start = $varrayre[$key1]['eventDateTime'];
			$duration='';
			$duration = $varrayre[$key1]['program_duration'];
			$duration_hour = floor($duration);
			$duration_minute = round(60*($duration-$duration_hour));
			$tz = new DateTimeZone(PERCH_TZ);
			$date = new DateTime($start, $tz);
			$date->modify('+'.$duration_hour.' hours +'.$duration_minute.' minutes');
			$endtime = $date->format('c');
			$varrayre[$key1]['endtime'] = $endtime; 		
			
			$varrayre[$key1]['allday'] = 'false'; 			

			};
			perch_template('content/_fullcalendar-output-multiday.html', $varrayre);

	
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
		allDaySlot:true,
		eventSources: [  
		<?php
			$opts = array ('skip-template'=>'true');
			$varray1 = perch_events_custom($opts);
			foreach ($varray1 as $key1 => $value1){
		   	
			$start = $varray1[$key1]['eventDateTime'];
			$duration='';
			$duration = $varray1[$key1]['program_duration'];
			$duration_hour = floor($duration);
			$duration_minute = round(60*($duration-$duration_hour));
			$tz = new DateTimeZone(PERCH_TZ);
			$date = new DateTime($start, $tz);
			$date->modify('+'.$duration_hour.' hours +'.$duration_minute.' minutes');
			$endtime = $date->format('c');
			$varray1[$key1]['endtime'] = $endtime; 		
			
			if ($varray1[$key1]['time_range'] != "1") {
			$varray1[$key1]['allday'] = 'true'; 
			
			} else {
				$varray1[$key1]['allday'] = 'false'; 			
			};
			};
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
					   element.attr('title', event.tooltip);
				          return true;
				      }
				     }
				     return false;
				    }
				   }
				});
			});
</script>
<<<<<<< HEAD
=======
<?php
// 			 	print_r($varray1);

	?>
>>>>>>> 0.95
<?php perch_get_javascript(); ?>
