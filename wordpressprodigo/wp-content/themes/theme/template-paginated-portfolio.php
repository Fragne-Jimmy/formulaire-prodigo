<?php 
/*
 * Template Name: Portfolio Simple
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
<div class="minipause"></div>
<style>
.item {float:left;}
</style>
<?php 
wp_enqueue_script('vuzzprettyPhoto');
wp_enqueue_script('vuzzisotope'); 
?>
<!-- Portfolio with pagination
================================================== -->
	<?php
	$paged = 1;  
	if ( get_query_var('paged') ) $paged = get_query_var('paged');  
	if ( get_query_var('page') ) $paged = get_query_var('page');  
	query_posts( '&post_type=myportfolio&paged=' . $paged );
	?>

	<?php if((of_get_option('vazz_portfoliostyle') == 'portfoliotwo') || (of_get_option('vazz_portfoliostyle') == '')) { ?>
	<!-- Portfolio 2 Columns
	================================================== -->
	<div id="container" class="row">			
	<ul>
	<?php						
	if (have_posts()) : while (have_posts()) : the_post(); 			
	$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
	<!--BEGIN .item -->	
	<li class="six columns item">
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
		<?php if ( has_post_thumbnail() ) : ?>
		<!-- .post-details -->
		<h5 class="portfoliotitle"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'studiopaul'), get_the_title()); ?>"><?php the_title(); ?></a></h5>
			<?php the_excerpt(); ?>
		<!-- /.post-details -->		
			 <div class="roll">						
					<div class="innerp ca-icon">
					<a href="<?php the_permalink(); ?>" class="innerlinkp">K</a>  
					<a data-gal="prettyPhoto[gallery]" href="<?php echo $imgurl; ?>" title="<?php the_title(); ?>"><span class="innergalleryp">L</span></a>					
					</div>
			</div>					 
			<?php the_post_thumbnail('portfolio2-thumb'); ?>		
		</div>
		<?php endif; ?>
	</li>			
	<!--END .item -->			
	<?php endwhile; endif; ?>
	</ul>		
	</div>	
	<?php } ?>		


	<?php if(of_get_option('vazz_portfoliostyle') == 'portfoliothree') { ?>
	<!-- Portfolio 3 Columns
	================================================== -->
	<div id="container" class="row">			
	<ul>
	<?php						
	if (have_posts()) : while (have_posts()) : the_post(); 			
	$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
	<!--BEGIN .item -->	
	<li class="four columns item" style="float:left;">
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
		<?php if ( has_post_thumbnail() ) : ?>
		<!-- .post-details -->
		<h5 class="portfoliotitle"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'studiopaul'), get_the_title()); ?>"><?php the_title(); ?></a></h5>
			<?php the_excerpt(); ?>
		<!-- /.post-details -->		
			 <div class="rollthree">						
					<div class="innerpthree ca-icon">
					<a href="<?php the_permalink(); ?>" class="innerlinkpthree">K</a>  
					<a data-gal="prettyPhoto[gallery]" href="<?php echo $imgurl; ?>" title="<?php the_title(); ?>"><span class="innergalleryp">L</span></a>			
					</div>
			</div>					 
			<?php the_post_thumbnail('portfolio3-thumb'); ?>		
		</div>
		<?php endif; ?>
	</li>			
	<!--END .item -->			
	<?php endwhile; endif; ?>		
	</ul>		
	</div>
	<?php } ?>


	<?php if(of_get_option('vazz_portfoliostyle') == 'portfoliofour') { ?>
	<!-- Portfolio 4 Columns
	================================================== -->
	<div id="container" class="row">			
	<ul id="ulportfolio">
	<?php						
	if (have_posts()) : while (have_posts()) : the_post(); 			
	$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
	<!--BEGIN .item -->	
	<li class="three columns item">
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
		<?php if ( has_post_thumbnail() ) : ?>
		<!-- .post-details -->
		<h5 class="portfoliotitle"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'studiopaul'), get_the_title()); ?>"><?php the_title(); ?></a></h5>
			<?php the_excerpt(); ?>
		<!-- /.post-details -->		
			 <div class="rollfour">						
					<div class="innerpfour ca-icon">
					<a href="<?php the_permalink(); ?>" class="innerlinkpfour">K</a>  
					<a data-gal="prettyPhoto[gallery]" href="<?php echo $imgurl; ?>" title="<?php the_title(); ?>"><span class="innergalleryp">L</span></a>			
					</div>
			</div>					 
			<?php the_post_thumbnail('portfolio4-thumb'); ?>		
		</div>
		<?php endif; ?>
	</li>			
	<!--END .item -->			
	<?php endwhile; endif; ?>
	</ul>		
	</div>			
	<?php } ?>		

	<div class="row">
	<?php vazz_pagination(); ?>
	</div>				
<?php get_footer(); ?>