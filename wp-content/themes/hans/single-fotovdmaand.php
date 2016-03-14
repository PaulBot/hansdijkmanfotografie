<?php get_header(); ?>
<div class="loadverlay"></div>
<div class="contentcontainer">
	<div class="holder clearfix">
		<div class="sidebar">
			<h2> <?php the_title(); ?> </h2>
			<img src="<?php echo get_template_directory_uri();?>/assets/images/camera-outline.svg">
			<div class="textcontent">

			<?php 
			if (have_posts()) :

			   	while (have_posts()) :
				   	if ( has_post_thumbnail() ) {
	    				$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'text');
					}
			      	the_post();
			        the_content();
			   	endwhile;
			endif;
			?>
		</div>
		</div>
		
		<div class="imagecontent">
			<img src="<?php echo($url[0]); ?>">
		</div>
	</div>
</div>

<?php get_footer(); ?>
