<?php
/**
 * The template for displaying Search Results pages.
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
				<?php printf( __( 'Search Results for: %s', 'studiopaul' ), '<span>' . get_search_query() . '</span>' ); ?>
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
			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'search' ); ?>
				<div class="clear"></div>
				<?php endwhile; ?>
				<div style="margin-left:-15px;"><?php vazz_pagination(); ?></div>
			<?php else : ?>
				<?php get_template_part( 'no-results', 'search' ); ?>
			<?php endif; ?>
</div>
<?php get_sidebar(); ?>
</div><!-- .row -->
<?php get_footer(); ?>