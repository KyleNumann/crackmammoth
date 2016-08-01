<!--
	template name: home
-->

<?php get_header(); ?>


			<div class="vpadding-md">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<?php
						// check if the flexible content field has rows of data
						if( have_rows('page_sections') ):
							while ( have_rows('page_sections') ) : the_row();
								$id = '';
								if(get_sub_field('title')){
									$id = strtolower(str_replace(' ', '', get_sub_field('title')));
								}

								if( get_row_layout() == 'general' ): ?>

										<section class="page-section general-content vpadding-lg">
											<div class="container">
												<div class="row">
													<div class="col-sm-12 col-sm-offset-6">
														<?php if(get_sub_field('title')): ?>
															<h2 class="h2 page-section__title text-center" id="<?=$id?>"><?php echo get_sub_field('title'); ?></h2>
														<?php endif; ?>
														<?php if(get_sub_field('content')): ?>
															<div class="wysiwyg">
																<?php echo get_sub_field('content'); ?>
															</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</section>

								<?php
									elseif( get_row_layout() == 'photo_gallery' ):
										$cols = 'col-sm-8';
										if(get_sub_field('layout')){
											if(get_sub_field('layout') == 'twocol'){
												$cols = 'col-sm-12';
											}
											if(get_sub_field('layout') == 'threecol'){
												$cols = 'col-sm-8';
											}
											if(get_sub_field('layout') == 'fourcol'){
												$cols = 'col-sm-6';
											}
										}

								?>


									<section class="page-section photo-gallery vpadding-lg">
										<div class="container">
											<div class="row">
												<div class="col-sm-24">
													<?php if(get_sub_field('title')): ?>
														<h2 class="h2 page-section__title text-center" id="<?=$id?>"><?php echo get_sub_field('title'); ?></h2>
													<?php endif; ?>

													<div class="row">
														<?php
															if(get_sub_field('photo_gallery')):
																$images = get_sub_field('photo_gallery');
																foreach ($images as $image):
														?>
																<!-- using custom BS class, need to work it out -->
																<div class="<?=$cols?>">
																	<div class="block mb2">
																		<img class="block" src="<?php echo $image['sizes']['medium']; ?>">
																		<?php if($image['caption']): ?>
																			<div class="item-copy">
																				<div class="h5"><?php echo $image['caption']; ?></div>
																			</div>
																		<?php endif; ?>
																	</div>
																</div>

														<?php endforeach; endif; ?>
													</div>

												</div>
											</div>
										</div>
									</section>


								<?php endif; ?>
					<?php
							endwhile;
						endif;
					?>


				<?php endwhile; endif; ?>
			</div>

<?php get_footer(); ?>
