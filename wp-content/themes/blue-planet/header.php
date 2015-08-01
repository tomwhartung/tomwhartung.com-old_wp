<?php
global $blueplanet_options_settings;
$bp_options = $blueplanet_options_settings;
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Blue Planet
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php  if( !empty( $bp_options['custom_favicon']  ) ) :?>
<link rel="shortcut icon"
href="<?php echo esc_url($bp_options['custom_favicon']); ?>" />
<?php  endif;?>

 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
          <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
        <![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
    //
    do_action( 'blue_planet_after_body_open' );
    //
    ?>
    <div class="container">
    <div class="container-open-wrapper">
    <?php
    //
    do_action( 'blue_planet_after_container_open' );
    //
    ?>
    </div>

    <div id="page" class="hfeed site">

    <?php
    //
    do_action( 'blue_planet_after_page_open' );
    //
    ?>

	<header id="masthead" class="site-header" role="banner">

    <?php
    //
    do_action( 'blue_planet_after_masthead_open' );
    //
    ?>

    <?php
    //
    do_action( 'blue_planet_before_masthead_close' );
    //
    ?>
	</header><!-- #masthead -->
    <?php
    //
    do_action( 'blue_planet_after_masthead_close' );
    //
    ?>
    <nav role="navigation" class="blueplanet-nav" id="site-navigation">
        <a title="Skip to content" href="#content" class="assistive-text"><?php _e('Skip to content', 'blue-planet'); ?></a>

        <?php if ( ! dynamic_sidebar( 'sidebar-top-menu' ) ) :?>

        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 0,
            'menu_class'        => 'nav-menu',
            'menu_id'         => 'menu-top',
            )
        );
        ?>

        <?php endif; ?>

    </nav>

<div class="clear"></div>

    <div id="content" class="site-content"  style="margin-top:10px;">
    <?php
    //
    do_action( 'blue_planet_after_content_open' );
    //
    ?>


