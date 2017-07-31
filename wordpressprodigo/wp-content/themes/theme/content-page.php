<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'studiopaul' ), 'after' => '</div>' ) ); ?>
		<div class="clear"></div><?php edit_post_link( __( 'Edit', 'studiopaul' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->