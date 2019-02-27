<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ronin
 */

get_header(); ?>


	<div id="primary" class="content-area 404-page">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found" style="background:url('<?php the_field('404_page_background', 'option'); ?>'); background-size:cover;">
				<div class="wrap">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ronin' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
				
						<h2><?php _e( 'This is somewhat embarrassing, isn’t it?', 'twentythirteen' ); ?></h2>
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->
				</div><!-- wrap -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
