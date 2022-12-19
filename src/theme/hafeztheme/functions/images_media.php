<?php

/**
 * Get first post image attachment
 * @param integer $id
 * @param boolean $show_hidden
 * @return array|boolean
 */
function hafez_get_first_attached_image($id = null, $show_hidden = true)
{
	if (!$id) {
		$id = get_the_ID();
	}

	$attrs = array(
		'post_parent' => $id,
		'post_status' => null,
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'numberposts' => 1,
		'orderby' => 'menu_order',
	);

	if (!$show_hidden) {
		$attrs['meta_query'] = array(
			array(
				'key'		=> '_hafez_hide_from_gallery',
				'value'		=> 0,
				'type'		=> 'DECIMAL',
			),
		);
	}

	$image = get_children($attrs);

	if (!count($image)) {
		return false;
	}

	$image = array_values($image);
	return $image[0];
}



/**
 * Get featured image src
 * @param int $post_id
 * @param string $size
 * @return string
 */
function hafez_get_featured_image_src($post_id, $size  = 'thumbnail')
{
	if (!$post_id) {
		$post_id = get_the_ID();
	}

	$post_thumbnail_id = get_post_thumbnail_id($post_id);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, $size);
		return $post_thumbnail_img[0];
	} else {
		return '';
	}
}

/**
 * Get first attached image source with set size.
 * 
 * @param int $post_id
 * @param string $size
 * @param boolean $show_hidden
 * @return string 
 */
function hafez_get_first_attached_image_src($post_id, $size = 'thumbnail', $show_hidden = true)
{
	if (!$post_id) {
		$post_id = get_the_ID();
	}
	$image = hafez_get_first_attached_image($post_id, $show_hidden);

	if ($image) {
		$image_img = wp_get_attachment_image_src($image->ID, $size);
		return $image_img[0];
	} else {
		return '';
	}
}
