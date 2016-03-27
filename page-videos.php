<?php
/*
Template Name: Videos Page
*/

get_header();

$page_object = get_queried_object();
$page_id     = get_queried_object_id();

//THE LOOP	
if ( get_query_var('paged') ) {	$paged = get_query_var('paged'); } 
else if ( get_query_var('page') ) {	$paged = get_query_var('page'); } 
else { $paged = 1; }   	
$args = array(
	'paged' => $paged,
	'posts_per_page' => 1,
	'post_type' => 'post',
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-video' )
		),
	),
);
query_posts($args);

if (have_posts()) : while (have_posts()) : the_post(); 

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

	<!--POST DETAILS-->
	<div <?php post_class('video-page-post'); ?>>	
		<?php 
		if( $wp_query->max_num_pages > 1 ) { 
			$currentPage = get_query_var( 'paged' );
			if( $currentPage == '0' ){ $currentPage = '1'; }
		?>
			<div class="current-page"><?php echo $currentPage .' &nbsp;/&nbsp; '. $wp_query->max_num_pages ; ?></div>
		<?php } ?>		
		<h2 class="posttitle"><?php echo the_title();?></h2>
		<?php if($post->post_content != "") { ?><div class="video-content"><?php echo the_content();?></div><?php } ?>
	</div><!--end post-->
			
	<!--VIDEO CONTAINER-->
	<div class="videoContainer <?php echo $vidType; ?>" id="video<?php echo $post->ID; ?>" data-vidid="<?php echo $vidID;?>" >
		<div class="closeVideo">&times;</div>
	</div>
	
	<!--VIDEO IMAGE CONTAINER-->
	<?php if(has_post_thumbnail()){
		
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );			
		echo '<div class="video-image-container" style="background-image:url('.$url.')"><img src="'.$url.'" alt="" /></div>';
	
	} elseif($youTubeId != ''){ ?>
		<div class="video-image-container" style="background-image:url('http://img.youtube.com/vi/<?php echo $youTubeId;?>/maxresdefault.jpg')"><img src="http://img.youtube.com/vi/<?php echo $youTubeId;?>/maxresdefault.jpg" alt="" /></div>
	<?php } elseif($vimeoId != ''){ ?>
		<script>
			function vimeoLoadingThumb(id){    
			    var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb";
			      
			    var id_img = "#vimeo-" + id;
			    var idimg = "#vimeoimg-" + id;
			    var script = document.createElement( 'script' );
			    script.type = 'text/javascript';
			    script.src = url;
			
			    jQuery(id_img).before(script);
			    jQuery(idimg).before(script);
			}
			
			function showThumb(data){
			    var id_img = "#vimeo-" + data[0].id;
			    var idimg = "#vimeoimg-" + data[0].id;
			    jQuery(id_img).css({backgroundImage:'url('+data[0].thumbnail_large+')'});
			    jQuery(idimg).attr('id',data[0].thumbnail_large);
			}
			jQuery(function() {
			    vimeoLoadingThumb(<?php echo $vimeoId;?>);
			});
		</script>
		<div class="video-image-container" id="vimeo-<?php echo $vimeoId;?>"><img id="vimeoimg-<?php echo $vimeoId;?>" src="http://img.youtube.com/vi/<?php echo $youTubeId;?>/maxresdefault.jpg" alt="" /></div>
	<?php }
	
endwhile;

//PAGINATION STUFF
if(is_paged()){
	previous_posts_link('<span></span>');
} elseif($wp_query->max_num_pages > 1) { ?>
	<a id="backpage" class="pagenav" href="<?php echo get_page_link($page_id); ?>page/<?php echo $wp_query->max_num_pages;?>/"><span></span></a>
<?php } if(get_query_var('paged') < $wp_query->max_num_pages ) {
	next_posts_link('<span></span>'); 
} elseif(is_paged()) { ?>
	<a id="nextpage" class="pagenav" href="<?php echo get_page_link($page_id); ?>"><span></span></a>
<?php }

endif;		
		
get_footer(); 
?>