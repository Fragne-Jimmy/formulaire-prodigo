<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>
<article id="post-0" class="post no-results not-found">	
	<h5><?php _e( 'Nothing Found', 'studiopaul' ); ?></h5>
	<div class="dots"></div>
	<div class="entry-content" style="margin-top:20px;min-height:300px;">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'studiopaul' ), admin_url( 'post-new.php' ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'studiopaul' ); ?></p>
		<?php else : ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'studiopaul' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->