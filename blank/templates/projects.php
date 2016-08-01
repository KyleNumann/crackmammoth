<?php
/*
Template Name: projects
*/
?>

<?php get_header(); ?>

	<!-- <main role="main"> -->
		<!-- section -->
		<section>


			<div class="case-study-list vpadding-sm">
				<?php
					$args = array(
						'post_type' => 'page',
						'post_parent' => 16
					);
					$i = 0;
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						$i++;
						$bg = '';
						if(get_field('cover_photo')){
							$bg = 'style="background-image:url('. get_field('cover_photo')[url] .'); background-repeat:no-repeat; background-position: center center; background-size:cover;"';
						}
						$bgColor = '';
						if(get_field('cover_screen_color')){
							$bgColor = 'style="background-color:'. get_field('cover_screen_color') .'"';
						} elseif(get_field('background_color')){
							$bgColor = 'style="background-color:'. get_field('background_color') .'"';
						}

				?>

				<div class="case-study-cover pl3 pr3 pb3">
					<div class="case-study-cover-inner text-white vpadding-xl" <?=$bg?>>
						<div class="case-study-cover-screen scroll-fade absolute-fill" <?=$bgColor?>></div>
						<div class="container">
							<div class="row">
								<div class="col-sm-22 col-sm-offset-1 vpadding-md">
									<?php if($i == 1): ?>
										<div class="h4 node-line-header scroll-trigger absolute-above mb4">Case Studies
											<div class="gs-svg">
												<?php echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_node-line-sideways.svg'); ?>
											</div>
										</div>
									<?php endif; ?>

									<?php if(get_field('title')): ?>
										<div class="h2"><?php echo get_field('title'); ?></div>
									<?php endif; ?>
									<?php if(get_field('subtitle')): ?>
										<div class="emphasis-sm mt2 mb3"><?php echo get_field('subtitle'); ?></div>
									<?php endif; ?>
									<a class="btn" href="<?php the_permalink(); ?>">View the Case Study</a>
								</div>
							</div>
						</div>
					</div>
				</div>


				<?php endwhile; wp_reset_postdata(); ?>
			</div><!-- case-study-list -->


			<div class="container vpadding-md">
				<div class="row">


					<?php
						// Let's diplay the work grid.

						// First, take a deep breath.

						// Okay, you good? Ready for this?

						// You Sure?

						// Allright, here we go...

						// Define some Vars:
						$spotInterval = 5; // Big spots appear every Nth item
						$quoteMix = 0.5; // The fraction of spots that should be quotes

						// Get all projects that are not quotes
						$args = array(
							'post_type' => 'gs_projects',
							'posts_per_page' => '999',
							'meta_key'   => 'project_type',
							'meta_value' => 'quote',
							'meta_compare' => '!='
						);
						$loop = new WP_Query( $args );

						$pCount = $loop->post_count; // count the number of non-quote projects

						$initSpots = $pCount / $spotInterval; // the initial number of spots

						$spotAdd = $initSpots * $quoteMix; // how many spots will be quotes, thus will be added

						$newPCount = floor($pCount + $spotAdd); // new total item count, rounded down to nearest whole number

						$roundPCount = $newPCount - ($newPCount % $spotInterval); // round down to nearest multiple of $spotInterval

						$finalSpots = $roundPCount / $spotInterval; // final number of big spots in list

						$quotesNeeded = floor($finalSpots * $quoteMix); // quotes needed based on final spots & quoteMix

						$projectsNeeded = $finalSpots - $quotesNeeded; // the projects needed are the leftover final spots


						// echo '<br/> pcount:'. $pCount;
						// echo '<br/> initspots:'. $initSpots;
						// echo '<br/> spotadd:'. $spotAdd;
						// echo '<br/> total items:'. $newPCount;
						// echo '<br/> final spots:'. $finalSpots;
						// echo '<br/> quote items:'. $quotesNeeded;
						// echo '<br/> projects in big spots:'. $projectsNeeded;


						$projects = array();
						// Now, loop through projects and add their post ID to array
						while ( $loop->have_posts() ) : $loop->the_post();
							$projects[] = get_the_id();
						endwhile; wp_reset_postdata();


						// Get all projects that ARE quotes
						// $args = array(
						// 	'post_type' => 'gs_projects',
						// 	'posts_per_page' => '999',
						// 	'meta_key'   => 'project_type',
						// 	'meta_value' => 'quote',
						// 	'meta_compare' => '='
						// );
						$args = array(
							'post_type' => 'gs_projects',
							'posts_per_page' => '999',
							'meta_key'   => 'is_featured_quote',
							'orderby' => 'meta_value_num',
							'order'   => 'DESC',
							'meta_query' => array(
								array(
									'key'     => 'project_type',
									'value'   => 'quote',
									'compare' => '=',
								),
							),
						);
						$loop = new WP_Query( $args );
						$quotes = array();
						// Now, loop through projects and add their post ID to array
						while ( $loop->have_posts() ) : $loop->the_post();
							$quotes[] = get_the_id();
						endwhile; wp_reset_postdata();

						// Randomize the projects and quotes
						shuffle($projects);
						// shuffle($quotes);

						// Now we need to take the right amount of items from $quotes and $projects, and add them to array for bigSpots
						// $bigSpots = array();
						$bigSpotsA = array_splice($quotes, 0, $quotesNeeded);
						$bigSpotsB = array_splice($projects, 0, $projectsNeeded);

						$bigSpots = array_merge($bigSpotsA, $bigSpotsB);
						shuffle($bigSpots);

						// print_r($bigSpots);
						// print_r($projects);


						$i = 0; // iterations
						$p = 0; // project items
						$bs = 0; // big spots
						$lastRow = false; // setting up for last row toggle

						while($i < $newPCount):
							$i++;

							// Set up Columns for this item
							$col1 = 'col-xs-12';
							$col2 = 'col-sm-12';
							$col3 = 'col-sm-12';
							$class = 'work-wrap';
							if($i % $spotInterval == 0){
								// if divisible by 5, we are in a 'big spot'.
								$postID = $bigSpots[$bs]; // get array item
								$bs++; // up the counter
								$col1 = 'col-sm-24';
								$col2 = 'col-sm-12';
								$col3 = 'col-sm-12 col-sm-push-12';
								$class = 'work-wrap-lg';
							} else {
								// not in a big spot
								$postID = $projects[$p]; // get array item
								$p++; // up the regular posts counter
							}
							if($lastRow){
									// if we are inside a row that will not make it to the large spot,
									// we are on the last row. Let the items be 1/4th the full-width wrap
									// IMPORTANT - this needs to come before the setting of $lastRow so it only fires on the NEXT iteration
									$col1 = 'col-xs-12 col-sm-6 4-away';
							}
							if($i % ($spotInterval * 2) == 0){
								// every other row, flip the order of the large container
								$col2 = 'col-sm-12 col-sm-pull-12';
								$col3 = 'col-sm-12';
								if(($i + $spotInterval) > $newPCount){
									// if we are starting a row that will not make it to the large spot,
									// we are starting the last row. Let the item wrap span full-width
									$col3 = 'col-sm-24';
									$lastRow = true;
								}
							}


							// create id from title for lightbox
							// $itemID = str_replace(' ', '-', get_the_title($postID));
							$itemID = preg_replace('#\W#', '', get_the_title($postID));
					?>

						<?php if($i == 1): // if first item, start the wrap ?>
							<div class="col-sm-12">
								<div class="row">
						<?php endif; ?>

						<?php if($i % $spotInterval == 0): // if divisible by spotInterval, start new wrap ?>
								</div><!-- row -->
							</div><!-- col -->
							<div class="<?=$col2?>">
								<div class="row">
						<?php endif; ?>

							<div class="<?=$col1?> <?=$class?>">
								<?php include('project-item.php'); // include the actual content ?>
							</div>

						<?php if($i % $spotInterval == 0): // if divisible by spotInterval, end & start a new wrap ?>
								</div><!-- row -->
							</div><!-- col -->
						</div><!-- row -->
						<div class="row">
							<div class="<?=$col3?>"><!-- is this it? -->
								<div class="row">
						<?php endif; ?>

						<?php
							if($i == $newPCount): // if the last item, end the wrap
						?>
								</div><!-- row -->
							</div><!-- col -->
						<?php endif; ?>

					<?php endwhile; ?>

				</div>
			</div>
		</section>
		<!-- /section -->
	<!-- </main> -->


<?php get_footer(); ?>
