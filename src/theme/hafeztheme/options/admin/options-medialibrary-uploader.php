<?php

/**
 * WooThemes Media Library-driven AJAX File Uploader Module (2010-11-05)
 *
 * Slightly modified for use in the Options Framework.
 */

if (is_admin()) {

	// Load additional css and js for image uploads on the Options Framework page
	$of_page = 'appearance_page_HafezTheme';

	add_action("admin_print_styles-$of_page", 'optionsframework_mlu_css', 0);
	add_action("admin_print_scripts-$of_page", 'optionsframework_mlu_js', 0);
}


/**
 * Adds the Thickbox CSS file and specific loading and button images to the header
 * on the pages where this function is called.
 */

if (!function_exists('optionsframework_mlu_css')) {

	function optionsframework_mlu_css()
	{

		$_html = '';
		$_html .= '<link rel="stylesheet" href="' . site_url() . '/' . WPINC . '/js/thickbox/thickbox.css" type="text/css" media="screen" />' . "\n";
		$_html .= '<script type="text/javascript">
		var tb_pathToImage = "' . site_url() . '/' . WPINC . '/js/thickbox/loadingAnimation.gif";
	    var tb_closeImage = "' . site_url() . '/' . WPINC . '/js/thickbox/tb-close.png";
	    </script>' . "\n";

		echo '' . $_html;
	}
}

/**
 * Registers and enqueues (loads) the necessary JavaScript file for working with the
 * Media Library-driven AJAX File Uploader Module.
 */

if (!function_exists('optionsframework_mlu_js')) {

	function optionsframework_mlu_js()
	{

		// Registers custom scripts for the Media Library AJAX uploader.
		wp_register_script('of-medialibrary-uploader', HafezTheme_URL . '/assets/js/of-medialibrary-uploader.js', array('jquery', 'thickbox'));
		wp_enqueue_script('of-medialibrary-uploader');
		wp_enqueue_script('media-upload');
	}
}

/**
 * Media Uploader Using the WordPress Media Library.
 *
 * Parameters:
 * - string $_id - A token to identify this field (the name).
 * - string $_value - The value of the field, if present.
 * - string $_mode - The display mode of the field.
 * - string $_desc - An optional description of the field.
 * - int $_postid - An optional post id (used in the meta boxes).
 *
 * Dependencies:
 * - optionsframework_mlu_get_silentpost()
 */

if (!function_exists('optionsframework_medialibrary_uploader')) {

	function optionsframework_medialibrary_uploader($_id, $_value, $_mode = 'full', $_desc = '', $_postid = 0, $_name = '')
	{

		$optionsframework_settings = get_option('optionsframework');

		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];

		$output = '';
		$id = '';
		$class = '';
		$int = '';
		$value = '';
		$name = '';

		$id = strip_tags(strtolower($_id));


		// If a value is passed and we don't have a stored value, use the value that's passed through.
		if ($_value != '' && $value == '') {
			$value = $_value;
		}

		if ($_name != '') {
			$name = esc_attr($option_name) . '[' . esc_attr($id) . '][' . esc_attr($_name) . ']';
		} else {
			$name = esc_attr($option_name) . '[' . esc_attr($id) . ']';
		}

		if ($value) {
			$class = ' has-file';
		}
		$output .= '<input id="' . esc_attr($id) . '" class="upload' . esc_attr($class) . '" type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" />' . "\n";
		if (function_exists('optionsframework_mlu_init')) {
			$output .= '<input id="upload_' . esc_attr($id) . '" class="upload_button button" type="button" value="' . esc_html__('Upload', 'hafezkids') . '" rel="' . esc_attr($int) . '" />' . "\n";
		} else {
			$output .= '<span class="noteplugin">For advanced options you can install the  <strong>hafezkids Core</strong> plugin.</span>' . "\n";
		}
		if ($_desc != '') {
			$output .= '<span class="of_metabox_desc">' . esc_html($_desc) . '</span>' . "\n";
		}

		$output .= '<div class="screenshot" id="' . esc_attr($id) . '_image">' . "\n";

		if ($value != '') {
			$remove = '<a href="javascript:(void);" class="mlu_remove">Remove</a>';
			$image = preg_match('/(^.*\.jpg|jpeg|png|gif|svg|ico*)/i', $value);
			if ($image) {
				$output .= '<img src="' . esc_url($value) . '" alt="' . esc_html__('Image', 'hafezkids') . '" />' . hafez_wp_kses($remove) . '';
			} else {
				$parts = explode("/", $value);
				for ($i = 0; $i < sizeof($parts); ++$i) {
					$title = $parts[$i];
				}

				// No output preview if it's not an image.			
				$output .= '';

				// Standard generic output if it's not an image.	
				$title = esc_html__('View File', 'hafezkids');
				$output .= '<div class="no_image"><span class="file_link"><a href="' . esc_url($value) . '" target="_blank" rel="external">' . esc_html($title) . '</a></span>' . hafez_wp_kses($remove) . '</div>';
			}
		}
		$output .= '</div>' . "\n";
		return $output;
	}
}


/**
 * Trigger code inside the Media Library popup.
 */

if (!function_exists('optionsframework_mlu_insidepopup')) {

	function optionsframework_mlu_insidepopup()
	{

		if (isset($_REQUEST['is_optionsframework']) && $_REQUEST['is_optionsframework'] == 'yes') {

			add_action('admin_head', 'optionsframework_mlu_js_popup');
			add_filter('media_upload_tabs', 'optionsframework_mlu_modify_tabs');
		}
	}
}

if (!function_exists('optionsframework_mlu_js_popup')) {

	function optionsframework_mlu_js_popup()
	{

		$_of_title = $_REQUEST['of_title'];
		if (!$_of_title) {
			$_of_title = 'file';
		} // End IF Statement
?>
		<script type="text/javascript">
			<!--
			jQuery(function($) {

				jQuery.noConflict();

				// Change the title of each tab to use the custom title text instead of "Media File".
				$('h3.media-title').each(function() {
					var current_title = $(this).html();
					var new_title = current_title.replace('media file', '<?php echo '' . esc_attr($_of_title); ?>');
					$(this).html(new_title);

				});

				// Change the text of the "Insert into Post" buttons to read "Use this File".
				$('.savesend input.button[value*="Insert into Post"], .media-item #go_button').attr('value', 'Use this File');

				// Hide the "Insert Gallery" settings box on the "Gallery" tab.
				$('div#gallery-settings').hide();

				// Preserve the "is_optionsframework" parameter on the "delete" confirmation button.
				$('.savesend a.del-link').click(function() {

					var continueButton = $(this).next('.del-attachment').children('a.button[id*="del"]');
					var continueHref = continueButton.attr('href');
					continueHref = continueHref + '&is_optionsframework=yes';
					continueButton.attr('href', continueHref);

				});

			});
			-->
		</script>
<?php
	}
}

/**
 * Triggered inside the Media Library popup to modify the title of the "Gallery" tab.
 */

if (!function_exists('optionsframework_mlu_modify_tabs')) {

	function optionsframework_mlu_modify_tabs($tabs)
	{
		$tabs['gallery'] = str_replace(esc_html__('Gallery', 'hafezkids'), esc_html__('Previously Uploaded', 'hafezkids'), $tabs['gallery']);
		return $tabs;
	}
}
