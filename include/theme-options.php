<?php
add_action( 'customize_register', 'themolitor_customizer_register' );

function themolitor_customizer_register($wp_customize) {

	//CREATE TEXTAREA OPTION
	class Example_Customize_Textarea_Control extends WP_Customize_Control {
    	public $type = 'textarea';
 
    	public function render_content() { ?>
        	<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        	</label>
        <?php }
	}
	
	//-------------------------------
	//-------------------------------
	//SANITIZATION FUNCTIONS
	//-------------------------------
	//-------------------------------
	
	//TEXT -- ALL
	function themolitor_sanitize_text( $input ) {
	    return wp_kses_post($input);
	}
	
	//CHECKBOX -- ALL
	function themolitor_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	//NUMBER CHECK
	function themolitor_sanitize_number( $input ) {
	   if(is_numeric($input)){
	        return $input;
	    } else {
	        return '';
	    }
	}

	//RATING OPTION
	function themolitor_sanitize_rating( $input ) {
	    $valid = array(
	        '' => 'Off',
   	 		'g' => 'G',
   	 		'pg' => 'PG',
   	 		'pg13' => 'PG-13',
   	 		'r' => 'R',
   	 		'nc17' => 'NC-17',
   	 		'no' => 'Not Yet Rated'
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}	

	//-------------------------------
	//SITE TITLE SECTION
	//-------------------------------
	
	//LOGO
	$wp_customize->add_setting( 'themolitor_customizer_logo', array(
		'default' => get_template_directory_uri().'/images/logo.png',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themolitor_customizer_logo', array(
    	'label'    => __('Logo', 'themolitor'),
    	'section'  => 'title_tagline',
    	'settings' => 'themolitor_customizer_logo',
    	'priority' => 1
	)));
	
	//LOGO
	$wp_customize->add_setting( 'themolitor_customizer_logo_2x', array(
		'default' => get_template_directory_uri().'/images/logo@2x.png',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themolitor_customizer_logo_2x', array(
    	'label'    => __('Hi-Res Logo', 'themolitor'),
    	'section'  => 'title_tagline',
    	'settings' => 'themolitor_customizer_logo_2x',
    	'description' => __('Image should be twice as large as logo above with "@2x" added to filename.','themolitor'),
    	'priority' => 2
	)));
	
	//SIDEBAR LOGO
	$wp_customize->add_setting( 'themolitor_customizer_sidebar_logo', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_sidebar_logo', array(
    	'label' => 'Display Logo in Sidebar',
    	'type' => 'checkbox',
    	'section' => 'title_tagline',
    	'settings' => 'themolitor_customizer_sidebar_logo',
    	'priority' => 3
	));
	
	//FOOTER LOGO
	$wp_customize->add_setting( 'themolitor_customizer_footer_logo', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_footer_logo', array(
    	'label' => 'Display Logo in Footer',
    	'type' => 'checkbox',
    	'section' => 'title_tagline',
    	'settings' => 'themolitor_customizer_footer_logo',
    	'priority' => 4
	));
	
	
	//-------------------------------
	//COLORS SECTION
	//-------------------------------
		
	//LINK COLOR
	$wp_customize->add_setting( 'themolitor_customizer_link_color', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_link_color', array(
		'label'   => __( 'Link Color', 'themolitor'),
		'section' => 'colors',
		'settings'   => 'themolitor_customizer_link_color',
    	'priority' => 1
	)));
	
	//BACKGROUND COLOR
	$wp_customize->add_setting( 'themolitor_customizer_bg_color', array(
		'default' => '#191919',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_bg_color', array(
		'label'   => __( 'Background Color', 'themolitor'),
		'section' => 'colors',
		'settings'   => 'themolitor_customizer_bg_color',
    	'priority' => 2
	)));
	
	//-------------------------------
	//HEADER IMAGE SECTION
	//-------------------------------
		
	//SLIDESHOW ON
	$wp_customize->add_setting( 'themolitor_customizer_slideshow_on', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_slideshow_on', array(
    	'label' => 'Slideshow On',
    	'type' => 'checkbox',
    	'section' => 'header_image',
    	'settings' => 'themolitor_customizer_slideshow_on',
    	'priority' => 2
	));
	
	//SLIDESHOW TIME
   	$wp_customize->add_setting( 'themolitor_customizer_slideshow_time',array(
   		'default' => '10',
   		'sanitize_callback' => 'themolitor_sanitize_number',
   	));
	$wp_customize->add_control('themolitor_customizer_slideshow_time', array(
    	'label'    => __('Slideshow Pause Time (seconds)', 'themolitor'),
    	'section'  => 'header_image',
    	'settings' => 'themolitor_customizer_slideshow_time',
    	'type' => 'text',
    	'priority' => 3
	));
	
	//OPACITY
   	$wp_customize->add_setting( 'themolitor_customizer_bg_opacity',array(
   		'default' => '.35',
   		'sanitize_callback' => 'themolitor_sanitize_number',
   	));
	$wp_customize->add_control( 'themolitor_customizer_bg_opacity', array(
	    'type'        => 'range',
	    'priority'    => 6,
	    'section'     => 'header_image',
	    'settings' => 'themolitor_customizer_bg_opacity',
	    'label'       => 'Image Overlay Transparency (no conten)',
	    'input_attrs' => array(
	        'min'   => 0,
	        'max'   => 1,
	        'step'  => .05,
	        'class' => 'test-class test',
	        'style' => 'color: #0a0',
	    ),
	));
	
	//OPACITY
   	$wp_customize->add_setting( 'themolitor_customizer_bg_opacity_with',array(
   		'default' => '.8',
   		'sanitize_callback' => 'themolitor_sanitize_number',
   	));
	$wp_customize->add_control( 'themolitor_customizer_bg_opacity_with', array(
	    'type'        => 'range',
	    'priority'    => 7,
	    'section'     => 'header_image',
	    'settings' => 'themolitor_customizer_bg_opacity_with',
	    'label'       => 'Image Overlay Transparency (with content)',
	    'input_attrs' => array(
	        'min'   => 0,
	        'max'   => 1,
	        'step'  => .05,
	        'class' => 'test-class test',
	        'style' => 'color: #0a0',
	    ),
	));

	
	//-------------------------------
	//STATIC FRONT PAGE SECTION
	//-------------------------------

	//AUTOPLAY VIDEO
	$wp_customize->add_setting( 'themolitor_customizer_showvideo', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_showvideo', array(
    	'label' => 'Auto play video in Pop-up',
    	'type' => 'checkbox',
    	'section' => 'static_front_page',
    	'settings' => 'themolitor_customizer_showvideo',
    	'priority' => 100
	));
	
	
	//-------------------------------
	//VIDEO SECTION
	//-------------------------------
	
	//ADD VIDEO SECTION
	$wp_customize->add_section( 'themolitor_customizer_video_section', array(
		'title' => __( 'Video Background', 'themolitor' ),
		'priority' => 196
	));
	
	//VIDEO URL
    $wp_customize->add_setting( 'themolitor_customizer_video', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_video', array(
   		'label'   => __( 'MP4 Video URL', 'themolitor'),
   		'description' => 'Video will override header image settings.',
    	'section' => 'themolitor_customizer_video_section',
    	'settings'   => 'themolitor_customizer_video',
    	'type' => 'text',
    	'priority' => 1
	));
	
	
	//-------------------------------
	//AUDIO SECTION
	//-------------------------------

	//ADD AUDIO SECTION
	$wp_customize->add_section( 'themolitor_customizer_audio_section', array(
		'title' => __( 'Audio', 'themolitor' ),
		'priority' => 197
	));
	
	//AUDIO URL
    $wp_customize->add_setting( 'themolitor_customizer_audio',array(
    	'default' => get_template_directory_uri().'/audio/secrets-demo.mp3',
    	'sanitize_callback' => 'esc_url_raw',
    ));
	$wp_customize->add_control('themolitor_customizer_audio', array(
   		'label'   => __( 'MP3 Audio URL', 'themolitor'),
    	'section' => 'themolitor_customizer_audio_section',
    	'settings'   => 'themolitor_customizer_audio',
    	'type' => 'text',
    	'priority' => 1
	));
	
	//AUTOPLAY AUDIO
	$wp_customize->add_setting( 'themolitor_customizer_autoplay', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_autoplay', array(
    	'label' => 'Autoplay',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_audio_section',
    	'settings' => 'themolitor_customizer_autoplay',
    	'priority' => 2
	));
	
	
	//-------------------------------
	//SOCIAL / SEARCH SECTION
	//-------------------------------

	//ADD SOCIAL SECTION
	$wp_customize->add_section( 'themolitor_customizer_social_section', array(
		'title' => __( 'Search / Social', 'themolitor' ),
		'priority' => 199
	));
	
	//DISPLAY SEARCH BUTTON
	$wp_customize->add_setting( 'themolitor_customizer_search_onoff', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_search_onoff', array(
    	'label' => 'Display Search Button',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_social_section',
    	'settings' => 'themolitor_customizer_search_onoff',
    	'priority' => 1
	));
	
	//DISPLAY RSS BUTTON
	$wp_customize->add_setting( 'themolitor_customizer_rss_onoff', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_rss_onoff', array(
    	'label' => 'Display RSS Button',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_social_section',
    	'settings' => 'themolitor_customizer_rss_onoff',
    	'priority' => 2
	));
	
	//FACEBOOK
    $wp_customize->add_setting( 'themolitor_customizer_facebook', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_facebook', array(
   		'label'   => __( 'Facebook URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_facebook',
    	'type' => 'text',
    	'priority' => 3
	));
	
	//TWITTER
    $wp_customize->add_setting( 'themolitor_customizer_twitter', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_twitter', array(
   		'label'   => __( 'Twitter URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_twitter',
    	'type' => 'text',
    	'priority' => 4
	));
	
	//YOUTUBE
    $wp_customize->add_setting( 'themolitor_customizer_youtube', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_youtube', array(
   		'label'   => __( 'YouTube URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_youtube',
    	'type' => 'text',
    	'priority' => 5
	));
	
	//VIMEO
    $wp_customize->add_setting( 'themolitor_customizer_vimeo', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_vimeo', array(
   		'label'   => __( 'Vimeo URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_vimeo',
    	'type' => 'text',
    	'priority' => 6
	));
	
	//INSTAGRAM
    $wp_customize->add_setting( 'themolitor_customizer_instagram', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_instagram', array(
   		'label'   => __( 'Instagram URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_instagram',
    	'type' => 'text',
    	'priority' => 7
	));
	
	//GOOGLE+
    $wp_customize->add_setting( 'themolitor_customizer_google_plus', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_google_plus', array(
   		'label'   => __( 'Google+ URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_google_plus',
    	'type' => 'text',
    	'priority' => 8
	));
	
	//TUMBLR
    $wp_customize->add_setting( 'themolitor_customizer_tumblr', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_tumblr', array(
   		'label'   => __( 'Tumblr URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_tumblr',
    	'type' => 'text',
    	'priority' => 9
	));
	
	//FLIKr
    $wp_customize->add_setting( 'themolitor_customizer_flikr', array(
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_flikr', array(
   		'label'   => __( 'Flikr URL', 'themolitor'),
    	'section' => 'themolitor_customizer_social_section',
    	'settings'   => 'themolitor_customizer_flikr',
    	'type' => 'text',
    	'priority' => 10
	));
	
	
	//-------------------------------
	//FOOTER SECTION
	//-------------------------------

	//ADD FOOTER SECTION
	$wp_customize->add_section( 'themolitor_customizer_footer_section', array(
		'title' => __( 'Footer', 'themolitor' ),
		'priority' => 200
	));
	
	//CREDITS TEXT
    $wp_customize->add_setting( 'themolitor_customizer_credits',array(
    	'default' => '[STUDIO NAME PICTURES (presents)] [(an) PRODUCERS (production)] [(a) JOHN DOE (picture)] [BOB SMITH] [JESSICA PHILLIPS] ["VYSUAL"] [(casting by) THE CASTING COMPANY] [(costumes by) THE COSTUME PEOPLE] [(production designer) THE SET DESIGN CREW] [(director of photography) CINEMATOGRAPHER] [(music by) THE COMPOSER DUDE] [(edited by) THE EDITOR GUY] [(executive producer) GUY ONE  GUY TWO] [(produced by) THE GUY WITH ALL THE MONEY] [(story by) THE NOVELIST] [(screenplay by) THE SCREEN WRITER] [(directed by) DIRECTOR NAME HERE]',
 		'sanitize_callback' => 'themolitor_sanitize_text',
    ));
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'themolitor_customizer_credits', array(
   		'label'   => __( 'Credits - [GROUP (small text)]', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_credits',
    	'priority' => 2
	)));
	
	//CREDITS FONT SIZE
   	$wp_customize->add_setting( 'themolitor_customizer_credits_size',array(
   		'default' => '28',
   		'sanitize_callback' => 'themolitor_sanitize_number',
   	));
	$wp_customize->add_control( 'themolitor_customizer_credits_size', array(
	    'type'        => 'range',
	    'priority'    => 3,
	    'section'     => 'themolitor_customizer_footer_section',
	    'settings' => 'themolitor_customizer_credits_size',
	    'label'       => 'Credits Text Size',
	    'input_attrs' => array(
	        'min'   => 22,
	        'max'   => 40,
	        'step'  => 2,
	        'class' => 'test-class test',
	        'style' => 'color: #0a0',
	    ),
	));
		
	//RATING
	$wp_customize->add_setting('themolitor_rating', array(
	    'capability'     => 'edit_theme_options',
	    'type'           => 'option',
	    'default' => 'no',
	    'sanitize_callback' => 'themolitor_sanitize_rating',
	));
	$wp_customize->add_control( 'themolitor_rating', array(
 	   'settings' => 'themolitor_rating',
 	   'label'   => __('Rating','themolitor'),
   	 	'section' => 'themolitor_customizer_footer_section',
   	 	'type'    => 'select',
   	 	'choices' => array(
   	 		'' => 'Off',
   	 		'g' => 'G',
   	 		'pg' => 'PG',
   	 		'pg13' => 'PG-13',
   	 		'r' => 'R',
   	 		'nc17' => 'NC-17',
   	 		'no' => 'Not Yet Rated'
   	 	),
    	'priority' => 4
	));
	
	//FOOTER TEXT
    $wp_customize->add_setting( 'themolitor_customizer_footer',array(
    	'default' => 'Handcrafted by <a target="_blank" href="http://themolitor.com">THE MOLITOR</a>',
    	'sanitize_callback' => 'themolitor_sanitize_text',
    ));
	$wp_customize->add_control('themolitor_customizer_footer', array(
   		'label'   => __( 'Copyright Text', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_footer',
    	'type' => 'text',
    	'priority' => 5
	));

	
	//-------------------------------
	//GOOGLE FONT SECTION
	//-------------------------------

	//ADD GOOGLE FONT SECTION
	$wp_customize->add_section( 'themolitor_customizer_googlefont_section', array(
		'title' => __( 'Google Font', 'themolitor' ),
		'description' => 'For available fonts, visit <a target="_blank" href="http://google.com/fonts">google.com/fonts</a> ',
		'priority' => 201
	));
	
	//GOOGLE KEYWORD
    $wp_customize->add_setting( 'themolitor_customizer_google_key', array(
    	'default' => 'Open Sans',
    	'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control('themolitor_customizer_google_key', array(
   		'label'   => __( 'Font Name', 'themolitor'),
    	'section' => 'themolitor_customizer_googlefont_section',
    	'settings'   => 'themolitor_customizer_google_key',
    	'type' => 'text',
    	'priority' => 1
	));
	
	//GOOGLE WEIGHT
    $wp_customize->add_setting( 'themolitor_customizer_google_weight', array(
    	'default' => '300,400,600',
    	'sanitize_callback' => 'themolitor_sanitize_number',
	));
	$wp_customize->add_control('themolitor_customizer_google_weight', array(
   		'label'   => __( 'Font Weights', 'themolitor'),
    	'section' => 'themolitor_customizer_googlefont_section',
    	'settings'   => 'themolitor_customizer_google_weight',
    	'type' => 'text',
    	'priority' => 2
	));
	
	
	//-------------------------------
	//SCRIPTS SECTION
	//-------------------------------
	
	//ADD SCRIPTS SECTION
	$wp_customize->add_section( 'themolitor_customizer_scripts', array(
		'title' => __( 'jQuery', 'themolitor' ),
		'priority' => 202,
	));
	
	//AJAX ON/OFF
	$wp_customize->add_setting( 'themolitor_customizer_ajax', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_ajax', array(
    	'label' => 'Load pages with AJAX',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_scripts',
    	'settings' => 'themolitor_customizer_ajax',
    	'priority' => 1
	));
			
	//CUSTOM SCRIPTS
    $wp_customize->add_setting( 'themolitor_customizer_run_scripts', array(
		'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'themolitor_customizer_run_scripts', array(
   		'label'   => __( 'Run scripts / functions after AJAX', 'themolitor'),
    	'section' => 'themolitor_customizer_scripts',
    	'settings'   => 'themolitor_customizer_run_scripts',
    	'priority' => 2
	)));
	
			
	//-------------------------------
	//CUSTOM CSS SECTION
	//-------------------------------
	
	//ADD CSS SECTION
	$wp_customize->add_section( 'themolitor_customizer_custom_css', array(
		'title' => __( 'CSS', 'themolitor' ),
		'priority' => 203,
	));
			
	//CUSTOM CSS
    $wp_customize->add_setting( 'themolitor_customizer_css', array(
		'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'themolitor_customizer_css', array(
   		'label'   => __( 'Custom CSS', 'themolitor'),
    	'section' => 'themolitor_customizer_custom_css',
    	'settings'   => 'themolitor_customizer_css',
    	'priority' => 1
	)));
}