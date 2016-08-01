<?php
/*
Template Name: culture
*/
?>
<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="vpadding-md">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<?php
						if( have_rows('page_sections') ):
							while ( have_rows('page_sections') ) : the_row();
					?>
						<div class="mb8 vpadding-sm">
							<div class="container">
								<div class="row">
									<div class="col-sm-24">
										<?php if(get_sub_field('title')): ?>
											<div class="h2 mb2 text-center"><?php echo get_sub_field('title'); ?></div>
										<?php endif; ?>
										<?php if(get_sub_field('description')): ?>
											<div class="emphasis-sm text-center"><?php echo get_sub_field('description'); ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-24 text-center">
										<?php
											if(get_sub_field('gallery')):
												$images = get_sub_field('gallery');
												foreach ($images as $image):
										?>
												<!-- using custom BS class, need to work it out -->
												<div class="col-ms-24 col-xs-12 col-md-8 col-lg-6">
													<div class="hover-copy bg-fade-blue-green block mb2">
														<img class="block" src="<?php echo $image['sizes']['blog-thumbnail-square']; ?>">
														<?php if($image['caption']): ?>
															<div class="item-copy">
																<div class="h5 lowercase"><?php echo $image['caption']; ?></div>
															</div>
														<?php endif; ?>
													</div>
												</div>
										<?php endforeach; endif; ?>
									</div>
								</div>
							</div>
						</div>

					<?php
							endwhile;
						endif;
					?>

				<?php endwhile; endif; ?>
			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->

<?php get_footer(); ?>
