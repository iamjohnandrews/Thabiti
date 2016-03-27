<?php 
///////////
//VAR SETUP
///////////
$logo = get_theme_mod('themolitor_customizer_logo', get_template_directory_uri().'/images/logo.png');
$sidebarLogo = get_theme_mod('themolitor_customizer_sidebar_logo', TRUE);


////////////////////
//DIV + CLOSE BUTTON
////////////////////
echo '<div id="sidebar">';


//////
//LOGO
//////
if($sidebarLogo == 1) { 
	echo '<a id="sidebar-logo" href="'. home_url('/').'"><img src="'.$logo.'" alt="'. get_bloginfo('name').' - '.get_bloginfo('description').'" /></a>'; 
}


//////
//MENU
//////
if (has_nav_menu( 'main' ) ) { 
	if($sidebarLogo == 1){
		wp_nav_menu(array('container' => 'nav','container_class' => 'hasLogo','theme_location' => 'main', 'container_id' => 'navigation', 'menu_id' => 'dropmenu')); 
	} else {
		wp_nav_menu(array('container' => 'nav','theme_location' => 'main', 'container_id' => 'navigation', 'menu_id' => 'dropmenu')); 
	}
}


/////////
//WIDGETS
/////////
if ( is_active_sidebar( 1 ) ) {
	echo '<ul id="sidebar-widgets">';
		dynamic_sidebar( 1 );
	echo '</ul>';
}


///////////
//CLOSE DIV
///////////
echo '</div><!--end sidebar-->';
?>