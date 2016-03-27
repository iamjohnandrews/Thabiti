<?php
get_header();

//////////
//IF POSTS
//////////
if ( have_posts() ) { 
	
	///////////////////////
	//START POSTS CONTAINER
	///////////////////////
	echo '<div class="posts-container">';
	?>
	
	<div id="slide-right" class="slide-nav"><span></span></div>
	<div id="slide-left" class="slide-nav"><span></span></div>
	
	<h1 class="entrytitle"><?php
		if (is_front_page()) 	{ _e('Latest Items','themolitor'); }
		else if (is_category()) { single_cat_title(); }
		else if (is_tax())		{ global $wp_query; $term = $wp_query->get_queried_object(); echo $term->name; }
		else if (is_tag()) 		{ single_tag_title(); }
		else if (is_author()) 	{ the_author(); }
		else if (is_day()) 		{ echo get_the_date(); }
		else if (is_month())	{ echo get_the_date('F Y'); }
		else if (is_year())		{ echo get_the_date('Y'); }
		else if (is_search()) 	{
			global $wp_query; 
			$queryResults = $wp_query->found_posts;
			if($queryResults > 1) { $items = __('items','themolitor'); } elseif ($queryResults == 1) { $items = __('item','themolitor'); }
			echo $queryResults.' '.$items; _e(' found for ','themolitor'); echo '"'.get_search_query().'"';
		}
		else { echo "Archives"; }
	?></h1>
	
	<?php

	echo '<div class="scroll-wrapper">';
	echo '<div class="scroll-this">';
	
	//////////
	//THE LOOP
	//////////
	while (have_posts()) : the_post(); 
	
	
	//VAR SETUP
	$selfURL = get_post_meta( $post->ID, 'self_url', TRUE );
	$youTubeId = get_post_meta( $post->ID, 'youtube_id', TRUE );
	$vimeoId = get_post_meta( $post->ID, 'vimeo_id', TRUE );	
	$vidSet = null;
	
	if($selfURL != ''){
		$vidType = 'self-video';
		$vidID = $selfURL;
		$vidSet = 1;
	} elseif($youTubeId != ''){
		$vidType = 'youtube-video';
		$vidID = $youTubeId;
		$vidSet = 1;
	} elseif($vimeoId != '') {
		$vidType = 'vimeo-video';
		$vidID = $vimeoId;
		$vidSet = 1;
	}
	?>
	
		<div <?php post_class(); ?>>
		
			<?php if( has_post_thumbnail() ){ 
				echo '<div class="image-container">';
				if($vidSet == 1){ ?>
					<!--PLAY BUTTON-->
					<a class="post-video" data-vidtype="<?php echo $vidType;?>" data-vidid="<?php echo $vidID;?>" href="#"><i class="fa fa-play"></i></a>
				<?php }
				the_post_thumbnail();	
				echo '</div>';
			}  elseif($youTubeId != ''){ ?>
				<div class="image-container">
					<?php if($vidSet == 1){ ?>
						<!--PLAY BUTTON-->
						<a class="post-video" data-vidtype="<?php echo $vidType;?>" data-vidid="<?php echo $vidID;?>" href="#"><i class="fa fa-play"></i></a>
					<?php } ?>
					<img src="http://img.youtube.com/vi/<?php echo $youTubeId;?>/maxresdefault.jpg" alt="" />
				</div>
			<?php } elseif($vimeoId != ''){ ?>
				<script>
					function vimeoLoadingThumb(id){    
					    var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb";
					      
					    var id_img = "#vimeo-" + id;
					    var script = document.createElement( 'script' );
					    script.type = 'text/javascript';
					    script.src = url;
					
					    jQuery(id_img).before(script);
					}
					
					function showThumb(data){
					    var id_img = "#vimeo-" + data[0].id;
					    jQuery(id_img).attr('src',data[0].thumbnail_large);
					}
					jQuery(function() {
					    vimeoLoadingThumb(<?php echo $vimeoId;?>);
					});
				</script>
				<div class="image-container">
					<?php if($vidSet == 1){ ?>
						<!--PLAY BUTTON-->
						<a class="post-video" data-vidtype="<?php echo $vidType;?>" data-vidid="<?php echo $vidID;?>" href="#"><i class="fa fa-play"></i></a>
					<?php } ?>
					<img id="vimeo-<?php echo $vimeoId;?>" src="" alt="" />
				</div>
			<?php } ?>
			
			<div class="postInfo">		
				<?php 
				if(!has_post_format() && $post->post_type == 'post' ){ echo '<div class="post-date">'.get_the_time( get_option( 'date_format' ) ).'</div>'; }
				$asideTitle = str_replace('|','<br />',get_the_title());
				echo '<h2 class="posttitle">'.$asideTitle.'</h2>';	
				echo the_content();
				if(!has_post_format()){  
					if ( comments_open() ) { 
						$commentsVal = get_comments_number();
						if($commentsVal == 0){ $commentsTitle = 'Comment on this post'; } else { $commentsTitle = $commentsVal.' comments'; }
						echo '<a title="'.$commentsTitle.'" class="post-sharing" href="'.get_permalink().'"><i class="fa fa-comment"></i>';
						echo '</a>'; 
					}
					echo '<a title="'.__('Share on Facebook','themolitor').'" class="post-sharing" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'"><i class="fa fa-facebook"></i></a>';
					echo '<a title="'.__('Share on Twitter','themolitor').'" class="post-sharing" target="_blank" href="https://twitter.com/home?status='.get_the_title().' '.get_permalink().'"><i class="fa fa-twitter"></i></a>';
					echo '<a title="'.__('Share on Google+','themolitor').'" class="post-sharing" target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"><i class="fa fa-google-plus"></i></a>';
					echo '<a title="Permalink for '.get_the_title().'" class="post-sharing" href="'.get_permalink().'"><i class="fa fa-link"></i></a>';
				}
				?>
			</div><!--end postInfo-->
					
		</div><!--end post-->
		
	<?php 
	//////////
	//END LOOP
	//////////
	endwhile;  
	
	
	/////////////////////
	//SHOW LOAD MORE LINK
	/////////////////////
	$nextPostLink = get_next_posts_link('+');
	if( $nextPostLink ){
		echo '<div id="load-more">'. $nextPostLink.'</div>';
	}
	
	/////////////////////
	//END POSTS CONTAINER
	/////////////////////
	echo '</div><!--end scroll-this-->';
	echo '</div><!--end scroll-wrapper-->';
	echo '</div><!--end posts-container-->';
	?>

	<!--VIDEO HOLDER-->
	<div class="videoContainer">
		<div class="closeVideo">&times;</div>
	</div>
	
<?php
} else { ?>

	<h1 class="error-404"><?php _e('Nothing found','themolitor'); if(is_search()){ echo ' for "'.get_search_query().'".'; } ?></h1>
	
<?php }

get_footer();
?>