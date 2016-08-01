<!--
	template name: process
-->

<?php get_header(); ?>

<!-- <main role="main"> -->
<!-- section -->
<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="container vpadding-md">

		<div class="row">
			<div class="col-sm-24 col-md-12 col-md-offset-6">

				<?php if ( get_field('section_title') ) : ?>
					<div class="vpadding-sm">
						<h4 class="h4 node-line-header scroll-trigger">
							<div class="gs-svg">
								<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
							</div>
							<?php echo get_field('section_title'); ?>
						</h4>
					</div>
				<?php endif; ?>

				<!-- inline grid fix: remove whitespace between col elements -->
				<?php if(have_rows('process_items')): ?>
					<?php while (have_rows('process_items')) : the_row(); ?>

						<div class="process-item vpadding-xs mb2">

							<?php if(get_sub_field('title')): ?>
								<div class="title h3"><?php echo get_sub_field('title'); ?></div>
							<?php endif; ?>
							<?php if(get_sub_field('title_remainder')): ?>
								<div class="title-remainder emphasis-sm mb2"><b><?php echo get_sub_field('title_remainder'); ?></b></div>
							<?php endif; ?>
							<?php if(get_sub_field('subtitle')): ?>
								<div class="emphasis mb2"><?php echo get_sub_field('subtitle'); ?></div>
							<?php endif; ?>
							<?php if(get_sub_field('description')): ?>
								<div><?php echo get_sub_field('description'); ?></div>
							<?php endif; ?>

						</div>

					<?php endwhile; ?>
				<?php endif; ?>

				<div class="text-center vpadding-md">
					<?php if(get_field('cta_intro')): ?>
						<div class="emphasis mb4"><?php echo get_field('cta_intro'); ?></div>
					<?php endif; ?>
					<?php if(get_field('cta_url')): ?>
						<a class="btn" href="<?php echo get_field('cta_url'); ?>"><?php echo get_field('cta_text'); ?></a>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div><!-- .container -->



	<?php endwhile; endif; ?>

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
