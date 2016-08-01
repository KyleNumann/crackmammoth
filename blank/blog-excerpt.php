<?php
	// default classes
	$classes = 'tilt-hover text-default';
	$titleClass = 'h4 lowercase mb2 ';
	if($isFeatured){
		$classes = 'featured-blog text-white tilt-hover-sm';
		$titleClass = 'h2 mb2';
	}
	if($isSubFeatured){
		$classes = 'sub-featured-blog tilt-hover text-default';
		$titleClass = 'h5 lowercase mb2 ';
	}

	if ( has_post_thumbnail()){
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'blog-thumbnail-sm');
		$bg = 'style="background:url('. $image_url[0] .') no-repeat center center; background-size:cover;"';
	}
?>
<!-- article -->
<article id="post-<?php the_ID(); ?>" class="blog-excerpt bg-fade-blue-green <?=$classes?>" <?=$bg?>>

	<a class="block absolute-fill" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>

	<div class="item-copy">
		<!-- post title -->
		<h2 class="<?=$titleClass?> item-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->

		<!-- post details -->
		<div class="row item-meta">
			<?php $authorclass = ''; if(!$isFeatured){	$authorclass = 'text-default';	} ?>
				<span class="author <?=$authorclass?>">Written by <?php the_author_posts_link(); ?></span>

				<span class="category"><?php //he_category(', ');?><?php include('templates/category-link.php'); ?></span>

		</div>

	</div>


</article>
<!-- /article -->
