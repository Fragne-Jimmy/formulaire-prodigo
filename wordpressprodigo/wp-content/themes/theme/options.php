<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	$shortname = "vazz";
	
	// Theme Color Schemes
	$colorschemes = array(
		'teal'=>'Teal',
		'blue'=>'Blue',
		'green'=>'Green',
		'orange'=>'Orange',
		'pink'=>'Pink',
		'red'=>'Red',
		'yellow'=>'Yellow',
		'lilac'=>'Lilac',
		'khaki'=>'Khaki'

	);
	
	// Numberofs Array	
	$numberofs_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
	
	// Robots Array
	$robots_array = array(
		"none" => "none",
		"index,follow" => "index,follow",
		"index, follow" => "index, follow",
		"index,nofollow" => "index,nofollow",
		"index,all" => "index,all",
		"index,follow,archive" => "index,follow,archive",
		"noindex,follow" => "noindex,follow",
		"noindex,nofollow" => "noindex,nofollow"
    );

	// Blogstyle Array
    $blogstyle_array = array(
		"blogstylethree" => "3 box column",
		"blogstyletwo" => "2 box column",
		"blogstyleone" => "1 box column"
    );
	
	// Archive Array
    $archivestyle_array = array(
		"archivestylethree" => "3 box column",
		"archivestyletwo" => "2 box column",
		"archivestyleone" => "1 box column"
    );
	
	// Homestyle Array
    $homestyle_array = array(
		"slider-full" => "Full Slider",
		"slider-boxed" => "Boxed Slider"
    );
	
	// Portfolio Template Array
    $portfoliostyle_array = array(
		"portfoliotwo" => "2 columns",
		"portfoliothree" => "3 columns",
		"portfoliofour" => "4 columns"
    );

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';	
	
	$options = array();

/*********************************************************************************************
	GENERAL OPTIONS
*********************************************************************************************/

	$options[] = array( "name" => "General",
						"sicon" => "advancedsettings.png",
                        "type" => "heading");

    $options[] = array( "name" => "Your Logo",
                        "desc" => "Click to upload your own logo or leave it blank if you want to use text as logo. Default size: 225px x 49px",
                        "id" => $shortname."_thelogo",
                        "std" => "",
                        "type" => "upload");
						
	$options[] = array( "name" => "Text as Logo",
                        "desc" => "If you don't use an image as logo, this text will show up in its place.",
                        "id" => $shortname."_thelogo_text",
                        "std" => "Studio Francesca",
                        "type" => "text");	
	
	$options[] = array( "name" => "Custom Favicon",
                        "desc" => "You can use your own custom favicon. Click to 'Upload Image' button and upload your favicon.",
                        "id" => $shortname."_custom_shortcut_favicon",
                        "std" => "",
                        "type" => "upload");   						
	
    $options[] = array( "name" => "Theme Color Scheme",
                        "id" => $shortname."_colorscheme",
                        "std" => "",
                        "type" => "select",
                        "options" => $colorschemes);
						
	$options[] = array( "name" => "Activate Hidden Panel",
                        "desc" => "Check if you want to enable the top hidden panel.",
                        "id" => $shortname."_hiddenpanel",
                        "std" => "1",
                        "type" => "checkbox");
							  
	$options[] = array( "name" => "Hidden Panel",
                        "desc" => "This text will show up in the hidden panel.",
                        "id" => $shortname."_hiddenpanel_text",
                        "std" => "Thank you for visiting my theme! Replace this text with your own message or <a href='#'>link</a> to a specific page.",
                        "type" => "textarea");
	
	$options[] = array( "name" => "Portfolio Template",
						"id" => $shortname."_portfoliostyle",
                        "std" => "2 columns",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $portfoliostyle_array);

	$options[] = array( "name" => "E-mail address",
                        "desc" => "Enter a valid e-mail address for your contact form.",
                        "id" => $shortname."_contactform_email",
                        "std" => "",
                        "type" => "text");

	
						
/*********************************************************************************************
	CUSTOM SKIN OPTIONS
*********************************************************************************************/
						
						
	$options[] = array( "name" => "Custom Skin",
    					"sicon" => "css.png",
						"type" => "heading");
	
	$options[] = array( "name" => "Enable custom skin",
                        "desc" => "Check this box to enable a custom skin created by you below. These settings will override the premade scheme selected in General options, but play with no worries, you can always uncheck this and revert to any chosen premade scheme. TIP: For better aesthetics, assign the same color to PRIMARY COLOR and BREADCRUMB BACKGROUND.",
                        "id" => $shortname."_activate_custom_skin",
                        "std" => "0",
                        "type" => "checkbox");
	
									
    $options[] = array( "name" => "Primary Color",
						"desc" => "Main color of your website",
						"id" => $shortname."_primary_color",
						"std" => "#2BA6CB",
						"type" => "color" );
						
	$options[] = array( "name" => "Breadcrumb Backround",
						"desc" => "Breadcrumb area - subheader.",
						"id" => $shortname."_breadcrumb_background",
						"std" => "#2BA6CB",
						"type" => "color" );
	
	$options[] = array( "name" => "Breadcrumb Text",
						"desc" => "Tip: choose a darker color if breadcrumb background is lighter and vice versa.",
						"id" => $shortname."_breadcrumb_text",
						"std" => "#ffffff",
						"type" => "color" );
    
	$options[] = array( "name" => "Link Color",
						"desc" => "",
						"id" => $shortname."_link_color",
						"std" => "#2BA6CB",
						"type" => "color" );
						
	$options[] = array( "name" => "Link Color Hover",
						"desc" => "",
						"id" => $shortname."_link_color_hover",
						"std" => "#2795B6",
						"type" => "color" );
					
	$options[] = array(
						"name" =>  __("Background", "options_framework_theme"),
						"desc" => __("Change the background CSS.", "options_framework_theme"),
						"id" => $shortname."_custom_bg",
						"std" => $background_defaults,
						"type" => "background" );					
		
	
/*********************************************************************************************
	HOMEPAGE CONTENT
*********************************************************************************************/
	
	$options[] = array( "name" => "Home",
	                    "sicon" => "user-home.png",
	                    "type" => "heading");						

	$options[] = array( "name" => "Display Recent Posts Carousel",
						"desc" => "Check to display recent posts carousel on homepage.",
                        "id" => $shortname."_recentpostscarousel",
                        "std" => "1",
                        "type" => "checkbox"); 						
	
	$options[] = array( "name" => "Display Slider on Homepage",
						"desc" => "Check to display slider on homepage.",
						"id" => $shortname."_slideroption",
						"std" => "0",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Select Slider",
						"desc" => "Ignore this if you chose not to display a slider.",
						"id" => $shortname."_homestyle",
                        "std" => "slider-full",
						"type" => "select",
						"class" => "sectionlast",
						"options" => $homestyle_array);
	
	$options[] = array( "name" => "Text Under Slider",
						"desc" => "Intro message",
						"id" => $shortname."_underslider",
						"std" => '"Vision is the art of seeing what is invisible to others" - Jonathan Swift',
						"type" => "text");
		
	$options[] = array( "name" => "HOME CONTENT -  for 'NO SLIDER' only",
						"desc" => "Edit the following content only if you choose a homepage without slider.",
						"type" => "info");	
	
	$options[] = array( "name" => "Header",
						"desc" => "Title or welcome message",
						"id" => $shortname."_homeheader",
						"std" => "Our Photography Studio",
						"type" => "text");					
	
	$options[] = array( "name" => "Intro Message",
						"desc" => "Describe in a few words what your website is about",
						"id" => $shortname."_homedescription",
						"std" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
						"type" => "textarea");
						
	$options[] = array( "name" => "Button Text",
						"desc" => "Ex: Read more, view projects, try now etc.",
						"id" => $shortname."_homeactionbutton",
						"std" => "Action Button",
						"type" => "text");
						
	$options[] = array( "name" => "Button Link",
						"desc" => "Enter link where visitors should be taken, ex: http://www.yoursite.com/projects",
						"id" => $shortname."_homeactionbuttonlink",
						"std" => "#",
						"class" => "sectionlast",
						"type" => "text");

/*********************************************************************************************
	BLOG OPTIONS
*********************************************************************************************/

						
	$options[] = array( "name" => "Blog",
    					"sicon" => "blog.png",
						"type" => "heading");	
						
	$options[] = array( "name" => "Display Author Box",
						"desc" => "Show Author box in posts.",
						"id" => $shortname."_authorbox",
						"std" => "1",
						"type" => "checkbox");	
						
	$options[] = array( "name" => "Blog Index Template",
						"id" => $shortname."_blogstyle",
                        "std" => "3 box column",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $blogstyle_array);
	
	$options[] = array( "name" => "Archives Template (by categories, months, authors)",
						"id" => $shortname."_archivestyle",
                        "std" => "3 box column",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $archivestyle_array);
						
/*********************************************************************************************
	META OPTIONS
*********************************************************************************************/							
						
	$options[] = array( "name" => "Meta",
    					"sicon" => "metatag.png",
						"type" => "heading");

    $options[] = array( "name" => "Active Meta Keywords, Description Revisit",
                        "id" => $shortname."_enablemeta",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Meta Description",
						"id" => $shortname."_metadescription",
						"std" => "your website description here",
						"type" => "textarea");

    $options[] = array( "name" => "Meta Keywords",
						"std" => "wordpress theme, francesca, wowthemesnet",
						"id" => $shortname."_metakeywords",
                        "type" => "textarea");

    $options[] = array( "name" => "Revisit After",
                        "id" => $shortname."_revisitafter",
                        "std" => "2",
                        "type" => "select",
                        "class" => "tiny", //mini, tiny, small
						"class" => "sectionlast",
                        "options" => $numberofs_array);

    $options[] = array( "name" => "Active Robots Indexing Option",
                        "id" => $shortname."_enablerobot",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Choose General Bot Indexing Type",
						"id" => $shortname."_metabots",
                        "std" => "",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $robots_array);

    $options[] = array( "name" => "Choose Google Bot Indexing Type",
						"id" => $shortname."_metagooglebot",
                        "std" => "",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $robots_array);

/*********************************************************************************************
	FOOTER & STATS OPTIONS
*********************************************************************************************/
	$options[] = array(	'name' => __('Footer & Stats', 'options_framework_theme'),
						'type' => 'heading');					
	
	$options[] = array( "name" => "Footer Copyright Left Area",
    					"desc" => "Change the footer copyright left area.",
						"id" => $shortname."_footer_copyright_left",
						"std" => "&copy; Copyright 2013 Your Agency Name.",
						"type" => "text");
	
	 $options[] = array( "name" => "Footer Copyright Right Area",
    					"desc" => "Change the footer copyright right area.",
						"id" => $shortname."_footer_copyright_right",
						"std" => "Purchase Studio Francesca - WowThemes.net",
						"type" => "text");
	
	 $options[] = array( "name" => "Stat Code",
    					"desc" => "You can use google analytics or other stats code in this area.",
						"id" => $shortname."_stats",
						"std" => "",
						"type" => "textarea");
						
/*********************************************************************************************
	SOCIAL
*********************************************************************************************/

	$options[] = array( "name" => "Social",
    					"sicon" => "metatag.png",
						"type" => "heading");

    $options[] = array( "name" => "Twitter URL",
                        "id" => $shortname."_twitter",
                        "std" => "",
                        "type" => "text");
						
	$options[] = array( "name" => "Facebook URL",
                        "id" => $shortname."_facebook",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Google+ URL",
                        "id" => $shortname."_google",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Dribble URL",
                        "id" => $shortname."_dribbble",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Vimeo URL",
                        "id" => $shortname."_vimeo",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Skype URL",
                        "id" => $shortname."_skype",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "LinkedIn URL",
                        "id" => $shortname."_linkedin",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Pinterest URL",
                        "id" => $shortname."_pinterest",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "RSS",
                        "desc" => "Display default RSS link",
                        "id" => $shortname."_rss",
                        "std" => "1",
                        "type" => "checkbox");
    $options[] = array( "name" => "External RSS URL",
                        "desc" => "Display a different RSS URL, like Feedburner. Unchek the previous box if you want to use this external RSS.",
                        "id" => $shortname."_extrss",
                        "std" => "",
                        "type" => "text");

						
/*********************************************************************************************
	STYLESHEET CSS
*********************************************************************************************/

	$options[] = array( "name" => "Custom CSS",
    					"sicon" => "css.png",
						"type" => "heading");    

    $options[] = array( "name" => "CSS Code",
                        "desc" => "You may add your CSS here. It will override the original, leaving it unmodified at the same time, so you can always revert by simply deleting it.",
                        "id" => $shortname."_css_code",						
                        "std" => "",
                        "type" => "textarea");
						
	return $options;
}
?>