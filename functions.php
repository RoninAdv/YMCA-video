<?php
///WORKING GIT TESTING sublime
/**
 * ronin functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ronin
 */

if ( ! function_exists( 'ronin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.π
 */
function ronin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ronin, use a find and replace
	 * to change 'ronin' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ronin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	add_filter( 'https_ssl_verify', '__return_false' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	function wptuts_scripts_basic()
	{
	
	   
	    // Register the script like this for a theme:
		// wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/build/slick.min.js' );

	    wp_register_script( 'site', get_template_directory_uri() . '/assets/js/build/site.min.js' );
	    // wp_register_script( 'parallax', get_template_directory_uri() . '/assets/js/build/parallax.min.js' );
	 	// wp_register_script( 'slider', get_template_directory_uri() . '/assets/js/build/cycle2.min.js' );
	 	wp_register_script( 'mobile-nav', get_template_directory_uri() . '/assets/js/build/mobile-nav.js' );

	 	wp_register_script( 'calendar', get_template_directory_uri() . '/assets/js/build/calendar.js' );

	 	wp_register_script( 'popup', get_template_directory_uri() . '/assets/js/build/jquery.magnific-popup.min.js' );



	    // For either a plugin or a theme, you can then enqueue the script:
	 	if(is_singular( 'trainers' ) || is_tax( 'class_types' ) || is_page('stronger')){ 
	 		global $wp_query;
	 		 wp_enqueue_script( 'calendar' );
	 	}
	 	
	    wp_enqueue_script( 'popup' );
	    // wp_enqueue_script( 'slick' );
	    wp_enqueue_script( 'site' );
	    // wp_enqueue_script( 'parallax' );
	    // wp_enqueue_script( 'slider' );
	    wp_enqueue_script( 'mobile-nav' );

	   
	}
	add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' );

	add_filter(  'gettext',  'register_text'  );
    add_filter(  'ngettext',  'register_text'  );
    function register_text( $translating ) {
         $translated = str_ireplace(  'Username or Email Address',  'Email',  $translating );
         return $translated;
    }


	add_action( 'rest_api_init', function () {
	    register_rest_route( 'calendar/display', 'calendar_link', array(
	       	'methods'  => 'GET',
	        'callback' => 'calendar_link'
	    ) );
		register_rest_route( 'calendar/display', 'start_date', array(
	       	'methods'  => 'GET',
	        'callback' => 'calendar_link_date'
	    ) );
		register_rest_route( 'ea', 'email', array(
	       	'methods'  => 'GET',
	        'callback' => 'email_addresses'
	    ) );
		register_rest_route( 'new', 'user', array(
	       	'methods'  => 'GET',
	        'callback' => 'new_user'
	    ) );
	});
	
	function new_user(){
		$name = $_GET['name'];
		$email = $_GET['email'];
		$password = $_GET['password'];
		$home_branch = $_GET['home_branch'];
		
		
		
		
		$user_id = wp_create_user( $email, $password, $email );
		
		update_field('home_branch', $home_branch, $user_id);
		
		$userdata = array(
			'ID'                    => $user_id,    //(int) User ID. If supplied, the user will be updated.
			'user_login'            => $email,   //(string) The user's login username.
			'first_name'            => $name,   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
			'last_name'             => $name,   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
			'user_email'             => $email,   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.

		);
		
		$user_id = wp_insert_user( $userdata ) ;
		
		
		
		return new WP_REST_Response( $user_id ) ;
		
		
	}
	
	function email_addresses(){
		$variable = get_field('email_list', 'option');
		$filtered = array();
		for ($x = 0; $x < count($variable); $x++) {
			array_push( $filtered, $variable[$x]['email']);
		} 
		return new WP_REST_Response( $filtered ) ;
	}

	function calendar_link(){
		
		if( $_GET['ID'] ) { 
			$posts = get_posts(array(
				'numberposts'	=> -1,
				'post_type'		=> 'classes',
				'meta_query'	=> array(
					array(
						'key'	  	=> 'trainer_associated',
						'value'	  	=> $_GET['ID'],
						'compare' 	=> 'LIKE',
					),
				),
			));
		} else {
			$posts = get_posts(array(
				'numberposts'	=> -1,
				'post_type'		=> 'classes',
				'meta_query'	=> array(
					array(
						'key'	  	=> 'trainer_associated',
						'value'	  	=> array( 97, 138, 139, 140 ),
						'compare' 	=> 'IN',
					),
				),
			));
		}
		
		
		$filtered = array();
		$location = wp_get_post_terms( $posts[$x]->ID, 'locations');
		
		for ($x = 0; $x < count($posts); $x++) {
			array_push( $filtered, array("ID" => $posts[$x]->ID, "title" => $posts[$x]->post_title, "name" => $posts[$x]->post_name, "dates" => get_field('dates', $posts[$x]->ID), "class_info" => get_field('class_info', $posts[$x]->ID), "trainer" => get_field('trainer_associated', $posts[$x]->ID), "times" => get_field('times', $posts[$x]->ID), "trainer_image_small" => get_field('trainer_image_small', get_field('trainer_associated', $posts[$x]->ID)),"locations" => wp_get_post_terms( $posts[$x]->ID, 'locations')));
		} 
		
		//print_r($posts);		

		return new WP_REST_Response( $filtered);
	}
	
	function calendar_link_date(){
		$myArr = array(get_field('start_date', $_GET['ID']));
		return new WP_REST_Response($myArr);
	}





	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'ronin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ronin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ronin_setup' );

add_filter( 'gform_enable_password_field', '__return_true' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ronin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ronin_content_width', 640 );
}
add_action( 'after_setup_theme', 'ronin_content_width', 0 );

/**
 * Register widget area.
 *
 * 
 */



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}


// Register Custom Post Type
function trainers() {

	$labels = array(
		'name'                  => _x( 'Trainers', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Trainer', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Trainers', 'text_domain' ),
		'name_admin_bar'        => __( 'Trainers', 'text_domain' ),
		'archives'              => __( 'Trainer Archives', 'text_domain' ),
		'attributes'            => __( 'Trainer Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Trainer:', 'text_domain' ),
		'all_items'             => __( 'All Trainer', 'text_domain' ),
		'add_new_item'          => __( 'Add New Trainer', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Trainer', 'text_domain' ),
		'edit_item'             => __( 'Edit Trainer', 'text_domain' ),
		'update_item'           => __( 'Update ItemTrainer', 'text_domain' ),
		'view_item'             => __( 'View Trainer', 'text_domain' ),
		'view_items'            => __( 'View Trainer', 'text_domain' ),
		'search_items'          => __( 'Search Trainer', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Trainer', 'text_domain' ),
		'description'           => __( 'YMCA Trainers', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( '', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_rest'          => true,
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'trainers', $args );

}
add_action( 'init', 'trainers', 0 );


// Register Custom Post Type
function classes() {

	$labels = array(
		'name'                  => _x( 'classes', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'class', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Classes', 'text_domain' ),
		'name_admin_bar'        => __( 'Classes', 'text_domain' ),
		'archives'              => __( 'class Archives', 'text_domain' ),
		'attributes'            => __( 'class Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent class:', 'text_domain' ),
		'all_items'             => __( 'All Classes', 'text_domain' ),
		'add_new_item'          => __( 'Add New class', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New class', 'text_domain' ),
		'edit_item'             => __( 'Edit class', 'text_domain' ),
		'update_item'           => __( 'Update ItemTrainer', 'text_domain' ),
		'view_item'             => __( 'View class', 'text_domain' ),
		'view_items'            => __( 'View class', 'text_domain' ),
		'search_items'          => __( 'Search class', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'class', 'text_domain' ),
		'description'           => __( 'YMCA classes', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'class_types, locations', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_rest'          => true,
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'classes', $args );

}
add_action( 'init', 'classes', 0 );


// Register Custom Taxonomy
function class_categories() {

	$labels = array(
		'name'                       => _x( 'Class Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Class Type', 'text_domain' ),
		'all_items'                  => __( 'All Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Class Type', 'text_domain' ),
		'add_new_item'               => __( 'Add Class Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Class Type', 'text_domain' ),
		'update_item'                => __( 'Update Class Type', 'text_domain' ),
		'view_item'                  => __( 'View Class Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Class Types with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove class types', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Class Types', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Class Types', 'text_domain' ),
		'items_list'                 => __( 'Class Types list', 'text_domain' ),
		'items_list_navigation'      => __( 'Class Types list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'				 => true
	);
	register_taxonomy( 'class_types', array( 'classes' ), $args );

}
add_action( 'init', 'class_categories', 0 );


// Register Custom Taxonomy
function locations() {

	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Locations', 'text_domain' ),
		'all_items'                  => __( 'Locations', 'text_domain' ),
		'parent_item'                => __( 'Parent Location', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Location:', 'text_domain' ),
		'new_item_name'              => __( 'New Location', 'text_domain' ),
		'add_new_item'               => __( 'Add Location', 'text_domain' ),
		'edit_item'                  => __( 'Edit Location', 'text_domain' ),
		'update_item'                => __( 'Update Location', 'text_domain' ),
		'view_item'                  => __( 'View Location', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Locations with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Locations', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Locations', 'text_domain' ),
		'search_items'               => __( 'Search Locations', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Locations', 'text_domain' ),
		'items_list'                 => __( 'Locations list', 'text_domain' ),
		'items_list_navigation'      => __( 'Locations list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'				 => true
	);
	register_taxonomy( 'locations', array( 'classes' ), $args );

}
add_action( 'init', 'locations', 0 );


//login in form changes

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
           background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/y-logo-white.png);
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//redirects to home instead of wordpress.org

function custom_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

function custom_login_logo_url_title() {
return 'Default Site Title';
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );


//removes page shake

function custom_login_head() {
remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'custom_login_head');


//redirects page after login

function custom_login_redirect( $redirect_to, $request, $user )
{
global $user;
if( isset( $user->roles ) && is_array( $user->roles ) ) {
if( in_array( "administrator", $user->roles ) ) {
return $redirect_to;
} else {
return home_url();
}
}
else
{
return $redirect_to;
}
}
add_filter("login_redirect", "custom_login_redirect", 10, 3);


function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/style-login.css' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . 'assets/js/build/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


function themename_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'theme_name' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
 
    register_sidebar( array(
        'name'          => __( 'Secondary Sidebar', 'theme_name' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'themename_widgets_init' );


//changes nav bar for logged in users
function my_wp_nav_menu_args( $args = '' ) {
 
if( is_user_logged_in() ) { 
    $args['menu'] = 'logged-in';
} else { 
    $args['menu'] = 'logged-out';
} 
    return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );


//removes the adminbar for users 
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// //redirect login to posts
function possibly_redirect(){
  global $pagenow;
  if( 'wp-login.php' == $pagenow ) {
    if ( isset( $_POST['wp-submit'] ) ||   // in case of LOGIN
      ( isset($_GET['action']) && $_GET['action']=='logout') ||   // in case of LOGOUT
      ( isset($_GET['checkemail']) && $_GET['checkemail']=='confirm') ||   // in case of LOST PASSWORD
      ( isset($_GET['checkemail']) && $_GET['checkemail']=='registered') ) return;    // in case of REGISTER
    else wp_redirect(home_url('/login')); wp_redirect('http://ultfitcomm.org/login'); // or wp_redirect(home_url('/login'));
    exit();
  }
}
// add_action('init','possibly_redirect');

// PUSH TO SIMPLE MEMBERHSIP
// 
// 
// 
//add_action( 'gform_after_submission_1', 'post_to_third_party', 10, 2 );
// function post_to_third_party( $entry, $form ) {

// 	$post_arr = array(
// 		'swpm_api_action' => 'create',
// 		'key' => '9737ce2c98bd8104cffb7498ffac3adf',
// 		'first_name' => rgar( $entry, '6' ),
// 		'last_name' => rgar( $entry, '6' ),
// 		'email' => rgar( $entry, '3' ),
// 		'password' => rgar( $entry, '4' ),
// 		'membership_level' => 2,
// 		//'user_name' => rgar( $entry, '6' ),
// 		'access_starts' => date("Y-m-d")
// 		);

// 		$ch = curl_init();

// 		curl_setopt($ch, CURLOPT_URL,"http://10.1.10.238:8888/YMCA-video-site/");
// 		curl_setopt($ch, CURLOPT_POST, 1);
// 		curl_setopt($ch,CURLOPT_USERAGENT,'curl');
// 		curl_setopt($ch, CURLOPT_POSTFIELDS,
// 		$post_arr);

// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 		$response = curl_exec ($ch);

// 		curl_close ($ch);

// 		$res=json_decode($response,true);

// 		if ($res!==NULL) {
// 		var_dump($res);
// 		} else {
// 		//API returned unexpected result
// 		echo "Error occurred";
// 		}

    
// }

///
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//TJ ADDED THIS FOR DEV
//
//
//

add_action( 'gform_after_submission_1', 'autoLogin', 10, 2 );
function autoLogin( $entry, $form ) {
    $creds = array(
        'user_login'    => rgar( $entry, '3' ),
        'user_password' => rgar( $entry, '4' ),
        'remember'      => true
    );
 
    $user = wp_signon( $creds, false );
 
    if ( is_wp_error( $user ) ) {
        echo $user->get_error_message();
    }
}

add_action('init', 'handle_preflight');

function handle_preflight() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, cache-control, Postman-Token, Authorization, Content-Length, X-Requested-With");

    if('OPTIONS' == $_SERVER['REQUEST_METHOD']) {
        status_header(200);
        exit();
    }
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'user/v1', 'update', array(
	  'methods'  => 'POST',
	  'callback' => 'update'
  ));
});

function update( $params ){
    $options = $params->get_params();
    $email = $options['email'];
	$cookie = $options['cookie'];
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_PORT => "8888",
	  CURLOPT_URL => "http://ultfitcomm.org/api/user/validate_auth_cookie/?insecure=cool&cookie=".$cookie,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "",
	  CURLOPT_HTTPHEADER => array(
		"Content-Type: application/json",
		"Postman-Token: bc545033-2bee-4c82-912f-55e115d4447c",
		"cache-control: no-cache"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  //echo "cURL Error #:" . $err;
	} else {
	  $user_data = wp_update_user( array( 'ID' => wp_validate_auth_cookie($cookie), 'user_email' => $email, 'user_login' => $email, 'display_name' => $email ) );
	}
 }
