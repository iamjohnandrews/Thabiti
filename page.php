<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post();
?>

<div id="pageContent" class="entry page-page">
	<h1 id="page-title"><?php the_title(); ?></h1>
	<?php 
	the_content();
	wp_link_pages();
	//COMMENTS
	if ('open' == $post->comment_status) { comments_template(); }
	?>
</div>

<?php
if(has_post_thumbnail()){		
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'large');
	$bgURL = $image[0];
	echo '<div class="page-image-container" style="background-image:url('.$bgURL.')"><img src="'.$bgURL.'" alt="" /></div>';
}
endwhile; endif; 
get_footer(); 
?>