
<?php get_header(); ?>
<div class="loadverlay"></div>
<div class="contentcontainer">
		<h2><?php the_title(); ?></h2>
		<section class="categories">

			<?php 

			$taxonomies = array( 
    			'media_category',
			);

			$homeslider =  get_term_by( 'name', 'homeslider', 'media_category' );
			$homeslider_id = $homeslider->term_id;
			 
			$args = array(
			    'hide_empty'        => true, 
			    'hierarchical'      => true,
			    'exclude'     		 => $homeslider_id, 
			); 

			$terms = get_terms($taxonomies, $args);
			if($terms){
				foreach ($terms as $term) {?>
					<div class="blogitem">
						<a href="<?php echo get_term_link( $term, 'media_category' ); ?>" title="<?php echo $term->name ?>">
							<figure>
								<?php if (function_exists('z_taxonomy_image_url')){ 
									$image_url =  z_taxonomy_image_url($term->term_id, 'text');
									?> <img src="<?php echo $image_url; ?>" title="<?php echo $term->name; ?>">
								<?php } ?>

							</figure>
							<div class="info">
								<h3><?php echo $term->name; ?></h3>
							</div>
						</a>
					</div>
						
					<?php }
				} ?>

		</section>
		
</div>

<?php get_footer();
