<?php
/**
 * @package studiopaul
 * @since studiopaul 1.0
 */
 $format = get_post_format();
if ( false === $format )
	$format = 'standard';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="sectiontitlepost"><h1><?php the_title(); ?></h1></div>
			<div class="entry-meta">
			<?php studiopaul_posted_on(); ?>
			<span class="right"><a href="<?php comments_link(); ?>"><?php comments_number('<span>No</span> Comments', '<span>One</span> Comment', '<span>%</span> Comments' );?></a></span>
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'studiopaul' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	
	<div class="clear" style="margin-top:10px;"></div>
	<footer class="entry-meta">
	<?php
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'studiopaul' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'studiopaul' ) );
		if ( '' != $tag_list ) {
			$utility_text = __( 'Posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>.', 'studiopaul' );
		} elseif ( '' != $categories_list ) {
			$utility_text = __( 'Posted in %1$s by <a href="%6$s">%5$s</a>.', 'studiopaul' );
		} else {
			$utility_text = __( 'Posted by <a href="%6$s">%5$s</a>.', 'studiopaul' );
		}

		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			esc_url( get_permalink() ),
			the_title_attribute( 'echo=0' ),
			get_the_author(),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
		);
	?>
	<?php edit_post_link( __( 'Edit', 'studiopaul' ), '<span class="edit-link">', '</span>' ); ?>	
	</footer><!-- .entry-meta -->
	
	<?php if(of_get_option('vazz_authorbox') == '1') : ?>
	<div style="height:10px;"></div>
	<div id="authorbox" class="panel clear">  
    <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>  
    <div class="authortext">  
       <h4><?php _e( 'ABOUT', 'studiopaul' ); ?> <?php the_author_posts_link(); ?></h4>  
       <p><?php the_author_meta('description'); ?></p> 
       <p class="author_email"><a href="mailto:<?php the_author_meta('email'); ?>" title="Send an Email to the Author of this Post">Contact the author</a></p>	   
    </div>  
	</div><div style="height:5px;"></div>
	<?php endif ?>
</article><!-- #post-<?php the_ID(); ?> -->