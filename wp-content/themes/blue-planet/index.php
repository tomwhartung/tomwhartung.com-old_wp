<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blue Planet
 */

get_header(); ?>
<?php
global $blueplanet_options_settings;
$bp_options = $blueplanet_options_settings;
?>

	<div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12 <?php echo blue_planet_layout_setup_class(); ?>">
    <?php
    //
    do_action( 'blue_planet_after_primary_open' );
    //
    ?>
		<main id="main" class="site-main" role="main">
        <?php
        //
        do_action( 'blue_planet_after_main_open' );
        //
        ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php blue_planet_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

        <?php
        //
        do_action( 'blue_planet_before_main_close' );
        //
        ?>

		</main><!-- #main -->

        <?php
        //
        do_action( 'blue_planet_before_primary_close' );
        //
        ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
