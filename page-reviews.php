<?php 
/*
Template Name: Reviews + Video
*/

get_header();

//THE LOOP	
$videPosts = null;    	
	$args = array(
		'post__in' => get_option('sticky_posts'),
   		'ignore_sticky_posts' => 1,
		'showposts' => 1,
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-video' )
			),
		),
	);
	$videPosts = new WP_Query($args);
	
	if ($videPosts->have_posts()) : while ($videPosts->have_posts()) : $videPosts->the_post();

//VAR SETUP
$selfURL = get_post_meta( $post->ID, 'self_url', TRUE );
$youTubeId = get_post_meta( $post->ID, 'youtube_id', TRUE );
$vimeoId = get_post_meta( $post->ID, 'vimeo_id', TRUE );	

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
		
	<!--PLAY BUTTON-->
	<a class="videoLink" id="<?php echo $post->ID;?>" href="#"><i class="fa fa-play"></i></a>
			
	<!--VIDEO CONTAINER-->
	<div class="videoContainer <?php echo $vidType; ?>" id="video<?php echo $post->ID; ?>" data-vidid="<?php echo $vidID;?>" >
		<div class="closeVideo">&times;</div>
	</div>
	
<?php
		
endwhile; endif;		
		
$videPosts = null;
wp_reset_postdata();

//REVIEWS
echo '<div id="reviews">';
	$showPostsInCategory = null;    	
	$args = array(
		'orderby' => 'rand',
		'showposts' => 100,
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-quote' )
			),
		),
	);
	$showPostsInCategory = new WP_Query($args);
	
	if ($showPostsInCategory->have_posts()) : while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post(); ?>
		<div class="review">
			<div class="reviewContent"><?php the_content(); ?></div>
			<div class="reviewTitle"><?php the_title(); ?></div>
		</div><!--end review-->
	<?php endwhile; endif;		
		
	$showPostsInCategory = null;
	wp_reset_postdata();
echo '</div><!--end reviews-->';

get_footer(); 
?>