<?php
/*********************************************************************************************
ACCORDION

[vazz_accordion]
[vazz_accordion_section title="Title 1"]Content one[/vazz_accordion_section]
[vazz_accordion_section title="Title 2"]Content two[/vazz_accordion_section]
[/vazz_accordion]
*********************************************************************************************/

// MainPart Shortcode
if( !function_exists('vuzz_accordion_main_shortcode') ) {
	function vuzz_accordion_main_shortcode( $atts, $content = null  ) {
		
		// Enque scripts
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('vuzz_accordion');
		
		// Display the accordion	
		return '<div class="vuzz-accordion">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'vazz_accordion', 'vuzz_accordion_main_shortcode' );
}


// SectionPart Shortcode
if( !function_exists('vuzz_accordion_section_shortcode') ) {
	function vuzz_accordion_section_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
		  'title' => 'Title',
		), $atts ) );
		  
	   return '<h3 class="vuzz-accordion-trigger"><a href="#">'. $title .'</a></h3><div>' . do_shortcode($content) . '</div>';
	}
	
	add_shortcode( 'vazz_accordion_section', 'vuzz_accordion_section_shortcode' );
}

/*********************************************************************************************
ALERTS [vazz_alert color="default/blue/green/gray/red" text="hello"]
*********************************************************************************************/
function foundation_shortcode_alert( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'color' => '',
		'text' => ''
		), $atts ) );

	return '<div class="alert-box ' . esc_attr($color) . '">' . $text . ' <a href="" class="close">&times;</a> </div>';
}

add_shortcode( 'vazz_alert', 'foundation_shortcode_alert' );

/*********************************************************************************************
BOXES [vazz_box color="olive/blue/green/red/gray/yellow/white" float="none" text_align="center" width="100%"] [/vazz_box]
*********************************************************************************************/
if( !function_exists('boxes_shortcode') ) { 
	function boxes_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => '',
			'float' => '',
			'text_align' => '',
			'width' => '100%'
		  ), $atts ) );
		  $alert_content = '';
		  $alert_content .= '<div class="box' . $color . ' '.$float.'" style="text-align:'. $text_align .'; width:'. $width .';">';
		  $alert_content .= ' '. do_shortcode($content) .'</div>';
		  return $alert_content;
	}
	add_shortcode('vazz_box', 'boxes_shortcode');
}

/********************************************************************************************************************
BUTTONS [vazz_button type="square/round" size="small/medium/big" color="blue/green/orange/black/violet/red/yellow/teal" fancy="shadow/noshadow" url="#" text="Download"]
*********************************************************************************************************************/
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'round', /* round, square */
	'size' => 'medium', /* small, medium, big */
	'color' => 'blue', /* blue, green, orange, black, violet, red, yellow, teal */
	'fancy' => 'noshadow', /* shadow, noshadow */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	$output = '<a href="' . $url . '" class="sbutton '. $type . ' ' .$fancy. ' '. $size . ' ' . $color;
	$output .= '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('vazz_button', 'buttons'); 

/*********************************************************************************************
CLEAR [vazz_clear]
*********************************************************************************************/
if( !function_exists('vuzz_clear_floats_shortcode') ) {
	function vuzz_clear_floats_shortcode() {
	   return '<div class="clear"></div>';
	}
	add_shortcode( 'vazz_clear', 'vuzz_clear_floats_shortcode' );
}

/*********************************************************************************************
COLUMNS [column columns=4] [/columns] (4 can be 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
*********************************************************************************************/

class REQ_Column_Shortcode {

    /**
     * The columns in our grid
     *
     * @since 1.0
     * @access public
     * @var    int
     */
    public $grid = 12;

    /**
     * The current total number of columns in the grid.
     *
     * @since 1.0
     * @access public
     * @var    int
     */
    public $columns = 0;

    /**
     * Whether we're viewing the first column.
     *
     * @since 1.0
     * @access public
     * @var    bool
     */
    public $is_first_column = true;

    /**
     * Whether we're viewing the last column.
     *
     * @since 1.0
     * @access public
     * @var    bool
     */
    public $is_last_column = false;

    /**
     * Sets up our actions/filters.
     *
     * @since 1.0
     * @access public
     * @return void
     */
    public function __construct() {

        /* Register shortcodes on 'init'. */
        add_action( 'init', array( &$this, 'register_shortcode' ) );

        /* Apply filters to the column content. */
        add_filter( 'req_column_content', 'do_shortcode' );
    }

    /**
     * Convert int into a word for our column classes
     *
     * @since 1.0
     * @access protected
     * @param  int $int
     * @return string $word
     */
    protected function convert_int_to_word( $int ) {

        // Make sure it's an integer
        absint( $int );

        switch( $int ) {

            case 1:     $word = "one"; break;
            case 2:     $word = "two"; break;
            case 3:     $word = "three"; break;
            case 4:     $word = "four"; break;
            case 5:     $word = "five"; break;
            case 6:     $word = "six"; break;
            case 7:     $word = "seven"; break;
            case 8:     $word = "eight"; break;
            case 9:     $word = "nine"; break;
            case 10:    $word = "ten"; break;
            case 11:    $word = "eleven"; break;
            case 12:    $word = "twelve"; break;
            case 0:
            default:
                        $word = "zero"; break;
        }
        return $word;
    }

    /**
     * Convert word to int for legacy support of old colmun shortcodes
     *
     * @since 1.0
     * @access protected
     * @param  string $word
     * @return int $int
     */
    protected function convert_word_to_int( $word ) {

        switch( $word ) {

            case "one":         $int = 1; break;
            case "two":         $int = 2; break;
            case "three":       $int = 3; break;
            case "four":        $int = 4; break;
            case "five":        $int = 5; break;
            case "six":         $int = 6; break;
            case "seven":       $int = 7; break;
            case "eight":       $int = 8; break;
            case "nine":        $int = 9; break;
            case "ten":         $int = 10; break;
            case "eleven":      $int = 11; break;
            case "twelve":      $int = 12; break;
            case "zero":
            default:
                                $int = 0; break;

        }
        return $int;
    }

    /**
     * Registers the [column] shortcode.
     *
     * @since 1.0
     * @access public
     * @return void
     */
    public function register_shortcode() {
        add_shortcode( 'column', array( &$this, 'do_shortcode' ) );
    }

    /**
     * Returns the content of the column shortcode.
     *
     * @since 1.0
     * @access public
     * @param  array  $attr The user-inputted arguments.
     * @param  string $content The content to wrap in a shortcode.
     * @return string
     */
    public function do_shortcode( $attr, $content = null ) {

        /* If there's no content, just return back what we got. */
        if ( is_null( $content ) )
            return $content;

        /* Set up the default variables. */
        $output = '';
        $row_classes = array();
        $column_classes = array();

        /* Set up the default arguments. */
        $defaults = apply_filters(
            'req_column_defaults',
            array(
                'columns'  => 1,
                'offset'  => 0,
                'class' => ''
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        /* Allow devs to filter the arguments. */
        $attr = apply_filters( 'req_column_args', $attr );

        /* Legacy support for old column shortcode */
        if ( !is_numeric( $attr['columns'] ) )
            $attr['columns'] = $this->convert_word_to_int( $attr['columns'] );

        /* Columns cannot be greater than the grid. */
        $attr['columns'] = ( $this->grid >= $attr['columns'] ) ? absint( $attr['columns'] ) : 3;

        /* The offset argument should always be less than the grid. */
        $attr['offset'] = ( $this->grid > $attr['offset'] ) ? absint( $attr['offset'] ) : 0;

        /* Add to the total $columns. */
        $this->columns = $this->columns + $attr['columns'] + $attr['offset'];

        /* Column classes. */
        $column_classes[] = 'columns';
        $column_classes[] = $this->convert_int_to_word( $attr['columns'] );
        if ( $attr['offset'] !== 0 ) // Offset is only necessary if it's not 0
            $column_classes[] = "offset-by-{$this->convert_int_to_word( $attr['offset'] )}";

        /* Add user-input custom class(es). */
        if ( !empty( $attr['class'] ) ) {
            if ( !is_array( $attr['class'] ) )
                $attr['class'] = preg_split( '#\s+#', $attr['class'] );
            $column_classes = array_merge( $column_classes, $attr['class'] );
        }

        /* If the $span property is greater than (shouldn't be) or equal to the $grid property. */
        if ( $this->columns >= $this->grid ) {

            /* Set the $is_last_column property to true. */
            $this->is_last_column = true;
        }

        /* Object properties. */
        $object_vars = get_object_vars( $this );

        /* Allow devs to create custom classes. */
        $column_classes = apply_filters( 'req_column_class', $column_classes, $attr, $object_vars );

        /* Sanitize and join all classes. */
        $column_class = join( ' ', array_map( 'sanitize_html_class', array_unique( $column_classes ) ) );

        /* Output */

        /* If this is the first column. */
        if ( $this->is_first_column ) {

            /* Open a wrapper <div> to contain the columns. */
            $output .= '<div class="row">';

            /* Set the $is_first_column property back to false. */
            $this->is_first_column = false;
        }

        /* Add the current column to the output. */
        $output .= '<div class="' . $column_class . '">' . apply_filters( 'req_column_content', $content ) . '</div>';

        /* If this is the last column. */
        if ( $this->is_last_column ) {

            /* Close the wrapper. */
            $output .= '</div>';

            /* Reset the properties that have been changed. */
            $this->reset();
        }

        /* Return the output of the column. */
        return apply_filters( 'req_column', $output );
    }

    /**
     * Resets the properties to their original states.
     *
     * @since 1.0
     * @access public
     * @return void
     */
    public function reset() {

        foreach ( get_class_vars( __CLASS__ ) as $name => $default )
            $this->$name = $default;
    }
}
/**
 * If you prefer the shortcode by http://themehybrid.com/plugins/grid-columns
 * please go ahead and use it. We don't stop you!
 */
if ( ! class_exists( 'Grid_Columns' ) )
    new REQ_Column_Shortcode();
	

/*********************************************************************************************
COLUMN HALF , use [halfcolumn] [/halfcolumn] 
*********************************************************************************************/
if( !function_exists('halfcolumn_shortcode') ) {
function halfcolumn_shortcode( $atts, $content = null ) {
	
	$output = '';
	$output .=  '<div class="six columns noleftmargin">';
    $output .=  do_shortcode($content);
    $output .=  '</div>';
    return $output;
}
add_shortcode( 'halfcolumn', 'halfcolumn_shortcode' );
}

/*********************************************************************************************
COLUMN HALF LAST , use [halfcolumnlast] [/halfcolumnlast]
*********************************************************************************************/
if( !function_exists('halfcolumnlast_shortcode') ) {
function halfcolumnlast_shortcode( $atts, $content = null ) {   
	
	$output = '';
	$output .=  '<div class="six columns">';
    $output .=  do_shortcode($content);
    $output .=  '</div><div class="clear"></div>';
    return $output;
}
add_shortcode( 'halfcolumnlast', 'halfcolumnlast_shortcode' );
}
	
/*********************************************************************************************
CONTACT  [vazz_contact email=youraddress@email.com]
*********************************************************************************************/
function mytheme_enqueue_scripts() {
      
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
$cs_base_dir = get_template_directory_uri(); 

function pippin_shortcode_contact( $atts, $content = null)	{
 
	// gives access to the plugin's base directory
	global $cs_base_dir;
 
	extract( shortcode_atts( array(
      'email' => get_bloginfo('admin_email')
      ), $atts ) ); 
 
	$content .= '
		<script type="text/javascript"> 
			var $j = jQuery.noConflict();
			$j(window).load(function(){				
				$j("#contact-form").submit(function() {
				  // validate and process form here
					var str = $j(this).serialize();					 
					   $j.ajax({
					   type: "POST",
					   url: "' . $cs_base_dir . '/sendmail.php",
					   data: str,
					     success: function(msg){						
							$j("#note").ajaxComplete(function(event, request, settings)
							{ 
								if(msg == "OK") // Message Sent? Show the Thank You message and hide the form
								{
									result = "Your message has been sent. Thank you!";
									$j("#fields").hide();
								}
								else
								{
									result = msg;
								}								 
								$j(this).html(result);							 
							});					 
						}	
					 });					 
					return false;
				});			
			});
		</script>';
		
        // now we put all of the HTML for the form into a PHP string
		$content .= '<div id="post-a-comment" class="clear">';
			$content .= '<div id="fields">';
				$content .= '<form id="contact-form" action="">';
					$content .= '<input name="to_email" type="hidden" id="to_email" value="' . $email . '"/>';
					$content .= '<p>';
						$content .= '<input name="name" type="text" id="name" class="smoothborder" placeholder="Your name *"/>';						
					$content .= '</p>';
					$content .= '<p>';
						$content .= '<input name="email" type="text" id="email" class="smoothborder" placeholder="E-mail address *"/>';						
					$content .= '</p>';
					$content .= '<p><textarea rows="6" cols="" name="message" class="smoothborder" placeholder="Message *"></textarea></p>';
					$content .= '<p><input type="submit" value="Submit" class="readmore" id="contact-submit" /></p>';
				$content .= '</form>';
			$content .= '</div><!--end fields-->';
			$content .= '<div id="note"></div> <!--notification area used by jQuery/Ajax -->';
		$content .= '</div>';
	return $content;
}
add_shortcode('vazz_contact', 'pippin_shortcode_contact');


/*********************************************************************************************
COUNTDOWN [vazz_countdown event="Black Friday" month="9" day="30" year="2013" /]
*********************************************************************************************/
function vuzz_countdown_event($atts, $content = null)
{
  extract(shortcode_atts(array(
    'event' => '',
    'month' => '',
    'day' => '',
    'year' => ''
  ), $atts));
    // subtract desired date from current date and give an answer in terms of days
    $remain = ceil( ( mktime( 0,0,0,$month,$day,$year ) - time() ) / 86400 );
    // show the number of days left
    if( $remain > 0 )
    {
        $daysleft = "<strong>$remain</strong> more days until the $event";
    }
    // Event has arrived!
    else
    {
        $daysleft = "...woops, $event has passed...(or some other message in here)";
    }

return $daysleft;
}
add_shortcode('vazz_countdown', 'vuzz_countdown_event');


/*********************************************************************************************
DIVIDER [divider]
*********************************************************************************************/
if( !function_exists('divider_shortcode') ) {
function divider_shortcode($atts, $content = null) {	
return '<hr>';
}
add_shortcode("vazz_divider", "divider_shortcode");
}


/*********************************************************************************************
EMBED AUDIO [vazz_audio5 src="youraudiolink" loop="true" autoplay="autoplay" preload="auto" loop="loop" controls=""]
*********************************************************************************************/
if( !function_exists('html5_audio') ) {
function html5_audio($atts, $content = null) {
extract(shortcode_atts(array(
"src" => '',
"autoplay" => '',
"preload"=> 'true',
"loop" => '',
"controls"=> ''
), $atts));
return '<audio src="'.$src.'" autoplay="'.$autoplay.'" preload="'.$preload.'" loop="'.$loop.'" controls="'.$controls.'" autobuffer />';
}
add_shortcode('vazz_audio5', 'html5_audio');
}

/****************************************************************************************************************************************
EMBED ANY VIDEO, credits to Baris Ünver [vazz_vid site="youtube/vimeo/dailymotion/yahoo/bliptv/veoh/viddler" id="dQw4w9WgXcQ" w="100%" h="360"]
*****************************************************************************************************************************************/
if( !function_exists('vazz_vid_sc') ) {
function vid_sc($atts, $content=null) {
	extract(
		shortcode_atts(array(
			'site' => '',
			'id' => '',
			'w' => '100%',
			'h' => '360'
		), $atts)
	);
	if ( $site == "youtube" ) { $src = 'http://www.youtube-nocookie.com/embed/'.$id; }
	else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id; }
	else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id; }
	else if ( $site == "yahoo" ) { $src = 'http://d.yimg.com/nl/vyc/site/player.html#vid='.$id; }
	else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
	else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id; }
	else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/simple/'.$id; }
	if ( $id != '' ) {
		return '<iframe width="'.$w.'" height="'.$h.'" src="'.$src.'" class="vid iframe-'.$site.'"></iframe>';
	}
}
add_shortcode('vazz_vid','vid_sc');
}

/*********************************************************************************************
GOOGLE MAP [vazz_googlemap src="Your Map Full Url"]
*********************************************************************************************/
if( !function_exists('google_maps_shortcode') ) {
function google_maps_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
      "width" => '100%',
      "height" => '480',
      "src" => ''
   ), $atts));
	
return '<iframe class="gmap" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&output=embed"></iframe>';
}
add_shortcode("vazz_googlemap", "google_maps_shortcode");
}

/*********************************************************************************************
PANEL [vazz_panel] [/vazz_panel]
*********************************************************************************************/
if( !function_exists('panel_shortcode') ) {
function panel_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
    'title' => ''
    ), $atts )
    );
    return '<div class="panel">'.$content.'</div>';
}
add_shortcode( 'vazz_panel', 'panel_shortcode' );
}

/*********************************************************************************************
PRICING TABLE 

[vazz_pricing_table size="four columns"]
[vazz_pricing plan="Gold" cost="$29.99" per="per month" button_url="#" button_text="Sign Up" button_color="teal" button_border_radius="" button_target="self" button_rel="nofollow"]
<ul>
	<li>5 products</li>
	<li>1 image per product</li>
	<li>basic stats</li>
	<li>non commercial</li>
</ul>
[/vazz_pricing]
[/vazz_pricing_table]
*********************************************************************************************/
 
/*main*/
if( !function_exists('vuzz_pricing_table_shortcode') ) {
	function vuzz_pricing_table_shortcode( $atts, $content = null  ) {
	   extract( shortcode_atts( array(
			'size' => 'four columns'
		), $atts ) );
	   return '<div class="vuzz-pricing-table '. $size .'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'vazz_pricing_table', 'vuzz_pricing_table_shortcode' );
}

/*section*/
if( !function_exists('vuzz_pricing_shortcode') ) {
	function vuzz_pricing_shortcode( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'position' => '',
			'featured' => 'no',
			'plan' => 'Basic',
			'cost' => '$20',
			'per' => 'month',
			'button_url' => 'http://www.vuzzthemes.com',
			'button_text' => 'Purchase',
			'button_color' => 'blue',
			'button_target' => 'self',
			'button_rel' => 'nofollow',
			'button_border_radius' => ''
		), $atts ) );
		
		//set variables
		$featured_pricing = ( $featured == 'yes' ) ? 'featured' : NULL;
		$border_radius_style = ( $button_border_radius ) ? 'style="border-radius:'. $button_border_radius .'"' : NULL;
		
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="vuzz-pricing '. $featured_pricing .' vuzz-column-'. $position. '">';
			$pricing_content .= '<div class="vuzz-pricing-header">';
				$pricing_content .= '<h5>'. $plan. '</h5>';
				$pricing_content .= '<div class="vuzz-pricing-cost">'. $cost .'</div><div class="vuzz-pricing-per">'. $per .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="vuzz-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_text ) {
				$pricing_content .= '<div class="vuzz-pricing-button"><a href="'. $button_url .'" class="vuzz-button '. $button_color .'" target="_'. $button_target .'" rel="'. $button_rel .'" '. $border_radius_style .'><span class="vuzz-button-inner" '. $border_radius_style .'>'. $button_text .'</span></a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
	
	add_shortcode( 'vazz_pricing', 'vuzz_pricing_shortcode' );
}

/*********************************************************************************************
SLIDER [vazz_slider][vazz_image link="pic1.jpg"][vazz_image link="pic2.jpg"][vazz_image link="pic3.jpg][/vazz_slider]
*********************************************************************************************/
if( !function_exists('nivo_slider_func') ) {
function nivo_slider_func( $atts, $content = null ) {
	//Enque nivo slider script
	wp_enqueue_script('vuzznivo');	
    $output  =  '<div class="slider-wrapper theme-default">';
    $output .=  '<div id="slider" class="nivoSlider detailslider">';
    $output .=  do_shortcode($content);
    $output .=  '</div></div>';
    return $output;
}
add_shortcode( 'vazz_slider', 'nivo_slider_func' ); 
}

if( !function_exists('nivo_image_shortcode') ) {
function nivo_image_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
    'link' => ''
    ), $atts )
    );
    return '<img src="'.$link.'">';
}
add_shortcode( 'vazz_image', 'nivo_image_shortcode' );
}

/*********************************************************************************************
SOCIAL [vazz_social network="facebook/twitter/google/dribbble/vimeo/skype/rss/linkedin/pinterest" profilelink="linkhere"]
*********************************************************************************************/     
    function smsc_shortcode_handler( $atts, $enclosed, $shortcode ) {
            extract(shortcode_atts( array(                    
					'network' => '',
					'profilelink' => '',
            ), $atts));
     
            global $smsc_shortcodes;
            $service = $smsc_shortcodes[$shortcode][0];
            $link = $smsc_shortcodes[$shortcode][1];
			
     		return "<ul id='social-links'><li class=\"$network-link\"><a href=\"$profilelink\" class=\"$network\" target='_blank'></a></li></ul>";
     		
    }
	
	add_shortcode( 'vazz_social', 'smsc_shortcode_handler' );


/*********************************************************************************************
SPACING [vazz_spacing size="20px"]
*********************************************************************************************/
if( !function_exists('vuzz_spacing_shortcode') ) {
	function vuzz_spacing_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'size' => '20px',
		  ),
		  $atts ) );
	 return '<div style="height: '. $size .'"></div>';
	}
	add_shortcode( 'vazz_spacing', 'vuzz_spacing_shortcode' );
}

/*********************************************************************************************
TABS 
[vazz_tabgroup]
[vazz_tab title="Tab Title 1"]Tab Content 1[/vazz_tab]
[vazz_tab title="Tab Title 2"]Tab Content 2[/vazz_tab]
[/vazz_tabgroup]
*********************************************************************************************/
if (!function_exists('vuzz_tabgroup_shortcode')) {
	function vuzz_tabgroup_shortcode( $atts, $content = null ) {
		
		//Enque scripts
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('vuzz_tabs');
		
		// Display Tabs
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
		if( count($tab_titles) ){
		    $output .= '<div id="vuzz-tab-'. rand(1, 100) .'" class="vuzz-tabs">';
			$output .= '<ul class="ui-tabs-nav vuzz-clearfix">';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#vuzz-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		return $output;
	}
	add_shortcode( 'vazz_tabgroup', 'vuzz_tabgroup_shortcode' );
}
if (!function_exists('vuzz_tab_shortcode')) {
	function vuzz_tab_shortcode( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="vuzz-tab-'. sanitize_title( $title ) .'" class="tab-content">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'vazz_tab', 'vuzz_tab_shortcode' );
}

/*********************************************************************************************
TEAMBOX [vazz_teambox name="John Doe" imagelink="image.jpg"]content and social shortcode here[/vazz_teambox]
*********************************************************************************************/
if( !function_exists('teambox_shortcode') ) {
function teambox_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(    
	'imagelink' => '',
	'name' => ''
    ), $atts )
    );
	
	$output = '';
	$output .=  '<div class="teamwrap teambox"><img src="'.$imagelink.'" alt=""><div class="mask"><h2>'.$name.'</h2><p>';
    $output .=  do_shortcode($content);
    $output .=  '</p></div></div>';
    return $output;
}
add_shortcode( 'vazz_teambox', 'teambox_shortcode' );
}

/*********************************************************************************************
TITLE [vazz_title text="text here"]
*********************************************************************************************/
if( !function_exists('title_shortcode') ) {
function title_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
    'text' => ''
    ), $atts )
    );
    return '<div class="sectiontitlepost"><h1>'.$text.'</h1></div>';
}
add_shortcode( 'vazz_title', 'title_shortcode' );
}

/*********************************************************************************************
TITLE SMALL , use [vazz_smalltitle text="hello"]
*********************************************************************************************/
if( !function_exists('smalltitle_shortcode') ) {
function smalltitle_shortcode( $atts, $content = null ) {
    extract(shortcode_atts( array(                    
					'text' => ''
            ), $atts));	
    return '<h5 class="sidebartitle" style="text-transform:none;">'.$text.'</h5>';
}
add_shortcode( 'vazz_smalltitle', 'smalltitle_shortcode' );
}

/*********************************************************************************************
TOGGLE [vazz_toggle title="Your title or question"]Your content or answer[/vazz_toggle]
*********************************************************************************************/
if( !function_exists('vuzz_toggle_shortcode') ) {
	function vuzz_toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array( 'title' => 'Toggle Title' ), $atts ) );
		 
		// Enque scripts
		wp_enqueue_script('vuzz_toggle');
		
		// Display the Toggle
		return '<div class="vuzz-toggle"><h3 class="vuzz-toggle-trigger">'. $title .'</h3><div class="vuzz-toggle-container">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode('vazz_toggle', 'vuzz_toggle_shortcode');
}
	
/*****************************************************************************************************
WP GALLERY WITH PRETTY PHOTO, use [gallery link="file"] or [gallery link="file" columns="4"] etc.
******************************************************************************************************/
function add_gallery_id_rel($link) {
wp_enqueue_script('vuzzprettyPhoto');
global $post;
return str_replace('<a href', '<a data-gal="prettyPhoto[gallery]-'. $post->ID .'" href', $link);
}
add_filter('wp_get_attachment_link', 'add_gallery_id_rel');

/*********************************************************************************************
CLEAN SHORTCODES AND ENABLE SHORTCODES IN WIDGETS
*********************************************************************************************/
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

// shortcode widgets

add_filter('widget_text', 'do_shortcode');

/*--------------------------------------*/
/*    Clean up Shortcodes
/*--------------------------------------*/
function wpex_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');