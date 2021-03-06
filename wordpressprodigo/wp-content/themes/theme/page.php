<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package studiopaul
 * @since studiopaul 1.0
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
				<?php echo get_post_meta( $post->ID, 'sp_pagedesc', true); ?>
			</p>
		</div>
	</div>
</div>
<div class="hr"></div>
<!-- Content
================================================== -->
<div class="row">
	<div class="eight columns">
		<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'page' ); ?>				
		<?php if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>
	</div>
<?php get_template_part( 'page', 'sidebar' ); ?>
</div><!-- row -->
<?php get_footer(); ?>