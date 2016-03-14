<?php /* Template Name: Contact*/ ?>
<?php get_header(); ?>
<div class="loadverlay"></div>
<?php 
				if (have_posts()) :
				  if ( has_post_thumbnail() ) {
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'slider')); ?>
    <div class="background-holder" style="background:url(<?php echo $url ?>) no-repeat; background-size:cover;">
	</div>
<?php }
				endif;
				?>
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
			<h2>Contactformulier</h2>
				

			<?php echo do_shortcode( '[contact-form-7 id="79" title="Contactformulier"]' ); ?>
		
		</div>
	</div>
</div>

<?php get_footer(); ?>
