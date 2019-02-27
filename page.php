<?php
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
		
				<?php 
					$context = Timber::get_context();
					$context['post'] = new TimberPost();
					Timber::render( 'page.twig', $context );
				?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
