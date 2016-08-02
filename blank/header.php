<!doctype html>
<html <?php language_attributes(); ?> class="no-js preload">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Oswald:300,400,700" rel="stylesheet">

	<?php wp_head(); ?>
</head>
	<body <?php body_class(); ?>>

		<nav id="mobile-menu" role="navigation" class="visible-xs">
			<?php/*
			wp_nav_menu(
			array(
				'menu'            => 'Mobile',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'nav',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => '',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => my_nav_wrap(),
				'depth'           => 0,
				'walker'          => ''
				)
			);*/
			?>
		</nav>

		<!-- wrapper -->
		<div id="wrapper" class="wrapper">

			<!-- header -->
			<header class="site-header clear" role="banner">
				<div class="container">
					<div class="row">
						<div class="col-md-18 col-md-offset-3 col-lg-16 col-lg-offset-4">
							<?php
								if(get_field('logo_type', 'option') == 'image' && get_field('header_logo', 'option')):
									$logo = get_field('header_logo', 'option')[sizes][medium];
							?>
								<img class="header-logo" src="<?=$logo?>">
							<?php else: ?>
								<h1 class="h5 site-title"><?php bloginfo('name'); ?></h1>
							<?php endif; ?>
							<!-- nav -->
							<nav id="main-nav" role="navigation" class="force-right-xs">

									<?php if (have_posts()): while (have_posts()) : the_post(); ?>

										<?php
											// check if the flexible content field has rows of data
											if( have_rows('page_sections') ):
												while ( have_rows('page_sections') ) : the_row();
													$id = '';
													if(get_sub_field('title')){
														$id = strtolower(str_replace(' ', '', get_sub_field('title')));
													} ?>

													<a class="btn h5 smooth-scroll" href="#<?=$id?>"><?php echo get_sub_field('title'); ?></a>

										<?php
												endwhile;
											endif;
										?>
									<?php endwhile; endif; ?>

							</nav>
							<!-- /nav -->
						</div>
					</div>
				</div>
			</header>
			<!-- /header -->


			<main id="main" role="main">
				<?php if(get_field('has_featured_image') && get_field('featured_image')):
					$bg = 'background:url('. get_field('featured_image')[sizes][large] .') no-repeat center center; background-size:cover;';
				?>

						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-24">
									<div class="header-featured-image" style="<?=$bg?>">
								</div>
							</div>
						</div>
				<?php endif; ?>
