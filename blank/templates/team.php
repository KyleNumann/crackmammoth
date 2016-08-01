<?php
/*
Template Name: team
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="container vpadding-md">
				<div class="row">
					<?php
						$args = array(  'post_type' => 'gs_team', 'posts_per_page' => '999' );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							$thumb = get_field('thumbnail_image');
					?>

						<div class="col-sm-12 col-md-8 team-member tilt-hover">
							<a href="<?=the_permalink()?>" title="<?=the_title()?>">
								<div class="team-photo bg-fade-blue-yellow">
									<img src="<?php echo $thumb['sizes']['gs-thumbnail']; ?>">
								</div>
								<div class="item-copy">
									<h2 class="emphasis-alt text-white title"><?=the_title()?></h2>
									<?php if(get_field('sub-title')): ?>
										<h4 class="emphasis-sm text-white subtitle"><?=get_field('sub-title')?></h4>
									<?php endif; ?>
								</div>
							</a>
							<?php if(get_field('linkedin') || get_field('email')): ?>
								<div class="connect-links">
									<?php if(get_field('email')): ?>
										<a href="<?php echo get_field('email'); ?>" target="_blank">
											<div class="gs-icon">
												<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-email.svg'); ?>
											</div>
										</a>
									<?php endif; ?>
									<?php if(get_field('linkedin')): ?>
										<a href="<?php echo get_field('linkedin'); ?>" target="_blank">
											<div class="gs-icon">
												<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_icon-linkedin.svg'); ?>
											</div>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->

<?php get_footer(); ?>
