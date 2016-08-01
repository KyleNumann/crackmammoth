
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="blog-excerpt-wrap col-xs-24 col-ms-12 col-sm-12 col-md-8 col-lg-6">
		<?php
			// Now we grab the rest of the posts, using the filter in functions.php to exclude featured posts
			include('blog-excerpt.php');
		?>
	</div>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
