<?php
define('BS_THEME_NAME', 'Blue Planet');
define('BS_THEME_SLUG', 'blue-planet');
define('BS_SHORT_NAME', 'bsk');
?>
<?php
/**
 * Blue Planet functions and definitions
 *
 * @package Blue Planet
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}

if ( ! function_exists( 'blue_planet_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blue_planet_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blue Planet, use a find and replace
	 * to change 'blue-planet' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'blue-planet', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

    // Add support for custom backgrounds
	add_theme_support( 'custom-background' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
    add_image_size( 'homepage-thumb', 285, 215, true ); //(cropped)

	// This theme uses wp_nav_menu()
	register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'blue-planet' ),
        'footer'  => __( 'Footer Menu', 'blue-planet' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blue_planet_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    // Load up theme options defaults
	require( get_template_directory() . '/inc/blueplanet-themeoptions-defaults.php' );

}
endif; // blue_planet_setup
add_action( 'after_setup_theme', 'blue_planet_setup' );

/**
 * Load scripts and styles required for admin side
 */
if (!function_exists('blue_planet_register_admin_scripts_styles')) :
    function blue_planet_register_admin_scripts_styles() {
        global $pagenow;

        if ( $pagenow =="themes.php" &&  isset($_REQUEST['page']) &&  'theme_options' == $_REQUEST['page']  ){
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style('thickbox');

            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');

            wp_enqueue_style('blue-planet-admin-styles-common',get_template_directory_uri(). '/css/admin.css' );

            wp_enqueue_script('blue-planet-cookies-script', get_template_directory_uri().'/js/jquery.cookie.js',
                    array('jquery', 'jquery-ui-tabs','media-upload','thickbox'));
            wp_enqueue_script('blue-planet-admin-script', get_template_directory_uri().'/js/admin.js',
                    array('jquery', 'jquery-ui-tabs','media-upload','thickbox','blue-planet-cookies-script','wp-color-picker'));
        }
    }
endif;
add_action( 'admin_enqueue_scripts', 'blue_planet_register_admin_scripts_styles' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function blue_planet_widgets_init() {
	register_sidebar( array(
        'name'          => __( 'Sidebar', 'blue-planet' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Default Sidebar', 'blue-planet' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
	) );
    register_sidebar( array(
        'name'          => __( 'Menu Widget Area', 'blue-planet' ),
        'id'            => 'sidebar-top-menu',
        'description'   => __( 'Widget area in the header. Specially for menu widget', 'blue-planet' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

    //
    global $blueplanet_options_settings;
    $bp_options = $blueplanet_options_settings;
    if( 1 == $bp_options['flg_enable_footer_widgets']){
        $num_footer = $bp_options['number_of_footer_widgets'];

        for($i = 1; $i <= $num_footer ;$i++){
            register_sidebar(array(
                'name'          => __('Footer Column','blue-planet') .'-'.$i,
                'id'            => 'footer-area-'.$i,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h1 class="footer-sidebar-title">',
                'after_title'   => '</h1>',
            ));

        }
    }

}
add_action( 'widgets_init', 'blue_planet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blue_planet_scripts() {
    global $blueplanet_options_settings;
    $bp_options = $blueplanet_options_settings;

    wp_enqueue_style( 'blue-planet-style', get_stylesheet_uri() );
    wp_enqueue_style( 'blue-planet-style-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', false ,'3.0.0' );
    wp_enqueue_style( 'blue-planet-style-responsive', get_template_directory_uri().'/css/responsive.css', false ,'' );

        wp_enqueue_script('bootstrap-script',get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'),'3.0.0', TRUE);


	wp_enqueue_script( 'blue-planet-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'blue-planet-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    if( 'none' != $bp_options['slider_status'] || 'none' != $bp_options['slider_status_2']){
        //nivo
        wp_enqueue_style( 'nivo-slider-style', get_template_directory_uri().'/thirdparty/nivoslider/nivo-slider.css', false ,'3.2' );
        wp_enqueue_style( 'nivo-slider-style-theme', get_template_directory_uri().'/thirdparty/nivoslider/themes/default/default.css', false ,'3.2' );
        wp_enqueue_script('nivo-slider-script',get_template_directory_uri().'/thirdparty/nivoslider/jquery.nivo.slider.pack.js', array('jquery'),'3.2', TRUE);



    }

    //meanmenu
    wp_enqueue_style( 'meanmenu-style', get_template_directory_uri().'/thirdparty/meanmenu/meanmenu.min.css', false ,'2.0.6' );
    wp_enqueue_script('meanmenu-script',get_template_directory_uri().'/thirdparty/meanmenu/jquery.meanmenu.min.js', array('jquery'),'2.0.6', TRUE);



    //theme custom
    wp_enqueue_script('blue-planet-theme-script-custom',get_template_directory_uri().'/js/custom.js', array('jquery'),'1.0', TRUE);
}
add_action( 'wp_enqueue_scripts', 'blue_planet_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


require get_template_directory() . '/inc/theme-custom.php';


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

require get_template_directory() . '/admin/setup.php';

require get_template_directory() . '/inc/widgets.php';
