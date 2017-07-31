<style type="text/css" media="all">
body, .centersectiontitle h1, .sectiontitle h1 { <?php $background = of_get_option('vazz_custom_bg');
if ($background) {
if ($background['image']) {
echo ' background:url('.$background['image'].') '.' '. $background['color'] .' '. $background['repeat'] .' '. $background['position'] .' '. $background['attachment'] .';';
}else{
echo ' background-color:'.$background['color'].'';
}
};
?>;} 
a {color: <?php echo of_get_option('vazz_link_color');?>;}
a:hover {color: <?php echo of_get_option('vazz_link_color_hover');?>;}
.colorme {color:<?php echo of_get_option('vazz_primary_color');?>;}
.recentpostsmore, .ei-title h2 {background:<?php echo of_get_option('vazz_primary_color');?>;}
.nav-bar > li:hover, .nav-bar > li a:hover  { color:<?php echo of_get_option('vazz_primary_color');?>;}
.nav-bar > li.active > a { }
ul.flyout li a:hover, .nav-bar li ul li a:hover {color:<?php echo of_get_option('vazz_primary_color');?>;}
.flyout {border-top:2px solid <?php echo of_get_option('vazz_primary_color');?>;}
.sectiontitle, .sectiontitlepost {border-left: 4px solid <?php echo of_get_option('vazz_primary_color');?>;}
::-moz-selection{background:<?php echo of_get_option('vazz_primary_color');?>;color:#fff;}
::selection{background:<?php echo of_get_option('vazz_primary_color');?>;color:#fff;}
.ca-menu li:hover .ca-main {color: <?php echo of_get_option('vazz_primary_color');?>;}
.topborder { border-top:4px solid <?php echo of_get_option('vazz_primary_color');?>;}
#subheader {background: <?php echo of_get_option('vazz_breadcrumb_background');?>; border-top: 1px solid <?php echo of_get_option('vazz_breadcrumb_background');?>; color: <?php echo of_get_option('vazz_breadcrumb_text');?>;}
#subheader a {color: <?php echo of_get_option('vazz_breadcrumb_text');?>;}
#subheader a:hover  {color: <?php echo of_get_option('vazz_breadcrumb_text');?>;}
.noslide h1, .noslide h1 a, a.noslide h1 {color: <?php echo of_get_option('vazz_breadcrumb_text');?>;}
.noslide h3, .noslide h3 a, a.noslide h3 {color: <?php echo of_get_option('vazz_breadcrumb_text');?>;}
#testimonials blockquote cite {color:<?php echo of_get_option('vazz_primary_color');?>;}
a.tagcloud, .tagcloud a {background:<?php echo of_get_option('vazz_primary_color');?>;}
ul.pagination li.current a {background: <?php echo of_get_option('vazz_primary_color');?>;}
.saymore {color:<?php echo of_get_option('vazz_primary_color');?>;}
dl.tabs dd.active { border-bottom: 3px solid <?php echo of_get_option('vazz_primary_color');?>;}
ul.accordion > li.active {border-top: 3px solid <?php echo of_get_option('vazz_primary_color');?>;}
.topborderslide {margin: 0;	padding: 0;	border-top: solid 4px <?php echo of_get_option('vazz_primary_color');?>;}
.btn-slide {background:<?php echo of_get_option('vazz_primary_color');?> url(<?php echo get_template_directory_uri();?>/images/plus.png) no-repeat;}
.btn-slide.active { background: <?php echo of_get_option('vazz_primary_color');?> url(<?php echo get_template_directory_uri();?>/images/minus.png) no-repeat;}
#footer {border-top:<?php echo of_get_option('vazz_primary_color');?> 4px solid;}
.sf-shadow ul {border-top:2px solid <?php echo of_get_option('vazz_primary_color');?>;}
.panel {border-left:4px solid <?php echo of_get_option('vazz_primary_color');?>;}
.pagination-comments .current, #commentform input#submit,.readmore, .submit, div.alert-box.default,.colorbackground ,.pagination .current, .pagination a:hover{background:<?php echo of_get_option('vazz_primary_color');?>;}
.back-top a:hover {background:<?php echo of_get_option('vazz_primary_color');?> url(<?php echo get_template_directory_uri();?>/images/up-arrow.png) no-repeat center center;}
.bordercomment {border-top: 1px solid <?php echo of_get_option('vazz_primary_color');?>;}
.vuzz-pricing-table .vuzz-pricing-cost, .vuzz-pricing-table .vuzz-pricing-per, .pagination .currentpage, .recentpostsmore {background:<?php echo of_get_option('vazz_primary_color');?>;}
.innerp:hover,.innerp:hover,.innerp a:hover,.innergalleryp:hover,.innerpthree:hover,.innerpthree:hover,.innerpthree a:hover,.innerpfour:hover,.innerpfour:hover,.innerpfour a:hover,.innergalleryp:hover{color:<?php echo of_get_option('vazz_primary_color');?>;}
.pagination-comments .current{background:<?php echo of_get_option('vazz_primary_color');?> !important;}
.multi-sidebar .tabs a:hover {color:<?php echo of_get_option('vazz_primary_color');?>;}
.multi-sidebar .tabs .ui-tabs-selected a {border-bottom: 2px solid <?php echo of_get_option('vazz_primary_color');?>;}
a.projectdetail{background:<?php echo of_get_option('vazz_primary_color');?>;}
.ui-tabs-active {border-bottom: 2px solid <?php echo of_get_option('vazz_primary_color');?>;}
.vuzz-tabs ul.ui-tabs-nav .ui-state-active a {border-bottom: 3px solid <?php echo of_get_option('vazz_primary_color');?>;}
.vuzz-pricing-table > div {border-top: <?php echo of_get_option('vazz_primary_color');?> 3px solid;}
.vuzz-accordion .vuzz-accordion-trigger.ui-state-active {border-top: 3px solid <?php echo of_get_option('vazz_primary_color');?>;}
</style>