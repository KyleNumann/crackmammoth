<?php
/*
Template Name: values
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="container vpadding-md">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<div class="row text-center">

					<div class="col-sm-22 col-sm-offset-1">
						<div class="row">

							<!-- inline grid fix: remove whitespace between col elements -->
							<?php while (have_rows('values')) : the_row();
							?><div class="col-lg-8 col-sm-12 col-xs-24">
									<div class="value-wrap">
										<div class="value flip-card">
											<?php if(strtolower(get_sub_field('title')) == 'values'): ?>
												<div class="values-label-wrap">
													<div class="bg-slideshow">
														<div class="bg-slide slide-1 bg-fade-blue-green"></div>
														<div class="bg-slide slide-2 bg-fade-blue-green"></div>
														<div class="bg-slide slide-3 bg-fade-blue-green"></div>
													</div>
													<div class="values-label">

														<div class="gs-svg">
															<?php $imgName = get_sub_field('value_image'); ?>
															<?php echo file_get_contents( get_template_directory_uri() .'/img/values/'. $imgName .'.svg'); ?>
														</div>
													</div>
												</div>

											<?php else: ?>
												<div class="card">

													<div class="card-face front">
														<div class="gs-svg">
															<?php $imgName = get_sub_field('value_image'); ?>
															<?php echo file_get_contents( get_template_directory_uri() .'/img/values/'. $imgName .'.svg'); ?>
														</div>
													</div>
													<div class="card-face back">
														<div class="gs-svg absolute-fill">
															<?php $imgName = get_sub_field('value_image'); ?>
															<?php echo file_get_contents( get_template_directory_uri() .'/img/values/'. $imgName .'.svg'); ?>
														</div>
														<div class="item-copy">
															<?php if(get_sub_field('title')): ?>
																<h2 class="h4 mb2 title"><?=get_sub_field('title')?></h2>
															<?php endif; ?>
															<?php if(get_sub_field('subtitle')): ?>
																<h4 class="mb4 subtitle"><?=get_sub_field('subtitle')?></h4>
															<?php endif; ?>
															<?php if(get_sub_field('description')): ?>
																<?=get_sub_field('description')?>
															<?php endif; ?>
														</div>
													</div>

												</div>
											<?php endif; ?>
										</div>
									</div><!-- value-wrap-->
								</div><?php endwhile; ?>

						</div>
					</div>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->

<?php get_footer(); ?>
