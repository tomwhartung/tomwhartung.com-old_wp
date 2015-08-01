<?php
/**
 * Decode Theme Customizer
 *
 * @package Decode
 */

function decode_add_customize_controls( $wp_customize ) {
	/* Adds Textarea Control*/
	class Decode_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%; padding: 5px;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	/* Adds a favicon image uploader control that only allows .ico and .png files to be uploaded */
	class Decode_Customize_Favicon_Image_Control extends WP_Customize_Image_Control {
		public $extensions = array( 'png', 'ico', 'image/x-icon' );
	}
}
add_action( 'customize_register', 'decode_add_customize_controls' );

class Decode_Customize {

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
public static function decode_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )        ->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' ) ->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

/**
 * Remove old, now unused theme modifications so that conflicts do not occur.
 */
	remove_theme_mod ( 'show_site_navigation' );
	remove_theme_mod ( 'show_social_icons' );
	remove_theme_mod ( 'linkedin_username' );
	remove_theme_mod ( 'yelp_userid' );
	remove_theme_mod ( 'show_all_post_types' );

/**
 * Header Options
 */

 	$wp_customize->add_section( 'decode_header_options', array(
    	'title'   => __( 'Header Options', 'decode' ),
		'priority'=> 32
	) );

	
	$wp_customize->add_setting( 'favicon_image', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'show_site_title', array(
		'default' => true,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_site_description', array(
		'default' => true,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_header_menu', array(
		'default' => true,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'html_description', array(
		'default' => '',
		'transport' => 'postMessage'
	) );

	
	$wp_customize->add_control(
		new Decode_Customize_Favicon_Image_Control(
		$wp_customize, 'favicon_image', array(
			'label'   => __( 'Favicon Image (must be a PNG)', 'decode' ),
			'section' => 'decode_header_options',
			'settings'=> 'favicon_image',
			'priority'=> 1
	) ) );
	
	$wp_customize->add_control( 'show_site_title', array(
		'label'   => __( 'Show Site Title', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'checkbox',
		'priority'=> 2
	) );
	
	$wp_customize->add_control( 'show_site_description', array(
		'label'   => __( 'Show Site Description', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'checkbox',
		'priority'=> 3
	) );
	
	$wp_customize->add_control( 'show_header_menu', array(
		'label'   => __( 'Show Header Menu', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'checkbox',
		'priority'=> 4
	) );
	
	$wp_customize->add_control( 'html_description', array(
		'label'   => __( 'HTML for description, if you wish to replace your blog description with HTML markup', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'text',
		'priority'=> 5
	) );



/**
 * Sidebar Options
 */

	$wp_customize->add_section( 'decode_sidebar_options', array(
    	'title'    => __( 'Sidebar Options', 'decode' ),
		'priority' => 33
    ) );


    $wp_customize->add_setting( 'show_sidebar', array(
		'default'  => true,
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'sidebar_position', array(
		'default'  => 'left'
	) );

	$wp_customize->add_setting( 'sidebar_button_position', array(
		'default'  => 'left'
	) );
	
	$wp_customize->add_setting( 'constant_sidebar', array(
		'default'  => 'closing'
	) );


	$wp_customize->add_control( 'show_sidebar', array(
		'label'   => __( 'Enable Sidebar', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'checkbox',
		'priority'=> 1
	) );

	$wp_customize->add_control( 'sidebar_position', array(
		'label'   => __( 'Sidebar Position', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'left'  => __( 'Left', 'decode' ),
			'right' => __( 'Right', 'decode' ),
        ),
		'priority'=> 2
	) );

	$wp_customize->add_control( 'sidebar_button_position', array(
		'label'   => __( 'Sidebar Button Position', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'left'  => __( 'Left', 'decode' ),
			'right' => __( 'Right', 'decode' ),
        ),
		'priority'=> 3
	) );
	
	$wp_customize->add_control( 'constant_sidebar', array(
		'label'   => __( 'Always Visible Sidebar', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'constant' => _x( 'Always open', 'Sidebar option', 'decode' ),
			'closing'  => _x( 'Closed by default', 'Sidebar option', 'decode' ),
        ),
        'priority'=> 4

	) );



/**
 * Discussion Options
 */

	$wp_customize->add_section( 'decode_discussion_options', array(
    	'title'   => __( 'Discussion Options', 'decode' ),
		'priority'=> 34
    ) );


	$wp_customize->add_setting( 'enable_comments', array(
		'default' => true,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_allowed_tags', array(
		'default' => false,
		'transport' => 'refresh'
	) );


	$wp_customize->add_control( 'enable_comments', array(
		'label'   => __( 'Enable Comments', 'decode' ),
		'section' => 'decode_discussion_options',
		'type'    => 'checkbox',
		'priority'=> 1
	) );
	
	$wp_customize->add_control( 'show_allowed_tags', array(
		'label'   => __( 'Show allowed HTML tags on comment form', 'decode' ),
		'section' => 'decode_discussion_options',
		'type'    => 'checkbox',
		'priority'=> 2
	) );



/**
 * Social Options
 */

	$wp_customize->add_section( 'decode_social_options', array(
    	'title'   => __( 'Social Options', 'decode' ),
		'priority'=> 35
    ) );

	$wp_customize->add_setting( 'show_header_social_icons', array(
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_footer_social_icons', array(
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'open_links_in_new_tab', array(
		'default' => false,
	) );

	$wp_customize->add_setting( 'twitter_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'adn_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'facebook_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'google_plus_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'myspace_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'diaspora_id', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'vk_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'dribbble_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'behance_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'linkedin_profile_url', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'pinterest_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'fancy_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'etsy_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'pinboard_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'delicious_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'instagram_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( '500px_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'flickr_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'deviantart_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'soundcloud_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'rdio_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'spotify_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'lastfm_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'vine_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'vimeo_username', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'youtube_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'kickstarter_url', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'gittip_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'goodreads_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'tumblr_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'medium_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'svbtle_url', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'wordpress_url', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'stackoverflow_userid', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'reddit_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'github_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'bitbucket_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'runkeeper_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'strava_userid', array(
		'default' => ''
	) );

	$wp_customize->add_setting( 'foursquare_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'yelp_url', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'slideshare_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'researchgate_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'youversion_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'psn_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'xbox_live_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'steam_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'steam_group_name', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'skype_username', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'email_address', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'website_link', array(
		'default' => ''
	) );
	
	$wp_customize->add_setting( 'show_rss_icon', array(
		'default' => false
	) );


	$wp_customize->add_control( 'show_header_social_icons', array(
		'label'   => __( 'Show Social Icons', 'decode' ) . ' '  . __( 'in Header', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 1
	) );
	
	$wp_customize->add_control( 'show_footer_social_icons', array(
		'label'   => __( 'Show Social Icons', 'decode' ) . ' ' . __( 'in Footer', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 2
	) );
	
	$wp_customize->add_control( 'open_links_in_new_tab', array(
		'label'   => __( 'Open Links in New Tab/Window', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 3
	) );

	$wp_customize->add_control( 'twitter_username', array(
		'label'   =>  sprintf( __( '%s Username', 'decode' ), 'Twitter' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 4
	) );

	$wp_customize->add_control( 'adn_username', array(
    	'label'   => sprintf( __( '%s Username', 'decode' ), 'App.net' ),
        'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 5
	) );

	$wp_customize->add_control( 'facebook_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Facebook' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 6
	) );

	$wp_customize->add_control( 'google_plus_username', array(
		'label'   => sprintf( _x( '%1$s Username %2$s', '[noun] [translation string] (explanation)', 'decode' ), 'Google+',  __(' (or the long number in your profile URL)', 'decode') ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 7
	) );
	
	$wp_customize->add_control( 'myspace_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'MySpace' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 8
	) );
	
	$wp_customize->add_control( 'diaspora_id', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Diaspora' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 9
	) );
	
	$wp_customize->add_control( 'vk_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'VK' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 10
	) );

	$wp_customize->add_control( 'dribbble_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Dribbble' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 11
	) );

	$wp_customize->add_control( 'behance_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Behance' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 12
	) );

	$wp_customize->add_control( 'linkedin_profile_url', array(
		'label'   => sprintf( __( '%s Profile URL', 'decode' ), 'LinkedIn' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 13
	) );

	$wp_customize->add_control( 'pinterest_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Pinterest' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 14
	) );
	
	$wp_customize->add_control( 'fancy_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Fancy' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 15
	) );
	
	$wp_customize->add_control( 'etsy_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Etsy' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 16
	) );
	
	$wp_customize->add_control( 'pinboard_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Pinboard' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 17
	) );
	
	$wp_customize->add_control( 'delicious_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Delicious' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 18
	) );

	$wp_customize->add_control( 'instagram_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Instagram' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 19
	) );

	$wp_customize->add_control( '500px_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), '500px' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 20
	) );

	$wp_customize->add_control( 'flickr_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Flickr' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 21
	) );
	
	$wp_customize->add_control( 'deviantart_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'DeviantART' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 22
	) );
	
	$wp_customize->add_control( 'soundcloud_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Soundcloud' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 23
	) );

	$wp_customize->add_control( 'rdio_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Rdio' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 24
	) );

	$wp_customize->add_control( 'spotify_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Spotify' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 25
	) );
	
	$wp_customize->add_control( 'lastfm_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Last.fm' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 26
	) );

	$wp_customize->add_control( 'vine_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Vine' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 27
	) );

	$wp_customize->add_control( 'vimeo_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Vimeo' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 28
	) );

	$wp_customize->add_control( 'youtube_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'YouTube' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 29
	) );
	
	$wp_customize->add_control( 'kickstarter_url', array(
		'label'   => sprintf( __( '%s Site URL', 'decode' ), 'Kickstarter' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 30
	) );
	
	$wp_customize->add_control( 'gittip_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Gittip' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 31
	) );
	
	$wp_customize->add_control( 'goodreads_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Goodreads' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 32
	) );
	
	$wp_customize->add_control( 'tumblr_username', array(
		'label'   => sprintf( __( '%s Site URL', 'decode' ), 'Tumblr' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 33
	) );
	
	$wp_customize->add_control( 'medium_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Medium' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 34
	) );
	
	$wp_customize->add_control( 'svbtle_url', array(
		'label'   => sprintf( __( '%s Site URL', 'decode' ), 'Svbtle' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 35
	) );
	
	$wp_customize->add_control( 'wordpress_url', array(
		'label'   => sprintf( __( '%s Site URL', 'decode' ), 'WordPress' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 36
	) );

	$wp_customize->add_control( 'stackoverflow_userid', array(
		'label'   => sprintf( __( '%s User ID', 'decode' ), 'Stack Overflow' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 37
	) );
	
	$wp_customize->add_control( 'reddit_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Reddit' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 38
	) );

	$wp_customize->add_control( 'github_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'GitHub' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 39
	) );
	
	$wp_customize->add_control( 'bitbucket_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Bitbucket' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 40
	) );
	
	$wp_customize->add_control( 'runkeeper_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Runkeeper' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 41
	) );
	
	$wp_customize->add_control( 'strava_userid', array(
		'label'   => sprintf( __( '%s User ID', 'decode' ), 'Strava' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 42
	) );

	$wp_customize->add_control( 'foursquare_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Foursquare' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 43
	) );
	
	$wp_customize->add_control( 'yelp_url', array(
		'label'   => sprintf( __( '%s Profile URL', 'decode' ), 'Yelp' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 44
	) );
	
	$wp_customize->add_control( 'slideshare_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'SlideShare' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 45
	) );
	
	$wp_customize->add_control( 'researchgate_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Research Gate' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 46
	) );
	
	$wp_customize->add_control( 'youversion_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'YouVersion' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 47
	) );
	
	$wp_customize->add_control( 'psn_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Playstation Network' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 48
	) );
	
	$wp_customize->add_control( 'xbox_live_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Xbox Live' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 49
	) );
	
	$wp_customize->add_control( 'steam_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Steam' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 50
	) );
	
	$wp_customize->add_control( 'steam_group_name', array(
		'label'   => sprintf( __( '%s Group Name', 'decode' ), 'Steam' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 51
	) );
	
	$wp_customize->add_control( 'skype_username', array(
		'label'   => sprintf( __( '%s Username', 'decode' ), 'Skype' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 52
	) );
	
	$wp_customize->add_control( 'email_address', array(
		'label'   => __( 'Email Address', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 53
	) );
	
	$wp_customize->add_control( 'website_link', array(
		'label'   => sprintf( __( '%s Link', 'decode' ), 'Website' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 54
	) );
	
	$wp_customize->add_control( 'show_rss_icon', array(
		'label'   => __( 'RSS Feed', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 55
	) );



/**
 * Reading Options
 */

	$wp_customize->add_section( 'decode_reading_options', array(
    	'title'   => __( 'Content Options', 'decode' ),
		'priority'=> 37
    ) );


	$wp_customize->add_setting( 'use_excerpts', array(
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'use_excerpts_on_archives', array(
		'default' => true,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_featured_images_on_excerpts', array(	// Yep, that's the longest setting name I have.
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_featured_images_on_singles', array(
		'default' => false,
		'transport' => 'refresh'
	) );

    $wp_customize->add_setting( 'show_tags', array(
		'default' => false,
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'show_categories', array(
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_author_section', array(
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'entry_date_position', array(
		'default' => 'below',
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_entry_date_on_excerpts', array(
		'default' => false,
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'show_page_headers', array(
		'default' => true,
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'link_post_title_arrow', array(
		'default' => false,
		'transport' => 'refresh'
	) );

    $wp_customize->add_setting( 'show_theme_info', array(
		'default' => true,
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'site_colophon', array(
		'default' => '',
		'transport' => 'postMessage'
	) );


	$wp_customize->add_control( 'use_excerpts', array(
		'label'   => __( 'Use entry excerpts instead of full text on site home. Excludes sticky posts.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 1
	) );
	
	$wp_customize->add_control( 'use_excerpts_on_archives', array(
		'label'   => __( 'Use entry excerpts on archive, category, and author pages.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 1
	) );
	
	$wp_customize->add_control( 'show_featured_images_on_excerpts', array(
		'label'   => __( 'Display posts\' featured images when excerpts are shown.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 2
	) );
	
	$wp_customize->add_control( 'show_featured_images_on_singles', array(
		'label'   => __( 'Display a post\'s featured image on its individual page.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 3
	) );

	$wp_customize->add_control( 'show_tags', array(
		'label'   => __( 'Show tags on front page (tags will be shown on post\'s individual page)', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 4
	) );

	$wp_customize->add_control( 'show_categories', array(
		'label'   => __( 'Show categories on front page (categories will be shown on post\'s individual page)', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 5
	) );
	
	$wp_customize->add_control( 'show_author_section', array(
		'label'   => __( 'Show author\'s name, profile image, and bio after posts', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 6
	) );
	
	$wp_customize->add_control( 'entry_date_position', array(
		'label'   => __( 'Entry Date Position', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'radio',
		'choices' => array(
			'above'  => __( 'Above Header', 'decode' ),
			'below' => __( 'Below Header', 'decode' ),
        ),
		'priority'=> 7
	) );
	
	$wp_customize->add_control( 'show_page_headers', array(
		'label'   => __( 'Show Page Headers', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 8
	) );
	
	$wp_customize->add_control( 'show_entry_date_on_excerpts', array(
		'label'   => __( 'Show entry date for post excepts on the main page', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 9
	) );

	$wp_customize->add_control( 'link_post_title_arrow', array(
		'label'   => __( 'Add an arrow before the title of a link post', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 10
	) );

	$wp_customize->add_control( 'show_theme_info', array(
		'label'   => __( 'Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 11
	) );
	
	$wp_customize->add_control(
		new Decode_Customize_Textarea_Control(
		$wp_customize, 'site_colophon', array(
			'label'   => __( 'Text (colophon, copyright, credits, etc.) for the footer of the site', 'decode' ),
			'section' => 'decode_reading_options',
			'settings'=> 'site_colophon',
			'priority'=> 12
	) ) );
	
	

/**
 * Other Options
 */
 
 	$wp_customize->add_section( 'decode_other_options', array(
    	'title'   => __( 'Other Options', 'decode' ),
		'priority'=> 38
    ) );
    
    
    $wp_customize->add_setting( 'custom_css', array(
		'default' => '',
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'add_custom_post_types', array(
		'default' => '',
		'transport' => 'refresh'
	) );
	
	
	$wp_customize->add_control(
		new Decode_Customize_Textarea_Control(
		$wp_customize, 'custom_css', array(
			'label'   => __( 'Custom CSS', 'decode' ),
			'section' => 'decode_other_options',
			'settings'=> 'custom_css',
			'priority'=> 1
	) ) );
	
	$wp_customize->add_control( 'add_custom_post_types', array(
		'label'   => __( 'Show the following post types on home blog page. (Separate with commas)', 'decode' ),
		'section' => 'decode_other_options',
		'type'    => 'text',
		'priority'=> 11
	) );



/**
 * Color Options
 */

	$wp_customize->add_setting( 'accent_color', array(
		'default'   => '#009BCD',
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'secondary_accent_color', array(
		'default'   => '#007EA6',
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'text_color', array(
		'default'   => '#444444',
		'transport' => 'refresh'
	) );

	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'   => '#808080',
		'transport' => 'refresh'
	) );
	
	$wp_customize->add_setting( 'accent_color_icons', array(
		'default'   => false,
		'transport' => 'refresh'
	) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'      => __( 'Accent Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'accent_color',
		'priority'=> 1
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
		'label'      => __( 'Active Link Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'secondary_accent_color',
		'priority'=> 2
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'      => __( 'Text Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'text_color',
		'priority'=> 3
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'      => __( 'Secondary Text Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'secondary_text_color',
		'priority'=> 4
	) ) );
	
	$wp_customize->add_control( 'accent_color_icons', array(
		'label'   => __( 'Use accent color instead of text color for icons', 'decode' ),
		'section' => 'colors',
		'type'    => 'checkbox',
	) );
}
	
	/**
	* This will output the custom WordPress settings to the live theme's WP head.
	* 
	* Used by hook: 'wp_head'
	* 
	* @see add_action('wp_head',$func)
	*/
	public static function decode_output_color_css() {
		?>
		<!-- Decode Custom Colors CSS -->
		<style type="text/css">
			<?php self::generate_css(
				'body, .sidebar, .SidebarTop, .menu ul ul',
				'background-color',
				'background_color',
				'#');
			
			self::generate_css(
				'body, button, select, textarea, .site-title a, .no-touch .site-title a:hover, .no-touch .site-title a:active, .menu a, .entry-title, .search-entry, .search-entry .entry-title, .entry-title a, .format-link .entry-title h2 a, .read-more, .author-name a, .explore-page .widget h1, .search .page-header input[type="search"]:focus, .decode-reply-tool-plugin .replylink, .decode-reply-tool-plugin .replytrigger',
				'color',
				'text_color' );
			
			self::generate_css( 
				'.menu ul > .menu-item-has-children > a::after, .menu ul > .page_item_has_children > a::after',
				'border-top-color',
				'text_color');
			
			self::generate_css( 
				'.footer-menu ul > .menu-item-has-children > a::after, .footer-menu ul > .page_item_has_children > a::after',
				'border-bottom-color',
				'text_color' );
			
			if (get_theme_mod( 'accent_color_icons', false ) == false ) :
				self::generate_css( 
					'.SidebarMenuTrigger, .SidebarMenuClose, .SocialIconFill',
					'fill',
					'text_color'
				);
			else : 
				self::generate_css( 
					'.SidebarMenuTrigger, .SidebarMenuClose, .SocialIconFill',
					'fill',
					'accent_color'
				);
			endif;
			
			self::generate_css(
				'a, .no-touch a:hover, button, input[type="button"], input[type="reset"], input[type="submit"], .no-touch .menu a:hover, .menu ul li.open > a, .sidebar-menu a, .menu .current-menu-item > a, .menu .current_page_item > a, .no-touch .search-entry:hover, .no-touch .search-entry:hover .entry-title, .no-touch article .date a:hover, .no-touch .format-link .entry-title a:hover, .no-touch .comment-metadata a:hover, .no-touch .decode-reply-tool-plugin .replylink:hover',
				'color',
				'accent_color' );
			
			self::generate_css(
				'.no-touch button:hover, .no-touch input[type="button"]:hover, .no-touch input[type="reset"]:hover, .no-touch input[type="submit"]:hover, .no-touch .site-description a:hover, .no-touch .entry-meta a:hover, .no-touch .entry-content a:hover, .no-touch .entry-footer a:hover, .no-touch .author-site a:hover, .no-touch .theme-info a:hover, .no-touch .site-colophon a:hover, .site-header, .menu ul ul, .menu a:focus, .site-breadcrumbs, .page-title, .post blockquote, .page blockquote, .entry-footer, .entry-header .entry-meta, .search .entry-footer, .SidebarTop, .sidebar.constant.left, .sidebar.constant.right, .explore-page .widget h1, button:focus, .no-touch input[type=\'text\']:focus, .touch input[type=\'text\']:focus, .no-touch input[type=\'email\']:focus, .touch input[type=\'email\']:focus, .no-touch input[type=\'password\']:focus, .touch input[type=\'password\']:focus, .no-touch input[type=\'search\']:focus, .touch input[type=\'search\']:focus, .no-touch input[type="tel"]:focus, .touch input[type="tel"]:focus, .no-touch input[type="url"]:focus, .touch input[type="url"]:focus, .no-touch textarea:focus, .touch textarea:focus, .search .page-header input[type="search"]:focus',
				'border-color',
				'accent_color' );
			
			self::generate_css(
				'.no-touch .menu ul > .menu-item-has-children > a:hover::after, .no-touch .menu ul > .page_item_has_children > a:hover::after, .menu ul li.open > a::after, .sidebar-menu ul .menu-item-has-children > a::after, .sidebar-menu ul .page_item_has_children > a::after, .menu ul > .current_page_item.menu-item-has-children > a::after, .menu ul > .current_page_item.page_item_has_children > a::after',
				'border-top-color',
				'accent_color' );
			
			self::generate_css(
				'.no-touch .footer-menu ul > .menu-item-has-children > a:hover::after, .no-touch .footer-menu ul > .page_item_has_children > a:hover::after, .footer-menu ul > li.open > a::after, .footer-menu ul > .current_page_item.menu-item-has-children > a::after, .footer-menu ul > .current_page_item.page_item_has_children > a::after',
				'border-bottom-color',
				'accent_color' );
			
			self::generate_css(
				'.no-touch a:active, .no-touch button:focus, .no-touch input[type="button"]:focus, .no-touch input[type="reset"]:focus, .no-touch input[type="submit"]:focus, .no-touch button:active, .no-touch input[type="button"]:active, .no-touch input[type="reset"]:active, .no-touch input[type="submit"]:active, .no-touch .menu a:active, .no-touch .sidebar-menu a:hover, .sidebar-menu ul li.open > a, .menu .current-menu-item > a:hover, .menu .current_page_item > a:hover, .sidebar-menu ul .current_page_item > a, .sidebar-menu ul .current_page_item > a, .no-touch .SidebarContent a:hover, .no-touch .search-entry:active, .no-touch .search-entry:active .entry-title, .no-touch article .date a:active, .no-touch .format-link .entry-title a:active, .no-touch .comment-metadata a:active, .no-touch .site-description a:active, .decode-reply-tool-plugin .replylink:active, .no-touch .decode-reply-tool-plugin .replylink:active',
				'color',
				'secondary_accent_color' );
			
			self::generate_css(
				'.no-touch button:focus, .no-touch input[type="button"]:focus, .no-touch input[type="reset"]:focus, .no-touch input[type="submit"]:focus, .no-touch button:active, .no-touch input[type="button"]:active, .no-touch input[type="reset"]:active, .no-touch input[type="submit"]:active, .no-touch .site-description a:active, .no-touch .entry-meta a:active, .no-touch .entry-content a:active, .no-touch .entry-footer a:active, .no-touch .author-site a:active, .no-touch .theme-info a:active, .no-touch .site-colophon a:active',
				'border-color',
				'secondary_accent_color' );
			
			self::generate_css(
				'.no-touch .menu ul > .menu-item-has-children > a:active::after, .no-touch .menu ul > .page_item_has_children > a:active::after, .no-touch .sidebar-menu ul .menu-item-has-children > a:hover::after, .no-touch .sidebar-menu ul .page_item_has_children > a:hover::after, .sidebar-menu ul li.open > a::after, .sidebar-menu ul .current_page_item.menu-item-has-children > a::after, .sidebar-menu ul .current_page_item.page_item_has_children > a::after',
				'border-top-color',
				'secondary_accent_color' );
			
			self::generate_css(
				'.no-touch .footer-menu ul > .menu-item-has-children > a:active::after, .no-touch .footer-menu ul > .page_item_has_children > a:active::after',
				'border-bottom-color',
				'secondary_accent_color' );
			
			self::generate_css(
				'article .tags, article .categories, article .date, article .date a, .comment-metadata a, .search .page-header input[type="search"]',
				'color',
				'secondary_text_color' );
			?>
		</style>
		<?php
	}

	
	/**
	* This will generate a line of CSS for use in header output. If the setting
	* ($mod_name) has no defined value, the CSS will not be output.
	* 
	* @uses get_theme_mod()
	* @param string $selector CSS selector
	* @param string $style The name of the CSS *property* to modify
	* @param string $mod_name The name of the 'theme_mod' option to fetch
	* @param string $prefix Optional. Anything that needs to be output before the CSS property
	* @param string $postfix Optional. Anything that needs to be output after the CSS property
	* @param bool $echo Optional. Whether to print directly to the page (default: true).
	* @return string Returns a single line of CSS with selectors and a property.
	*/
	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s: %s; }',
			$selector,
			$style,
			$prefix.$mod.$postfix
		);
		if ( $echo ) {
			echo $return;
			}
		}
		return $return;
	}
}

// Adds settings to Customize menu
add_action( 'customize_register', array( 'Decode_Customize', 'decode_customize_register' ) );


// Output custom CSS to live site
add_action( 'wp_head' , array( 'Decode_Customize', 'decode_output_color_css' ) );

// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function decode_customize_preview_js() {
	wp_enqueue_script( 'decode-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ), '2.9.1', true );
}
add_action( 'customize_preview_init', 'decode_customize_preview_js' );
