

			<div id="comments">

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php get_the_title();
			?></h3>



			<ul class="commentlist">
				<?php
					/*
					 * Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments(  );
				?>
			</ul>



	<?php
	/*
	 * If there are no comments and comments are closed, let's leave a little note, shall we?
	 * But we only want the note on posts and pages that had comments in the first place.
	 */
	if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php echo 'Comments are closed.'; ?></p>
	<?php endif;  ?>

<?php endif; // end have_comments() ?>



</div><!-- #comments -->
