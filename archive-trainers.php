<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ronin
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main trainers-page" role="main">
			<div class="wrap">

				<?php
				if ( have_posts() ) : ?>


					<header class="page-header">
						<h1>OUR TRAINERS</h1>
					</header><!-- .page-header -->

					<div class="trainers-wrap">

					<?php 
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/trainers-content', get_post_format() );

					endwhile;


				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
