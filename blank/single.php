<?php get_header(); ?>

	<!-- <main role="main"> -->
	<!-- section -->
	<section>

		<div class="container vpadding-md mb4">

			<div class="row single-blog-body">
				<div class="col-md-11 col-sm-offset-2">

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<!-- post thumbnail -->
							<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id,'blog-thumbnail-sm');
									$bg = 'style="background:url('. $image_url[0] .') no-repeat center center; background-size:cover;"';
							?>
								<div class="single-featured-image bg-fade-blue-green" <?=$bg?>>

									<?php //he_post_thumbnail('blog-thumbnail-lg'); // Fullsize image for the single post ?>

								</div>
							<?php endif; ?>
							<!-- /post thumbnail -->

							<header class="article-header vpadding-md pt3 text-center">
								<!-- post title -->
								<h1 class="h2 lowercase mb2">
									<?php the_title(); ?>
								</h1>
								<!-- /post title -->

								<!-- post details -->
								<span class="author">Written by <?php the_author_posts_link(); ?></span>
								<span class="date"><?php the_time('d/m/Y'); ?></span>
								<span class="category"><?php the_category(', ');?></span>
								<!-- /post details -->
							</header>

							<div class="wysiwyg">
								<?php the_content(); // Dynamic Content ?>
							</div>

							<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

							<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

							<p>This post was written by <?php the_author_posts_link(); ?></p>


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

					<div class="text-center vpadding-md">
						<a class="btn btn-back" href="/blog">Back to Blog</a>
					</div>

				</div>
				<div class="single-post-sidebar col-sm-20 col-sm-offset-2 col-md-7 col-md-offset-2">
					<div class="sticky">
						<div class="sub-featured">
							<div class="h4 absolute-above mb2 ml1">Related Posts</div>
							<?php
								// get current posts category
								$postCat = get_the_category();
								if ( ! empty( $postCat ) ) {
									$catName = esc_html( $postCat[0]->name );
								}
								// get current posts ID (to exclude)
								$this_post = $post->ID;

								// Next, get the sub-featured posts
								$args = array(
									'category_name' => $catName,
									'posts_per_page' => 3,
									'post__not_in' => array($this_post)
								);
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
									$isSubFeatured = true;
							?>

									<?php include('blog-excerpt.php'); ?>

							<?php $isSubFeatured = false; endwhile; wp_reset_postdata(); ?>
						</div>
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
					</div>
				</div>
			</div>

		</div>

	</section>
	<!-- /section -->
	<!-- </main> -->

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
