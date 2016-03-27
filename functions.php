<?php
//////////////////
// TITLE TAG STUFF
//////////////////
add_theme_support( 'title-tag' );


///////////////////
//SIDEBAR GENERATOR
///////////////////
function vysual_widgets_init() {
    register_sidebar( array(
		'name'=>'Live Widgets',
		'id' => 'sidebar-1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
}
add_action( 'widgets_init', 'vysual_widgets_init' );


/////////////////////////
//ADD CLASS TO PAGE LINKS
/////////////////////////
add_filter('next_posts_link_attributes', 'next_post_link_att');
add_filter('previous_posts_link_attributes', 'prev_post_link_att');
//NEXT LINK
function next_post_link_att() {
    return 'id="nextpage" class="pagenav"';
}
//PREV LINK
function prev_post_link_att() {
    return 'id="backpage" class="pagenav"';
}


///////////////////////////
//IMAGE ATTACHMENTS TOOLBOX
///////////////////////////
function attachment_toolbox($size = 'full') {

	if($images = get_children(array(
		'order'   => 'ASC',
		'orderby' => 'menu_order',
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image'
	))) {
		foreach($images as $image) {
			$attimg   = wp_get_attachment_image($image->ID,$size);
			$atturl   = wp_get_attachment_url($image->ID);
			$atttitle = apply_filters('the_title',$image->post_title);
			$caption= apply_filters('the_excerpt',$image->post_excerpt);
			echo'<li class="gallery-image" style="background-image:url('.$atturl.');" data-imgtitle="'.$atttitle.'" data-caption="'.$caption.'">'.$attimg.'</li>';
		}
	}
}


//////////////
//POST FORMATS - http://codex.wordpress.org/Post_Formats
//////////////
add_theme_support( 'post-formats', array( 'video','quote','aside' ) );


///////////////////////
//Localization Support
///////////////////////
load_theme_textdomain( 'themolitor', get_template_directory().'/languages' );
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);
    
    
///////////////
//EDITOR STYLES
///////////////
function vys_add_editor_styles() {
    add_editor_style( '/css/vys-editor-style.css' );
}
add_action( 'init', 'vys_add_editor_styles' );


/////////////
//STYLESHEETS
/////////////
function vysual_enqueue_style() {
	$protocol = is_ssl() ? 'https' : 'http';
	$googleKeyword = get_theme_mod('themolitor_customizer_google_key','Open Sans');
	if(!empty($googleKeyword)) {
		$googleWeight = get_theme_mod('themolitor_customizer_google_weight','300,400,600');
		$googleKeyEdited = str_replace(" ", "+", $googleKeyword);
	    $protocol = is_ssl() ? 'https' : 'http';
	    wp_enqueue_style( 'vysual-fonts', $protocol.'://fonts.googleapis.com/css?family='.$googleKeyEdited.':'.$googleWeight );
	}
    wp_enqueue_style( 'poster-fonts', $protocol.'://fonts.googleapis.com/css?family=Six+Caps' );
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );
	wp_enqueue_style( 'respond', get_template_directory_uri() . '/css/respond.css');
	wp_enqueue_style( 'fonticons', get_template_directory_uri() . '/font-awesome-4.3.0/css/font-awesome.min.css');
	if(get_theme_mod('themolitor_customizer_video') != ''){
		wp_enqueue_style( 'background', get_template_directory_uri() . '/css/background.css');
	}
}
add_action( 'wp_enqueue_scripts', 'vysual_enqueue_style' );


/////////
//SCRIPTS
/////////
function vysual_enqueue_scripts() {
	wp_enqueue_script('comment-reply');
	wp_enqueue_script('jquery');
	if(get_theme_mod('themolitor_customizer_video') != ''){
		wp_enqueue_script('core',get_template_directory_uri() . '/scripts/core.js',array(),false,true);
		wp_enqueue_script('transition',get_template_directory_uri() . '/scripts/transition.js',array(),false,true);
		wp_enqueue_script('background',get_template_directory_uri() . '/scripts/background.js',array(),false,true);	
	}
	wp_enqueue_script('spin',get_template_directory_uri() . '/scripts/spin.js',array(),false,true);
	wp_enqueue_script('custom',get_template_directory_uri() . '/scripts/custom.js',array(),false,true);
	wp_enqueue_script('retina',get_template_directory_uri() . '/scripts/retina.js',array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'vysual_enqueue_scripts' );


/////////////////////
//CUSTOM HEADER IMAGE
/////////////////////
$headerArgs = array(
	'default-image' => get_template_directory_uri() . '/images/bridge.jpg',
	'header-text'   => false,
	'height'        => 800,
	'width'         => 1200,
	'uploads'       => true
);
add_theme_support( 'custom-header', $headerArgs );


///////////////
//CONTENT WIDTH
///////////////
if ( ! isset( $content_width ) ) $content_width = 500;


//////////////////////
//AUTOMATIC FEED LINKS
//////////////////////
add_theme_support('automatic-feed-links' );


////////////////////////
//FEATURED IMAGE SUPPORT
////////////////////////
add_theme_support( 'post-thumbnails', array( 'post','page') );
set_post_thumbnail_size( 700, 450, true );


//////////////////
//ADD MENU SUPPORT
//////////////////
add_theme_support( 'menus' );
register_nav_menu('main', 'Main Menu');
register_nav_menu('footer', 'Footer Menu');


///////////////
//POST OPTIONS
///////////////
include(TEMPLATEPATH . '/include/post-options/custom-meta-box-template.php');


///////////////
//THEME OPTIONS
///////////////
include(TEMPLATEPATH . '/include/theme-options.php');