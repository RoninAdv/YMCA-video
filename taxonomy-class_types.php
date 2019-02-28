<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ronin
 */
if ( is_user_logged_in() ) {
    //echo 'Welcome, registered user!';
} else {
	$login_url = SwpmSettings::get_instance()->get_value('login-page-url');
    header('Location: '.$login_url );
}

get_header(); ?>




	<?php 	$term = get_queried_object(); 
			$image = get_field('hero_image', $term);
			$content = get_field('hero_content', $term);

			$videoLink = get_field('video_link', $term);
			$videoImage = get_field('video_image', $term);
			$videoHeadline = get_field('video_headline', $term);
			$videoContent = get_field('video_content', $term);
	?>

	<div class="hero-wrapper">
		<img src="<?php echo $image; ?>"  alt=""/>
		<div class="hero-content">
			<div class="hero-content-wrap">
				<h2><?php single_term_title(); ?></h2>
				<?php echo $content; ?>	
			</div><!-- hero-content-wrap -->
		</div><!-- hero-content -->
	</div><!-- hero-wrapper -->
	<div class="hero-wrapper">
		<a class="popup-vimeo" href="<?php echo $videoLink; ?>">
			<img src="<?php echo $videoImage; ?>"  alt=""/>
			<div class="video-content">
				<div class="video-content-wrap">
					<h3><?php echo $videoHeadline; ?></h3>
					<p><?php echo $videoContent; ?></p>
				</div><!-- hero-content-wrap -->
			</div><!-- video-content -->
		</a>
	</div><!-- hero-wrapper -->

	<div class="trainers-wrapper-slide">
		<?php

		// check if the repeater field has rows of data
		if( have_rows('trainers', $term) ):
		 	// loop through the rows of data
		    while ( have_rows('trainers', $term) ) : the_row();
		    		
		        // display a sub field value
		        $post_object = get_sub_field('trainer');
		        if( $post_object ): 

		        	// override $post
		        	$post = $post_object;
		        	setup_postdata( $post ); 
		        	?>
		            <div>
		            	<div class="trainer-info-wrap">
		            		<div class="trainer-image" style="background:url(<?php the_field('trainer_image'); ?>) top center; background-size:cover;"></div>
			            	<div class="trainer-content-wrap">
			            		<div class="trainer-content-padding">
			            			<h3><?php the_title(); ?></h3>
			            			<h2><?php the_field('subtitle'); ?></h2>
									<?php the_field('trainer_content'); ?>	
								</div>	
							</div>
						</div>

		            	<?php get_template_part( 'calendar', 'overview' ); ?>
		            </div>
				<?php endif;  ?>
		<?php endwhile;

		else :

		    // no rows found

		endif;

		?>
	</div>
		
	
		
<?php
get_footer();
