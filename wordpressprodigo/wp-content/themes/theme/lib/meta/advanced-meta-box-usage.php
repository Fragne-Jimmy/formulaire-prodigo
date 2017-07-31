<?php
$prefix = 'sp_';

$sp_meta_boxes = array();

// meta box ===> Slides
$sp_meta_boxes[] = array(
	'id' => 'slidelink',
	'title' => __('Slide Options','studiopaulslider'),
	'pages' => array('slides'),
	'update' => false,
	'fields' => array(
			array(
            'name' => __('Slide Description','studiopaulslider'),
            'desc' => __('Enter a description for your slider (optional). Use h2 tag for a nice title.','studiopaul'),
            'id' => $prefix . 'studiopaul_description',
            'type' => 'textarea',
            'std' => ''
        ),
		array(
            'name' => __('Slide URL','studiopaulslider'),
            'desc' => __('Enter a URL to link this slide to - perfect for linking slides to pages on your site or other sites. Optional.','studiopaul'),
            'id' => $prefix . 'studiopaul_slideurl',
            'type' => 'text',
            'std' => ''
        )
	)
);


// DO NOT DELETE BELOW
foreach ($sp_meta_boxes as $meta_box) {
	new Advanced_Meta_Box($meta_box);
}

/*********************************************************************************************
META PAGE DESCRIPTION
*********************************************************************************************/
$prefix = 'sp_';

$pagedesc_meta_boxes = array();

// meta box ===> Slides
$pagedesc_meta_boxes[] = array(	
	'id' => 'padgedesc',
	'title' => __('Page Description','studiopaul'),
	'pages' => array('page','myportfolio','filterable-portfolio'),
	'update' => false,
	'fields' => array(
			array(
            'name' => __('Secondary Title','studiopaulslider'),
            'desc' => __('Enter a secondary title for this page. It will appear at the top right of this page (optional).','studiopaul'),
            'id' => $prefix . 'pagedesc',
            'type' => 'text',
            'std' => ''
        )
	)
);


// DO NOT DELETE BELOW
foreach ($pagedesc_meta_boxes as $meta_box) {
	new Advanced_Meta_Box($meta_box);
}

/*********************************************************************************************
FLEX SLIDER
*********************************************************************************************/	
	function register_slides_posttype() {
		$labels = array(
			'name' 				=> _x( 'Boxed Slider', 'post type general name', 'studiopaul' ),
			'singular_name'		=> _x( 'Boxed Slider', 'post type singular name', 'studiopaul' ),
			'add_new' 			=> __( 'Add New Slide', 'studiopaul' ),
			'add_new_item' 		=> __( 'Add New Slide', 'studiopaul' ),
			'edit_item' 		=> __( 'Edit Slide', 'studiopaul' ),
			'new_item' 			=> __( 'New Slide', 'studiopaul' ),
			'view_item' 		=> __( 'View Slide', 'studiopaul' ),
			'search_items' 		=> __( 'Search Slides', 'studiopaul' ),
			'not_found' 		=> __( 'Slide', 'studiopaul' ),
			'not_found_in_trash'=> __( 'Slide', 'studiopaul' ),
			'parent_item_colon' => __( 'Slide', 'studiopaul' ),
			'menu_name'			=> __( 'Boxed Slider', 'studiopaul' )
		);				
		
		$supports = array('title','thumbnail');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Slide', ''),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,			
			'rewrite' 			=> array('slug' => 'slides' ),
			'supports' 			=> $supports,
			'menu_position' 	=> 27, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> get_template_directory_uri() . '/images/slideicon.jpg'			
		 );
		 register_post_type('slides',$post_type_args);
	}
	add_action('init', 'register_slides_posttype');
	

/*********************************************************************************************
ELASTIC SLIDER
*********************************************************************************************/	
	function register_elasticslides_post_type() {
		$labels = array(
			'name' 				=> _x( 'Elastic Slider', 'post type general name', 'studiopaul' ),
			'singular_name'		=> _x( 'Elastic Slider', 'post type singular name', 'studiopaul' ),
			'add_new' 			=> __( 'Add New Slide', 'studiopaul' ),
			'add_new_item' 		=> __( 'Add New Slide', 'studiopaul' ),
			'edit_item' 		=> __( 'Edit Slide', 'studiopaul' ),
			'new_item' 			=> __( 'New Elastic Slide', 'studiopaul' ),
			'view_item' 		=> __( 'View Elastic Slide', 'studiopaul' ),
			'search_items' 		=> __( 'Search Elastic Slides', 'studiopaul' ),
			'not_found' 		=> __( 'Elastic Slide', 'studiopaul' ),
			'not_found_in_trash'=> __( 'Elastic Slide', 'studiopaul' ),
			'parent_item_colon' => __( 'Elastic Slide', 'studiopaul' ),
			'menu_name'			=> __( 'Elastic Slider', '' )
		);				
		
		$supports = array('title', 'editor', 'thumbnail');
		
		$elastic_post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Elastic Slider', 'studiopaul'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,			
			'rewrite' 			=> array('slug' => 'elasticslider' ),
			'supports' 			=> $supports,
			'menu_position' 	=> 27, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> get_template_directory_uri() . '/images/slideicon.jpg'			
		 );
		 register_post_type('elasticslider',$elastic_post_type_args);
	}
	add_action('init', 'register_elasticslides_post_type');


/*********************************************************************************************
FILTERABLE PORTFOLIO 
*********************************************************************************************/	

$labels = array(
	'name' => __( 'Filterable Folio','studiopaul'),
	'singular_name' => __( 'Portfolio Filterable' ,'studiopaul' ),
	'add_new' => __('Add New','studiopaul'),
	'add_new_item' => __('Add New Item','studiopaul'),
	'edit_item' => __('Edit Item','studiopaul'),
	'new_item' => __('New Item' ,'studiopaul'),
	'view_item' => __('View Item','studiopaul'),
	'search_items' => __('Search Portfolio' ,'studiopaul'),
	'not_found' =>  __('No Item Found','studiopaul'),
	'not_found_in_trash' => __('No Item Found in Trash','studiopaul'),
	'parent_item_colon' => ''

);  

$args = array(
	'labels' => $labels,
	'public' => true,
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_position' => null,	
	'menu_icon' => get_template_directory_uri() . '/images/slideicon.jpg',
	'rewrite' => array('slug' => 'portfolio'),
	'supports' =>  array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt')
); 

register_post_type( 'filterable-portfolio', $args );
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'pt_';
	
	$meta_boxes[] = array(
		'id'         => 'portfolio_metabox',
		'title'      => __('Portfolio Settings', 'studiopaul'),
		'pages'      => array( 'filterable-portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(			
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'meta-box.php';

}

/* ==  Register Custom Taxonomy  ==============================*/
  $labels = array(
    'name' => __( 'Categories', 'studiopaul' ),
    'singular_name' => __( 'Category', 'studiopaul' ),
    'search_items' =>  __( 'Search Categories', 'studiopaul' ),
    'all_items' => __( 'All Categories', 'studiopaul' ),
    'parent_item' => __( 'Parent Category', 'studiopaul' ),
    'parent_item_colon' => __( 'Parent Category:', 'studiopaul' ),
    'edit_item' => __( 'Edit Category', 'studiopaul' ), 
    'update_item' => __( 'Update Category', 'studiopaul' ),
    'add_new_item' => __( 'Add New Category', 'studiopaul' ),
    'new_item_name' => __( 'New Category Name', 'studiopaul' ),
    'menu_name' => __( 'Categories', 'studiopaul' ),
  ); 	

  register_taxonomy('portfolio-categories',array('filterable-portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio-categories' ),
  ));  

/* ==  List categories for the galleries  ==============================*/
class Category_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  $link = '<a href="#" data-filter=".term-'.$category->term_id.'" ';
	  

      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items filed under %s', 'studiopaul' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';

      // $link .= $cat_name . '</a>';

      $link .= $cat_name;
      if(!empty($category->description)) {
         //$link .= ' <span>'.$category->description.'</span>';
      }

      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';

         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'studiopaul' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }

         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }

      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';

      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }

      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }

   }

}

/*********************************************************************************************
SIMPLE PORTFOLIO
*********************************************************************************************/	

function justins_custom_post_types() {		
	
	$labels_portfolio = array(
		'add_new' => __('Add New', 'portfolio'),
		'add_new_item' => __('Add New Portfolio Post', 'studiopaul'),
		'edit_item' => __('Edit Portfolio Post', 'studiopaul'),
		'menu_name' => __('Portfolio Simple', 'studiopaul'),
		'name' => __('Portfolio Simple', 'post type general name'),
		'new_item' => __('New Portfolio Post', 'studiopaul'),
		'not_found' =>  __('No portfolio posts found', 'studiopaul'),
		'not_found_in_trash' => __('No portfolio posts found in Trash', 'studiopaul'), 
		'parent_item_colon' => '',
		'singular_name' => __('Portfolio Simple', 'post type singular name'),
		'search_items' => __('Search Portfolio Posts', 'studiopaul'),
		'view_item' => __('View Portfolio Post', 'studiopaul'),
	);
	$args_portfolio = array(
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'labels' => $labels_portfolio,
		'menu_position' => null,	
	    'menu_icon' => get_template_directory_uri() . '/images/slideicon.jpg',
		'public' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'myportfolio', 'with_front' => true ),
		'show_in_menu' => true, 
		'show_ui' => true, 
		'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
	);
	register_post_type( 'myportfolio', $args_portfolio );
	
	
}

add_action( 'init', 'justins_custom_post_types' );


?>