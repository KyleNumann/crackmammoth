<?php
	if(get_field('billboard_select')):
		$post_object = get_field('billboard_select');
		$post = $post_object;
		setup_postdata( $post );
		$bgImage = '';
		if(get_field('billboard_background_image')){
			$bgImage = 'style="background:url('. get_field('billboard_background_image')[url] .') no-repeat center center; background-size:cover;"';
		}
?>
<div class="billboard bg-dark text-center">
	<?php if($bgImage): ?>
		<div class="billboard-bg bg-fade-blue-green" <?=$bgImage?>></div>
	<?php endif; ?>
	<div class="container vpadding-xxl">

		<?php if ( get_field('billboard_node_line_title') ) : ?>
			<h4 class="h4 node-line-header scroll-trigger">
				<div class="gs-svg">
					<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
				</div>
				<?php the_field('billboard_node_line_title'); ?>
			</h4>
		<?php else: ?>

			<div class="gs-svg node-line-down">
				<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-down.svg'); ?>
			</div>

		<?php endif; ?>


		<div class="row">
			<div class="col-md-12 col-md-offset-6 col-sm-20 col-sm-offset-2">

				<?php if ( get_field('billboard_title') ) : ?>
					<div class="h2 billboard__title mb0"><?php the_field('billboard_title');?></div>
				<?php endif; ?>
				<?php if ( get_field('billboard_subtitle') ) : ?>
						<h3 class="emphasis billboard__sub-title mb2 mt2"><?php the_field('billboard_subtitle');?></h3>
				<?php endif; ?>
				<?php if ( get_field('billboard_description_text') ) : ?>
					<div class="billboard__description">
						<?php the_field('billboard_description_text')?>
					</div>
				<?php endif; ?>
				<?php
					if ( get_field('billboard_button_link') ) :
						$btnText = 'Read More';
						if(get_field('billboard_button_link')){
							$btnText = get_field('billboard_button_text');
						}
						$btnClass = 'btn';
						if(get_field('billboard_outline_button')){
							$btnClass = 'btn btn-outlined';
						}
				?>
					<div class="btn-wrap">
						<a class="mt8 <?=$btnClass?>" href="<?php the_field('billboard_button_link')?>"><?=$btnText?></a>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
