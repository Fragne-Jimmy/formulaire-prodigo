<?php
	// Add Social Media Widget
	class vazz_SocialMedia_Widget extends WP_Widget {
		function vazz_SocialMedia_Widget() {
			$widget_ops = array('classname' => 'theme_socialmedia', 'description' => __('Show your Social Media Buttons', 'themezee_lang') );
			$this->WP_Widget('theme_socialmedia', '&raquo; Vuzz Social', $widget_ops);
		}
	 
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			
			$url = get_template_directory_uri() . '/images/socialpack';
			$options = of_get_option('');
			$networks = '';
			
			// Output
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		?>
			
			<ul id="social-links">	
			<?php 
				// Twitter Button
				if(of_get_option('vazz_twitter') != ''){ ?> 
				<li class="twitter-link">
				<a href="<?php echo of_get_option('vazz_twitter'); ?>" class="twitter" target="_blank" title="Follow Us on Twitter">Twitter</a>					
				</li>
				<?php } 				
				
				// Facebook Button
				if(of_get_option('vazz_facebook') != ''){ ?> 
				<li class="facebook-link">
				<a href="<?php echo of_get_option('vazz_facebook'); ?>" class="facebook" target="_blank" title="Join us on Facebook">Facebook</a>					
				</li>
				<?php } 
				
				// Google Button
				if(of_get_option('vazz_google') != ''){ ?> 
				<li class="google-link">
				<a href="<?php echo of_get_option('vazz_google'); ?>" class="google" target="_blank" title="Google +">Google</a>					
				</li>
				<?php } 
				
				// Dribbble Button
				if(of_get_option('vazz_dribbble') != ''){ ?> 
				<li class="dribbble-link">
				<a href="<?php echo of_get_option('vazz_dribbble'); ?>" class="dribbble" target="_blank" title="Dribbble">Dribbble</a>					
				</li>
				<?php }
				
				// Vimeo Button
				if(of_get_option('vazz_vimeo') != ''){ ?> 
				<li class="vimeo-link">
				<a href="<?php echo of_get_option('vazz_vimeo'); ?>" class="vimeo" target="_blank" title="Vimeo">Vimeo</a>					
				</li>
				<?php }	
				
				// Skype Button
				if(of_get_option('vazz_skype') != ''){ ?> 
				<li class="skype-link">
				<a href="<?php echo of_get_option('vazz_skype'); ?>" class="skype" target="_blank" title="Skype">Skype</a>					
				</li>
				<?php }	
				
				// Linkedin Button
				if(of_get_option('vazz_linkedin') != ''){ ?> 
				<li class="linkedin-link">
				<a href="<?php echo of_get_option('vazz_linkedin'); ?>" class="linkedin" target="_blank" title="Linkedin">Linkedin</a>					
				</li>
				<?php }	
				
				// Pinterest Button
				if(of_get_option('vazz_pinterest') != ''){ ?> 
				<li class="pinterest-link">
				<a href="<?php echo of_get_option('vazz_pinterest'); ?>" class="pinterest" target="_blank" title="Pinterest">Pinterest</a>					
				</li>
				<?php }
				
				// RSS Button
				if ( of_get_option('vazz_rss')== '1') { ?>
				<li class="rss-link">
				<a href="<?php echo site_url(); ?>/feed/rss/" class="rss" title="RSS Feeds">RSS Feeds</a>					
				</li>
				<?php } 
				
				if(of_get_option('vazz_extrss') != ''){ ?> 
				<li class="rss-link">
				<a href="<?php echo of_get_option('vazz_extrss'); ?>" class="rss" target="_blank" title="RSS Feeds">RSS Feeds</a>					
				</li>
				<?php }
				
			?>
			</ul>
			<div class="clear"></div>
		<?php
			echo $after_widget;
		}
	 
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = isset($new_instance['title']) ? esc_attr($new_instance['title']) : '';
			return $instance;
		}
	 
		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themezee_lang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
		}
	}
	register_widget('vazz_SocialMedia_Widget');
?>