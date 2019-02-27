<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ronin
 */

get_header(); ?>

<div class="sidebar">
	    <div id="accordion">
			<h2 class="accordion-toggle">Video Series <span class="arrow arrowDown"></span></h2>
			<ul class="accordion-content">
				<?php
				$args = array( 'numberposts' => -1, 'order' => 'asc' );
				$lastposts = get_posts( $args );
				foreach($lastposts as $post) : setup_postdata($post); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - 
						<?php
						foreach((get_the_category()) as $category) {
						    echo $category->cat_name . ' ';
						}
						?>
					</a></li>
						
				<?php endforeach; ?>
			</ul>
		</div>
	</div>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="wrap">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

				endwhile; // End of the loop.
				?>

			<div class="nav-links">
				<div class="nav-previous">
					<?php previous_post_link('%link'); ?>   
				</div> 
			<!-- 	<h3>
					- <?php the_title(); ?> -
				</h3> -->
				<div class="nav-next">
					<?php next_post_link('%link'); ?>
				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->


	

<?php

get_footer();
