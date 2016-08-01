<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>
			<div class="container">
				<div class="row vpadding-sm blog-header">
					<div class="col-sm-8 blog-title-wrap">

						<div class="blog-icon gs-svg inline-block">
							<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_blog.svg'); ?>
						</div>
						<div class="h3 blog-title inline-block">Blog</div>

					</div>
					<div class="col-sm-16 pt3 text-right blog-category-wrap">
						<?php include('templates/category-list.php'); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-24">

						<div class="row featured-blog-posts">
							<div class="col-md-13 col-lg-16 main-featured">
								<?php
									// First, get the main featured image
									$args = array(
										'post_type' => 'post',
										'meta_key'   => 'main_featured',
										'meta_value' => true,
										'meta_compare' => '='
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										$isFeatured = true;
								?>

										<?php include('blog-excerpt.php'); ?>

								<?php $isFeatured = false; endwhile; wp_reset_postdata(); ?>
							</div>
							<div class="col-md-11 col-lg-8 sub-featured">
								<?php
									// Next, get the sub-featured posts
									$args = array(
										'post_type' => 'post',
										'meta_key'   => 'sub_featured',
										'meta_value' => true,
										'meta_compare' => '='
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										$isSubFeatured = true;
								?>

									<?php include('blog-excerpt.php'); ?>

								<?php $isSubFeatured = false; endwhile; wp_reset_postdata(); ?>
							</div>
						</div>

						<?php /*if(is_paged()): ?>
						<div class="main-blog-pagination-prev">
							<?php previous_posts_link(); ?>
						</div>
					<?php endif; */?>

						<div class="row main-blog-list">


							<?php get_template_part('blog', 'loop'); ?>


						</div>

						<?php if($url = get_previous_posts_page_link()): ?>
							<div class="main-blog-pagination-next text-center vpadding-sm">
  							<a class="btn" href="<?=$url?>">View More Posts</a>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>

		</section>
		<!-- /section -->
	<!-- </main> -->


<?php get_footer(); ?>
