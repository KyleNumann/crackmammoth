<?php
/*
Template Name: capabilities
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="container vpadding-md">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<div class="row text-center inline-grid">


					<!-- inline grid fix: remove whitespace between col elements -->
					<?php
						$colors = array( 'green', 'blue', 'yellow', 'red', 'purple');
						$i = 0;
						$c = count($colors);
						while (have_rows('capabilities')) : the_row();
							if($i <= $c){	$theme = $colors[$i];	} else {	$i = 0; }
							$i++;
					?><div class="col-lg-8 col-sm-12">
							<div class="capability <?=$theme?>-theme svg-fill-on-hover expanding-content mb8">
								<div class="item-icon gs-svg">
									<?php $iconName = get_sub_field('capability_icon_name'); ?>
									<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $iconName .'.svg'); ?>
								</div>
								<?php if(get_sub_field('capability_title')): ?>
									<h2 class="h4 mb2"><?=get_sub_field('capability_title')?></h2>
								<?php endif; ?>
								<?php if(get_sub_field('capability_excerpt')): ?>
									<?=get_sub_field('capability_excerpt')?>
								<?php endif; ?>

								<?php if(get_sub_field('capability_full_text')): ?>

									<a class="a_show text-cta arrow-down" href="#">Read More</a>
									<div class="hidden-info text-left">
										<?=get_sub_field('capability_full_text')?>
									</div>
									<a href="#" class="a_hide text-cta arrow-up">Show Less</a>
								<?php endif; ?>
							</div>
						</div><?php endwhile; ?>

				</div>
				<?php endwhile; endif; ?>
			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->

<?php get_footer(); ?>
