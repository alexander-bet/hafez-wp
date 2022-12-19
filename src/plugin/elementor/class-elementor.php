<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class hafez_Elementor
{
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';
	const MINIMUM_PHP_VERSION = '7.2';
	private static $_instance = null;

	/**
	 * Instance
	 * Ensures only one instance of the class is loaded or can be loaded.
	 */

	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 */

	public function __construct()
	{

		add_action('after_setup_theme', [$this, 'init']);
	}

	/**
	 * Initialize
	 */

	public function init()
	{

		// Check if Elementor installed and activated

		if (!did_action('elementor/loaded')) {
			return;
		}

		// Check for required Elementor version

		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return;
		}

		// Check for required PHP version

		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return;
		}

		// Add actions

		require_once(__DIR__ . '/class-elementor-helper.php');

		add_action('elementor/elements/categories_registered', 'hafez_Elementor_Helper::categories_registered');
		add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
	}


	/**
	 * Admin notice
	 * Warning when the site doesn't have a minimum required Elementor version.
	 */

	public function admin_notice_minimum_elementor_version()
	{

		$message = esc_html__('Theme requires Elementor version', 'hafez') . ' <strong>' . self::MINIMUM_ELEMENTOR_VERSION . '</strong> ' . esc_html__('or greater.', 'hafez');
		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 * Warning when the site doesn't have a minimum required PHP version.
	 */

	public function admin_notice_minimum_php_version()
	{

		$message = esc_html__('Theme requires PHP version', 'hafez') . ' <strong>' . self::MINIMUM_PHP_VERSION . '</strong> ' . esc_html__('or greater.', 'hafez');
		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Init Widgets
	 * Include widgets files and register them
	 */

	public function init_widgets()
	{

		$widgets = [
			'hafez_presentation',
		];

		foreach ($widgets as $widget) {

			require_once(__DIR__ . '/widgets/' . $widget . '/' . $widget . '.php');

			$class = '\Elementor_Widget_' . str_replace(' ', '_', ucfirst(str_replace('-', ' ', $widget)));
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $class());
		}
	}
}

hafez_Elementor::instance();
