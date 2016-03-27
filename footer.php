<?php
///////////
//VAR SETUP
///////////
$logo = get_theme_mod('themolitor_customizer_logo',get_template_directory_uri().'/images/logo.png');
$showVideo = get_theme_mod('themolitor_customizer_showvideo',TRUE);
$footerLogo = get_theme_mod('themolitor_customizer_footer_logo',TRUE);
$videoUrl = get_theme_mod('themolitor_customizer_video');
$audioUrl = get_theme_mod('themolitor_customizer_audio',get_template_directory_uri().'/audio/secrets-demo.mp3');
$autoplay = get_theme_mod('themolitor_customizer_autoplay',TRUE);
$credits = get_theme_mod('themolitor_customizer_credits','[STUDIO NAME PICTURES (presents)] [(an) PRODUCERS (production)] [(a) JOHN DOE (picture)] [BOB SMITH] [JESSICA PHILLIPS] ["VYSUAL"] [(casting by) THE CASTING COMPANY] [(costumes by) THE COSTUME PEOPLE] [(production designer) THE SET DESIGN CREW] [(director of photography) CINEMATOGRAPHER] [(music by) THE COMPOSER DUDE] [(edited by) THE EDITOR GUY] [(executive producer) GUY ONE  GUY TWO] [(produced by) THE GUY WITH ALL THE MONEY] [(story by) THE NOVELIST] [(screenplay by) THE SCREEN WRITER] [(directed by) DIRECTOR NAME HERE]');
$notCoded = array('[', ']', '(',')');
$coded = array('<span>', '</span>', '<small>','</small>');
$creditText = str_replace($notCoded, $coded, $credits);
$footerText = get_theme_mod('themolitor_customizer_footer');
$displaySearch = get_theme_mod('themolitor_customizer_search_onoff',TRUE);
$displayRss = get_theme_mod('themolitor_customizer_rss_onoff',TRUE);
$facebookLink = get_theme_mod('themolitor_customizer_facebook');
$twitterLink = get_theme_mod('themolitor_customizer_twitter');
$youtubeLink = get_theme_mod('themolitor_customizer_youtube');
$vimeoLink = get_theme_mod('themolitor_customizer_vimeo');
$instagramLink = get_theme_mod('themolitor_customizer_instagram');
$googleLink = get_theme_mod('themolitor_customizer_google_plus');
$tumblrLink = get_theme_mod('themolitor_customizer_tumblr');
$flikrLink = get_theme_mod('themolitor_customizer_flikr');
$rating = get_option('themolitor_rating','no');
$headerImages = get_uploaded_header_images();
$slideshowOn = get_theme_mod('themolitor_customizer_slideshow_on',TRUE);
$slideshowTime = get_theme_mod('themolitor_customizer_slideshow_time','8') * 1000;
$headerImages = get_uploaded_header_images();
$bgURL = get_header_image();
if($bgURL == ''){$bgURL = get_template_directory_uri().'/images/bridge.jpg';}
$runScripts = get_theme_mod('themolitor_customizer_run_scripts');
?>

</div><!--CLOSE AJAX CONTENT-->

	<!--FULL SEARCH BAR-->
	<?php if($displaySearch == 1){ ?>
	<form role="search" method="get" id="full-search" action="<?php echo home_url( '/' ); ?>">
		<input type="text" value="<?php _e('Search Site...','themolitor'); ?>" onfocus="this.value='';" name="s" id="big-input" />
	</form>
	<?php } ?>
	
	<!--AUDIO PLAYER-->
	<?php if($audioUrl != ''){ ?>
	<div id="audioControl" class="paused">
		<span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
	</div>
	<audio id="audioPlayer">
	  <source src="<?php echo $audioUrl; ?>" type="audio/mpeg">
	</audio>
	<?php } ?>
		
	<!--SOCIAL ICONS-->
	<div id="socialIcons">
		<?php if($displaySearch == 1){ ?><a id="link-search" rel="search" data-title="Search" href="#"><i class="fa fa-search"></i></a><?php } ?>
		<?php if($displayRss == 1){ ?><a target="_blank" id="link-rss" data-title="RSS" href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss"></i></a><?php } ?>
		<?php if($facebookLink != ''){ ?><a target="_blank" id="link-facebook" data-title="Facebook" href="<?php echo $facebookLink; ?>"><i class="fa fa-facebook"></i></a><?php } ?>
		<?php if($twitterLink != ''){ ?><a target="_blank" id="link-twitter" data-title="Twitter" href="<?php echo $twitterLink; ?>"><i class="fa fa-twitter"></i></a><?php } ?>
		<?php if($youtubeLink != ''){ ?><a target="_blank" id="link-youtube" data-title="YouTube" href="<?php echo $youtubeLink; ?>"><i class="fa fa-youtube-play"></i></a><?php } ?>
		<?php if($vimeoLink != ''){ ?><a target="_blank" id="link-vimeo" data-title="Vimeo" href="<?php echo $vimeoLink; ?>"><i class="fa fa-vimeo-square"></i></a><?php } ?>
		<?php if($instagramLink != ''){ ?><a target="_blank" id="link-instagram" data-title="Instagram" href="<?php echo $instagramLink; ?>"><i class="fa fa-instagram"></i></a><?php } ?>
		<?php if($googleLink != ''){ ?><a target="_blank" id="link-google-plus" data-title="Google+" href="<?php echo $googleLink; ?>"><i class="fa fa-google-plus"></i></a><?php } ?>
		<?php if($tumblrLink != ''){ ?><a target="_blank" id="link-tumblr" data-title="Tumblr" href="<?php echo $tumblrLink; ?>"><i class="fa fa-tumblr"></i></a><?php } ?>
		<?php if($flikrLink != ''){ ?><a target="_blank" id="link-flickr" data-title="Flickr" href="<?php echo $flikrLink; ?>"><i class="fa fa-flickr"></i></a><?php } ?>
	</div>
		
	<!--IMAGE SLIDESHOW-->
	<div id="headerImages">
		<?php 
		if($headerImages != '' && $videoUrl == '' && $slideshowOn == TRUE){
			if(is_random_header_image()) { shuffle($headerImages); }
			foreach($headerImages as $headerImage) {
				if ($headerImage === reset($headerImages)) {
					echo '<div class="header-image activeBg" style="background-image:url('.$headerImage['url'].');"><img src="'.$headerImage['url'].'" alt=""></div>';
				} else {
					echo '<div class="header-image" style="background-image:url('.$headerImage['url'].');"><img src="'.$headerImage['url'].'" alt=""></div>';
				}
			}
		} elseif($bgURL != '' && $videoUrl == '') {
			echo '<div class="header-image activeBg" style="background-image:url('.$bgURL.');"><img src="'.$bgURL.'" alt=""></div>';
		} ?>
	</div><!--end headerImages-->
	
	<!--LOADING ANIMATION-->
	<div id="loading-page"></div>
	
	<!--CONTENT COVER-->
	<div id="contentCover"></div>
	
</div><!--end contentContainer-->

<div id="footerContainer">
	<div id="footer">  		
		
		<!--CREDITS-->
		<?php if($footerLogo == 1 || $creditText != '' || $rating != '') { ?>
		<div id="vys-credits">
			<?php 
			//LOGO
			if($footerLogo == 1) { echo '<a id="footer-logo" href="'. home_url('/').'"><img src="'.$logo.'" alt="'. get_bloginfo('name').' - '.get_bloginfo('description').'" /></a><!--end logo-->'; }
			//TEXT
			if($creditText != '') { echo $creditText; } 
			//RATING
			if($rating != '') { get_template_part('rating'); } 
			?>
		</div><!--end vys-credits-->
		<?php } ?>
	
		<!--FOOTER MENU-->
		<?php if ( has_nav_menu('footer') ) { 
			wp_nav_menu(array(
				'depth'=> 1,
				'theme_location' => 'footer', 
				'container_id' => 'footerMenuContainer', 
				'menu_id' => 'footerMenu'
			))
		;} ?>
		
		<!--COPYRIGHT NOTICE-->
		<div id="copyright">&copy; <?php echo date('Y '); bloginfo('name'); ?>. <?php echo $footerText;?></div>
		
	</div><!--end footer-->
</div><!--end footerContainer-->

<?php
get_sidebar();
wp_footer(); 
?>

<script>
jQuery(document).ready(function(){	
	
	////////////////
	//INTERVAL SETUP
	////////////////
	reviewinterval = '';
	headerinterval = '';
	
	//////////////////
	//REVIEWS INTERVAL -- runReviews
	//////////////////
	function runReviews(){
		if(jQuery('.review').length > 1){
			clearInterval(reviewinterval);
			reviewinterval = setInterval(function(){ reviewsSlideshow(); }, <?php echo $slideshowTime; ?>);
		} else {
			clearInterval(reviewinterval);
		}
	}

	<?php
	/////////////////////
	//BACKGROUND INTERVAL -- runHeader
	/////////////////////
	if($slideshowOn == 1 && $videoUrl == ''){ ?>
	function runHeader(){
		if(headerImage.length > 1 && !theBody.hasClass('stopSlideshow') ){
			clearInterval(headerinterval);
			headerinterval = setInterval(function(){ imageSlideshow(); }, <?php echo $slideshowTime; ?>);
		} else {
			clearInterval(headerinterval);
		}
	}
	<?php } ?>
	
	//////////////////////////////
	//RUN SCRIPTS AFTER AJAX LOADS -- ajaxComplete
	//////////////////////////////
	jQuery(document).ajaxComplete(function() {
		bodyCheck();
		runReviews();
		<?php 
		if($slideshowOn == 1 && $videoUrl == '') echo 'runHeader();'; 
		echo $runScripts;
		?> 
		
	});
	
	<?php 
	//////////////////
	//VIDEO BACKGROUND -- background
	//////////////////
	if ($videoUrl != ''){ ?>
	headerImages.background({
		source: {
			poster: "<?php echo $bgURL; ?>",
			mp4: 	"<?php echo $videoUrl; ?>"
		}
	});
	<?php } ?>
	
	/////////////
	//WINDOW LOAD -- load
	/////////////
	jQuery(window).load(function(){
	
		<?php
		//PLAY AUDIO
		if ($autoplay) {?>
			if(!jQuery('body').hasClass('mobile-device')) playAudio();
		<?php }
		
		//PLAY VIDEO
		if (is_front_page() && $showVideo){ ?>			
			jQuery('.videoLink').click();
		<?php } ?>
				
		//RUN FUNCTIONs
		bodyCheck();
		<?php if($slideshowOn == 1 && $videoUrl == '') echo 'runHeader();'; ?> 
		runReviews();
	});	
});
</script>

</body>
</html>