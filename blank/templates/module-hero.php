<?php if(is_singular( 'post' )): ?>
	<!-- do nothing -->
	<div class="hero-content">
		<div class="hero-content-inner">
		</div>
	</div>
<?php elseif(is_front_page()): ?>

	<?php include('home-hero.php'); ?>

<?php elseif(is_page_template( 'templates/case-studies.php' )): ?>
	<!-- do nothing -->
	<div class="hero-content">
		<div class="hero-content-inner">
		</div>
	</div>
<?php elseif(is_page_template( 'templates/connect.php' )): ?>
	<!-- do nothing -->
	<div class="hero-content">
		<div class="hero-content-inner">
		</div>
	</div>
<?php elseif (is_singular('gs_resources')): ?>
	<div class="hero-content">
		<div class="hero-content-inner">
			<div class="container vpadding-xs">
				<div class="row">
					<div class="col-sm-24">
						<div class="h1 hero__title mb0 text-center"><?php the_title();?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php elseif (is_singular('gs_team')): ?>
	<div class="hero-content">
		<div class="hero-content-inner">
			<div class="container vpadding-xs">
				<div class="row">
					<div class="col-sm-12 col-sm-offset-6">
						<div class="h1 alt hero__title mb0"><?php the_title();?></div>
						<?php if ( get_field('sub-title') ) : ?>
							<h3 class="emphasis hero__sub-title mb2 mt2"><?php the_field('sub-title');?></h3>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php elseif (is_home() || is_archive()): ?>
	<?php /*<div class="container vpadding-xs">
	<div class="row">
	<div class="col-sm-24 text-center vert-top">
	<div class="hero-icon gs-svg inline-block">
	<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_blog.svg'); ?>
	</div>
	<div class="h1 hero__title mb0 mt2 inline-block">Blog</div>
	</div>
	</div>
	</div>*/?>
	<div class="hero-content">
		<div class="hero-content-inner">
		</div>
	</div>
<?php	elseif(get_field('hero_background_image')): ?>
	<div class="hero-content">
		<div class="hero-content-inner">
			<div class="container vpadding-xs">
				<div class="row">
					<div class="col-sm-16 col-sm-offset-4">
						<?php if(get_field('hero_icon_name')): ?>
							<div class="hero-icon svg-draw gs-svg scroll-trigger">
								<?php $iconName = get_field('hero_icon_name'); ?>
								<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $iconName .'.svg'); ?>
							</div>
						<?php endif; ?>
						<?php if ( get_field('hero_title') ) : ?>
							<div class="h1 hero__title mb0"><?php the_field('hero_title');?></div>
						<?php else: ?>
							<div class="h1 hero__title mb0"><?php the_title();?></div>
						<?php endif; ?>
						<?php if ( get_field('hero_subtitle') ) : ?>
							<h3 class="emphasis hero__sub-title mb2 mt2"><?php the_field('hero_subtitle');?></h3>
						<?php endif; ?>
						<?php if ( get_field('hero_description_text') ) : ?>
							<div class="hero__description">
								<?php the_field('hero_description_text')?>
							</div>
						<?php endif; ?>
						<div class="hero-node-line svg-draw">
							<!-- <svg class="icon"><use xlink:href="#gs_node-line-1"></use></svg> -->
							<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-1.svg'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="hero-content">
		<!-- Minimal Hero -->
		<div class="hero-content-inner">
			<div class="container vpadding-xs">
				<div class="row">
					<?php if(get_field('hero_icon_name')): ?>
						<div class="col-sm-5">
							<div class="hero-icon gs-svg svg-draw scroll-trigger">
								<?php $iconName = get_field('hero_icon_name'); ?>
								<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $iconName .'.svg'); ?>
							</div>
						</div>
						<div class="col-sm-15">
						<?php else: ?>
							<div class="col-sm-24">
							<?php endif; ?>

							<?php if ( get_field('hero_title') ) : ?>
								<div class="h1 hero__title mb0"><?php the_field('hero_title');?></div>
							<?php else: ?>
								<div class="h1 hero__title mb0"><?php the_title();?></div>
							<?php endif; ?>
							<?php if ( get_field('hero_subtitle') ) : ?>
								<h3 class="emphasis hero__sub-title mb2 mt2"><?php the_field('hero_subtitle');?></h3>
							<?php endif; ?>
							<?php if ( get_field('hero_description_text') ) : ?>
								<div class="hero__description">
									<?php the_field('hero_description_text')?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
