<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class hafez_Elementor_Helper
{

	/**
	 * Create new category
	 */

	public static function categories_registered($elements_manager)
	{

		$elements_manager->add_category(
			'hafez_builder',
			[
				'title' => __('hafez', 'hafez'),
				'icon' => 'fa fa-plug',
			]
		);
	}
}
