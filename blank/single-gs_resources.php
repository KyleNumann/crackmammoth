<?php get_header(); ?>

	<!-- <main role="main"> -->
	<!-- section -->
	<section>

		<div class="container vpadding-md mb8">

			<div class="row">
				<div class="col-md-24 col-lg-20 col-lg-offset-2">

					<div class="row">
						<?php
							if (have_posts()): while (have_posts()) : the_post();
								$gated = false;
								$cols1 = 'col-md-11';
								$cols2 = 'col-sm-20 col-sm-offset-2 col-md-11 col-md-offset-2';
								if(get_field('is_gated_resource')){
									$cols1 = 'col-md-13';
									$cols2 = 'col-sm-20 col-sm-offset-2 col-md-7 col-md-offset-4';
									$gated = true;
								}
						?>

						<div class="<?=$cols1?>">

								<!-- article -->
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<div class="wysiwyg">
										<?php the_content(); // Dynamic Content ?>
									</div>
									<?php if($gated): ?>
											<img src="<?php echo get_field('preview_image')['url']; ?>">
									<?php
										elseif(get_field('document_upload')):
											$dlFile = get_field('document_upload');
											$url = wp_get_attachment_url($dlFile);
									?>
										<div class="vpadding-sm">
											<a class="btn direct-download-btn" href="<?=$url?>"><?php echo get_field('dl_button_text') ? get_field('dl_button_text') : 'Download'; ?></a>
										</div>
									<?php endif; ?>
								</article>
								<!-- /article -->

							<?php endwhile; ?>

							<?php else: ?>

								<!-- article -->
								<article>
									<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
								</article>
								<!-- /article -->

							<?php endif; ?>


						</div>
						<div class="resource-sidebar <?=$cols2?>">

							<?php if($gated): ?>

								<!-- This form does not yet have a processing script, or a method to pass the mailchimp list ID -->
								<?php include('inc/resource-signup-form.php'); ?>

								<div class="share-links-wrap vpadding-sm">
									<h3 class="h4 mb2">Share This Article</h3>
									<ul class="share-links">
										<li><a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank">
											<div class="gs-icon">
												<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-facebook.svg'); ?>
											</div>
											facebook
										</a></li>
										<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank">
											<div class="gs-icon">
												<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-twitter.svg'); ?>
											</div>
											twitter
										</a></li>
										<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo site_url(); ?>" target="_blank">
											<div class="gs-icon">
												<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-linkedin.svg'); ?>
											</div>
											linkedin
										</a></li>
									</ul>
								</div>

							<?php else: ?>

								<img src="<?php echo get_field('preview_image')['url']; ?>">

							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- /section -->
	<!-- </main> -->

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
