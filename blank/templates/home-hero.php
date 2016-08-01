<div class="home-hero-slides">
	<?php
	// check if the flexible content field has rows of data
	if( have_rows('home_slides') ):
		while ( have_rows('home_slides') ) : the_row();

		if( get_row_layout() == 'hero_feature' ):
			$bgImage = '';
			if (get_sub_field('background_image')){
				// If the page has hero background image uploaded
				$bgImage = 'style="background:url('. get_sub_field('background_image')[url] .') no-repeat center center; background-size:cover;"';
			}
			$bgFade = '';
			if(get_field('image_overlay')){
				$bgFade = 'bg-fade-'. get_field('image_overlay');
			}
			?>
			<div class="home-slide hero-content text-white">
				<div class="absolute-fill <?=$bgFade?>" <?=$bgImage?>></div>
				<div class="hero-content-inner">
					<div class="container vpadding-xs">
						<div class="row">
							<div class="col-sm-16 col-sm-offset-4">
								<?php if(get_sub_field('icon_name')): ?>
									<div class="hero-icon svg-draw gs-svg scroll-trigger">
										<?php $iconName = get_sub_field('icon_name'); ?>
										<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $iconName .'.svg'); ?>
									</div>
								<?php endif; ?>
								<?php if ( get_sub_field('title') ) : ?>
									<div class="h1 hero__title mb0"><?php the_sub_field('title');?></div>
								<?php endif; ?>
								<?php if ( get_sub_field('subtitle') ) : ?>
									<h3 class="emphasis hero__sub-title mb2 mt2"><?php the_sub_field('subtitle');?></h3>
								<?php endif; ?>
								<?php if ( get_sub_field('description_text') ) : ?>
									<div class="hero__description">
										<?php the_sub_field('description_text')?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			elseif( get_row_layout() == 'resource_feature' ):

				$bg = 'bg-blue';
				if(get_sub_field('bg')){
					$bg = 'bg-'. get_sub_field('bg');
				}

				?>
				<div class="home-slide hero-content text-white">
					<div class="absolute-fill <?=$bg?>"></div>
					<div class="hero-content-inner text-left">
						<div class="container vpadding-xs">
							<div class="row">
								<div class="col-sm-10 col-sm-offset-2">

									<?php if ( get_sub_field('title') ) : ?>
										<div class="h2 hero__title mb2"><?php the_sub_field('title');?></div>
									<?php endif; ?>
									<?php if ( get_sub_field('subtitle') ) : ?>
										<h3 class="emphasis hero__sub-title mb2 mt2"><?php the_sub_field('subtitle');?></h3>
									<?php endif; ?>
									<?php if ( get_sub_field('description_text') ) : ?>
										<div class="hero__description mb6">
											<?php the_sub_field('description_text')?>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-sm-8 col-sm-offset-1">
									<?php if ( get_sub_field('image') ) : ?>
										<img src="<?php echo get_sub_field('image')[url];?>">
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php
				elseif( get_row_layout() == 'blog_feature' ):
					$bg = 'bg-blue';
					if(get_sub_field('bg')){
						$bg = 'bg-'. get_sub_field('bg');
					}
				?>


					<div class="home-slide hero-content">
						<div class="absolute-fill <?=$bg?>"></div>
						<div class="hero-content-inner text-left">
							<div class="container vpadding-xs">
								<div class="row gutters">
									<div class="col-sm-12 col-sm-offset-2">

										<?php
											if(get_sub_field('main_featured_blog')): // Begin markup for Blog CTA
												$post_object = get_sub_field('main_featured_blog');
												$post = $post_object;
												setup_postdata( $post );
												$isSubFeatured = true;
										?>
											<?php include( get_template_directory() .'/blog-excerpt.php'); ?>

											<?php wp_reset_postdata(); ?>
										<?php endif; ?>

										<?php if ( get_sub_field('title') ) : ?>
											<div class="h3 hero__title mb1"><?php the_sub_field('title');?></div>
										<?php endif; ?>
										<?php if ( get_sub_field('subtitle') ) : ?>
											<h3 class="emphasis-sm hero__sub-title mb3"><?php the_sub_field('subtitle');?></h3>
										<?php endif; ?>
										<?php if ( get_sub_field('description_text') ) : ?>
											<div class="hero__description mb6">
												<?php the_sub_field('description_text')?>
											</div>
										<?php endif; ?>

									</div>
									<div class="col-sm-8">
										<?php
											if(get_sub_field('sub-featured_blog_1')): // Begin markup for Blog CTA
												$post_object = get_sub_field('sub-featured_blog_1');
												$post = $post_object;
												setup_postdata( $post );
										?>
											<?php include( get_template_directory() .'/blog-excerpt.php'); ?>

											<?php wp_reset_postdata(); ?>
										<?php endif; ?>
										<?php
											if(get_sub_field('sub-featured_blog_2')): // Begin markup for Blog CTA
												$post_object = get_sub_field('sub-featured_blog_2');
												$post = $post_object;
												setup_postdata( $post );
										?>
											<?php include( get_template_directory() .'/blog-excerpt.php'); ?>

											<?php wp_reset_postdata(); ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>



				<?php endif; ?>
				<?php
			endwhile;
		endif;
		?>
</div>
