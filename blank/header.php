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

		<div class="loading-animation">
			<?php include('loading-animation.php'); ?>
		</div>

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

			<?php
			 	$headerbg = 'style="background-color:transparent;"';
				if(get_field('header_bg_color', 'option')){
					$headerbg = 'style="background-color:'. get_field('header_bg_color', 'option') .';"';
				}
				$headertext = 'style="color:transparent;"';
				if(get_field('header_text_color', 'option')){
					$headertext = 'style="color:'. get_field('header_text_color', 'option') .';"';
				}
				$player = '';
				if(get_field('audio_player', 'option')){
					$player = '<div class="audio-player">';
					$player .= get_field('audio_player', 'option');
					$player .= '</div>';
				}
			?>

			<!-- header -->
			<header class="site-header clear" role="banner" <?=$headerbg?>>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-24">
							<?php
								if(get_field('logo_type', 'option') == 'image' && get_field('header_logo', 'option')):
									$logo = get_field('header_logo', 'option')[sizes][medium];
							?>
								<a href="<?php echo bloginfo('site_url'); ?>">
									<img class="header-logo" src="<?=$logo?>">
								</a>
							<?php else: ?>
								<a href="<?php echo bloginfo('site_url'); ?>" <?=$headertext?>>
									<h1 class="h4 site-title" <?=$headertext?>><?php bloginfo('name'); ?></h1>
								</a>
							<?php endif; ?>
							<!-- nav -->

							<nav id="main-nav" role="navigation" class="force-right-xs">
									<?php if (have_posts()): while (have_posts()) : the_post(); ?>

										<?php
											// check if the flexible content field has rows of data
											if( have_rows('page_sections') ):
												while ( have_rows('page_sections') ) : the_row();
												if(get_sub_field('include_in_nav')):

													$id = '';
													$text = '';
													if(get_sub_field('nav_link_text')){
														$text = get_sub_field('nav_link_text');
														$id = strtolower(str_replace(' ', '', get_sub_field('nav_link_text')));
													} else {
														$text = get_sub_field('title');
														$id = strtolower(str_replace(' ', '', $text));
													}
													?>

													<a class="h5 smooth-scroll" href="#<?=$id?>" <?=$headertext?>><?=$text?></a>

										<?php
													endif;
												endwhile;
											endif;
										?>
										<a class="h5" href="https://www.facebook.com/crackmammoth" target="_blank"><span class="fa fa-facebook"></span></a>
										<a class="h5" href="https://soundcloud.com/crack-mammoth" target="_blank"><span class="fa fa-soundcloud"></span></a>
									<?php endwhile; endif; ?>

							</nav>

							<!-- embed player if exists -->
							<?=$player?>

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
								<div class="col-sm-24 header-featured-image-wrap">
									<div class="header-featured-image">
										<div class="absolute-fill" style="<?=$bg?>" data-top="transform:translateY(0px);" data-top-bottom="transform:translateY(250px);"></div>
										<?php
											if(get_field('header_text')):
												$layout = '';
												if(get_field('text_layout')){
													$layout = get_field('text_layout');
												}
										?>
										<div class="header-text__padding" data-top="transform:translateY(0px);" data-top-bottom="transform:translateY(150px);">

												<div class="header-text wysiwyg sm-ab50-<?=$layout?>">
													<?php echo get_field('header_text'); ?>
												</div>

										</div>
									<?php endif; ?>

									</div>
								</div>
							</div>
						</div>
				<?php endif; ?>
