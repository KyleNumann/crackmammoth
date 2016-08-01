<?php
/*
Template Name: case studies
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->

		<?php
			$bg='';
			$classes = '';
			if(get_field('background_color')){
				$bg = 'style="background-color:'. get_field('background_color') .';"';
				$classes = 'text-white';
			}
			if(get_field('secondary_color')){
				echo '<style>blockquote { color:'. get_field('secondary_color') .' !important;}</style>';

			}
		?>


		<div class="case-study-banner clearfix" <?=$bg?>>

		  <div class="container">
				<?php
					// check if the flexible content field has rows of data
					$v = 0;
					if( have_rows('visual_sections') ):
						while ( have_rows('visual_sections') ) : the_row();
						$v++;
				 ?>
		      <?php
		        $bannerIcon = get_sub_field('banner_icon');
						$bannerTitle = get_sub_field('banner_title');
		        $bannerContent = get_sub_field('banner_content');
		        $bannerID = 'section-' . $v;
		      ?>
		      <?php if ($bannerIcon): ?>
		        <div class="banner-item <?php echo $bannerIcon; ?>" id="<?php echo $bannerID; ?>">
		          <div class="case-study-switcher">
		            <a class="switcher-item switcher-item-visual active" href="#">Visual Case Study</a>
		            <a class="switcher-item switcher-item-text" href="#">Written Case Study</a>
		            <div class="switcher-bg"></div>
		          </div>
		          <div class="banner-icon">
								<div class="gs-svg">
									<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $bannerIcon .'.svg'); ?>
								</div>
		            <svg class="icon"><use xlink:href="#gs-icon-<?php echo $bannerIcon; ?>"></use></svg>
		          </div>
		          <div class="banner-content">
								<div class="emphasis title"><?php echo $bannerTitle; ?></div>
		            <div class="copy"><?php echo $bannerContent; ?></div>
		          </div>
		        </div>
					<?php endif; ?>
				<?php
						endwhile;
					endif;
				?>
		  </div>
		</div>


		<section <?=$bg?> class="case-study-wrap <?=$classes?> vpadding-md">

			<div class="container vpadding-md">
				<div class="row">

					<div class="case-study-header text-center mb8">
						<div class="emphasis-sm">Case Study</div>
						<?php if(get_field('title')): ?>
							<div class="h1 mb1"><?php echo get_field('title'); ?></div>
						<?php endif; ?>
						<?php if(get_field('subtitle')): ?>
							<div class="emphasis mb1"><?php echo get_field('subtitle'); ?></div>
						<?php endif; ?>
					</div>
					<?php if(get_field('intro')): ?>
						<div class="page-intro col-md-12 col-md-offset-6 col-sm-18 col-sm-offset-3 vpadding-sm">
							<?php echo get_field('intro'); ?>
						</div>
					<?php endif; ?>

					<div class="col-sm-24">
						<div class="case-study-switcher">
	            <a class="switcher-item switcher-item-visual active" href="#">Visual Case Study</a>
	            <a class="switcher-item switcher-item-text" href="#">Written Case Study</a>
	            <div class="switcher-bg"></div>
	          </div>
					</div>

				</div>
			</div>


			<div class="case-study-sections">
				<div class="case-study-section text">

					<?php
						// check if the flexible content field has rows of data
						if( have_rows('written_sections') ):
							while ( have_rows('written_sections') ) : the_row();
								if( get_row_layout() == 'copy_section' ): ?>

						<div class="container">
							<div class="row">
								<div class="col-md-12 col-md-offset-6 col-sm-18 col-sm-offset-3">
									<?php if(get_sub_field('section_title')): ?>
										<div class="h2 mb2 mt3 text-center"><?php echo get_sub_field('section_title'); ?></div>
									<?php endif; ?>
									<?php if(get_sub_field('section_text')): ?>
										<div class="emphasis-sm wysiwyg"><?php echo get_sub_field('section_text'); ?></div>
									<?php endif; ?>
								</div>
							</div>
						</div>

						<?php
							elseif( get_row_layout() == 'image_section' ):
						?>

							<?php
								if(get_sub_field('section_layout') == 'one-column' || get_sub_field('section_layout') == 'two-column'):
									$images = get_sub_field('section_images');
									$classes = 'col-sm-24';
									if(get_sub_field('section_layout') == 'two-column'){
										$classes = 'col-sm-12';
									}
							?>
								<div class="container image-section">
									<div class="row gutters">
										<?php foreach($images as $image): ?>
											<div class="<?=$classes?>">
												<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
											</div>
										<?php endforeach; ?>
									</div>
								</div>

							<?php
								elseif(get_sub_field('section_layout') == 'web-slider'):
									$images = get_sub_field('section_images');
							?>


							<div class="container-fluid web-slider">
								<div class="row">
									<div class="col-sm-24">
										<div class="case-study-gallery-container case-study-gallery-monitor-slider">
											<div class="case-study-gallery-focus">
												<?php foreach($images as $image): ?>
													<div>
														<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
													</div>
												<?php endforeach; ?>
											</div>
											<div class="case-study-gallery">
												<?php foreach($images as $image): ?>
													<div>
														<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>



							<?php
								elseif(get_sub_field('section_layout') == 'doc-slider'):
									$images = get_sub_field('section_images');
							?>
							<div class="container-fluid doc-slider">
								<div class="row">
									<div class="col-sm-24">
										<div class="case-study-gallery-container">
											<div class="case-study-gallery basic-gallery">
												<?php foreach($images as $image): ?>
													<div>
														<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php endif; ?>


						<?php endif; //image section ?>

					<?php
							endwhile;
						endif;
					?>
					<div class="text-center mb4 mt4">
						<button class="btn btn-case-study-more see">See More</button>
					</div>

				</div>




				<div class="case-study-section visual active">

					<!-- Just added this code for visual case studies... needs to be refined -->
					<?php
						// check if the flexible content field has rows of data
						$v = 0;
						if( have_rows('visual_sections') ):
							while ( have_rows('visual_sections') ) : the_row();
							$v++;
							$bannerID = 'section-' . $v;
					 ?>


							<?php
								if(get_sub_field('section_layout') == 'one-column'):
									$images = get_sub_field('section_images');
									$classes = 'col-sm-18 col-sm-offset-3';
							?>
								<div class="container image-section" data-banner="<?=$bannerID?>">
									<div class="row">
										<?php foreach($images as $image): ?>
											<div class="<?=$classes?>">
												<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
											</div>
										<?php endforeach; ?>
									</div>
								</div>

							<?php
								elseif(get_sub_field('section_layout') == 'web-slider'):
									$images = get_sub_field('section_images');
							?>

							<div class="container-fluid web-slider" data-banner="<?=$bannerID?>">
								<div class="row">
									<div class="col-sm-24">

											<div class="case-study-gallery-container case-study-gallery-monitor-slider">
												<div class="case-study-gallery-focus">
													<?php foreach($images as $image): ?>
														<div>
															<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
														</div>
													<?php endforeach; ?>
												</div>
												<div class="case-study-gallery">
													<?php foreach($images as $image): ?>
														<div>
															<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
														</div>
													<?php endforeach; ?>
												</div>
											</div>

									</div>
								</div>
							</div>



							<?php
								elseif(get_sub_field('section_layout') == 'doc-slider'):
									$images = get_sub_field('section_images');
							?>
							<div class="container-fluid doc-slider" data-banner="<?=$bannerID?>">
								<div class="row">
									<div class="col-sm-24">

											<div class="case-study-gallery-container case-study-gallery-document-slider">
												<div class="case-study-gallery basic-gallery">
													<?php foreach($images as $image): ?>
														<div>
															<img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
														</div>
													<?php endforeach; ?>
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

					<div class="text-center mb4 mt4">
						<button class="btn btn-case-study-more read">Read More</button>
					</div>

				</div>

			</div><!-- case study sections -->




				<!-- </div>
			</div> -->
		</section>
		<!-- /section -->
	<!-- </main> -->


<?php get_footer(); ?>
