<div class="lightbox-gallery project-gallery mfp-hide" id="<?=$itemID?>">
    <?php if(get_field('project_type', $postID) == 'video'): ?>

		<div class="video-wrap">

			<?php /*<iframe src="//player.vimeo.com/video/<?php echo $workItem->getgetCustomFieldWithKey('video'); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=6ca7dc&amp;api=1" width="1281" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>*/ ?>
				<iframe src="<?php echo get_field('video_url', $postID); ?>" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>

	<?php else: ?>


		<div class="lightbox-slideshow">

			<?php
				$galItems = get_field('project_images', $postID);
				foreach($galItems as $galItem):
			?>
				<div class="slide">
					<img data-lazy="<?php echo $galItem['url']; ?>" alt="<?php echo $galItem['title']; ?>" data-thumb="<?php echo $galItem['sizes']['thumbnail']; ?>">
					<?php/*<div class="slide-image">
						<img src="<?php echo $galItem['url']; ?>" alt="<?php echo $galItem['title']; ?>">
					</div>
					<?php if($galItem['caption']): ?>
						<div class="slide-caption">
							<?php echo $galItem['caption']; ?>
						</div>
					<?php endif; */?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if(get_field('website_url', $postID)): ?>
			<div class="cta-wrap text-center vpadding-sm">
				<a class="btn" href="<?php echo get_field('website_url', $postID); ?>" target="_blank">View Website</a>
			</div>
		<?php endif; ?>

	<?php endif; ?><!-- video or images if -->
</div>
