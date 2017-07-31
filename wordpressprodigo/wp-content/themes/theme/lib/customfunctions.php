<?php
/****************************************************************************************************
Custom template tags for this theme.
*****************************************************************************************************/
if ( ! function_exists( 'studiopaul_content_nav' ) ) :
function studiopaul_content_nav( $nav_id ) {
	global $wp_query, $post;
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}
	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';
	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'studiopaul' ); ?></h1>
	<?php if ( is_single() ) : // navigation links for single posts ?>
		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'studiopaul' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'studiopaul' ) . '</span>' ); ?>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'studiopaul' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'studiopaul' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>
	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // studiopaul_content_nav

if ( ! function_exists( 'studiopaul_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since studiopaul 1.0
 */
function studiopaul_posted_on() {
   printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'studiopaul' ),
                esc_url( get_permalink() ),
                esc_attr( get_the_time() ),
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                esc_attr( sprintf( __( 'View all posts by %s', 'studiopaul' ), get_the_author() ) ),
                get_the_author()
        );
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since studiopaul 1.0
 */
function studiopaul_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so studiopaul_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so studiopaul_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in studiopaul_categorized_blog
 *
 * @since studiopaul 1.0
 */
function studiopaul_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'studiopaul_category_transient_flusher' );
add_action( 'save_post', 'studiopaul_category_transient_flusher' );

add_filter( 'the_category', 'add_nofollow_cat' );  function add_nofollow_cat( $text ) { $text = str_replace('rel="category tag"', "", $text); return $text; }

/*********************************************************************************************
COMMENT FORM
*********************************************************************************************/
add_filter('comment_form_defaults', 'rapid_comment_form');

function rapid_comment_form($form_options)
{
$user = wp_get_current_user();
$user_identity = $user->exists() ? $user->display_name : '';
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

    // Fields Array
    $fields = array(

        'author' =>
        '<div class="four columns noleftmargin"><p class="comment-form-author">' .
        ( $req ? '<span class="required"></span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Name *', 'studiopaul' ) . '" />' .
        '</p></div>',

        'email' =>
        '<div class="four columns"><p class="comment-form-email">' .
        ( $req ? '<span class="required"></span>' : '' ) .
        '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Email (not published) *', 'studiopaul' ) . '" />' .
        '</p></div>',

        'url' =>
        '<div class="four columns"><p class="comment-form-url">'  .
        '<input name="url" size="30" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" type="text" placeholder="' . __( 'Website', 'studiopaul' ) . '" />' .
        '</p></div>',

    );

    // Form Options Array
    $form_options = array(
        // Include Fields Array
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),

        // Template Options
        'comment_field' =>
        '<div class="clear twelve columns noleftmargin"><p class="comment-form-comment">' .
        '<textarea name="comment" id="comment" aria-required="true" rows="8" cols="45" placeholder="' . _x( 'Comment *', 'noun', 'studiopaul' ) . '"></textarea>' .
        '</p></div>',
       
	    'logged_in_as' =>
		'<br/><p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		
	   'comment_notes_before' => '',
       'comment_notes_after'  => '',


        // Rest of Options
        'id_form' => 'commentform',
        'id_submit' => 'submit',
        'title_reply' => __( '<h5 id="comment-form-title">ADD YOUR COMMENT</h5><div class="bordercomment"></div>', 'studiopaul'  ),
        'title_reply_to' => __( 'Leave a Reply to %s', 'studiopaul' ),
        'cancel_reply_link' => __( 'Cancel reply', 'studiopaul' ),
        'label_submit' => __( 'Post Comment', 'studiopaul' ),
    );

    return $form_options;
}

/*********************************************************************************************
BREADCRUMBS
*********************************************************************************************/
function ShowBreadCrumb($tag="nav") {
  $breadcrumb .= "<{$tag} class='breadcrumb'>";
  $breadcrumb .= CreateBreadcrumb();
  $breadcrumb .= "</{$tag}>";
}
function CreateBreadcrumb() {
  $breadcrumb = "";
  if (is_front_page() || is_home()) {
    $breadcrumb .= "<span style='font-size:18px;'>OUR BLOG</span>";
    return($breadcrumb);
  }
  $breadcrumb .= "<a href='" . home_url() . "' > Home </a>";
  if (is_page()) { // pages don't have a category
    $breadcrumb .= " / ";
    $breadcrumb .= get_the_title();
    return($breadcrumb);
  }
  if (is_search()) {
    $breadcrumb .= " / ";
    $breadcrumb .= "Search";
    return($breadcrumb);
  }
if (is_tag()) {
    $breadcrumb .= " /; ";
    $breadcrumb .= "Tags " . " &rspuo; " . single_tag_title('', false);
    return($breadcrumb);
}
  if (is_category()) {
    $breadcrumb .= " / ";
    $category = get_the_category();
    $breadcrumb .= $category[0]->cat_name; // get the first one only
    return($breadcrumb);
  }
  
if ( is_singular( 'elasticslider' ) || is_singular( 'slides' )) {
	$breadcrumb .= " / ";
	$breadcrumb .= get_the_title();
    return($breadcrumb);
		}
  
  $breadcrumb .= " / ";
  $category = get_the_category();
  $categoryName = $category[0]->cat_name;
  $categoryLink = get_category_link($category[0]->term_id);

  $breadcrumb .= "<a href='" . $categoryLink . "'>" . $categoryName . "</a>";
  $breadcrumb .= " / ";
  $breadcrumb .= get_the_title();
  return($breadcrumb);
}

/*********************************************************************************************
EXCERPTS
*********************************************************************************************/
function get_custom_excerpt($count){  
  global $post;
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  return $excerpt;
}

/*********************************************************************************************
PAGINATION
*********************************************************************************************/
function vazz_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='currentpage'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*********************************************************************************************
TWITTER
*********************************************************************************************/

function vazz_twitter(){
	// get php variables for js
    $twitter_user = of_get_option('vazz_twittername');
	$twitter_number = of_get_option('vazz_twitternumber');
	//
	echo "<script type='text/javascript'>\n" ;
	// twitter
	echo "twitter_user = '".$twitter_user."';\n";
	echo "twitter_number = '".$twitter_number."';\n";
	echo "</script>";
} 
?>