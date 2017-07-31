<?php
/**
 * @package studiopaul
 * @since studiopaul 1.0
 */
 
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');
  if ( post_password_required() ) { ?>
  	<div class="help">
    	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','studiopaul'); ?></p>
  	</div>
  <?php
    return;
  }
?>
<div id="comments" class="comments-area">
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>	
	<div class="clear comments-title">
		<?php
			printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'studiopaul' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
		?>
	</div>
	<ol class="commentlist">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use studiopaul_comment() to format the comments.
			 */
			wp_list_comments( array( 'callback' => 'studiopaul_comment' ) );
		?>
	</ol><!-- .commentlist -->	
	<div class="pagination-comments">
		<?php paginate_comments_links(); ?> 
	</div>
	<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but there are no comments. -->
	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<p class="nocomments"><?php _e('Comments are closed.','studiopaul'); ?></p>
	<?php endif; ?>
<?php endif; ?>
</div>
<?php if ( comments_open() ) : ?>
<?php comment_form(); ?>
<?php endif; // if you delete this the sky will fall on your head ?>