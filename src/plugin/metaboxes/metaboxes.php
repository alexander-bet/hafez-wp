<?php

function hafez_init_metaboxes()
{
	if (!function_exists('hafez_metaboxes')) {
		return;
	}

	add_filter('hafez_meta_boxes', 'hafez_metaboxes');

	$meta_boxes = array();
	$meta_boxes = apply_filters('hafez_meta_boxes', $meta_boxes);
	foreach ($meta_boxes as $meta_box) {
		new hafez_Meta_Box($meta_box);
	}
}
if (is_admin()) {
	add_action('init', 'hafez_init_metaboxes');
}

/**
 * Validate value of meta fields
 * Define ALL validation methods inside this class and use the names of these 
 * methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class hafez_meta_box_validate
{
	function check_text($text)
	{
		if ($text != 'hello') {
			return false;
		}
		return true;
	}
}

/**
 * Create meta boxes
 */
class hafez_Meta_Box
{
	protected $_meta_box;

	function __construct($meta_box)
	{
		if (!is_admin()) return;

		$this->_meta_box = $meta_box;

		$upload = false;
		foreach ($meta_box['fields'] as $field) {
			if ($field['type'] == 'file' || $field['type'] == 'file_list') {
				$upload = true;
				break;
			}
		}

		global $pagenow;
		if ($upload && in_array($pagenow, array('page.php', 'page-new.php', 'post.php', 'post-new.php'))) {
			add_action('admin_head', array(&$this, 'add_post_enctype'));
		}

		add_action('admin_menu', array(&$this, 'add'));
		add_action('save_post', array(&$this, 'save'));

		add_filter('hafez_show_on', array(&$this, 'add_for_id'), 10, 2);
		add_filter('hafez_show_on', array(&$this, 'hafez_add_for_page_template'), 10, 2);
	}

	function add_post_enctype()
	{
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#post").attr("enctype", "multipart/form-data");
			jQuery("#post").attr("encoding", "multipart/form-data");
		});
		</script>';
	}

	// Add metaboxes
	function add()
	{
		$this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
		$this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
		$this->_meta_box['show_on'] = empty($this->_meta_box['show_on']) ? array('key' => false, 'value' => false) : $this->_meta_box['show_on'];

		foreach ($this->_meta_box['pages'] as $page) {
			if (apply_filters('hafez_show_on', true, $this->_meta_box))
				add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	/**
	 * Show On Filters
	 * Use the 'hafez_show_on' filter to further refine the conditions under which a metabox is displayed.
	 * Below you can limit it by ID and page template
	 */

	// Add for ID 
	function add_for_id($display, $meta_box)
	{
		if ('id' !== $meta_box['show_on']['key'])
			return $display;

		// If we're showing it based on ID, get the current ID					
		if (isset($_GET['post'])) $post_id = $_GET['post'];
		elseif (isset($_POST['post_ID'])) $post_id = $_POST['post_ID'];
		if (!isset($post_id))
			return false;

		// If value isn't an array, turn it into one	
		$meta_box['show_on']['value'] = !is_array($meta_box['show_on']['value']) ? array($meta_box['show_on']['value']) : $meta_box['show_on']['value'];

		// If current page id is in the included array, display the metabox

		if (in_array($post_id, $meta_box['show_on']['value']))
			return true;
		else
			return false;
	}

	// Add for Page Template
	function hafez_add_for_page_template($display, $meta_box)
	{
		if ('page-template' !== $meta_box['show_on']['key'])
			return $display;

		// Get the current ID
		if (isset($_GET['post'])) $post_id = $_GET['post'];
		elseif (isset($_POST['post_ID'])) $post_id = $_POST['post_ID'];
		if (!(isset($post_id) || is_page())) return false;

		// Get current template
		$current_template = get_post_meta($post_id, '_wp_page_template', true);

		// If value isn't an array, turn it into one	
		$meta_box['show_on']['value'] = !is_array($meta_box['show_on']['value']) ? array($meta_box['show_on']['value']) : $meta_box['show_on']['value'];

		// See if there's a match
		if (in_array($current_template, $meta_box['show_on']['value']))
			return true;
		else
			return false;
	}

	// Show fields
	function show()
	{

		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table hafez_metabox">';

		foreach ($this->_meta_box['fields'] as $field) {
			// Set up blank or default values for empty ones
			if (!isset($field['name'])) $field['name'] = '';
			if (!isset($field['desc'])) $field['desc'] = '';
			if (!isset($field['std'])) $field['std'] = '';
			if ('file' == $field['type'] && !isset($field['allow'])) $field['allow'] = array('url', 'attachment');
			if ('file' == $field['type'] && !isset($field['save_id']))  $field['save_id']  = false;
			if ('multicheck' == $field['type']) $field['multiple'] = true;

			$meta = get_post_meta($post->ID, $field['id'], 'multicheck' != $field['type'] /* If multicheck this can be multiple values */);

			echo '<tr>';

			if ($field['type'] == "title") {
				echo '<td colspan="2">';
			} else {
				if ($this->_meta_box['show_names'] == true) {
					echo '<th style="width:18%"><label for="', $field['id'], '">', $field['name'], '</label></th>';
				}
				echo '<td>';
			}

			switch ($field['type']) {

				case 'text':
					echo '<input type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" />', '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'text_small':
					echo '<input class="hafez_text_small" type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" /><span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'text_medium':
					echo '<input class="hafez_text_medium" type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" /><span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'text_date':
					echo '<input class="hafez_text_small hafez_datepicker" type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" /><span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'text_date_timestamp':
					echo '<input class="hafez_text_small hafez_datepicker" type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? date('m\/d\/Y', $meta) : esc_attr($field['std']), '" /><span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'text_datetime_timestamp':
					echo '<input class="hafez_text_small hafez_datepicker" type="text" name="', esc_attr($field['id']), '[date]" id="', esc_attr($field['id']), '_date" value="', '' !== $meta ? date('m\/d\/Y', $meta) : esc_attr($field['std']), '" />';
					echo '<input class="hafez_timepicker text_time" type="text" name="', esc_attr($field['id']), '[time]" id="', esc_attr($field['id']), '_time" value="', '' !== $meta ? date('h:i A', $meta) : esc_attr($field['std']), '" /><span class="hafez_metabox_description" >', esc_attr($field['desc']), '</span>';
					break;
				case 'text_time':
					echo '<input class="hafez_timepicker text_time" type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" /><span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'text_money':
					echo '$ <input class="hafez_text_money" type="text" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" /><span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'colorpicker':
					echo '<div id="' . esc_attr($field['id'] . '_picker') . '" class="colorSelector"><div style="' . esc_attr('background-color:' . ('' !== $meta ? $meta : esc_attr($field['std']))) . '"></div></div>';
					echo '<input class="hafez_colorpicker hafez_text_small" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" type="text" value="', '' !== $meta ? $meta : esc_attr($field['std']), '" />';
					break;
				case 'textarea':
					echo '<textarea name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" cols="60" rows="10">', '' !== $meta ? $meta : esc_attr($field['std']), '</textarea>', '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'textarea_small':
					echo '<textarea name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" cols="60" rows="4">', '' !== $meta ? $meta : esc_attr($field['std']), '</textarea>', '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'textarea_code':
					echo '<textarea name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '" cols="60" rows="10" class="hafez_textarea_code">', '' !== $meta ? $meta : $field['std'], '</textarea>', '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'select':
					echo '<select name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '">';
					foreach ($field['options'] as $option) {
						echo '<option value="', esc_attr($option['value']), '"', $meta == $option['value'] ? ' selected="selected"' : '', '>', esc_attr($option['name']), '</option>';
					}
					echo '</select>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'custom_post_select':
					echo '<select name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '">';
					echo '<option value="0"></option>';
					$items = get_posts(array('post_type' => esc_attr($field['post_type']), 'numberposts' => -1));

					foreach ($items as $item) {
						echo '<option value="', esc_attr($item->ID), '"', $meta == $item->ID ? ' selected="selected"' : '', '>', esc_attr($item->post_title), '</option>';
					}
					echo '</select>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'radio_inline':
					if (empty($meta) && !empty($field['std'])) $meta = $field['std'];
					echo '<div class="hafez_radio_inline">';
					$i = 1;
					foreach ($field['options'] as $option) {
						echo '<div class="hafez_radio_inline_option"><input type="radio" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), $i, '" value="', esc_attr($option['value']), '"', $meta == $option['value'] ? ' checked="checked"' : '', ' /><label for="', esc_attr($field['id']), $i, '">', esc_attr($option['name']), '</label></div>';
						$i++;
					}
					echo '</div>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'radio':
					if (empty($meta) && !empty($field['std'])) $meta = $field['std'];
					echo '<ul>';
					$i = 1;
					foreach ($field['options'] as $option) {
						echo '<li><input type="radio" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), $i, '" value="', esc_attr($option['value']), '"', $meta == $option['value'] ? ' checked="checked"' : '', ' /><label for="', esc_attr($field['id']), $i, '">', esc_attr($option['name']) . '</label></li>';
						$i++;
					}
					echo '</ul>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '"', $meta ? ' checked="checked"' : '', ' />';
					echo '<span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'multicheck':
					echo '<ul>';
					$i = 1;
					foreach ($field['options'] as $value => $name) {
						// Append `[]` to the name to get multiple values
						// Use in_array() to check whether the current option should be checked
						echo '<li><input type="checkbox" name="', esc_attr($field['id']), '[]" id="', esc_attr($field['id']), $i, '" value="', esc_attr($value), '"', in_array($value, $meta) ? ' checked="checked"' : '', ' /><label for="', esc_attr($field['id']), $i, '">', esc_attr($name), '</label></li>';
						$i++;
					}
					echo '</ul>';
					echo '<span class="hafez_metabox_description">', esc_attr($field['desc']), '</span>';
					break;
				case 'title':
					echo '<h5 class="hafez_metabox_title">', esc_attr($field['name']), '</h5>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'wysiwyg':
					wp_editor($meta ? $meta : $field['std'], $field['id'], isset($field['options']) ? $field['options'] : array());
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'taxonomy_select':
					echo '<select name="', esc_attr($field['id']), '" id="', esc_attr($field['id']), '">';
					$names = wp_get_object_terms($post->ID, $field['taxonomy']);
					$terms = get_terms($field['taxonomy'], 'hide_empty=0');
					foreach ($terms as $term) {
						if (!is_wp_error($names) && !empty($names) && !strcmp($term->slug, $names[0]->slug)) {
							echo '<option value="' . esc_attr($term->slug) . '" selected>' . esc_attr($term->name) . '</option>';
						} else {
							echo '<option value="' . esc_attr($term->slug) . '  ', $meta == $term->slug ? $meta : ' ', '  ">' . esc_attr($term->name) . '</option>';
						}
					}
					echo '</select>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'taxonomy_radio':
					$names = wp_get_object_terms($post->ID, $field['taxonomy']);
					$terms = get_terms($field['taxonomy'], 'hide_empty=0');
					echo '<ul>';
					foreach ($terms as $term) {
						if (!is_wp_error($names) && !empty($names) && !strcmp($term->slug, $names[0]->slug)) {
							echo '<li><input type="radio" name="', esc_attr($field['id']), '" value="' . esc_attr($term->slug) . '" checked>' . esc_attr($term->name) . '</li>';
						} else {
							echo '<li><input type="radio" name="', esc_attr($field['id']), '" value="' . esc_attr($term->slug) . '  ', $meta == $term->slug ? $meta : ' ', '  ">' . esc_attr($term->name) . '</li>';
						}
					}
					echo '</ul>';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					break;
				case 'taxonomy_multicheck':
					echo '<ul>';
					$names = wp_get_object_terms($post->ID, $field['taxonomy']);
					$terms = get_terms($field['taxonomy'], 'hide_empty=0');
					foreach ($terms as $term) {
						echo '<li><input type="checkbox" name="', esc_attr($field['id']), '[]" id="', esc_attr($field['id']), '" value="', esc_attr($term->name), '"';
						foreach ($names as $name) {
							if ($term->slug == $name->slug) {
								echo ' checked="checked" ';
							};
						}
						echo ' /><label>', esc_attr($term->name), '</label></li>';
					}
					break;
				case 'file_list':
					echo '<input class="hafez_upload_file" type="text" size="36" name="', esc_attr($field['id']), '" value="" />';
					echo '<input class="hafez_upload_button button" type="button" value="Upload File" />';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => null,
						'post_status' => null,
						'post_parent' => $post->ID
					);
					$attachments = get_posts($args);
					if ($attachments) {
						echo '<ul class="attach_list">';
						foreach ($attachments as $attachment) {
							echo '<li>' . wp_get_attachment_link($attachment->ID, 'thumbnail', 0, 0, 'Download');
							echo '<span>';
							echo apply_filters('the_title', '&nbsp;' . esc_attr($attachment->post_title));
							echo '</span></li>';
						}
						echo '</ul>';
					}
					break;
				case 'file':
					$input_type_url = "hidden";
					if ('url' == $field['allow'] || (is_array($field['allow']) && in_array('url', $field['allow'])))
						$input_type_url = "text";
					echo '<input class="hafez_upload_file" type="' . esc_attr($input_type_url) . '" size="45" id="', esc_attr($field['id']), '" name="', esc_attr($field['id']), '" value="', esc_attr($meta), '" />';
					echo '<input class="hafez_upload_button button" type="button" value="Upload File" />';
					echo '<input class="hafez_upload_file_id" type="hidden" id="', esc_attr($field['id']), '_id" name="', esc_attr($field['id']), '_id" value="', get_post_meta($post->ID, esc_attr($field['id']) . "_id", true), '" />';
					echo '<p class="hafez_metabox_description">', esc_attr($field['desc']), '</p>';
					echo '<div id="', esc_attr($field['id']), '_status" class="hafez_upload_status">';
					if ($meta != '') {
						$check_image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $meta);
						if ($check_image) {
							echo '<div class="img_status">';
							echo '<img src="', esc_url($meta), '" alt="' . esc_html__('Image', 'hafez') . '" />';
							echo '<a href="#" class="hafez_remove_file_button" rel="', esc_attr($field['id']), '">Remove Image</a>';
							echo '</div>';
						} else {
							$parts = explode('/', $meta);
							for ($i = 0; $i < count($parts); ++$i) {
								$title = $parts[$i];
							}
							echo 'File: <strong>', esc_attr($title), '</strong>&nbsp;&nbsp;&nbsp; (<a href="', esc_url($meta), '" target="_blank" rel="external">Download</a> / <a href="#" class="hafez_remove_file_button" rel="', esc_attr($field['id']), '">Remove</a>)';
						}
					}
					echo '</div>';
					break;
				default:
					do_action('hafez_render_' . $field['type'], $field, $meta);
			}

			echo '</td>', '</tr>';
		}
		echo '</table>';
	}

	// Save data from metabox
	function save($post_id)
	{

		// verify nonce
		if (!isset($_POST['wp_meta_box_nonce']) || !wp_verify_nonce($_POST['wp_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ($this->_meta_box['fields'] as $field) {
			$name = $field['id'];

			if (!isset($field['multiple']))
				$field['multiple'] = ('multicheck' == $field['type']) ? true : false;

			$old = get_post_meta($post_id, $name, !$field['multiple'] /* If multicheck this can be multiple values */);
			$new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : null;

			if (in_array($field['type'], array('taxonomy_select', 'taxonomy_radio', 'taxonomy_multicheck'))) {
				$new = wp_set_object_terms($post_id, $new, $field['taxonomy']);
			}

			if (($field['type'] == 'textarea') || ($field['type'] == 'textarea_small')) {
				$new = htmlspecialchars($new);
			}

			if (($field['type'] == 'textarea_code')) {
				$new = wp_specialchars_decode($new);
			}

			if ($field['type'] == 'text_date_timestamp') {
				$new = strtotime($new);
			}

			if ($field['type'] == 'text_datetime_timestamp') {
				$string = $new['date'] . ' ' . $new['time'];
				$new = strtotime($string);
			}

			$new = apply_filters('hafez_validate_' . $field['type'], $new, $post_id, $field);

			// validate meta value
			if (isset($field['validate_func'])) {
				$ok = call_user_func(array('hafez_meta_box_validate', $field['validate_func']), $new);
				if ($ok === false) { // pass away when meta value is invalid
					continue;
				}
			} elseif ($field['multiple']) {
				delete_post_meta($post_id, $name);
				if (!empty($new)) {
					foreach ($new as $add_new) {
						add_post_meta($post_id, $name, $add_new, false);
					}
				}
			} elseif ('' !== $new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new) {
				delete_post_meta($post_id, $name);
			}

			if ('file' == $field['type']) {
				$name = $field['id'] . "_id";
				$old = get_post_meta($post_id, $name, !$field['multiple'] /* If multicheck this can be multiple values */);
				if (isset($field['save_id']) && $field['save_id']) {
					$new = isset($_POST[$name]) ? $_POST[$name] : null;
				} else {
					$new = "";
				}

				if ($new && $new != $old) {
					update_post_meta($post_id, $name, $new);
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $name, $old);
				}
			}
		}
	}
}

function hafez_editor_footer_scripts()
{ ?>
	<?php
	if (isset($_GET['hafez_force_send']) && 'true' == $_GET['hafez_force_send']) {
		$label = $_GET['hafez_send_label'];
		if (empty($label)) $label = "Select File";
	?>
		<script type="text/javascript">
			jQuery(function($) {
				$('td.savesend input').val('<?php echo esc_attr($label); ?>');
			});
		</script>
<?php
	}
}
add_action('admin_print_footer_scripts', 'hafez_editor_footer_scripts', 99);

// Force 'Insert into Post' button from Media Library 
add_filter('get_media_item_args', 'hafez_force_send');
function hafez_force_send($args)
{

	// if the Gallery tab is opened from a custom meta box field, add Insert Into Post button	
	if (isset($_GET['hafez_force_send']) && 'true' == $_GET['hafez_force_send'])
		$args['send'] = true;

	// if the From Computer tab is opened AT ALL, add Insert Into Post button after an image is uploaded	
	if (isset($_POST['attachment_id']) && '' != $_POST["attachment_id"]) {
		$args['send'] = true;
	}

	// change the label of the button on the From Computer tab
	if (isset($_POST['attachment_id']) && '' != $_POST["attachment_id"]) {

		echo '
			<script type="text/javascript">
				function cmbGetParameterByNameInline(name) {
					name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
					var regexS = "[\\?&]" + name + "=([^&#]*)";
					var regex = new RegExp(regexS);
					var results = regex.exec(window.location.href);
					if(results == null)
						return "";
					else
						return decodeURIComponent(results[1].replace(/\+/g, " "));
				}
							
				jQuery(function($) {
					if (cmbGetParameterByNameInline("hafez_force_send")=="true") {
						var hafez_send_label = cmbGetParameterByNameInline("hafez_send_label");
						$("td.savesend input").val(hafez_send_label);
					}
				});
			</script>
		';
	}

	return $args;
}


/**
 * Add metabox for Top level pages only
 */
function hafez_metabox_add_for_top_level_posts_only($display, $meta_box)
{

	if ('parent-id' !== $meta_box['show_on']['key'])
		return $display;

	// Get the post's ID so we can see if it has ancestors					
	if (isset($_GET['post'])) $post_id = $_GET['post'];
	elseif (isset($_POST['post_ID'])) $post_id = $_POST['post_ID'];
	if (!isset($post_id))
		return false;

	// If the post doesn't have ancestors, show the box
	if (!get_post_ancestors($post_id))
		return $display;
	// Otherwise, it's not a top level post, so don't show it
	else
		return false;
}
add_filter('hafez_show_on', 'hafez_metabox_add_for_top_level_posts_only', 10, 2);

/**
 * Add metabox for ancestor pages
 */
function hafez_metabox_add_for_ancestors_posts_only($display, $meta_box)
{

	if ('ancestor' !== $meta_box['show_on']['key'])
		return $display;

	// Get the post's ID so we can see if it has ancestors					
	if (isset($_GET['post'])) $post_id = $_GET['post'];
	elseif (isset($_POST['post_ID'])) $post_id = $_POST['post_ID'];
	if (!isset($post_id))
		return false;

	$post = get_post($post_id);

	// If the post doesn't have ancestors, show the box
	if ($post->post_parent)
		return $display;
	// Otherwise, it's not a top level post, so don't show it
	else
		return false;
}
add_filter('hafez_show_on', 'hafez_metabox_add_for_ancestors_posts_only', 10, 2);