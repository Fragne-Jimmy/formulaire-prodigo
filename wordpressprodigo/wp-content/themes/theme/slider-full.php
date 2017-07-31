<?php
/**
 * The Template for elastic slider - full (homepage).
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>

<!-- SLIDER
================================================== -->

<div id="ei-slider" class="ei-slider">
<ul class="ei-slider-large">
<?php
// Enque elastic slider script
wp_enqueue_script('vuzzelasticslideshow');

//This is for our custom Slides menu
$args = array( 'post_type' => 'elasticslider', 'orderby' => 'menu_order', 'posts_per_page' => 10);
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>
   <li>
      <?php the_post_thumbnail('full',array('title' => '', 'alt' => '', 'class'	=> "greyScale")); ?>
      <div class="ei-title">
         <h2><?php the_title(); ?></h2>
         <?php the_content(); ?>
      </div>
   </li>
<?php
endwhile;
?>
</ul>
<ul class="ei-slider-thumbs">
   <li class="ei-slider-element">Current</li>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
   <li><a href="#"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
</div><!-- ei-slider -->
<!-- SUBHEADER
================================================== -->
<div id="subheader" class="page clear" style="padding:27px 50px;">
	<div class="row">
		<div class="twelve columns">
			<p class="text-center">
				 <?php echo of_get_option('vazz_underslider') ?>
			</p>
		</div>
	</div>
</div>