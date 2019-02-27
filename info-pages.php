<?php
/* Template Name: Info Pages */
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
		<main id="main" class="site-main login-pages" role="main">
			<div class="wrap">
				<div class="login-content-wrap">
					<div class="login-content">
							<?php
						if (have_posts()) :
						   while (have_posts()) :
						      the_post();
						         the_content();
						   endwhile;
						endif; ?>
					</div> <!-- login-content -->
				</div><!-- login-content-wrap -->
			</div><!-- wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
