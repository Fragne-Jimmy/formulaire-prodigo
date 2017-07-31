<?php
/*---------------------------------------------------------------------------------*/
/* Info boxes widget */
/*---------------------------------------------------------------------------------*/
    add_action('widgets_init', 'vuzz_infobox'); 
 
    function vuzz_infobox() { // function name matches name from add_action
        register_widget('Vuzz_infobox');
    }
 
    class Vuzz_infobox extends WP_Widget {
 
        function Vuzz_infobox() { // function name matches class name
            $widget_ops = array(			    
                'classname'=>'vuzz_infobox', // class that will be added to li element in widgeted area ul
                'description'=>'Drag this to homepage area and edit.' // description displayed in admin
                );
            $control_ops = array(
                'width'=>200, 'height'=>250, // width of input widget in admin
                'id_base'=>'vuzz_infobox' // base of id of li element ex. id="vuzz_infobox-1"
                );
            $this->WP_Widget('vuzz_infobox', '&raquo; 2. Vuzz Home Info Boxes', $widget_ops, $control_ops); // "Example Widget" will be name in control panel
        }
 
        function widget($args, $instance) {
                extract($args);
				
				$spheader= $instance['spheader'];
				
				$sptitle= $instance['sptitle'];
				$sptext= $instance['sptext'];	
				$spurl = $instance['spurl'];
				$spbuttontext= $instance['spbuttontext'];
                
				
				$sptitle2= $instance['sptitle2'];
				$sptext2= $instance['sptext2'];	
				$spurl2 = $instance['spurl2'];
				$spbuttontext2= $instance['spbuttontext2'];
				
				$sptitle3= $instance['sptitle3'];
				$sptext3= $instance['sptext3'];	
				$spurl3 = $instance['spurl3'];
				$spbuttontext3= $instance['spbuttontext3'];			
				
 
                echo $before_widget;
				
				if ($spheader) echo '<div class="row"><div class="twelve columns"><div class="centersectiontitle"><h1 class="hometitles">'.$spheader.'</h1></div></div></div>';
				
				if ($sptitle) echo '<div class="row"><div class="four columns"><h5>'.$sptitle.'</h5>';
				if ($sptext) echo '<p>'.$sptext.'</p>';
                if ($spurl) echo '<p><a href="'.$spurl.'" class="readmore">'; 
				if ($spbuttontext) echo '&nbsp;'.$spbuttontext.'</a></p></div>';
				
				
				if ($sptitle2) echo '<div class="four columns"><h5>'.$sptitle2.'</h5>';
				if ($sptext2) echo '<p>'.$sptext2.'</p>';
                if ($spurl2) echo '<p><a href="'.$spurl2.'" class="readmore">'; 
				if ($spbuttontext2) echo '&nbsp;'.$spbuttontext2.'</a></p></div>';
				
				
				if ($sptitle3) echo '<div class="four columns"><h5>'.$sptitle3.'</h5>';
				if ($sptext3) echo '<p>'.$sptext3.'</p>';
                if ($spurl3) echo '<p><a href="'.$spurl3.'" class="readmore">'; 
				if ($spbuttontext3) echo '&nbsp;'.$spbuttontext3.'</a></p></div>';			
				
 
                echo $after_widget;
				
            }
 
        function update( $new_instance, $old_instance ) {		
            $instance = $old_instance;
			
			$instance['spheader'] = $new_instance['spheader'];
			
			$instance['sptitle'] = $new_instance['sptitle'];			
			$instance['sptext'] = $new_instance['sptext'];
            $instance['spurl'] = $new_instance['spurl'];
			$instance['spbuttontext'] = $new_instance['spbuttontext'];
			
			$instance['sptitle2'] = $new_instance['sptitle2'];			
			$instance['sptext2'] = $new_instance['sptext2'];
            $instance['spurl2'] = $new_instance['spurl2'];
			$instance['spbuttontext2'] = $new_instance['spbuttontext2'];
			
			$instance['sptitle3'] = $new_instance['sptitle3'];			
			$instance['sptext3'] = $new_instance['sptext3'];
            $instance['spurl3'] = $new_instance['spurl3'];
			$instance['spbuttontext3'] = $new_instance['spbuttontext3'];	
 
            return $instance;
        }
 
        function form( $instance ) {
 
            $defaults = array('spheader' =>'WHAT WE DO',
			
							  'sptitle' =>'Photography',							  
							  'sptext' =>'With our fully-equipped digital studio, you will know you are in safe hands. Studio Paul is not just about creating photographs, we go beyond that. You are free to browse around our portfolio.',
							  'spurl' =>'#',
							  'spbuttontext' =>'Learn more',
							  
							  'sptitle2' =>'Artwork',							  
							  'sptext2' =>'With our fully-equipped digital studio, you will know you are in safe hands. Studio Paul is not just about creating photographs, we go beyond that. You are free to browse around our portfolio.',
							  'spurl2' =>'#',
							  'spbuttontext2' =>'Learn more',
							  
							  'sptitle3' =>'Logos',							  
							  'sptext3' =>'With our fully-equipped digital studio, you will know you are in safe hands. Studio Paul is not just about creating photographs, we go beyond that. You are free to browse around our portfolio.',
							  'spurl3' =>'#',
							  'spbuttontext3' =>'Learn more');
							  
            $instance = wp_parse_args( (array) $instance, $defaults ); ?> 
            
			<!-- Header -->
			 <p>
                <label for="<?php echo $this->get_field_id( 'spheader' ); ?>">Header</label>
                <input id="<?php echo $this->get_field_id( 'spheader' ); ?>" name="<?php echo $this->get_field_name( 'spheader' ); ?>" value="<?php echo $instance['spheader']; ?>" style="width:100%;" />
            </p>
			
			<!-- Box 1 -->
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 1</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'sptitle' ); ?>">Title:</label>
                <input id="<?php echo $this->get_field_id( 'sptitle' ); ?>" name="<?php echo $this->get_field_name( 'sptitle' ); ?>" value="<?php echo $instance['sptitle']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'sptext' ); ?>">Text:</label>
                 <textarea id="<?php echo $this->get_field_id( 'sptext' ); ?>" name="<?php echo $this->get_field_name( 'sptext' ); ?>" style="width:100%;height:120px;" type="text"><?php echo $instance['sptext']; ?></textarea>
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'spbuttontext' ); ?>">Button Text:</label>
                <input id="<?php echo $this->get_field_id( 'spbuttontext' ); ?>" name="<?php echo $this->get_field_name( 'spbuttontext' ); ?>" value="<?php echo $instance['spbuttontext']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'spurl' ); ?>">Button Link:</label>
                <input id="<?php echo $this->get_field_id( 'spurl' ); ?>" name="<?php echo $this->get_field_name( 'spurl' ); ?>" value="<?php echo $instance['spurl']; ?>" style="width:100%;" />
            </p>
			
			
			<!-- Box 2 -->
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 2</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'sptitle2' ); ?>">Title:</label>
                <input id="<?php echo $this->get_field_id( 'sptitle2' ); ?>" name="<?php echo $this->get_field_name( 'sptitle2' ); ?>" value="<?php echo $instance['sptitle2']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'sptext2' ); ?>">Text:</label>
                <textarea id="<?php echo $this->get_field_id( 'sptext2' ); ?>" name="<?php echo $this->get_field_name( 'sptext2' ); ?>" style="width:100%;height:120px;" type="text"><?php echo $instance['sptext2']; ?></textarea>
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'spbuttontext2' ); ?>">Button Text:</label>
                <input id="<?php echo $this->get_field_id( 'spbuttontext2' ); ?>" name="<?php echo $this->get_field_name( 'spbuttontext2' ); ?>" value="<?php echo $instance['spbuttontext2']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'spurl2' ); ?>">Button Link:</label>
                <input id="<?php echo $this->get_field_id( 'spurl2' ); ?>" name="<?php echo $this->get_field_name( 'spurl2' ); ?>" value="<?php echo $instance['spurl2']; ?>" style="width:100%;" />
            </p>
			
			
			<!-- Box 3 -->
			<p style="font-weight:bold; color:#e36b0c; border-bottom:2px solid;padding-bottom:5px;">BOX 3</p>
			 <p>
                <label for="<?php echo $this->get_field_id( 'sptitle3' ); ?>">Title:</label>
                <input id="<?php echo $this->get_field_id( 'sptitle3' ); ?>" name="<?php echo $this->get_field_name( 'sptitle3' ); ?>" value="<?php echo $instance['sptitle3']; ?>" style="width:100%;" />
            </p>
			 
			 <p>
                <label for="<?php echo $this->get_field_id( 'sptext3' ); ?>">Text:</label>
                 <textarea id="<?php echo $this->get_field_id( 'sptext3' ); ?>" name="<?php echo $this->get_field_name( 'sptext3' ); ?>" style="width:100%;height:120px;" type="text"><?php echo $instance['sptext3']; ?></textarea>
            </p>
			
			
			 <p>
                <label for="<?php echo $this->get_field_id( 'spbuttontext3' ); ?>">Button Text:</label>
                <input id="<?php echo $this->get_field_id( 'spbuttontext3' ); ?>" name="<?php echo $this->get_field_name( 'spbuttontext3' ); ?>" value="<?php echo $instance['spbuttontext3']; ?>" style="width:100%;" />
            </p>
			
			<p>
                <label for="<?php echo $this->get_field_id( 'spurl3' ); ?>">Button Link:</label>
                <input id="<?php echo $this->get_field_id( 'spurl3' ); ?>" name="<?php echo $this->get_field_name( 'spurl3' ); ?>" value="<?php echo $instance['spurl3']; ?>" style="width:100%;" />
            </p>			
				
 
<?php
    }
}

?>