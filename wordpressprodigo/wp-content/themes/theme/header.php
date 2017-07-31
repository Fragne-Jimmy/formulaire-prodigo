<?php
/**
 * The Header for our theme.
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;
wp_title( '|', true, 'right' );
// Add the blog name.
bloginfo( 'name' );
// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";
// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( __( 'Page %s', 'studiopaul' ), max( $paged, $page ) );
?></title>
<!-- meta -->
<meta name="viewport" content="width=device-width"/>
<?php if ( of_get_option('vazz_enablemeta')== '1') { ?>		

<meta name="keywords" content="<?php echo of_get_option('vazz_metakeywords')  ?>" />
<meta name="revisit-after" content="<?php echo of_get_option('vazz_revisitafter')  ?> days" />
<meta name="author" content="">
<?php } ?>
<?php if ( of_get_option('vazz_enablerobot')== '1') { ?>		
<!-- robots -->
<meta name="robots" content="<?php echo of_get_option('vazz_metabots')  ?>" />
<meta name="msvalidate.01" content="04588BBFC047C4D64FEF93159B0F1AE2" />
<meta name="googlebot" content="<?php echo of_get_option('vazz_metagooglebot')  ?>" />
<?php } ?>		
<!-- icons & favicons-->
<?php if (of_get_option('vazz_custom_shortcut_favicon') != '') { echo '<link rel="shortcut icon" href="'. of_get_option('vazz_custom_shortcut_favicon') .'" type="image/ico" />'."\n";	} ?>		
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	<?php 
	wp_head();
	
	if(of_get_option('vazz_css_code') != '') { 		 
	load_template( get_template_directory() . '/stylesheets/custom.css.php' );
	}
	if(of_get_option('vazz_activate_custom_skin') == '1') { 
	load_template( get_template_directory() . '/stylesheets/customskin.css.php' );
	}
	if ( of_get_option('vazz_enabletwitter')== '1') {
    vazz_twitter();
	}
	?>
</head>
<body <?php body_class(); ?>>
<!-- HIDDEN PANEL 
================================================== -->
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=203633783040676";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php if(of_get_option('vazz_hiddenpanel') == '1') { 
// Enque elastic slider script
wp_enqueue_script('vuzzhiddenpanel');
?>
<div id="panel">
	<div class="row">		
		<div class="twelve columns">
			<img src="<?php echo get_template_directory_uri(); ?>/images/info.png" class="pics" alt="info">
			<div class="infotext">
				<?php echo of_get_option('vazz_hiddenpanel_text')  ?>
			</div>
		</div>
	</div>
</div>
<p class="topborderslide">
	<a href="#" class="btn-slide"></a>
</p>
<?php } else { ?>
<p class="topborderslide"></p>
<?php }?>
<!-- LOGO & MENU 
================================================== -->
<div class="row header">	
	<div class="four columns">
		<!-- begin #logo -->
		<div class="logo">	
		<?php if ( !of_get_option('vazz_thelogo')== '') { ?>
		<hgroup class="logo-wrapper">
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option('vazz_thelogo'); ?>" alt="<?php echo bloginfo( 'name' ) ?>" /></a></h1>							
		</hgroup>						
		<?php } else { ?>		
		<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php if( !of_get_option('vazz_thelogo_text')== '') {
				echo of_get_option('vazz_thelogo_text'); 
				} else {
				bloginfo( 'name' );
			}
			?></a></h1>					
		<?php }?>		
		</div>
		<!-- end #logo -->
	</div>		
	<div class="eight columns noleftmarg">
		<!-- begin #nav-wrap -->
		<nav id="nav-wrap">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav-bar sf-menu', ) ); ?>  
		</nav>
		<!-- end #nav-wrap -->		
	</div>
</div>
<!-- Begin Page -->