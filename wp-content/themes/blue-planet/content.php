<?php
/**
 * @package Blue Planet
 */
?>
<?php
global $blueplanet_options_settings;
$bp_options = $blueplanet_options_settings;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php blue_planet_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">

		<?php if('excerpt' == $bp_options['content_layout']  ) : ?>
				<?php if ( has_post_thumbnail()) : ?>
				<div class="bp-thumbnail-wrapper">
				   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				   <?php the_post_thumbnail('full', array('class'=> 'img-responsive')); ?>
				   </a>
				</div>
				 <?php endif; ?>
				<?php the_excerpt(); ?>


        <?php else:?>
        	<?php if ( 'excerpt-thumb' == $bp_options['content_layout']  ): ?>
        		<div class="et-row row ">
        			<div class="et-row-left col-md-5 col-sm-5 col-xs-12">
	        			<?php if ( has_post_thumbnail()) : ?>
        				<div class="bp-thumbnail-wrapper excerpt-thumb">
        					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
        						<?php the_post_thumbnail('homepage-thumb'); ?>
        					</a>
        				</div>
        			<?php endif; ?>
        			</div>
        			<div class="et-row-right col-md-7 col-sm-7 col-xs-12">
        				<?php the_excerpt(); ?>
      				</div>
        		</div>


	        <?php else: ?>

		        	<?php if ( has_post_thumbnail()) : ?>
		        		<div class="bp-thumbnail-wrapper">
		        			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		        				<?php the_post_thumbnail(); ?>
		        			</a>
		        		</div>
		        	<?php endif; ?>
					 		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blue-planet' ) ); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'blue-planet' ),
									'after'  => '</div>',
								) );
							?>
		        <?php endif; //end if excerpt-thumb ?>
        <?php endif; // end if content_layout ?>



	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'blue-planet' ) );
				if ( $categories_list && blue_planet_categorized_blog() ) :
			?>
				<?php
				if (!empty($categories_list)) {
					echo '<span class="bs-category">'.$categories_list.'</span>';
				}
				 ?>

			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'blue-planet' ) );
				if ( $tags_list ) :

			?>
				<?php
				if (!empty($tags_list)) {
					echo '<span class="bs-tags">'.$tags_list.'</span>';
				}
				 ?>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>




		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<?php
			echo '<span class="comments">';
			echo comments_popup_link( __('0 comment','blue-planet'), __('1 comment','blue-planet'), __('% comments','blue-planet') );
			echo '</span>';
			?>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'blue-planet' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
