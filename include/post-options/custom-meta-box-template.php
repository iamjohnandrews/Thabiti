<?php
/*
* Adds a meta box to the post editing screen
*/
function prfx_custom_meta() {
	add_meta_box( 'prfx_meta', __( 'Options', 'themolitor' ), 'prfx_meta_callback', 'post', 'advanced','high' );
}
add_action( 'add_meta_boxes', 'prfx_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function prfx_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	$prfx_stored_meta = get_post_meta( $post->ID );
	?>
	
	<p>
		<label for="self_url" class="prfx-row-title"><?php _e( 'Self Hosted Video URL', 'themolitor' )?></label>
		<input type="text" name="self_url" id="self_url" value="<?php if ( isset ( $prfx_stored_meta['self_url'] ) ) echo $prfx_stored_meta['self_url'][0]; ?>" /> <small><?php _e( 'Enter full URL to MP4 video. Example: http://www.w3schools.com/html/mov_bbb.mp4', 'themolitor' )?></small>
	</p>
	
	<p>
		<label for="youtube_id" class="prfx-row-title"><?php _e( 'YouTube Video ID', 'themolitor' )?></label>
		<input type="text" name="youtube_id" id="youtube_id" value="<?php if ( isset ( $prfx_stored_meta['youtube_id'] ) ) echo $prfx_stored_meta['youtube_id'][0]; ?>" /> <small><?php _e( 'Enter ID to YouTube video. Example: JU9PdgB3rsk', 'themolitor' )?></small>
	</p>
	
	<p>
		<label for="vimeo_id" class="prfx-row-title"><?php _e( 'Vimeo Video ID', 'themolitor' )?></label>
		<input type="text" name="vimeo_id" id="vimeo_id" value="<?php if ( isset ( $prfx_stored_meta['vimeo_id'] ) ) echo $prfx_stored_meta['vimeo_id'][0]; ?>" /> <small><?php _e( 'Enter ID to Vimeo video. Example: 41444323', 'themolitor' )?></small>
	</p>
	
	<?php
}


/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {
 
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}
 
	// Checks for input and sanitizes/saves if needed
	if( isset( $_POST[ 'self_url' ] ) ) {
		update_post_meta( $post_id, 'self_url', sanitize_text_field( $_POST[ 'self_url' ] ) );
	}
	if( isset( $_POST[ 'youtube_id' ] ) ) {
		update_post_meta( $post_id, 'youtube_id', sanitize_text_field( $_POST[ 'youtube_id' ] ) );
	}
	if( isset( $_POST[ 'vimeo_id' ] ) ) {
		update_post_meta( $post_id, 'vimeo_id', sanitize_text_field( $_POST[ 'vimeo_id' ] ) );
	}

	// Checks for input and saves if needed
	/*
	if( isset( $_POST[ 'header-style' ] ) ) {
		update_post_meta( $post_id, 'header-style', $_POST[ 'header-style' ] );
	}*/

}
add_action( 'save_post', 'prfx_meta_save' );


/**
 * Adds the meta box stylesheet when appropriate
 */
function prfx_admin_styles(){
	global $typenow;
	if( $typenow == 'post' || $typenow == 'page' ) {
		wp_enqueue_style( 'prfx_meta_box_styles', get_template_directory_uri() . '/include/post-options/meta-box-styles.css' );
	}
}
add_action( 'admin_print_styles', 'prfx_admin_styles' );


/**
 * Loads the color picker javascript
 */
function prfx_color_enqueue() {
	global $typenow;
	if( $typenow == 'post' || $typenow == 'page' ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'meta-box-color-js', get_template_directory_uri() . '/include/post-options/meta-box-color.js', array( 'wp-color-picker' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'prfx_color_enqueue' );

/**
 * Loads the image management javascript
 */
function prfx_image_enqueue() {
	global $typenow;
	if( $typenow == 'post' || $typenow == 'page' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'meta-box-image', get_template_directory_uri() . '/include/post-options/meta-box-image.js', array( 'jquery' ) );
		wp_localize_script( 'meta-box-image', 'meta_image',
			array(
				'title' => __( 'Choose or Upload an Image', 'themolitor' ),
				'button' => __( 'Use this image', 'themolitor' ),
			)
		);
		wp_enqueue_script( 'meta-box-image' );
	}
}
add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );
