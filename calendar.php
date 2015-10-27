<?php include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php'); 
perch_content_create('Recurring Events', array(
    'template' => '_recurring_events.html',
    'multiple' => true,
    'edit-mode' => 'listdetail',
    'sort' => 'date',
    'sort-order' => 'DESC',
    'columns' => 'eventtitle, all_day, start_time, end_time, startingondate, endingondate, mondays, tuesdays, wednesdays, thursdays, fridays, saturdays, sundays, show_on_calendar'
)); 
	perch_layout('global.head.calendar'); ?>
    <body id="top" class="ndportfoliowd">
    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">
	<section id="cal" class="clear">
		<div id="calendar">
		</div>
	</section>
    </div>
<?php perch_layout('global.footer.scripts.calendar'); ?>