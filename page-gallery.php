<?php
/*
Template Name: Gallery
*/

get_header(); 

$args = array(
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'post_status' => null, 
	'post_parent' => $post->ID 
); 
$attachments = get_posts($args);
if ($attachments && !post_password_required()) { ?>

	<ul id="attachmentGallery">
		<?php attachment_toolbox(); ?>
	</ul>
	
	<div id="nextImg" class="gallery-nav"><span></span></div>
	<div id="prevImg" class="gallery-nav"><span></span></div>
	
	<div id="imgInfo"></div>

<?php } elseif($attachments && post_password_required()){ ?>
	<div id="pageContent" class="entry page-page">
	<?php echo '<form action="'.esc_url(site_url('wp-login.php?action=postpass','login_post')).'" method="post">
    <label for="passwordForm">'.__('Password Required:','themolitor').' </label>
    <input name="post_password" id="passwordForm" type="password" size="20" maxlength="20" />
    <input type="submit" name="Submit" value="'.esc_attr__('Submit','themolitor').'" />
    </form>';?>
	</div>
<?php }

get_footer(); 
?>