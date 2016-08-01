<?php
/*
Template Name: resources
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="vpadding-md">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<?php
						// check if the flexible content field has rows of data
						if( have_rows('page_sections') ):
							while ( have_rows('page_sections') ) : the_row();

								if( get_row_layout() == 'callout' ): ?>



								<?php
									$bgColor = '';
									if(get_sub_field('cta_background_color')){
										$bgColor = 'bg-'. get_sub_field('cta_background_color');
										$bgColor .= ' text-white';
									}
									$sectionImg = '';
									if(get_sub_field('image')){
										$sectionImg = get_sub_field('image');
									}

									$ctaURL = '';
									if(get_sub_field('cta_text') && (get_sub_field('internal_cta_url') || get_sub_field('external_cta_url'))) {
										if(get_sub_field('internal_cta_url')){
											$ctaURL = get_sub_field('internal_cta_url');
										}
										if(get_sub_field('external_cta_url')){
											$ctaURL = get_sub_field('external_cta_url');
											$target = '_blank';
										}
									}
								?>
									<div class="<?=$bgColor?> vpadding-lg callout-section">
										<div class="container">
											<div class="row">
												<div class="col-sm-24 pb6">
													<?php if ( get_sub_field('section_title') ) : ?>
														<h4 class="h4 node-line-header scroll-trigger absolute-above ml2">
															<div class="gs-svg svg-draw">
																<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
															</div>
															<?php the_sub_field('section_title'); ?>
														</h4>
													<?php endif; ?>
												</div>

												<div class="col-sm-24 col-lg-18 col-lg-offset-3">



													<div class="row section-content">
														<div class="col-sm-10 section-image">
															<?php if($sectionImg):?>
																	<?php if($ctaURL !== ''): ?>
																		<a href="<?=$ctaURL?>" target="<?=$target?>" class="<?=$anchor_class?>">
																			<img src="<?php echo $sectionImg['url']; ?>" title="<?php echo $sectionImg['title']; ?>">
																		</a>
																	<?php else: ?>
																		<img src="<?php echo $sectionImg['url']; ?>" title="<?php echo $sectionImg['title']; ?>">
																	<?php endif; ?>
															<?php endif; ?>
														</div>

														<div class="col-sm-14 col-sm-offset-1 section-copy">
															<?php if(get_sub_field('callout_title')): ?>
																<div class="h3 mb1"><?php echo get_sub_field('callout_title'); ?></div>
															<?php endif; ?>
															<?php if(get_sub_field('callout_copy')): ?>
																<div class="wysiwyg"><?php echo get_sub_field('callout_copy'); ?></div>
															<?php endif; ?>

															<?php if($ctaURL !== ''): ?>
																<div>
																	<a class="text-cta" href="<?=$ctaURL?>"><?php echo get_sub_field('cta_text'); ?></a>
																</div>
															<?php endif; ?>

														</div>
													</div>

												</div>

											</div>
										</div>
									</div>

								<?php elseif( get_row_layout() == 'resource_listing' ): ?>


									<div class="vpadding-lg resource-list-section">
										<div class="container">
											<div class="row">
												<div class="col-sm-24 pb8">
													<?php if ( get_sub_field('section_title') ) : ?>
														<h4 class="h4 node-line-header scroll-trigger ml2">
															<div class="gs-svg svg-draw">
																<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
															</div>
															<?php the_sub_field('section_title'); ?>
														</h4>
													<?php endif; ?>
												</div>
											</div>
											<div class="row inline-grid">

												<?php
								        	if( have_rows('resource_listing') ):
											    while ( have_rows('resource_listing') ) : the_row();

														$ctaURL = '';
														$target = '_self';
														$image = '';
														$icon = 'placeholder';
														$postType = '';
														if(get_sub_field('cta_text') && (get_sub_field('internal_cta_url') || get_sub_field('external_cta_url'))) {
															if(get_sub_field('cta_type') == 'internal-link'){
																$post_object = get_sub_field('internal_cta_url');
																if( $post_object ):
																	// if internal url, load the post object and get some content from the post
																	$post = $post_object;
																	setup_postdata( $post );

																		$ctaURL = get_permalink();

																		if(get_post_type() == 'post'){
																			// if this is blog post...
																			$postType = 'blog';
																			if(has_post_thumbnail()){
																				$image_id = get_post_thumbnail_id();
																				$image_url = wp_get_attachment_image_src($image_id,'blog-thumbnail-sm');
																				$image = 'style="background-image:url('. $image_url[0] .'); background-repeat:no-repeat; background-position: center center; background-size:cover;"';
																			}
																		} elseif(get_post_type() == 'gs_resources'){
																			// if this is resource...
																			$postType = 'resource';
																			if(get_field('preview_image')){

																				$image_url = get_field('preview_image')['sizes']['gs-thumbnail'];
																				$image = 'style="background-image:url('. $image_url .'); background-repeat:no-repeat; background-position: center center; background-size:cover;"';
																			}
																		} elseif(get_post_type() == 'page'){
																			// if this is page...
																			$postType = 'page';
																			if(get_field('icon_name')){
																				$icon = get_field('icon_name');
																			}
																		}

																	// reset the post
																	wp_reset_postdata();
																endif;
															} elseif(get_sub_field('cta_type') == 'external-link'){
																$ctaURL = get_sub_field('external_cta_url');
																$target = '_blank';
															}
															$bg = 'bg-blue';
															if(get_sub_field('bg_color')){
																$bg = 'bg-'. get_sub_field('bg_color');
															}
														}
								        ?><div class="resource-listing col-sm-12 col-md-8 col-lg-6 vpadding-sm text-center">
															<div class="item-image <?=$bg?> mb2">

																<?php if($image && $postType == 'blog'): ?>
																	<div class="absolute-fill bg-fade-green-blue" <?=$image?>></div>
																<?php elseif($image && $postType == 'resource'): ?>
																	<div class="absolute-fill" <?=$image?>></div>
																<?php else: ?>
																	<div class="gs-svg absolute-fill">
																		<?php
																		// $icon_name = get_field('cta_icon_name');
																		echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $icon .'.svg');
																		?>
																	</div>
																<?php endif; ?>
																<?php if($ctaURL !== ''): ?>
																	<a class="block absolute-fill" href="<?=$ctaURL?>"></a>
																<?php endif; ?>
															</div>
								              <div class="item-copy">
								                <?php if(get_sub_field('title')): ?>
																	<div class="h4 mt0 mb3"><?php echo get_sub_field('title'); ?></div>
								                <?php endif; ?>
								                <?php if(get_sub_field('excerpt')): ?>
								                  <div class="wysiwyg"><?php echo get_sub_field('excerpt'); ?></div>
								                <?php endif; ?>

								                <?php if($ctaURL !== ''): ?>
								                  <a class="text-cta" href="<?=$ctaURL?>" target="<?=$target?>"><?php echo get_sub_field('cta_text'); ?></a>
								                <?php endif; ?>
								              </div>

								          </div><?php endwhile; endif; ?>

											</div>
										</div>
									</div>

								<?php elseif( get_row_layout() == 'custom_blog_listing' ): ?>


									<div class="vpadding-lg resource-blog-listing">
										<div class="container">

											<div class="row">
												<div class="col-sm-24 pb8">
													<?php if ( get_sub_field('section_title') ) : ?>
														<h4 class="h4 node-line-header scroll-trigger ml2">
															<div class="gs-svg svg-draw">
																<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
															</div>
															<?php the_sub_field('section_title'); ?>
														</h4>
													<?php endif; ?>
												</div>
											</div>

											<div class="row inline-grid vpadding-sm">

												<?php
													// First, get the main featured image
													$args = array(
														'post_type' => 'post',
														'posts_per_page' => 3
														// 'category_name'   => 'news'
													);
													$loop = new WP_Query( $args );
													while ( $loop->have_posts() ) : $loop->the_post();
												?><div class="resource-blog-listing-item col-sm-8 mb8">

														<div class="item-copy">
															<!-- post title -->
															<h2 class="h4 item-title text-default mb2">
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
															</h2>

															<div class="wysiwyg">
																<p><?php the_excerpt(); ?></p>
															</div>

														</div>

													</div><?php endwhile; wp_reset_postdata(); ?>

													<div class="vpadding-sm text-center">
														<a class="btn" href="/category/news/">View More</a>
													</div>

											</div>
										</div>
									</div>


								<?php endif; ?>
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
