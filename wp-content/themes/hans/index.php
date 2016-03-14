<?php get_header(); ?>
<div class="loadverlay"></div>
<div class="fullslider">
	<?php 

		$slider_images = get_slider_images();
		foreach ( $slider_images as $image) {
			$image_id = $image->ID;
			$get_thumb = wp_get_attachment_image_src( $image_id, 'slider');
			$url = $get_thumb[0];
			?>
			<div class="slide" style="background:url('<?php echo $url;?>') no-repeat center center fixed; background-size:cover;">
			</div>
			<?php 
		}
	?>

</div>

<?php get_footer(); ?>