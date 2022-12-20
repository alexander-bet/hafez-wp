<?php

/**
 * Add admin scripts and styles
 */
function hafez_add_scripts($hook)
{

	// Add general scripts & styles
	wp_enqueue_style('hafeztheme-admin-css', HAFEZTHEME_URL . '/assets/css/admin.css', array(), HAFEZTHEME_THEME_VERSION);

	wp_enqueue_script('hafeztheme-colorpicker', HAFEZTHEME_URL . '/assets/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('hafeztheme-admin-js', HAFEZTHEME_URL . '/assets/js/admin.js', array('jquery', 'HAFEZTHEME_colorpicker'), HAFEZTHEME_THEME_VERSION);
	wp_enqueue_script('hafeztheme-metaboxes', HAFEZTHEME_URL . '/assets/js/metaboxes.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'media-upload', 'thickbox'));


	// Add scripts for metaboxes
	if ($hook == 'post.php' || $hook == 'post-new.php' || $hook == 'page-new.php' || $hook == 'page.php') {
		wp_enqueue_script('hafeztheme-metaboxes', HAFEZTHEME_URL . '/assets/js/metaboxes.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'media-upload', 'thickbox'));
		wp_enqueue_script('hafeztheme-metabox-gallery', HAFEZTHEME_URL . '/assets/js/metabox-gallery.js', array('jquery', 'jquery-ui-sortable'));
	}

	// Add scripts for Theme Options page
	if (in_array($hook, array('appearance_page_HafezTheme'))) {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('options-custom', HAFEZTHEME_URL . '/assets/js/options-custom.js', array('jquery'));
	}

	//Add scripts for Demo Import Page
	if (in_array($hook, array('appearance_page_hafeztheme_theme_demos'))) {

		wp_enqueue_script('hafeztheme-demos', HAFEZTHEME_URL . '/assets/js/demos.js', array('jquery'));

		//Variables for Demo Import JS
		wp_localize_script('hafeztheme-demos', 'olins_strings', array(
			'installingPlugin' => esc_html__('Installing plugin', 'hafezkids'),
			'activatingPlugin' => esc_html__('Activating plugin', 'hafezkids'),
			'tryAgain' => esc_html__('Try again', 'hafezkids'),
			'hafezWpAdminImportNonce' => wp_create_nonce('hafez-demo-install'),
			'hafez_ajax_url' => site_url('/wp-admin/admin-ajax.php?hafez_theme_name=' . HAFEZTHEME_SHORTNAME . '&v=' . HAFEZTHEME_THEME_VERSION),
			'plugin_failed_activation' => esc_html__('Failed to activate.', 'hafezkids'),
			'plugin_active' => esc_html__('Active', 'hafezkids'),
			'plugin_failed_activation_retry' => esc_html__('Failed.', 'hafezkids'),
			'plugin_failed_activation_memory' => esc_html__('The plugin failed to activate. Please try to increase the memory_limit on your server.', 'hafezkids'),
			'content_importing_error' => esc_html__('There was a problem during the importing process resulting in the following error from your server:', 'hafezkids'),
			'required_plugins' => esc_html__('Install required plugins first.', 'hafezkids'),
		));
	}
}
add_action('admin_enqueue_scripts', 'hafez_add_scripts', 10);

/**
 * Add HafezTheme Options to Admin Navigation 
 */
function hafez_add_admin_menu()
{
	add_theme_page(esc_html__('Theme Options', 'hafezkids'), esc_html__('Theme Options', 'hafezkids'), 'edit_theme_options', 'HafezTheme', 'optionsframework_page');
}
add_action('admin_menu', 'hafez_add_admin_menu', 1);


/**
 * Add custom post types to navigation 
 */
function hafez_admin_custom_to_navigation()
{
	$post_types = get_post_types(array(
		'show_in_nav_menus' => true
	), 'object');

	foreach ($post_types as $post_type) {
		if ($post_type->has_archive) {
			add_filter('nav_menu_items_' . $post_type->name, 'hafez_admin_custom_to_navigation_checkbox', null, 3);
		}
	}
}
add_action('admin_head-nav-menus.php', 'hafez_admin_custom_to_navigation');

/**
 * Add custom post type to navigation
 * @global int $_nav_menu_placeholder
 * @global object $wp_rewrite
 * @param array $posts
 * @param array $args
 * @param string $post_type
 * @return array 
 */
function hafez_admin_custom_to_navigation_checkbox($posts, $args, $post_type)
{
	global $_nav_menu_placeholder, $wp_rewrite;
	$_nav_menu_placeholder = (0 > $_nav_menu_placeholder) ? intval($_nav_menu_placeholder) - 1 : -1;

	$archive_slug = $post_type->has_archive === true ? $post_type->rewrite['slug'] : $post_type->has_archive;
	if ($post_type->rewrite['with_front'])
		$archive_slug = substr($wp_rewrite->front, 1) . $archive_slug;
	else
		$archive_slug = $wp_rewrite->root . $archive_slug;

	array_unshift($posts, (object) array(
		'ID' => 0,
		'object_id' => $_nav_menu_placeholder,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => $post_type->labels->all_items,
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => site_url($archive_slug),
	));

	return $posts;
}


/**
 * Add custom columns to admin data tables 
 */
function hafez_admin_table_columns()
{
	if (function_exists('hafeztheme_get_post_types')) {
		foreach (hafeztheme_get_post_types() as $type => $config) {
			if (isset($config['columns']) && count($config['columns'])) {
				foreach ($config['columns'] as $column) {
					if (function_exists('hafez_admin_posts_' . $column . '_column_head') && function_exists('hafez_admin_posts_' . $column . '_column_content')) {
						add_filter('manage_' . $type . '_posts_columns', 'hafez_admin_posts_' . $column . '_column_head', 10);
						add_action('manage_' . $type . '_posts_custom_column', 'hafez_admin_posts_' . $column . '_column_content', 10, 2);
					}
				}
			}
		}
	}
}
add_action('admin_init', 'hafez_admin_table_columns', 100);

/**
 * Add featured image header column to admin data-table
 * 
 * @param array $defaults
 * @return array 
 */
function hafez_admin_posts_featured_column_head($defaults)
{
	hafez_array_put_to_position($defaults, 'Image', 1, 'featured-image');
	return $defaults;
}

/**
 * Add featured image data column to admin data-table
 *
 * @param string $column_name
 * @param int $post_id 
 */
function hafez_admin_posts_featured_column_content($column_name, $post_id)
{
	if ($column_name == 'featured-image') {
		$post_featured_image = hafez_get_featured_image_src($post_id);
		if ($post_featured_image) {
			echo '<img src="' . esc_url($post_featured_image) . '" alt="' . esc_html__('Image', 'hafezkids') . '" width="60" />';
		}
	}
}


/**
 * Add featured image header column to admin data-table
 * 
 * @param array $defaults
 * @return array 
 */
function hafez_admin_posts_first_image_column_head($defaults)
{
	hafez_array_put_to_position($defaults, 'Image', 1, 'first-image');
	return $defaults;
}

/**
 * Add featured image data column to admin data-table
 *
 * @param string $column_name
 * @param int $post_id 
 */
function hafez_admin_posts_first_image_column_content($column_name, $post_id)
{
	if ($column_name == 'first-image') {
		if (has_post_thumbnail($post_id)) :
			$image = hafez_get_featured_image_src($post_id);
		else :
			$image = hafez_get_first_attached_image_src($post_id);
		endif;

		if ($image) {
			echo '<img src="' . esc_url($image) . '" alt="' . esc_html__('Image', 'hafezkids') . '" width="60" />';
		}
	}
}
