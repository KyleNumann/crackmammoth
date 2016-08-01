<!doctype html>
<html <?php language_attributes(); ?> class="no-js preload">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

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
			<header class="header clear" role="banner">
				<h1 class="site-title"><?php bloginfo('name'); ?></h1>
				<!-- nav -->
				<nav id="main-nav" role="navigation" class="">
					<div class="container">
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>

							<?php
								// check if the flexible content field has rows of data
								if( have_rows('page_sections') ):
									while ( have_rows('page_sections') ) : the_row();
										$id = '';
										if(get_sub_field('title')){
											$id = strtolower(str_replace(' ', '', get_sub_field('title')));
										} ?>

										<a class="h3" href="#<?=$id?>"><?php echo get_sub_field('title'); ?></a>

							<?php
									endwhile;
								endif;
							?>
						<?php endwhile; endif; ?>
					</div>
				</nav>
				<!-- /nav -->
			</header>
			<!-- /header -->


			<main id="main" role="main">
