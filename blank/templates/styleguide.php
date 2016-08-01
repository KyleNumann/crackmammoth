<?php
/*
Template Name: style guide
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>

			<div class="container vpadding-md">

				<div class="row">
					<div class="col-md-12 col-md-offset-6">
						<h1 class="h1">Header One (.h1)</h1>
						<h2 class="h2">Header Two (.h2)</h2>
						<h3 class="h3">Header Three (.h3)</h2>

						<p class="emphasis">Emphasis text - focused marketing expertise to B2B enterprises.</p>
						<p class="emphasis-sm">Emphasis small, the smaller version of the emphasis text. Our team shares a passion for the business to business arena, so that is where we turned our sights.</p>

						<h4 class="h4 node-line-header mb4 scroll-trigger">
							<div class="gs-svg">
								<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
							</div>
							Node Line Header
						</h4>

						<div class="btn-wrap">
							<a class="btn" href="/">CTA Button (.cta)</a>
							<a class="btn btn-outlined" href="/">CTA Outlined Button (.cta .cta-outlined)</a>
							<a class="btn btn-alt" href="/">CTA Alt Button (.cta .cta-alt)</a>
							<br>
							<a class="btn text-lg" href="/">CTA Button LG (.cta .text-lg)</a>
						</div>

						<div class="expanding-content vpadding-sm">
							<h2 class="h4 mb2">Expanding Content</h2>
							<p>Lorem ipsum dolor sit amet, vero cetero epicuri at pri, detraxit accusata expetenda in cum. Et ius duis nobis consul. Suas iudico bonorum cu ius, vis ad bonorum periculis. Id choro vitae alienum mea, per at nihil consul oporteat. Graece legendos ei vel. Duo unum ornatus at, sea at eligendi democritum.</p>
								<a class="a_show text-cta arrow-down" href="#">Read More</a>
								<div class="hidden-info text-left">
									<p>Homero civibus oportere ius te. Et graeco viderer qui, ius semper audiam no. Te sensibus postulant mel. Per sale inciderint an, fugit accusata ut duo. Ea fuisset mediocrem splendide sed. Labores vulputate cum ut, nec ea stet dolores molestiae.</p>
									<p>Nostrud expetendis per ex, at eam illud deleniti dissentiet, pro dicat pericula repudiare ex. Utinam nonumy intellegam ea vel, rebum populo in vel. His tantas nonumy no, wisi dicta aeterno mei in. Integre diceret atomorum at mea, ea vix veri libris labore.</p>
								</div>
								<a href="#" class="a_hide text-cta arrow-up">Show Less</a>
						</div>

						<div class="wysiwyg mt8">
							<?php if (have_posts()): while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>

			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->

<?php get_footer(); ?>
