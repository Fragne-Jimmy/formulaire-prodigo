<?php
/**
 * The template for Archive pages.
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
				<?php
					if ( is_category() ) {
						printf( __( 'Category Archives: %s', 'studiopaul' ), '<span>' . single_cat_title( '', false ) . '</span>' );

					} elseif ( is_tag() ) {
						printf( __( 'Tag Archives: %s', 'studiopaul' ), '<span>' . single_tag_title( '', false ) . '</span>' );

					} elseif ( is_author() ) {
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						*/
						the_post();
						printf( __( 'Author Archives: %s', 'studiopaul' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					} elseif ( is_day() ) {
						printf( __( 'Daily Archives: %s', 'studiopaul' ), '<span>' . get_the_date() . '</span>' );

					} elseif ( is_month() ) {
						printf( __( 'Monthly Archives: %s', 'studiopaul' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					} elseif ( is_year() ) {
						printf( __( 'Yearly Archives: %s', 'studiopaul' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					} else {
						_e( 'Archives', 'studiopaul' );

					}
				?>
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
	<!-- Archive Style 1
	================================================== -->
	<?php if(of_get_option('vazz_archivestyle') == 'archivestyleone') { ?>
	<div class="eight columns">	
	<?php if ( have_posts() ) : ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>			
	<div class="circledate">
	<div class="textcircle">
		- <?php the_time('d'); ?> -<div class="datepause"></div><?php the_time('M'); ?><div class="datepause"></div><?php the_time('Y'); ?>
	</div>
	</div>
	<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( '', 'studiopaul' ); ?> <?php the_title(); ?>" class="titleblack"><?php _e( '', 'studiopaul' ); ?> <?php the_title(); ?></a> <span class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('<span>No</span> Comments', '<span>One</span> Comment', '<span>%</span> Comments' );?></a></span></h4>
	<div class="dots blogdots"></div>				
	<?php echo get_custom_excerpt(725); ?>...
	<p class="floatright continueread"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Continue reading: ', 'studiopaul' ); ?><?php the_title(); ?>">Continue reading</a></p>
	<div class="clear"></div>
	<?php endwhile; ?>			
	<div class="negamargin">
	<?php vazz_pagination(); ?>
	</div>
	<?php else : ?>
	<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>						
	</div>
	<?php } ?>

	<!-- Archive Style 2
	================================================== -->
	<?php if(of_get_option('vazz_archivestyle') == 'archivestyletwo') { ?>
	<div class="eight columns noleftmargin">	
	<?php if ( have_posts() ) : ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="six columns">
	<div class="boxblog">
	<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( '', 'studiopaul' ); ?> <?php the_title(); ?>"><?php if (strlen($post->post_title) > 18) {echo substr(the_title($before = '', $after = '', FALSE), 0, 18) . '...'; } else {the_title();} ?></a></h5>
	<p class="small datepost">
	Posted on <?php echo the_time('Y-m-d'); ?> 
	<span class="floatright" title="<?php comments_number( 'no responses', 'one response', '% responses' ); ?>"><a href="<?php comments_link(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/comments.png" alt=""></a></span>
	</p>
	<div class="innerblogboxtwo">
	<p>
	<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
	<?php if(has_post_thumbnail()) :?>
	<?php echo get_custom_excerpt(192); ?>...
	<?php else :?>
	<?php echo get_custom_excerpt(270); ?>...
	<?php endif;?>
	</p>
	</div>
	<p class="continueread readmorebox"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Continue reading: ', 'studiopaul' ); ?><?php the_title(); ?>">Continue reading</a></p>
	</div>
	</div>
	<?php endwhile; ?>
	<?php vazz_pagination(); ?>
	<?php else : ?>
	<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
	</div>
	<?php } ?>

	<!-- Archive Style 3
	================================================== -->
	<?php if((of_get_option('vazz_archivestyle') == 'archivestylethree') || (of_get_option('vazz_archivestyle') == '')) { ?>			
	<div class="eight columns noleftmargin">	
	<?php if ( have_posts() ) : ?>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="four columns">
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<div class="boxblog">
	<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( '', 'studiopaul' ); ?> <?php the_title(); ?>"><?php if (strlen($post->post_title) > 18) {echo substr(the_title($before = '', $after = '', FALSE), 0, 18) . '...'; } else {the_title();} ?></a></h5>
	<p class="small datepost">
	Posted on <?php echo the_time('Y-m-d'); ?> 
	<span class="floatright" title="<?php comments_number( 'no responses', 'one response', '% responses' ); ?>"><a href="<?php comments_link(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/comments.png" alt=""></a></span>
	</p>
	<div class="innerblogboxthree"><p><?php echo get_custom_excerpt(135);?>...</p></div>
	<p class="continueread readmorebox"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Continue reading: ', 'studiopaul' ); ?><?php the_title(); ?>">Continue reading</a></p>
	</div>
	</div>
	</div>
	<?php endwhile; ?>
	<div class="clear"></div>
	<?php vazz_pagination(); ?>
	<?php else : ?>
	<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>	
	</div>	
	<?php } ?>
	<!-- End Styles
	================================================== -->
<?php get_sidebar(); ?>
</div><!-- .row -->
<?php get_footer(); ?>