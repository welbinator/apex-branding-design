<?php

/**
 * Apex Branding & Design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Apex_Branding_&_Design
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.1');
}

if (!function_exists('apex_branding_design_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function apex_branding_design_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Apex Branding & Design, use a find and replace
		 * to change 'apex-branding-design' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('apex-branding-design', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header-nav' => esc_html__('Primary', 'apex-branding-design'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'apex_branding_design_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'apex_branding_design_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function apex_branding_design_content_width()
{
	$GLOBALS['content_width'] = apply_filters('apex_branding_design_content_width', 640);
}
add_action('after_setup_theme', 'apex_branding_design_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function apex_branding_design_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'apex-branding-design'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'apex-branding-design'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'apex_branding_design_widgets_init');
/**
 * Enqueue scripts and styles.
 */
function apex_branding_design_scripts()
{

	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), _S_VERSION);
	wp_enqueue_style('apex-branding-design-league-spartan', get_template_directory_uri() . '/assets/css/Proxima_Nova.css', array(), _S_VERSION);
	//wp_style_add_data('apex-branding-design-league-spartan', 'rtl', 'replace');
	wp_enqueue_style('apex-branding-design-fa', get_template_directory_uri() . '/assets/fonts/fontawesome-all.min.css', array(), _S_VERSION);
	//wp_style_add_data('apex-branding-design-fa', 'rtl', 'replace');
	wp_enqueue_style('apex-branding-design-style', get_template_directory_uri() . '/sass/style.css', array(), _S_VERSION);
	//wp_style_add_data('apex-branding-design-style', 'rtl', 'replace');
	wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array(), _S_VERSION, true);
 	wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array(), _S_VERSION, true);
	//wp_enqueue_script( 'bs-init', get_template_directory_uri() . '/assets/js/bs-init.js', array(), _S_VERSION, true );
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'apex_branding_design_scripts');

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if (defined('JETPACK__VERSION')) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * Create Custom Post Type Work
 */

/*
* Creating a function to create our CPT
*/

function cpt_register_my_cpts()
{

	/** 
	 * Post Type: Works
	 */

	$labels = array(
		'name'                => _x('Works', 'Post Type General Name', 'apex-branding-design'),
		'singular_name'       => _x('Work', 'Post Type Singular Name', 'apex-branding-design'),
		'menu_name'           => __('Works', 'apex-branding-design'),
		'parent_item_colon'   => __('Parent Work', 'apex-branding-design'),
		'all_items'           => __('All Works', 'apex-branding-design'),
		'view_item'           => __('View Work', 'apex-branding-design'),
		'add_new_item'        => __('Add New Work', 'apex-branding-design'),
		'add_new'             => __('Add New', 'apex-branding-design'),
		'edit_item'           => __('Edit Work', 'apex-branding-design'),
		'update_item'         => __('Update Work', 'apex-branding-design'),
		'search_items'        => __('Search Work', 'apex-branding-design'),
		'not_found'           => __('Not Found', 'apex-branding-design'),
		'not_found_in_trash'  => __('Not found in Trash', 'apex-branding-design'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('works', 'apex-branding-design'),
		'description'         => __('Work news and reviews', 'apex-branding-design'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('genres', 'category'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);

	register_post_type('works', $args);

	/**
	 * Post Type: Team Members
	 */

	$labels = array(
		'name'                => _x('Team Member', 'Post Type General Name', 'apex-branding-design'),
		'singular_name'       => _x('Team Member', 'Post Type Singular Name', 'apex-branding-design'),
		'menu_name'           => __('Team Members', 'apex-branding-design'),
		'parent_item_colon'   => __('Parent Team Member', 'apex-branding-design'),
		'all_items'           => __('All Team Members', 'apex-branding-design'),
		'view_item'           => __('View Team Member', 'apex-branding-design'),
		'add_new_item'        => __('Add New Team Member', 'apex-branding-design'),
		'add_new'             => __('Add New', 'apex-branding-design'),
		'edit_item'           => __('Edit Team Member', 'apex-branding-design'),
		'update_item'         => __('Update Team Member', 'apex-branding-design'),
		'search_items'        => __('Search Team Member', 'apex-branding-design'),
		'not_found'           => __('Not Found', 'apex-branding-design'),
		'not_found_in_trash'  => __('Not found in Trash', 'apex-branding-design'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('team_member', 'apex-branding-design'),
		'description'         => __('Team Member news and reviews', 'apex-branding-design'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('genres'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);
	register_post_type('team_member', $args);

	/** 
	 * Post Type: Podcasts
	 */

	$labels = array(
		'name'                => _x('Podcasts', 'Post Type General Name', 'apex-branding-design'),
		'singular_name'       => _x('Podcast', 'Post Type Singular Name', 'apex-branding-design'),
		'menu_name'           => __('Podcasts', 'apex-branding-design'),
		'parent_item_colon'   => __('Parent Podcast', 'apex-branding-design'),
		'all_items'           => __('All Podcasts', 'apex-branding-design'),
		'view_item'           => __('View Podcast', 'apex-branding-design'),
		'add_new_item'        => __('Add New Podcast', 'apex-branding-design'),
		'add_new'             => __('Add New', 'apex-branding-design'),
		'edit_item'           => __('Edit Podcast', 'apex-branding-design'),
		'update_item'         => __('Update Podcast', 'apex-branding-design'),
		'search_items'        => __('Search Podcast', 'apex-branding-design'),
		'not_found'           => __('Not Found', 'apex-branding-design'),
		'not_found_in_trash'  => __('Not found in Trash', 'apex-branding-design'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('podcasts', 'apex-branding-design'),
		'description'         => __('podcast', 'apex-branding-design'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('genres', 'category'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);

	register_post_type('podcasts', $args);

	/** 
	 * Post Type: YouTubes
	 */

	 $labels = array(
		'name'                => _x('YouTubes', 'Post Type General Name', 'apex-branding-design'),
		'singular_name'       => _x('YouTube', 'Post Type Singular Name', 'apex-branding-design'),
		'menu_name'           => __('YouTubes', 'apex-branding-design'),
		'parent_item_colon'   => __('Parent YouTube', 'apex-branding-design'),
		'all_items'           => __('All YouTubes', 'apex-branding-design'),
		'view_item'           => __('View YouTube', 'apex-branding-design'),
		'add_new_item'        => __('Add New YouTube', 'apex-branding-design'),
		'add_new'             => __('Add New', 'apex-branding-design'),
		'edit_item'           => __('Edit YouTube', 'apex-branding-design'),
		'update_item'         => __('Update YouTube', 'apex-branding-design'),
		'search_items'        => __('Search YouTube', 'apex-branding-design'),
		'not_found'           => __('Not Found', 'apex-branding-design'),
		'not_found_in_trash'  => __('Not found in Trash', 'apex-branding-design'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('youtubes', 'apex-branding-design'),
		'description'         => __('youtube', 'apex-branding-design'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('genres', 'category'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);

	register_post_type('youtubes', $args);
}






/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/

add_action('init', 'cpt_register_my_cpts', 0);


// add class to anchor tags in menu
add_filter('nav_menu_link_attributes', 'add_class_to_anchors', 10, 3);

function add_class_to_anchors($classes, $item, $args)
{
	if (isset($args->add_link_class)) {
		$classes['class'] = $args->add_link_class;
	}
	return $classes;
}

/**
 * Replace the_excerpt "more" text with a link
 *
 */

function apex_new_excerpt_more($more)
{
	global $post;
	return '... <a class="more-link" href="' . get_permalink($post->ID) . '">Continue Reading</a>';
}
add_filter('excerpt_more', 'apex_new_excerpt_more');


function add_plyr_js() 
{
	echo '<script src="https://cdn.plyr.io/3.7.3/plyr.polyfilled.js"></script><script>
	const players = Array.from(document.querySelectorAll(".video-apex")).map((p) => new Plyr(p));</script>';
}

add_filter('wp_footer', 'add_plyr_js');

function add_plyr_css() 
{
	echo '<link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />';
}

add_filter('wp_head', 'add_plyr_css');