<!--
	template name: evaluate
-->

<?php get_header(); ?>

<!-- <main role="main"> -->
<!-- section -->
<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="container vpadding-md">

		<div class="row">
			<div class="col-sm-24 col-md-12 col-md-offset-6">

				<?php if ( get_field('page_intro') ) : ?>
					<div class="vpadding-sm wysiwyg">
						<?php echo get_field('page_intro'); ?>
					</div>
				<?php endif; ?>

			</div>
			<div class="col-sm-24 col-md-14 col-md-offset-5">
				<div class="row">

				<!-- inline grid fix: remove whitespace between col elements -->
				<?php if(have_rows('evaluate_items')): ?>
					<?php while (have_rows('evaluate_items')) : the_row(); ?>
						<div class="col-sm-8">
							<div class="evaluate-item mb4 pr2 pl2">

								<?php if(get_sub_field('icon_name')): ?>
									<div class="item-icon gs-svg">
										<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. get_sub_field('icon_name') .'.svg'); ?>
									</div>
								<?php endif; ?>
								<?php if(get_sub_field('description')): ?>
									<div class="vpadding-xs text-center"><?php echo get_sub_field('description'); ?></div>
								<?php endif; ?>

							</div>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>

				</div>
			</div>
			<div class="col-sm-24 col-md-12 col-md-offset-6">

				<?php if ( get_field('page_content') ) : ?>
					<div class="vpadding-sm wysiwyg">
						<?php echo get_field('page_content'); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>

	</div><!-- .container -->



	<?php endwhile; endif; ?>

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
