<?php
 
    add_action('widgets_init', 'anim_widget'); 
 
    function anim_widget() { // function name matches name from add_action
        register_widget('Anim_Widget');
    }
 
    class Anim_Widget extends WP_Widget {
 
        function Anim_Widget() { // function name matches class name
            $widget_ops = array(			    
                'classname'=>'animatedboxes-widget', // class that will be added to li element in widgeted area ul
                'description'=>'Drag this to homepage area and edit.' // description displayed in admin
                );
            $control_ops = array(
                'width'=>200, 'height'=>250, // width of input widget in admin
                'id_base'=>'animatedboxes-widget' // base of id of li element ex. id="animatedboxes-widget-1"
                );
            $this->WP_Widget('animatedboxes-widget', '&raquo; 1. Vuzz Home Animated Boxes', $widget_ops, $control_ops); // "Example Widget" will be name in control panel
        }
 
        function widget($args, $instance) {
                extract($args);
				
				$url= $instance['url'];
				$icon= $instance['icon'];				
				$header= $instance['header'];
                $text = $instance['text'];
				
				$url2= $instance['url2'];
				$icon2= $instance['icon2'];				
				$header2= $instance['header2'];
                $text2 = $instance['text2'];
				
				$url3= $instance['url3'];
				$icon3= $instance['icon3'];				
				$header3= $instance['header3'];
                $text3 = $instance['text3'];
				
				$url4= $instance['url4'];
				$icon4= $instance['icon4'];				
				$header4= $instance['header4'];
                $text4 = $instance['text4'];
 
                echo $before_widget;
				
				if ($url) echo '<div class="row"><ul class="twelve columns ca-menu" style="margin-left:15px;margin-right:15px;"><li><a href="'.$url.'">';
				if ($icon) echo '<span class="ca-icon">'.$icon.'</span>';
				if ($header) echo '<div class="ca-content"><h2 class="ca-main">'.$header.'</h2>';
                if ($text) echo '<h3 class="ca-sub">'.$text.'</h3></div></a></li>'; 
				
				if ($url2) echo '<li><a href="'.$url2.'">';
				if ($icon2) echo '<span class="ca-icon">'.$icon2.'</span>';
				if ($header2) echo '<div class="ca-content"><h2 class="ca-main">'.$header2.'</h2>';
                if ($text2) echo '<h3 class="ca-sub">'.$text2.'</h3></div></a></li>'; 
				
				if ($url3) echo '<li><a href="'.$url3.'">';
				if ($icon3) echo '<span class="ca-icon">'.$icon3.'</span>';
				if ($header3) echo '<div class="ca-content"><h2 class="ca-main">'.$header3.'</h2>';
                if ($text3) echo '<h3 class="ca-sub">'.$text3.'</h3></div></a></li>'; 
				
				if ($url4) echo '<li><a href="'.$url4.'">';
				if ($icon4) echo '<span class="ca-icon">'.$icon4.'</span>';
				if ($header4) echo '<div class="ca-content"><h2 class="ca-main">'.$header4.'</h2>';
                if ($text4) echo '<h3 class="ca-sub">'.$text4.'</h3></div></a></li></ul>'; 
 
                echo $after_widget;
				
            }
 
        function update( $new_instance, $old_instance ) {		
            $instance = $old_instance;
			
			$instance['url'] = $new_instance['url'];
			$instance['icon'] = $new_instance['icon'];			
			$instance['header'] = $new_instance['header'];
            $instance['text'] = $new_instance['text'];
			
			$instance['url2'] = $new_instance['url2'];
			$instance['icon2'] = $new_instance['icon2'];			
			$instance['header2'] = $new_instance['header2'];
            $instance['text2'] = $new_instance['text2'];
			
			$instance['url3'] = $new_instance['url3'];
			$instance['icon3'] = $new_instance['icon3'];			
			$instance['header3'] = $new_instance['header3'];
            $instance['text3'] = $new_instance['text3'];
			
			$instance['url4'] = $new_instance['url4'];
			$instance['icon4'] = $new_instance['icon4'];			
			$instance['header4'] = $new_instance['header4'];
            $instance['text4'] = $new_instance['text4'];
 
            return $instance;
        }
 
        function form( $instance ) {
 
            $defaults = array('url' =>'#',
							  'icon' =>'F',							  
							  'header' =>'Responsive<br/>Design',
							  'text' =>'Across all major devices',
							  
							  'url2' =>'#',
							  'icon2' =>'H',							  
							  'header2' =>'Useful Theme<br/>Options',
							  'text2' =>'Friendly documentation',
							  
							  'url3' =>'#',
							  'icon3' =>'N',							  
							  'header3' =>'Alternate<br/>Home Pages',
							  'text3' =>'Full slider, boxed or none',
							  
							  'url4' =>'#',
							  'icon4' =>'K',							  
							  'header4' =>'Filterable<br/>Portfolios',
							  'text4' =>'Isotope & PrettyPhoto');
							  
            $instance = wp_parse_args( (array) $instance, $defaults ); ?> 
            

			<!-- Box 1 -->
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 1</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'url' ); ?>">URL:</label>
                <input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'icon' ); ?>">Icon Letter:</label>
                <input id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" value="<?php echo $instance['icon']; ?>" style="width:100%;" />
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'header' ); ?>">Header Text:</label>
                <input id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" value="<?php echo $instance['header']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'text' ); ?>">Text:</label>
                <input id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo $instance['text']; ?>" style="width:100%;" />
            </p>
			
			
			<!-- Box 2 -->
			
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 2</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'url2' ); ?>">URL:</label>
                <input id="<?php echo $this->get_field_id( 'url2' ); ?>" name="<?php echo $this->get_field_name( 'url2' ); ?>" value="<?php echo $instance['url2']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'icon2' ); ?>">Icon Letter:</label>
                <input id="<?php echo $this->get_field_id( 'icon2' ); ?>" name="<?php echo $this->get_field_name( 'icon2' ); ?>" value="<?php echo $instance['icon2']; ?>" style="width:100%;" />
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'header2' ); ?>">Header Text:</label>
                <input id="<?php echo $this->get_field_id( 'header2' ); ?>" name="<?php echo $this->get_field_name( 'header2' ); ?>" value="<?php echo $instance['header2']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'text2' ); ?>">Text:</label>
                <input id="<?php echo $this->get_field_id( 'text2' ); ?>" name="<?php echo $this->get_field_name( 'text2' ); ?>" value="<?php echo $instance['text2']; ?>" style="width:100%;" />
            </p>
			
			<!-- Box 3 -->
			
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 3</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'url3' ); ?>">URL:</label>
                <input id="<?php echo $this->get_field_id( 'url3' ); ?>" name="<?php echo $this->get_field_name( 'url3' ); ?>" value="<?php echo $instance['url3']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'icon3' ); ?>">Icon Letter:</label>
                <input id="<?php echo $this->get_field_id( 'icon3' ); ?>" name="<?php echo $this->get_field_name( 'icon3' ); ?>" value="<?php echo $instance['icon3']; ?>" style="width:100%;" />
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'header3' ); ?>">Header Text:</label>
                <input id="<?php echo $this->get_field_id( 'header3' ); ?>" name="<?php echo $this->get_field_name( 'header3' ); ?>" value="<?php echo $instance['header3']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'text3' ); ?>">Text:</label>
                <input id="<?php echo $this->get_field_id( 'text3' ); ?>" name="<?php echo $this->get_field_name( 'text3' ); ?>" value="<?php echo $instance['text3']; ?>" style="width:100%;" />
            </p>
			
				<!-- Box 4 -->
			
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 4</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'url4' ); ?>">URL:</label>
                <input id="<?php echo $this->get_field_id( 'url4' ); ?>" name="<?php echo $this->get_field_name( 'url4' ); ?>" value="<?php echo $instance['url4']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'icon4' ); ?>">Icon Letter:</label>
                <input id="<?php echo $this->get_field_id( 'icon4' ); ?>" name="<?php echo $this->get_field_name( 'icon4' ); ?>" value="<?php echo $instance['icon4']; ?>" style="width:100%;" />
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'header4' ); ?>">Header Text:</label>
                <input id="<?php echo $this->get_field_id( 'header4' ); ?>" name="<?php echo $this->get_field_name( 'header4' ); ?>" value="<?php echo $instance['header4']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'text4' ); ?>">Text:</label>
                <input id="<?php echo $this->get_field_id( 'text4' ); ?>" name="<?php echo $this->get_field_name( 'text4' ); ?>" value="<?php echo $instance['text4']; ?>" style="width:100%;" />
            </p>
 
<?php
    }
}

?>
