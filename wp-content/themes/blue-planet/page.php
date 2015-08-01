<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Blue Planet
 */

get_header(); ?>
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

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

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
