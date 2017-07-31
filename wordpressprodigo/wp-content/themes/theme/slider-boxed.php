<?php
/**
 * The Template for slider boxed (homepage).
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>
<!-- BOXED SLIDER
================================================== -->
<div id="subheader" class="page pageboxedslider">
	<div class="row">
		<div class="twelve columns">
		<?php 
		function efs_get_slider(){
		// Enque flexslider script
		wp_enqueue_script('vuzzflexslider');
		 $slider= '<div class="flexslider">
		 <ul class="slides">';
		 $efs_query= "post_type=slides";  
		 $myposts = get_posts($efs_query);
			foreach($myposts as $post) : setup_postdata($post);
			   $attr = array(
										'title' => "",
										'alt' => ""
									);
			   $img= get_the_post_thumbnail( $post->ID, 'full', $attr);
			   $slide_link= get_post_meta( $post->ID, 'sp_studiopaul_slideurl', true);
			   $slide_caption= get_post_meta( $post->ID, 'sp_studiopaul_description', true);
			   if($slide_link != '') { 
			   $slider.='<li><a href='.$slide_link.'>'.$img.'</a><div class="flex-caption">'.$slide_caption.'</div></li>';
				}
			   else {
				$slider.='<li>'.$img.'<div class="flex-caption">'.$slide_caption.'</div></li>';
				}
			endforeach;
		 $slider.= '</ul>
		 </div>';
		 return $slider;
		 }
		?>
		<?php print efs_get_slider(); ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/boxedshadow.png" class="shadowsliderboxed">
		</div>
	</div>
</div>
<!-- END SLIDER
================================================== -->
<br class="clear">