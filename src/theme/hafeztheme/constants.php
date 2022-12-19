<?php

/****************************************************************
 * System Functions
 ****************************************************************/


/**
 * Load Theme Variable Data
 * @param string $var
 * @return string 
 */
function hafez_theme_data_variable($var)
{
	if (!is_file(STYLESHEETPATH . '/style.css')) {
		return '';
	}

	$theme_data = wp_get_theme();
	return $theme_data->{$var};
}

/****************************************************************
 * Define Constants
 ****************************************************************/
define('HafezTheme_THEME_VERSION', hafez_theme_data_variable('Version'));
define('HafezTheme_SHORTNAME', 'hafezKids');
define("HafezTheme_THEME_OPTIONS_NAME", "hafezkids");
define("HafezTheme_THEME_URL", esc_url(get_template_directory_uri()));
define("HafezTheme_DEMOS_HOST", "http://HafezThemes.com/");


/****************************************************************
 * Find The Configuration File
 ****************************************************************/
require_once HafezTheme_PATH . '/config.php';

/****************************************************************
 * Options Framework Set Up
 ****************************************************************/
require_once HafezTheme_PATH . '/options/options.php';
require_once HafezTheme_PATH . '/options/admin/options-framework.php';
require_once(HafezTheme_PATH . '/functions/general.php');


/****************************************************************
 * Require Needed Files & Libraries
 ****************************************************************/

require_once(HafezTheme_PATH . '/etc/admin.php');
require_once(HafezTheme_PATH . '/etc/front.php');
require_once(HafezTheme_PATH . '/etc/system.php');
require_once(HafezTheme_PATH . '/etc/menu.php');

require_once(HafezTheme_PATH . '/functions/images_media.php');
require_once(HafezTheme_PATH . '/functions/class-tgm-plugin-activation.php');

if (!isset($content_width)) {
	$content_width = 1000; // default content width
}

load_theme_textdomain('hafezkids', get_template_directory() . '/lang');
$lochafez = get_lochafez();
$lochafez_file = get_template_directory() . "/lang/$lochafez.php";
if (is_readable($lochafez_file))
	require_once($lochafez_file);
