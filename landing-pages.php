<?php
/* Template Name: Landing Pages */
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

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
							<div id="primary" class="content-area">
								<main id="main" class="site-main" role="main">
								
										<?php 
											$context = Timber::get_context();
											$context['post'] = new TimberPost();
											Timber::render( 'page.twig', $context );
										?>


								</main><!-- #main -->
							</div><!-- #primary -->
			

			<div class="trainers-wrapper-slide">
				
			
				    		
				       <?php
				       $post_object = get_field('trainer');
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
				      <?php endif; ?>
				        
				            

				            	<?php get_template_part( 'calendar', 'overview' ); ?>
				            </div>
			
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
