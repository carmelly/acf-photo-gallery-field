<?php

//Fires off when the WordPress update button is clicked
function acf_photo_gallery_save( $post_id ){
	
	// If this is a revision, get real post ID
	if ( $parent_id = wp_is_post_revision( $post_id ) )
	$post_id = $parent_id;
	// unhook this function so it doesn't loop infinitely
	remove_action( 'save_post', 'acf_photo_gallery_save' );

	// make array of [field_name => field_key]
	$fields = [];
	$field_names = isset($_POST['acf-photo-gallery-groups']) ? $_POST['acf-photo-gallery-groups'] : [];
	$field_keys = isset($_POST['acf-photo-gallery-field']) ? $_POST['acf-photo-gallery-field'] : [];
	if (count($field_names) == count($field_keys)) {
		$fields = array_combine($field_names, $field_keys);
	}

	if (!empty($fields)) {
		foreach ($fields as $name => $key) {
			$ids = isset($_POST[$name]) ? $_POST[$name] : [];
			if (!empty($ids)) {
				$ids = implode(',', $ids);
				update_post_meta($post_id, $name, $ids);
				acf_update_metadata($post_id, $name, $key, true);
			} else {
				delete_post_meta($post_id, $name);
				acf_delete_metadata($post_id, $name, true);
			}
		}
	}

	// re-hook this function
	add_action( 'save_post', 'acf_photo_gallery_save' );
}
add_action( 'save_post', 'acf_photo_gallery_save' );
