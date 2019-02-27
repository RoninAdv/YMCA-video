
<?php
	

$currentID = get_the_ID();

// echo $currentID;

$args = array(
        'posts_per_page' => -1,
        'post_type' =>  'classes',
        'post_status' => 'publish',
        'meta_key'=>'start_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key'           => 'start_date',
            'value'         => date('Ymd',strtotime("today")),
            'compare'       => '>=',
            'type'          => 'DATE',
          ),
          array(
            'key'           => 'trainer_associated',
            'value'         => $currentID,
            'compare'       => 'like',
          )
        )
  );

 

  // query
  $the_query = new WP_Query( $args );
  ?>
  <?php if( $the_query->have_posts() ): ?>
    

    <ul class="event-list">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

      <?php get_field('trainer_assocaiated'); ?>

    
      <?php get_template_part( 'single', 'class' ); ?> 
  
  <?php endwhile; ?>
  </ul> <!-- .event-list -->

<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
