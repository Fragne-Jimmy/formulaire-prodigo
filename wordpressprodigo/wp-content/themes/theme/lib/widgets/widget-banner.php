<?php
/*
Plugin Name: Mukulla Custom Widgets
Plugin URI: https://gist.github.com/3726056
Description: A test plugin for showing some example widgets
Version: 0.1
Author: norcross
Author URI: http://andrewnorcross.com
License: GPL2
*/
/*
	Copyright 2012 WordPress Facebook Open Graph protocol plugin (email: chuck@rynoweb.com)
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.
	
	This program is distributed in the hope that it will be useful, 
	but WITHOUT ANY WARRANTY; without even the implied warranty of 
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/


// add image and banners

class rkv_speaking_badge extends WP_Widget {
	function rkv_speaking_badge() {
		$widget_ops = array( 'classname' => 'speaking_badge', 'description' => 'Ads, images, banners with link.' );
		$this->WP_Widget( 'speaking_badge', '&raquo; Vuzz Banners, Ads', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		echo '<a href="'.$instance['link'].'" title="'.$instance['text'].'" target="_blank">';
		echo '<img src="'.$instance['image'].'" title="'.$instance['text'].'" alt="'.$instance['text'].'" style="max-width:100% !Important;">';
		echo '</a>';
		echo $after_widget;
		?>
        
        <?php }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['link']	= strip_tags($new_instance['link']);
	$instance['text']	= strip_tags($new_instance['text']);
	$instance['image']	= strip_tags($new_instance['image']);	
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $instance = wp_parse_args( (array) $instance, array( 
			'link'	=> '',
			'text'	=> '',
			'image'	=> '',
			));
		$link	= strip_tags($instance['link']);
		$text	= strip_tags($instance['text']);
		$image	= strip_tags($instance['image']);		
        ?>
		<p><label for="<?php echo $this->get_field_id('link'); ?>">Target Link:<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>">Anchor / Alt Text:<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($text); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('image'); ?>">Image Link:<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></label></p>        
		<?php }

} // class 


// register widget

add_action( 'widgets_init', create_function( '', "register_widget('rkv_speaking_badge');" ) ); ?>