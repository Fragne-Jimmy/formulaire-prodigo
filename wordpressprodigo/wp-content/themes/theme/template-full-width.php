<?php 
/*
 * Template Name: Full Width
 */
 
 get_header(); ?>
 
<!-- Subheader
================================================== -->
<div id="subheader" class="inshadow page">
	<div class="row">
		<div class="twelve columns">
			<p class="left">
				<span class="upperc"><?php the_title(); ?></span>
			</p>
			<p class="right">
				 <?php echo get_post_meta($post->ID, 'sp_pagedesc', true); ?>
			</p>
		</div>
	</div>
</div>
<div class="hr">
</div>

<!-- Full width page
================================================== -->
<div class="row">
<div class="twelve columns">
<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content', 'page' ); ?>					
	<?php if ( comments_open() || '0' != get_comments_number() )
			comments_template( '', true ); ?>
	<?php endwhile; // end of the loop. ?>
</div><!-- .twelve columns -->
</div><!-- .row -->
<?php get_footer(); ?>