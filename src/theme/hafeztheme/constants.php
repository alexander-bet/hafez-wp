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
define('HAFEZTHEME_THEME_VERSION', hafez_theme_data_variable('Version'));
define('HAFEZTHEME_SHORTNAME', 'hafezKids');
define("HAFEZTHEME_THEME_OPTIONS_NAME", "hafezkids");
define("HAFEZTHEME_THEME_URL", esc_url(get_template_directory_uri()));
define("HAFEZTHEME_DEMOS_HOST", "http://HafezThemes.com/");


/****************************************************************
 * Find The Configuration File
 ****************************************************************/
require_once HAFEZTHEME_PATH . '/config.php';

/****************************************************************
 * Options Framework Set Up
 ****************************************************************/
require_once HAFEZTHEME_PATH . '/options/options.php';
require_once HAFEZTHEME_PATH . '/options/admin/options-framework.php';
require_once(HAFEZTHEME_PATH . '/functions/general.php');


/****************************************************************
 * Require Needed Files & Libraries
 ****************************************************************/

require_once(HAFEZTHEME_PATH . '/etc/admin.php');
require_once(HAFEZTHEME_PATH . '/etc/front.php');
require_once(HAFEZTHEME_PATH . '/etc/system.php');
require_once(HAFEZTHEME_PATH . '/etc/menu.php');

require_once(HAFEZTHEME_PATH . '/functions/images_media.php');
require_once(HAFEZTHEME_PATH . '/functions/class-tgm-plugin-activation.php');

if (!isset($content_width)) {
	$content_width = 1000; // default content width
}

load_theme_textdomain('hafezkids', get_template_directory() . '/lang');
$locale = get_locale();
$locale_file = get_template_directory() . "/lang/$locale.php";
if (is_readable($locale_file))
	require_once($locale_file);
