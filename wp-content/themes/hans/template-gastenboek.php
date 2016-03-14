<?php /* Template Name: Gastenboek*/ ?>
<?php get_header(); ?>
<div class="loadverlay"></div>
<div class="contentcontainer">
	<div class="holder clearfix">
		<div class="sidebar">
			<h2> <?php the_title(); ?> </h2>
			<img src="<?php echo get_template_directory_uri();?>/assets/images/camera-outline.svg">
	
			<div class="textcontent">
				<h2> <?php the_title(); ?> </h2>
				<?php 
				if (have_posts()) :
				   while (have_posts()) :
				      the_post();
				        the_content();
				   endwhile;
				endif;
				?>
				<?php  comment_form(); ?>
			</div>
		</div>
		<div class="comments">

			<?php   $comments = get_comments(); 

			foreach ($comments as $comment) {
				if($comment->comment_approved == 1){ ?>
					
					<div class="comment">
						<div class="name"><h3><?php echo $comment->comment_author ?></h3></div>
						<div class="message">
							<?php echo $comment->comment_content ?>
						</div>
					</div>

				<?php }
			}
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
