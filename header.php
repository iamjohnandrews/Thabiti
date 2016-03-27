<!DOCTYPE html>
<html <?php language_attributes('html'); ?>>
<head>
<meta name="viewport" content="initial-scale=1.0,width=device-width,maximum-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
///////////
//VAR SETUP
///////////
$ajax = get_theme_mod('themolitor_customizer_ajax', TRUE);
if($ajax == true) { $ajax = 'ajax-on'; } else { $ajax = 'ajax-off'; }
$logo = get_theme_mod('themolitor_customizer_logo',get_template_directory_uri().'/images/logo.png');
$linkColor = get_theme_mod('themolitor_customizer_link_color','#fff');
$bgColor = get_theme_mod('themolitor_customizer_bg_color','#191919');
$headerOpacity = get_theme_mod('themolitor_customizer_bg_opacity','.35');
$headerOpacityWith = get_theme_mod('themolitor_customizer_bg_opacity_with','.8');
$googleKeyword = get_theme_mod('themolitor_customizer_google_key','Open Sans');
$customCSS = get_theme_mod( 'themolitor_customizer_css');
$bgURL = get_header_image();
$creditsSize = get_theme_mod('themolitor_customizer_credits_size','28');

wp_head();
?>

<script> var siteUrl = '<?php echo home_url('/'); ?>'; </script>

<style>
<?php if(!empty($googleKeyword)) echo 'body { font-family: "'.$googleKeyword.'", sans-serif;}'; ?>

/*--BACKGROUND COLOR--*/
body,
#sidebar,
#contentContainer {background-color: <?php echo $bgColor; ?>}

/*--LINK COLOR--*/
a {color: <?php echo $linkColor;?>;}

/*--OVERLAY OPACITY--*/
#headerImages:after,
.gallery-image:after,
.video-image-container:after,
body.page-template-page-reviews #headerImages:after {
	opacity: <?php echo $headerOpacity; ?>;
}

body.single #headerImages:after,
body.page-template-default #headerImages:after,
body.page-template-page-center #headerImages:after,
body.category #headerImages:after,
body.blog #headerImages:after,
body.archive #headerImages:after,
body.search #headerImages:after,
.page-image-container:after {
    opacity: <?php echo $headerOpacityWith; ?>;
}

#vys-credits span {
	font-size: <?php echo $creditsSize;?>px;
}

<?php echo $customCSS; ?>
</style>
</head>

<body <?php body_class($ajax);?>>

<div id="contentContainer">
	
	<!--LOGO-->
	<a id="logo" href="<?php echo home_url('/'); ?>"><img src="<?php echo $logo;?>" alt="<?php echo get_bloginfo('name').' - '.get_bloginfo('description'); ?>" /></a><!--end logo-->
		
	<!--MENU CONTROL-->
	<div id="menu-control"><span></span></div>
	
	<!--AJAX CONTAINER-->
	<div id="ajax-content">
	
	<!--PAGE INFO FOR UPDATING BODY CLASS AND DOC TITLE-->
	<div id="page-info" data-page-title="<?php wp_title( '|', true, 'right' ); ?>" <?php body_class($ajax);?>></div>
