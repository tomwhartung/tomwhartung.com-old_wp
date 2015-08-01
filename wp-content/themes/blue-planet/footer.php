<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Blue Planet
 */
?>
<?php
global $blueplanet_options_settings;
$bp_options = $blueplanet_options_settings;
?>
    <?php
    //
    do_action( 'blue_planet_before_content_close' );
    //
    ?>
	</div><!-- #content -->
    <div class="clear"></div>
    <?php
    //
    do_action( 'blue_planet_after_content_close' );
    //
    ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php
    //
    do_action( 'blue_planet_after_footer_open' );
    //
    ?>
		<div class="site-info">
            <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'footer',
                                'depth'             => 1,
                                'container'         => 'div',
                                'container_class'   => 'footer-nav-wrapper',
                                'menu_class'        => 'footer-nav',
                                'fallback_cb'       => '',
                                'link_after'        => '<span class="pipe">|</span>',
                                )
                            );
                        ?>
			<?php do_action( 'blue_planet_credits' ); ?>

		</div><!-- .site-info -->

        <?php
        //
        do_action( 'blue_planet_before_footer_close' );
        //
        ?>
	</footer><!-- #colophon -->
<div class="footer-end-page">
<?php
//
do_action( 'blue_planet_before_page_close' );
//
?>
</div> <!-- .footer-end-page -->
</div><!-- #page -->
<?php
//
do_action( 'blue_planet_before_container_close' );
//
?>
</div> <!-- // .container -->
<?php wp_footer(); ?>

</body>
</html>
