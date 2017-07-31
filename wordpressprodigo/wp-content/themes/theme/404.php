<?php
/**
 * The template for 404 pages (Not Found).
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
get_header(); ?>
<!-- Subheader 
================================================== -->
<div id="subheader" class="inshadow">
	<div class="row">
		<div class="eight columns">
			<p class="bread leftalign">
				Use the search box...
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
	<div id="primary" class="content-area">
		<div id="content" class="twelve columns site-content" role="main">
			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h4 class="entry-title colorme" class="bitteritalic"><?php _e( 'Sorry, the page you are looking for cannot be found.', 'studiopaul' ); ?></h4>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<p><?php _e( 'You may like to try the search at the top right of this page, browse our menu or visit one of the links below.', 'studiopaul' ); ?></p>
					<div class="minipause"></div>
					<div class="four columns noleftmargin">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					</div>					
					<div class="four columns">
					<div class="widget">
					<h4 class="widgettitle"><?php _e( 'Most Used Categories', 'studiopaul' ); ?></h4>
					<ul>
					<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
					</ul>
					</div><!-- .widget -->
					</div>					
					<div class="four columns">
					<?php
					the_widget( 'WP_Widget_Archives', 'dropdown=1' );
					?>
					</div>				
				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->
		</div><!-- #content .twelve columns site-content -->
	</div><!-- #primary .content-area -->	
</div><!-- .row -->	
<?php get_footer(); ?>