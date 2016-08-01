<?php
/*
Template Name: careers
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="container vpadding-md">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<div class="row">

					<div class="col-sm-14 col-sm-offset-5">


							<!-- inline grid fix: remove whitespace between col elements -->
							<?php if(have_rows('career_listing')): ?>

								<?php while (have_rows('career_listing')) : the_row(); ?>
									<div class="career-listing vpadding-sm mb8">
										<div class="row">
											<div class="col-sm-5">
												<div class="gs-svg">
													<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_careers.svg'); ?>
												</div>
											</div>
											<div class="col-sm-18 col-sm-offset-1">
												<?php if(get_sub_field('career_title')): ?>
													<div class="title h3 mb2"><?php echo get_sub_field('career_title'); ?></div>
												<?php endif; ?>
												<?php if(get_sub_field('career_description')): ?>
													<div class="copy"><?php echo get_sub_field('career_description'); ?></div>
												<?php endif; ?>
												<?php if(get_sub_field('career_link_url')): ?>
													<a class="text-cta" href="<?php echo get_sub_field('career_link_url'); ?>"><?php echo get_sub_field('career_link_text'); ?></a>
												<?php endif; ?>
											</div>
										</div>
									</div>

								<?php endwhile; ?>
							<?php else: ?>
								<div class="h4">No careers currently available</div>
							<?php endif; ?>


					</div>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->

<?php get_footer(); ?>
