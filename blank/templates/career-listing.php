<?php
/*
Template Name: career listing
*/
?>

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
					<div class="col-md-11 col-md-offset-3">
				<?php else: ?>
					<div class="col-md-12 col-md-offset-6">
				<?php endif; ?>


				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</article>
					<!-- /article -->


					<?php if(get_field('action_option') == 'form'): ?>

						<div class="row">
							<div class="col-sm-18 col-sm-offset-3">

								<div class="vpadding-md">
									<form class="minimal-form" id="career-contact">
										<input id="careerListing" name="careerListing" type="hidden" value="<?php the_title(); ?>">
										<input id="careerCategory" name="careerCategory" type="hidden" value="<?php/*echo $category*/?>">
										<div class="form-group">
											<label for="careerFirstName" class="hidden">first name</label>
											<input type="text" class="form-control" id="careerFirstName" name="careerFirstName" placeholder="first name*" required>
										</div>
										<div class="form-group">
											<label for="careerLastName" class="hidden">last name</label>
											<input type="text" class="form-control" id="careerLastName" name="careerLastName" placeholder="last name*" required>
										</div>
										<div class="form-group">
											<label for="careerEmail" class="hidden">email</label>
											<input type="text" class="form-control" id="careerEmail" name="careerEmail" placeholder="email*" required>
										</div>
										<div class="form-group">
											<label for="careerPhone" class="hidden">phone number</label>
											<input type="text" class="form-control" id="careerPhone" name="careerPhone" placeholder="phone number">
										</div>
										<div class="form-group">
											<label for="careerPortfolio" class="hidden">portfolio url</label>
											<input type="text" class="form-control" id="careerPortfolio" name="careerPortfolio" placeholder="portfolio url">
										</div>
										<div class="form-group">
											<label for="careerComment" class="hidden">cover letter/comments</label>
											<textarea id="careerComment" name="careerComment" class="form-control" rows="10" cols="40" placeholder="cover letter/comments*" required></textarea>
										</div>
										<label for="careerResume">resume</label>
										<div class="form-group">
											<input type="file" class="form-control" id="careerResume" name="careerResume" placeholder="resume">
										</div>

										<button id="career-submit" name="career-submit" class="btn btn-submit">Send</button>
									</form>
								</div>

							</div>
						</div>

					<?php elseif(get_field('action_option') == 'cta'): ?>
						<div class="text-center vpadding-sm">
							<a class="btn" href="<?php echo get_field('cta_url'); ?>"><?php echo get_field('cta_text'); ?></a>
						</div>
					<?php endif; ?>


				<?php endwhile; endif; ?>

			</div>


			<?php
				if(have_rows('page_ctas') && get_field('show_as_sidebar') && $canHaveSidebar):
			?>
				<div class="col-sm-6 col-sm-offset-3">
					<div class="sticky">
						<?php include('module-cta-sidebar.php'); ?>
					</div>
				</div>

			<?php endif; ?>



		</div><!-- row -->

</div><!-- .container -->

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
