<?php
/*
 * Template Name: Homepage
 */
get_header(); ?>
<?php if ( of_get_option('vazz_slideroption')== '1') 
{ 
$homestyle = of_get_option('vazz_homestyle') ;
get_template_part($homestyle); 
} 
else { ?>
<!-- SUBHEADER
================================================== -->
<div id="subheader" class="inshadow subheadertext">
	<div class="row">
		<div class="twelve columns">
			<div class="noslide">
				<h1><?php echo of_get_option('vazz_homeheader') ?></h1>
				<h3><?php echo of_get_option('vazz_homedescription') ?></h3>
				<div class="minipause"></div><br>
			<a href="<?php echo of_get_option('vazz_homeactionbuttonlink') ?>" class="clear actbutton"><?php echo of_get_option('vazz_homeactionbutton') ?></a>
			</div>
		</div>
	</div>
</div>
<?php 
}?>
<!-- HOME WIDGETS
================================================== -->
<?php if (is_sidebar_active('home-page')) : ?>	
<!-- home widgets begin --> 
<?php dynamic_sidebar('home-page'); ?>
<!-- home widgets end -->
<?php else : ?>
		<!-- This content shows up if there are no widgets defined in the backend. -->
		<?php if(current_user_can('edit_theme_options')) : ?>
		<div class="help">	
			<p>
				<?php _e("Please activate some widgets in Blog area.", "studiopaul"); ?>			
				<a href="<?php echo admin_url('widgets.php')?>" class="add-widget"><?php _e("Add Widget", "studiopaul"); ?></a>			
			</p>	
		</div>
		<?php endif ?>	
	<?php endif; ?>

<!-- CONTENT
================================================== -->
<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content clear twelve columns">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'studiopaul' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'studiopaul' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->				
<?php endwhile; // end of the loop. ?>	
</div>

<!-- FROM THE BLOG
================================================== -->
<?php if(of_get_option('vazz_recentpostscarousel') == '1') { 
wp_enqueue_script('vuzzmousewheel');
wp_enqueue_script('vuzzcontentcarousel');
?>
<div class="hr"></div>
<div class="row">
<div class="twelve columns">
	<div class="centersectiontitle">
		<h1 class="hometitles"><?php _e( 'FROM THE BLOG', 'studiopaul' ); ?></h1>
	</div>
	<div id="recentpostscontainer" class="recentpostscontainer">
		<div class="recentpostswrapper">
		 <?php	
			$carouselPosts = new WP_Query();
			$carouselPosts->query('showposts=10');
			?>
			<?php while ($carouselPosts->have_posts()) : $carouselPosts->the_post(); ?>       
				<div class="recentpostsitem recentpostsitem-1">
					<div class="recentpostsitem-main">				
						<div class="recentpostsicon"><?php the_post_thumbnail('home-recenposts-thumb'); ?></div>
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( '', 'studiopaul' ); ?> <?php the_title(); ?>" style="color:#222;"><?php if (strlen($post->post_title) > 18) {echo substr(the_title($before = '', $after = '', FALSE), 0, 18) . '...'; } else {the_title();} ?></a></h3>
						<h4>
							<span class="recentpostsquote">&ldquo;</span>
							<span><a href="<?php the_permalink() ?>" rel="bookmark" title=""><?php echo get_custom_excerpt(200); ?>...</a></span>
						</h4>
							<a href="#" class="recentpostsmore">more...</a>					
					</div>
					<div class="recentpostscontent-wrapper">
						<div class="recentpostscontent">
							<h6><?php echo get_the_title(); ?></h6>
							<a href="#" class="recentpostsclose">close</a>
							<div class="recentpostscontent-text">
								<?php echo get_custom_excerpt(700); ?>...
							</div>
							<ul>
								<li><a href="<?php the_permalink() ?>">Read full post</a></li>									
							</ul>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div><!-- .recentpostswrapper -->
	</div><!-- .recentpostscontainer -->
</div><!-- .twelve columns -->
</div><!-- .row -->
<?php } ?>
<?php get_footer(); ?>