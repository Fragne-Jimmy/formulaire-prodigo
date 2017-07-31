<?php 
/*
 * Template Name: Portfolio Filterable
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
<?php 
wp_enqueue_script('vuzzprettyPhoto');
wp_enqueue_script('vuzzisotope'); 
?>
	<!-- Portfolio Categories
	================================================== -->
	<div class="row">
	<div class="twelve columns">
	<section id="options" class="clearfix">
	<!-- #filter -->
	<ul id="filter">
		<li id="all" class="portofoliobutton current"><a href="#" data-filter="*"><?php _e('Show all', 'studiopaul'); ?></a></li>
		<?php
		wp_list_categories( array(
				'taxonomy' => 'portfolio-categories',
				'hide_empty' => 0,
				'title_li' => '',
				'depth' => 1,
				'walker' => new Category_Walker(),
				'show_option_none' => ''
			) 
		); 
		?>			
	</ul>
	</section>
	</div>
	</div><div class="minipause"></div>
	
	<?php if((of_get_option('vazz_portfoliostyle') == 'portfoliotwo') || (of_get_option('vazz_portfoliostyle') == '')) { ?>
	<!-- Portfolio 2 Columns
	================================================== -->
	<div id="container" class="row">			
	<ul id="ulportfolio">
	<?php 				
	$all_terms = get_terms( 'portfolio-categories', array('hide_empty' => 0 ) );				
	$count = 1;					
	$args = array(
		'post_type' => 'filterable-portfolio',
		'posts_per_page' => -1
	);				
	query_posts($args);				
	if (have_posts()) : while (have_posts()) : the_post(); 				
	$terms = get_the_terms( get_the_ID(), 'portfolio-categories' ); 				
	$featured = get_post_meta(get_the_ID(), 'pt_featured', TRUE); 
	$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>			
	
	<!--BEGIN .item -->	
	<li data-order='<?php echo $count; ?>' data-id="id-<?php echo $count; ?>" class="six columns item <?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->term_id.' '; } endif; ?>">
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
	<?php $count++; endwhile; endif; ?>		
	</ul>       
	</div>
	<div class="clear"></div>
	<?php } ?>


	<?php if(of_get_option('vazz_portfoliostyle') == 'portfoliothree') { ?>
	<!-- Portfolio 3 Columns
	================================================== -->
	<div id="container" class="row">
	<ul id="ulportfolio">
	<?php 				
	$all_terms = get_terms( 'portfolio-categories', array('hide_empty' => 0 ) );				
	$count = 1;					
	$args = array(
		'post_type' => 'filterable-portfolio',
		'posts_per_page' => -1
	);				
	query_posts($args);				
	if (have_posts()) : while (have_posts()) : the_post(); 				
	$terms = get_the_terms( get_the_ID(), 'portfolio-categories' ); 				
	$featured = get_post_meta(get_the_ID(), 'pt_featured', TRUE); 
	$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
	<!--BEGIN .item -->	
	<li data-order='<?php echo $count; ?>' data-id="id-<?php echo $count; ?>" class="four columns portfoliothree item <?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->term_id.' '; } endif; ?>" style="float:left;">
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<!-- .post-details -->
		<h5 class="portfoliotitle"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'studiopaul'), get_the_title()); ?>"><?php the_title(); ?></a></h5>
			<?php the_excerpt(); ?>
		<!-- /.post-details -->		
			 <div class="rollthree">
					<div class="innerpthree ca-icon">
					<a href="<?php the_permalink(); ?>" class="innerlinkp">K</a>
					<a data-gal="prettyPhoto[gallery]" href="<?php echo $imgurl; ?>" title="<?php the_title(); ?>"><span class="innergalleryp">L</span></a>
					</div>
			</div>
			<?php the_post_thumbnail('portfolio3-thumb'); ?>		
		</div>
		<?php endif; ?>
	</li>
	<!--END .item -->
	<?php $count++; endwhile; endif; ?>
	</ul>
	</div>
	<div class="clear"></div>
	<?php } ?>		


	<?php if(of_get_option('vazz_portfoliostyle') == 'portfoliofour') { ?>
	<!-- Portfolio 4 Columns
	================================================== -->
	<div id="container" class="row">			
	<ul id="ulportfolio">
	<?php 				
	$all_terms = get_terms( 'portfolio-categories', array('hide_empty' => 0 ) );				
	$count = 1;					
	$args = array(
		'post_type' => 'filterable-portfolio',
		'posts_per_page' => -1
	);				
	query_posts($args);				
	if (have_posts()) : while (have_posts()) : the_post(); 				
	$terms = get_the_terms( get_the_ID(), 'portfolio-categories' ); 				
	$featured = get_post_meta(get_the_ID(), 'pt_featured', TRUE); 
	$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>			
	
	<!--BEGIN .item -->	
	<li data-order='<?php echo $count; ?>' data-id="id-<?php echo $count; ?>" class="three columns portfoliofour item <?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->term_id.' '; } endif; ?>">
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<!-- .post-details -->
		<h5 class="portfoliotitle"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'studiopaul'), get_the_title()); ?>"><?php the_title(); ?></a></h5>
			<?php the_excerpt(); ?>
		<!-- /.post-details -->		
			 <div class="rollfour">
					<div class="innerpfour ca-icon">
					<a href="<?php the_permalink(); ?>" class="innerlinkp">K</a>  
					<a data-gal="prettyPhoto[gallery]" href="<?php echo $imgurl; ?>" title="<?php the_title(); ?>"><span class="innergalleryp">L</span></a>			
					</div>
			</div>					 
			<?php the_post_thumbnail('portfolio4-thumb'); ?>		
		</div>
		<?php endif; ?>
	</li>
	<!--END .item -->			
	<?php $count++; endwhile; endif; ?>		
	</ul>       
	</div>
	<div class="clear"></div>
	<?php } ?>
		

<?php get_footer(); ?>