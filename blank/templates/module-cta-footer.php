	<?php if(have_rows('page_ctas')):	?>
		<?php
			global $canHaveSidebar;
			// only show sub-footer if show_as_sidebar == false or canHaveSidebar == false
			if(get_field('show_as_sidebar') == false || $canHaveSidebar == false):
		?>

			<div class="cta-module sub-footer">
				<?php if(count(get_field('page_ctas')) > 1): ?>
					<div class="cta__backgrounds">
						<?php while (have_rows('page_ctas')) : the_row(); ?>
							<div class="cta__background bg-<?php the_sub_field('cta_background_color'); ?>">
								<!--<div class="hover-highlight"></div>-->

								<?php
									if(get_sub_field('cta_type') == 'blog-post'): // Begin markup for Blog CTA
										$opacity = '';
										if(get_sub_field('image_overlay_opacity')){
											$opacity = 'opacity:'. get_sub_field('image_overlay_opacity') .';';
										}
										$post_object = get_sub_field('blog_selection');
										$post = $post_object;
										setup_postdata( $post );
										$image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,'blog-thumbnail-sm');
										$bg = 'style="background:url('. $image_url[0] .') no-repeat center center; background-size:cover;'. $opacity .'"';

								?>
									<div class="absolute-fill cta-bg-image" <?=$bg?>></div>
								<?php wp_reset_postdata(); endif; ?>

							</div>
						<?php endwhile; ?>
					</div>
				<?php else: ?>
					<?php while (have_rows('page_ctas')) : the_row();	?>
						<div class="cta__background bg-<?php the_sub_field('cta_background_color'); ?>">
							<?php
								if(get_sub_field('cta_type') == 'blog-post'): // Begin markup for Blog CTA
									$opacity = '';
									if(get_sub_field('image_overlay_opacity')){
										$opacity = 'opacity:'. get_sub_field('image_overlay_opacity') .';';
									}
									$post_object = get_sub_field('blog_selection');
									$post = $post_object;
									setup_postdata( $post );
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id,'blog-thumbnail-sm');
									$bg = 'style="background:url('. $image_url[0] .') no-repeat center center; background-size:cover;'. $opacity .'"';
							?>
								<div class="absolute-fill cta-bg-image" <?=$bg?>></div>
							<?php wp_reset_postdata(); endif; ?>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<div class="">
					<div class="row ml0 mr0">

					<?php
						while (have_rows('page_ctas')) : the_row();
							$classes = 'col-sm-24 ';
							if(count(get_field('page_ctas')) > 1){
								$classes = 'col-sm-12 ';
							}
							if(get_sub_field('cta_background_color')){
								$classes .= 'bg-'. get_sub_field('cta_background_color');
							}
					?>
						<div class="page-cta scroll-trigger vpadding-xl clearfix <?=$classes?>">


							<?php
								if(get_sub_field('cta_type') == 'custom-cta'): // Begin markup for Custom CTA
									$post_object = get_sub_field('custom_cta_selection');
									$post = $post_object;
									setup_postdata( $post );
							?>
								<div class="inner">
									<div class="page-cta__image">
										<?php if(get_field('cta_image_type') == 'image'):
											$imageUrl = get_field('cta_image')[sizes][medium];
										?>
											<div class="cta-image">
												<img src="<?php echo $imageUrl; ?>">
											</div>
										<?php elseif(get_field('cta_image_type') == 'icon'): ?>
											<div class="gs-svg svg-draw">
												<?php
													$icon_name = get_field('cta_icon_name');
													echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $icon_name .'.svg');
												?>
											</div>
										<?php endif; ?>
									</div>
									<div class="page-cta__copy">
										<h2 class="h4 mb2"><?php the_title(); ?></h2>
										<?php the_field('cta_excerpt'); ?>
										<a class="text-cta" href="<?php the_field('cta_link_url'); ?>"><?php the_field('cta_link_text'); ?></a>
									</div>
								</div>
								<?php wp_reset_postdata(); ?>

							<?php
								elseif(get_sub_field('cta_type') == 'blog-post'): // Begin markup for Blog CTA
									$post_object = get_sub_field('blog_selection');
									$post = $post_object;
									setup_postdata( $post );
							?>
								<div class="inner blog-cta">
										<!--<div class="page-cta__image">
											<div class="cta-image mb2">
												<img src="<?php //he_post_thumbnail_url('thumbnail'); ?>">
											</div>
										</div>-->
										<div class="page-cta__image">
											<div class="gs-svg svg-draw">
												<?php
												$icon_name = get_field('cta_icon_name');
												echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_blog.svg');
												?>
											</div>
										</div>

									<div class="page-cta__copy">
										<h2 class="h4 mb2"><?php the_title(); ?></h2>
										<p><?php echo gs_excerpt(12); ?></p>
										<a class="text-cta" href="<?php the_permalink(); ?>">Read More</a>
									</div>
								</div>

								<?php wp_reset_postdata(); ?>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>


					</div>
				</div>
			</div>
			<?php endif; ?>
	<?php endif; ?>
