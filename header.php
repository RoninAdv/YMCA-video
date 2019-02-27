<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * 
 *
 * @package ronin
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div id="canvas">
		<div class="mobile-head">
<!-- 			<div class="mobile-logo"><img src="<?php bloginfo('template_directory'); ?>/assets/img/global/logo.png"></div>
 -->			<a href="#" class="icon-menu toggle-nav"><i class="fas fa-bars"></i><span class="screen-reader-text">Menu</span></a>
		</div>

		<nav id="mobile-nav" class="mobile-nav" role="navigation">
			<div class="welcome-nav">
				<?php global $current_user; wp_get_current_user(); ?>
				<?php if ( is_user_logged_in() ) { 
				  echo 'Welcome, ' . $current_user->display_name; } 
				else { wp_loginout(); echo ' | <a href="#signup">Sign Up</a>'; } ?>
			</div>

			
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-menu' ) ); ?>

				

		</nav>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'ronin' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	

			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/global/y-logo-white.png"/></a>

			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

			
			</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">


