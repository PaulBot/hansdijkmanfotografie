<?php get_header(); 
	$queried_object = get_queried_object();
	$category = $queried_object->slug;
	$images = get_library_images($category); 

?>
<div class="loadverlay"></div>
<div class="contentcontainer images">
	<div class="holder">
		<section class="gallery" id="lightbox">
			<?php

				foreach ($images as $image) { 
				$image_id = $image->ID;
				$get_thumb = wp_get_attachment_image_src( $image_id, 'gallery');
				$get_full = wp_get_attachment_image_src( $image_id, 'full');

				$thumb_url = $get_thumb[0];
				$full = $get_full[0];

				if($get_thumb[1] > $get_thumb[2]){
					$class="item";
				} else {
					$class="item item-2";
				}

				?>
	
					<a  href="<?php echo $full; ?>"  class="<?php echo $class;?>" data-caption="<?php echo $image->post_content?>" >
						<img src="<?php echo $thumb_url ?>"  class="item" alt="<?php echo $image->post_title ?>" >
					</a>

				<?php } ?>
			</div>
		</section>
	</div>
</div>

<?php get_footer();
