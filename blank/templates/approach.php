<!--
	template name: approach
-->

<?php get_header(); ?>

<!-- <main role="main"> -->
<!-- section -->
<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="container vpadding-md">

		<div class="row">
			<div class="col-sm-24 col-md-18 col-md-offset-3">

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

				<div class="row mb8 pb4">
					<div class="evaluate-callout col-sm-11">

						<?php if(get_field('evaluate_callout')): ?>
							<div class="template-wysiwyg"><?php echo get_field('evaluate_callout'); ?></div>
						<?php endif; ?>

					</div>
					<div class="process-callout col-sm-11 col-sm-offset-2">

						<?php if(get_field('process_callout')): ?>
							<div class="template-wysiwyg"><?php echo get_field('process_callout'); ?></div>
						<?php endif; ?>

					</div>
				</div>

				<div class="row vpadding-sm">
					<div class="partner-for-success col-sm-24">
						<div class="row">
							<div class="col-sm-4">
								<div class="gs-svg">
									<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_placeholder.svg'); ?>
								</div>
							</div>
							<div class="col-sm-20">
								<?php if(get_field('partner_callout')): ?>
									<div class="template-wysiwyg"><?php echo get_field('partner_callout'); ?></div>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>

	</div><!-- .container -->


	<?php include('module-billboard.php'); ?>

	<?php endwhile; endif; ?>

</section>
<!-- /section -->
<!-- </main> -->

<?php get_footer(); ?>
