<?php get_header(); ?>

<!-- <main role="main"> -->
<!-- section -->
<section>

	<div class="container vpadding-md wysiwyg">

		<div class="row">
			<?php
				global $canHaveSidebar;
				if(have_rows('page_ctas') && get_field('show_as_sidebar') && $canHaveSidebar):
			?>
				<div class="col-sm-11 col-sm-offset-3">

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php the_content(); ?>

							<?php edit_post_link(); ?>

						</article>
						<!-- /article -->

					<?php endwhile; endif; ?>

				</div>

				<div class="col-sm-6 col-sm-offset-3">
					<div class="sticky">
						<?php include('templates/module-cta-sidebar.php'); ?>
					</div>
				</div>




			<?php else: ?>

				<div class="col-sm-12 col-sm-offset-6">

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php the_content(); ?>

							<?php edit_post_link(); ?>

						</article>
						<!-- /article -->

					<?php endwhile; endif; ?>

				</div>
			<?php endif; ?>

		</div>

</div><!-- .container -->

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
