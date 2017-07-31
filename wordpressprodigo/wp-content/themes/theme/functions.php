<?php
/**
 * studiopaul functions and definitions
 *
 * @package studiopaul
 * @since studiopaul 1.1
 */ 
 
/*********************************************************************************************
GENERAL
*********************************************************************************************/
if ( ! isset( $content_width ) )
$content_width = 640; /* pixels */
if ( ! function_exists( 'studiopaul_setup' ) ) :
function studiopaul_setup() {
	load_theme_textdomain( 'studiopaul', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
		}
	}

/*********************************************************************************************
SCRIPTS AND STYLES
*********************************************************************************************/
	
    function studiopaul_assets() {	
	wp_register_script( 'vuzzhiddenpanel', get_template_directory_uri() .  '/js/hiddenpanel.js', array( 'jquery' ), false, true );
	wp_register_script( 'vuzzcycleall', get_template_directory_uri() .  '/js/jquery.cycle.all.js', array( 'jquery' ), false, true );
	wp_register_script( 'vuzzjquerytweet', get_template_directory_uri() .  '/js/jquery.tweet.js', array( 'jquery' ), false, true );	
	wp_register_script( 'vuzzmousewheel', get_template_directory_uri() .  '/js/jquery.mousewheel.js', array( 'jquery' ), false, true );
	wp_register_script( 'vuzzcontentcarousel', get_template_directory_uri() .  '/js/jquery.contentcarousel.js', array( 'jquery' ), false, true );
	wp_register_script( 'vuzztabbedwidget', get_template_directory_uri() .  '/js/tabs.js', array( 'jquery' ), true );
	wp_register_script( 'vuzzelasticslideshow', get_template_directory_uri() .  '/js/elasticslideshow.js', array( 'jquery' ), true );
	wp_register_script( 'vuzznivo', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array( 'jquery' ), 'studiopaul', true );
	wp_register_script( 'vuzzflexslider', get_template_directory_uri() .  '/js/jquery.flexslider-min.js', array( 'jquery' ), true );
	wp_register_script( 'vuzzprettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), 'studiopaul', true );	
	wp_register_script( 'vuzzisotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '', true);	
	
    wp_enqueue_script( 'vuzzfoundation', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), 'studiopaul', true );
	wp_enqueue_script( 'vuzzmodernizr', get_template_directory_uri() . '/js/modernizr.foundation.js', array( 'jquery' ), 'studiopaul', true );	
	wp_enqueue_script( 'vuzzapp', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), 'studiopaul', true );
	wp_enqueue_script( 'vuzzeasing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), 'studiopaul', true );
	wp_enqueue_script( 'vuzzhoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), 'studiopaul', true );
	wp_enqueue_script( 'vuzzsuperfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), 'studiopaul', true );	 
    wp_enqueue_script( 'vuzzcustom', get_template_directory_uri() . '/js/common.js', array( 'jquery' ), 'studiopaul', true );
	
	wp_enqueue_style( 'mainstyle', get_template_directory_uri() . '/stylesheets/style.css');	
	wp_enqueue_style( 'responsive', get_template_directory_uri(). '/stylesheets/responsive.css');
	wp_enqueue_style( 'user', get_bloginfo('stylesheet_url'));	
	
	if(of_get_option('vazz_colorscheme') != '') {
	$colorscheme = of_get_option('vazz_colorscheme');
	wp_enqueue_style('customskin', get_template_directory_uri(). '/stylesheets/skins/'.$colorscheme.'.css', 'style');
	} 
	else {
	wp_enqueue_style('defaultskin', get_template_directory_uri(). '/stylesheets/skins/teal.css', 'style');
	}
	
	}
	add_action( 'wp_enqueue_scripts', 'studiopaul_assets' );

/*********************************************************************************************
REMOVE JUNK FROM HEAD
*********************************************************************************************/
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);	

/*********************************************************************************************
REGISTER NAVIGATION MENUS
*********************************************************************************************/
function foundation_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'foundation' )
		)
	);	
}
add_action( 'init', 'foundation_menus' );

// Create a graceful fallback to wp_page_menu
function foundation_page_menu() {

	$args = array(
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => '',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => ''
	);

	wp_page_menu($args);
}

/*********************************************************************************************
POST FORMATS
*********************************************************************************************/
	add_theme_support( 'post-formats', array( 'gallery' ) );
	endif; // studiopaul_setup
	add_action( 'after_setup_theme', 'studiopaul_setup' );

/*********************************************************************************************
THUMBNAILS
*********************************************************************************************/
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
	}

	if ( function_exists( 'add_image_size' ) ) { 
			add_image_size( 'popularpost-thumb', 60, 60, true );
	}

/*********************************************************************************************
PINGBACK, TRACKBACK
*********************************************************************************************/
if ( ! function_exists( 'studiopaul_comment' ) ) :
function studiopaul_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'studiopaul' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'studiopaul' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s , %2$s :', 'studiopaul' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'studiopaul' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'studiopaul' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'studiopaul' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'studiopaul' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for studiopaul_comment()

/*********************************************************************************************
REGISTER GLOBAL SIDEBARS
*********************************************************************************************/
function is_sidebar_active($index) {
	global $wp_registered_sidebars;
	$widgetcolums = wp_get_sidebars_widgets();
	if ($widgetcolums[$index])
		return true;
	return false;
}

function studiopaul_widgets_init() {
	register_sidebar( array (
		'name' => __('Homepage', 'studiopaul'),
		'id' => 'home-page',
		'description' => __('Widget areas displayed below the slider (or intro text) on the homepage.', 'studiopaul'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	
	register_sidebar( array (
		'name' => __( 'Blog', 'studiopaul' ),
		'id' => 'blog',
		'description' => __('Widget areas displayed in blog.', 'studiopaul'),
		'before_widget' => '<div class="sidebarBox widget-container %2$s" id="%1$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
		
	register_sidebar( array (
		'name' => __( 'Page', 'studiopaul' ),
		'id' => 'page',
		'description' => __('Widget areas displayed in page sidebar (optional because you can choose a full width template when editing your page).', 'studiopaul'),
		'before_widget' => '<div class="sidebarBox widget-container %2$s" id="%1$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'studiopaul' ),
		'id' => 'footer-sidebar', 
		'description' => __( "Widget areas displayed in footer (3 widgets)", 'studiopaul' ),
		'before_widget' => '<div class="four columns widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1>','after_title' => '</h1>'
    ) );

}

add_action( 'init', 'studiopaul_widgets_init' );

/*********************************************************************************************
THEME OPTIONS
*********************************************************************************************/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options/' );
	require_once dirname( __FILE__ ) . '/options/options-framework.php';
}

/*********************************************************************************************
MORE FUNCTIONS, META, WIDGETS, SHORTCODES
*********************************************************************************************/    
	require( get_template_directory() . '/lib/customfunctions.php' );
	require( get_template_directory() . '/lib/meta/class-advanced-meta-box.php');
	require( get_template_directory() . '/lib/meta/advanced-meta-box-usage.php');
	require( get_template_directory() . '/lib/widgets/widget-facebook.php');
	require( get_template_directory() . '/lib/widgets/widget-banner.php');
	require( get_template_directory() . '/lib/widgets/widget-social.php');
	require( get_template_directory() . '/lib/widgets/widget-animatedboxes.php');
	require( get_template_directory() . '/lib/widgets/widget-infoboxes.php');	
	require( get_template_directory() . '/lib/widgets/widget-tabsandvid.php');
	include( get_template_directory() . '/lib/shortcodes/scripts.php'); 
	include( get_template_directory() . '/lib/shortcodes/shortcode-functions.php'); 
	include( get_template_directory() . '/lib/shortcodes/mce/vuzz_shortcodes_tinymce.php');
/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/

?>