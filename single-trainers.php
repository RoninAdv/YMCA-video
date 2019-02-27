<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ronin
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			
				<div class="trainer-wrap">
						<div class="wrap">
							<div class="trainer-information">
					<div class="trainer-image-left" style="background:url(<?php the_field('trainer_image'); ?>) center center; background-size:cover;">
						<img src="<?php the_field('trainer_image'); ?>">
					</div>
				
						<div class="trainer-content-page">
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field('subtitle'); ?></h3>
							<?php the_field('trainer_content'); ?>
						</div><!-- trainer-content -->
					</div>
				</div><!-- wrap -->
			</div><!-- trainer-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php if ( is_user_logged_in() ) { ?>
	   	<div class="trainer-calendar">
    		<?php get_template_part( 'calendar', 'overview' ); ?> 
		</div><!-- trainer-calendar -->
	<?php } ?>

	

	<?php endwhile; // End of the loop. ?>
<?php

get_footer();
