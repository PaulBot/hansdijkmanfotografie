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
				      the_post();
				        the_content();
				   endwhile;
				endif;
				?>
			</div>
		</div>
		<div class="imagecontent">
			<?php 
				for ($i = 1; $i <= 10; $i++) {
					$field = 'afbeelding_' . $i;
				    $image = get_field($field);


					if( !empty($image) ){ ?>
						


					 <img src="<?php echo $image['sizes']['text']; ?>" alt="<?php echo $image['alt']; ?>" /> 
					<?php }

				}
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
