<?php

/****************************************************************
 * DO NOT DELETE
 ****************************************************************/
if (get_stylesheet_directory() == get_template_directory()) {
    define('HAFEZTHEME_PATH', get_template_directory() . '/HafezTheme');
    define('HAFEZTHEME_URL', esc_url(get_template_directory_uri()) . '/HafezTheme');
} else {
    define('HAFEZTHEME_PATH', get_theme_root() . '/fwc/HafezTheme');
    define('HAFEZTHEME_URL', get_theme_root_uri() . '/fwc/HafezTheme');
}

require_once HAFEZTHEME_PATH . '/constants.php';



/****************************************************************
 * Parent theme functions should not be edited.
 * 
 * If you want to add custom functions you should use child theme.
 ****************************************************************/
