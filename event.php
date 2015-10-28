<?php 
  include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php');
  if (perch_get('s')) {
		$opts = array(
	            'filter'=>'eventSlug',
				'match'=>'eq',
				'value'=>$_GET['s'],
				'sort'=>'eventDateTime',
				'sort-order'=>'desc',
	    		'skip-template'=>'true'
            );
	    	$eventarray =	perch_events_custom($opts);
	    	$start = $eventarray[0]['eventDateTime'];
	    	$event = $eventarray[0]['eventTitle'];
	    	$duration = $eventarray[0]['program_duration'];
	    	$duration_hour = floor($duration);
			$duration_minute = round(60*($duration-$duration_hour));
	    	$tz = new DateTimeZone(PERCH_TZ);
			$date = new DateTime($start, $tz);
	    	$date->modify('+'.$duration_hour.' hours +'.$duration_minute.' minutes');
			$endtime = $date->format('g:i a');
			$endtimeadd = $date->format('m-d-Y h:i:s A');
	    	if (empty($duration)) {
		    	$endtime = $date->modify('+ 2 hours');
		    	$endtime = $date->format('g:i a');
				$endtimeadd = $date->format('m-d-Y h:i:s A');
				};
			$eventarray[0]['endtimeadd'] = $endtimeadd;  
			$eventarray[0]['endtime'] = $endtime;
			};
 if (perch_get('r')) {
		$opts = array(
	            'filter'=>'slug',
				'match'=>'eq',
				'value'=>$_GET['r'],
	    		'skip-template'=>'true',
	    		'page'=>'/calendar.php'
            );
	    	$eventarray =	perch_content_custom('Recurring Events', $opts);
	    	$start = $eventarray[0]['eventDateTime'];
	    	$event = $eventarray[0]['eventTitle'];
	    	$duration = $eventarray[0]['program_duration'];
	    	$duration_hour = floor($duration);
			$duration_minute = round(60*($duration-$duration_hour));
	    	$tz = new DateTimeZone(PERCH_TZ);
			$date = new DateTime($start, $tz);
	    	$date->modify('+'.$duration_hour.' hours +'.$duration_minute.' minutes');
			$endtime = $date->format('g:i a');
			$endtimeadd = $date->format('m-d-Y h:i:s A');
	    	if (empty($duration)) {
		    	$endtime = $date->modify('+ 2 hours');
		    	$endtime = $date->format('g:i a');
				$endtimeadd = $date->format('m-d-Y h:i:s A');
				};
			$eventarray[0]['endtimeadd'] = $endtimeadd;  
			$eventarray[0]['endtime'] = $endtime;
			}

	perch_layout('global.head.calendar');


  ?>
<?php
// 	echo($endtimeadd);
	// 	print_r($eventarray);
	if (perch_get('s')) {
	  	perch_template('content/_event_page_listing.html', $eventarray);
		};
	if (perch_get('r')) {
	  	perch_template('content/_recurring_event_page_listing.html', $eventarray);
		};

?>
