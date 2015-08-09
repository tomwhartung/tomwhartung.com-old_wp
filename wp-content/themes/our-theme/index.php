<?php get_header();?>
<?php get_sidebar(); ?>
<div id="content">
<!--START THE LOOP-->
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="entry">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="entry-body">
		<?php the_content(); ?>
			<div class="post-metadata">
				<span class="date"><?php the_time('F jS, Y'); ?></span>
				<span class="categories">See more in: <?php the_category(' &middot; '); ?></span>		
			</div>
			</div>
	</div>	
		<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
<!--END THE LOOP-->
<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts')) ?></div>
		<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>')) ?></div>
	</div>
</div>
<?php get_footer(); ?>