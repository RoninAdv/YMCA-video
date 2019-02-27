<li class="single-class
  <?php 
    // check if the repeater field has rows of data
    if( have_rows('dates') ):

      // loop through the rows of data
        while ( have_rows('dates') ) : the_row();

            // display a sub field value
            $date = get_sub_field('class_dates', false, false); 
            $date = new DateTime($date); 

            echo $date->format('M') . $date->format('d')  . " ";

        endwhile;

    endif;
  ?>
" id="<?php echo $post->post_name;?>">
    <div class="class-wrap">
     <div class="class-info">
    

        <div class="left-class-content">
          <!-- formats and displays the date -->
          <?php   $startDate = get_field('start_date', false, false); 
                  $startDate = new DateTime($startDate); ?>
          <div class="date class-day"><?php echo $startDate->format('d'); ?></div>
          <div class="date class-month"><?php echo $startDate->format('M'); ?></div>

        <?php get_field('trainer_image_small'); ?>  
         
        </div><!-- left-class-content -->

        <div class="right-class-content">

          <h2><?php the_title(); ?></h2>

          <!-- displays the class category for class type -->
          <?php $categories = get_the_terms( $post->ID, 'class_types' );
          foreach( $categories as $category ) {
            echo '<h3>' . $category->name . '</h3>';
           } ?>

          <div class="class-info">
            <?php the_field('class_info'); ?>
          </div>

                 <!-- Displays trainer assigned to class-->
          <?php 
          $associated_trainer = get_field('trainer_associated');
          if( $associated_trainer ): 
            setup_postdata( $post ); ?>
                <h6><strong>Trainer:</strong> <?php echo $associated_trainer->post_title ?></h6>
          <?php endif; ?>

          <!-- Time format end -->

          <!-- displays the class category for location -->
          <?php $locations = get_the_terms( $post->ID, 'locations' );
          foreach( $locations as $location ) {
            echo '<h6><strong>Location: </strong>' . $location->name . '</h6>';
           } ?>

         
          <!-- formats and displays the event times -->
          <div class="class-date">

            <h6><strong>Time: </strong></h6>
            <div class="time-slots">
              <?php the_field('times'); ?>
            </div>
             <!--  <?php
               $startTime = get_field('start_time');
               $startTime = new DateTime($startTime);

               $endTime = get_field('end_time');
               $endTime = new DateTime($endTime);

              if( get_field('start_time') ):
                 echo $startTime->format('g:i A'); ?> -
              <?php endif; ?>
              <?php if( get_field('end_time') ):
                  echo $endTime->format('g:i A'); ?>
              <?php endif; ?> -->
            
          </div><!-- date -->
  
   
        </div><!-- right-class-content -->

  </div><!-- class-wrap -->
</li><!-- class-event -->
<?php wp_reset_postdata(); ?>
