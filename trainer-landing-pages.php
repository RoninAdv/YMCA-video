<?php
/* Template Name: Trainer Landing Pages */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ronin
 */

get_header(); ?>

	
	<?php

	$post_object = get_field('trainer_landing');

	if( $post_object ): 

		// override $post
		$post = $post_object;
		setup_postdata( $post ); 

		?>

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

	
	   	<div class="trainer-calendar">
    		<?php get_template_part( 'calendar', 'overview' ); ?> 
		</div><!-- trainer-calendar -->
	

	

	<?php endif; ?>

<?php
get_footer();
