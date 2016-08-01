<?php
	$categories = get_the_category();
	foreach ( $categories as $category ) :
		$catId = $category->cat_ID;
		$catUrl = get_category_link( $catId );
		// $catIcon = get_field('icon_name', $category->taxonomy .'_'. $category->term_id);
		$catColor = get_field('color', $category->taxonomy .'_'. $category->term_id);
		$catClass = '';
		if($catColor){
			$catClass = 'text-'. $catColor;
		}
?>
		<a class="category-link <?=$catClass?>" href="<?=$catUrl?>">
			<?php /*if($catIcon): ?>
				<div class="gs-svg">
					<?php
					echo file_get_contents( get_template_directory_uri() .'/img/svg/gs_'. $catIcon .'.svg');
					?>
				</div>
			<?php endif; */?>
			<?php echo $category->cat_name; ?>
		</a>
<?php endforeach; ?>
