<?php get_header(); ?>

<!-- <main role="main"> -->
<!-- section -->
<section>

	<div class="container vpadding-md wysiwyg">

		<div class="row">
			<div class="col-md-12 col-md-offset-6">

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


							<?php the_content(); ?>

							<div class="vpadding-sm text-center">
								<a class="btn btn-back" href="/team">Back to Team</a>
							</div>

					</article>
					<!-- /article -->

				<?php endwhile; endif; ?>

			</div>
		</div>

</div><!-- .container -->

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
