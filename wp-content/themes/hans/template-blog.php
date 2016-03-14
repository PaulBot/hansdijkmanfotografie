<?php /* Template Name: Blog */ ?>
<?php get_header(); ?>
<div class="loadverlay"></div>
<div class="contentcontainer clearfix overzicht">
	<div class="holder">
	<h2><?php the_title(); ?></h2>
	<?php 
		$args = array(

			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
		
	);
		$posts_array = get_posts( $args ); 

				foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
			<div class="blogitem">
				<a href="<?php the_permalink(); ?>">
					<figure>
						<?php if ( has_post_thumbnail() ) { 
					        the_post_thumbnail('text');
						} 
						?>
					</figure>
					<div class="info">
						<h3><?php the_title(); ?></h3>
						<div class="date">
							<?php echo get_the_date( 'j F Y' ); ?>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach; 
		wp_reset_postdata();
	?>
</div>
</div>

<?php get_footer();
