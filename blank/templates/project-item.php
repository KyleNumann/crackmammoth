<?php
// if we don't have $postID (projects page) then we get it from the loop
if(!$postID){
	$postID = get_the_id();
}
// echo 'post-ID'. $postID;
if(get_field('project_type', $postID) == 'image_gallery'):
	$images = get_field('project_images', $postID);
	$thumb = $images[0]['sizes']['gs-work'];
	$bg = 'style="background-image:url('. $thumb .'); background-repeat: no-repeat; background-position: center center; background-size:cover;"';
?>

		<div class="work-container work-image-gallery tilt-hover">
			<div class="absolute-fill" <?=$bg?>></div>
			<div class="item-copy">
				<h2 class="h5 lowercase title"><?php echo get_the_title($postID); ?></h2>
			</div>
			<a class="block absolute-fill lightbox-inline" href="#<?=$itemID?>"></a>
		</div>
		<?php include('project-gallery.php'); ?>

<?php
	elseif(get_field('project_type', $postID) == 'quote'):
	$bgColor = '';
	if(get_field('bg_color', $postID)){
		$bgColor = get_field('bg_color', $postID);
	}
	$bg = 'style="background-color:'. $bgColor .';"';
?>

		<div class="work-container work-quote">
			<div class="absolute-fill" <?=$bg?>></div>
			<div class="item-copy">
				<div class="emphasis"><?php echo get_field('quote_text', $postID); ?></div>
					<div class="row item-meta">
						<?php if(get_field('author_logo', $postID)): ?>
							<div class="col-sm-6">
								<img class="quote-author-logo" src="<?php echo get_field('author_logo', $postID)[url]; ?>">
							</div>
							<div class="col-sm-18">
						<?php else: ?>
							<div class="col-sm-24">
						<?php endif; ?>
						<?php if(get_field('quote_author', $postID)): ?>
							<div class="h4">— <?php echo get_field('quote_author', $postID); ?></div>
						<?php endif; ?>
						<?php if(get_field('quote_author_subtitle', $postID)): ?>
							<p class="h5 lowercase"><?php echo get_field('quote_author_subtitle', $postID); ?></p>
						<?php endif; ?>
						</div>
					</div>
			</div>
		</div>

<?php
	elseif(get_field('project_type', $postID) == 'video'):
	$image = get_field('preview_image', $postID);
	$thumb = $image['sizes']['gs-thumbnail'];
	$bg = 'style="background-image:url('. $thumb .'); background-repeat: no-repeat; background-position: center center; background-size:cover;"';
?>

		<div class="work-container work-video  tilt-hover">
			<div class="absolute-fill" <?=$bg?>></div>
			<div class="item-copy">
				<h2 class="h5 lowercase title"><?php echo get_the_title($postID); ?></h2>
			</div>
			<a class="block absolute-fill lightbox-inline" href="#<?=$itemID?>"></a>
		</div>
		<?php include('project-gallery.php'); ?>

<?php endif; ?>

<?php $postID = ''; ?>
