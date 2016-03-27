<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post();
$postMonth = get_the_date('m');
$postYear = get_the_date('Y');
$selfURL = get_post_meta( $post->ID, 'self_url', TRUE );
$youTubeId = get_post_meta( $post->ID, 'youtube_id', TRUE );
$vimeoId = get_post_meta( $post->ID, 'vimeo_id', TRUE );	
$vidType = null;
if(has_post_thumbnail()){		
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'large');
	$bgURL = $image[0];
}

if($selfURL != ''){
	$vidType = 'self-video';
	$vidID = $selfURL;
} elseif($youTubeId != ''){
	$vidType = 'youtube-video';
	$vidID = $youTubeId;
} elseif($vimeoId != '') {
	$vidType = 'vimeo-video';
	$vidID = $vimeoId;
}
?>

	<div id="pageContent" class="entry post-page">
		<h1 id="page-title"><?php the_title(); ?></h1>
		<?php 
		if($vidType == 'self-video') {			
			
			echo '<video style="background-image:url('.$bgURL.')" class="singleVid" width="500" height="280" controls><source src="' . $vidID . '" type="video/mp4">'.__('Your browser does not support the video tag.','themolitor').'</video> ';
	
		} elseif($vidType == 'youtube-video') {
	
			echo '<iframe class="singleVid" src="https://www.youtube.com/embed/' . $vidID . '?rel=0&amp;showinfo=0&amp;controls=1" width="500" height="280" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	
		} elseif($vidType == 'vimeo-video') {
		
			echo '<iframe class="singleVid" src="//player.vimeo.com/video/' . $vidID . '?color=ffffff&title=0&byline=0&portrait=0&badge=0" width="500" height="280" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		}
		the_content();
		wp_link_pages();
		?>
		
		<div id="post-details">
		<?php if(!has_post_format()){ ?><span><?php _e('DATE','themolitor');?> <a href="<?php echo get_month_link($postYear, $postMonth);?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span> <?php } ?><span><?php _e('CATEGORY ','themolitor'); the_category(', ');?></span> <?php the_tags('<span>'.__('TAGS','themolitor').' ',', ','</span>');?>
		</div>
		
		<?php 
		//RESPONSIVE NAVIGATION
		next_post_link('%link','&larr; Back', TRUE);
		previous_post_link('%link','Next &rarr;', TRUE);
		
		//COMMENTS
		if ('open' == $post->comment_status) { comments_template(); }
		?>
	</div>

<?php
if(has_post_thumbnail()){		
	echo '<div class="page-image-container" style="background-image:url('.$bgURL.')"><img src="'.$bgURL.'" alt="" /></div>';
}
endwhile; 

previous_post_link('%link','<span></span>', TRUE);
next_post_link('%link','<span></span>', TRUE); 

endif; 
get_footer(); 
?>