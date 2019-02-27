<div class="calendar-wrapper">
	<div class="fixed-calendar">
		<?php $currentID = get_the_ID(); ?>
		<!-- <h3><?php the_title(); ?></h3> -->
		<h5><?php echo date("Y"); ?> CALENDAR</h5> 
		<div id="calendar" data-trainer="<?php echo $currentID; ?>" data-start="<?php echo get_field('start_date', $currentID ); ?>" ></div>
	</div>
</div>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
 -->