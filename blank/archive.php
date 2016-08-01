<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->


		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-24 text-center vpadding-sm">
						<h2 class="h3 inline-block"><?php the_archive_title (); ?> </h2><a class="ml6 mt3 inline-block" href="/blog">View all blog posts</a>
					</div>
					<div class="col-sm-24 vpadding-sm mb4">


						<div class="row">

							<?php if (have_posts()): while (have_posts()) : the_post(); ?>

								<div class="col-sm-6">
									<?php include('blog-excerpt.php'); ?>
								</div>

							<?php endwhile; ?>

							<?php else: ?>

								<!-- article -->
								<article>
									<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
								</article>
								<!-- /article -->

							<?php endif; ?>

						</div>




					</div>
				</div>
			</div>

		</section>
		<!-- /section -->
	<!-- </main> -->


<?php get_footer(); ?>
