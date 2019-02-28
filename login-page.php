<?php
/* Template Name: Login Page */
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

// if ( is_user_logged_in() ) {
//     //$login_url = SwpmSettings::get_instance()->get_value('login-page-url');
//     header('Location: http://ultfitcomm.org/member-overview/' );
// } else {
	
// }

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<div class="login-wrap">
			<div class="wrap">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="login-logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/global/y-logo-white.png"/></a>
					<div class="form-wrap">
				
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
