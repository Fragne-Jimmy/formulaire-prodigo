<?php
/**
 * The Template for displaying all single posts.
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */

get_header(); ?>

<!-- Subheader 
================================================== -->
<div id="subheader">
	<div class="row">
		<div class="eight columns">
			<p class="bread leftalign">
				 <?php echo CreateBreadcrumb(); ?>
			</p>
		</div>
		<div class="four columns">
		  <?php get_search_form(); ?>
        </div>		  
	</div>
</div>
<div class="hr"></div>
<!-- Content
================================================== -->
<div class="row">
	<div class="eight columns">
		<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'single' ); ?>
		<!-- RELATED POSTS -->
		<?php $orig_post = $post;
		global $post;
		$categories = get_the_category($post->ID);
		if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
		'category__in' => $category_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 3, // Number of related posts that will be shown.
		'ignore_sticky_posts'=>1
		);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
		echo '<div id="related_posts" style="border-bottom: 1px solid #DDD;"><h5>Related Posts</h5><ul>';
		while( $my_query->have_posts() ) {
		$my_query->the_post();?>

		<li>
		<div class="relatedcontent four columns noleftmargin">
		<h6><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( '', 'studiopaul' ); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h6>
		<?php echo get_custom_excerpt(150); ?> [...]<div class="clear"></div>
		<span class="small"><?php the_time('M j, Y') ?></span>
		</div>
		</li>
		<?php
		}
		echo '</ul></div>';
		}
		}
		$post = $orig_post;
		wp_reset_query(); ?>
		<!-- END RELATED POSTS -->			
		<div class="clear"></div><div class="hr"></div>
			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true );
			?>
			<?php endwhile; // end of the loop. ?>
	</div><!-- .eight columns -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>