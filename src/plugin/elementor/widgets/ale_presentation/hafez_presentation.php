<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Elementor_Widget_hafez_Presentation extends \Elementor\Widget_Base
{

	public function get_script_depends()
	{
		if (\Elementor\Plugin::$instance->preview->is_preview_mode()) {
			wp_register_script('hafez_presentation_editor', plugins_url('editor.js', __FILE__), ['elementor-frontend'], '1.0', true);
			return ['hafez_presentation_editor'];
		} else {
			wp_register_script('fwc_presentation', plugins_url('index.js', __FILE__), [], '1.0', true);
			return ['hafez_presentation'];
		}

		return [];
	}

	public function get_style_depends()
	{
		wp_register_style('hafez_presentation', plugins_url('hafez_presentation.css', __FILE__));

		return [
			'hafez_presentation',
		];
	}

	/**
	 * Widget base constructor
	 */

	public function __construct($data = [], $args = null)
	{

		parent::__construct($data, $args);
	}

	/**
	 * Get widget name
	 */

	public function get_name()
	{
		return 'hafez_presentation';
	}

	/**
	 * Get widget title
	 */

	public function get_title()
	{
		return esc_html__('Presentation', 'hafez');
	}

	/**
	 * Get widget icon
	 */

	public function get_icon()
	{
		return 'eicon-image-rollover';
	}

	/**
	 * Get widget categories
	 */

	public function get_categories()
	{
		return ['hafez_builder'];
	}

	/**
	 * Register widget controls
	 */

	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'hafez'),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__("Title", "hafez"),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'sectionid',
			[
				'label' => esc_html__("Section ID", "fwc"),
				'description' => esc_html__('Specify the section ID for scrolling option. ex: blocktitle', 'hafez'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'hafez'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__('Type your text here', 'hafez'),
			]
		);

		$this->add_control(
			'buttob_link',
			[
				'label' => esc_html__('URL', 'hafez'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'hafez'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__("Button Value", "hafez"),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'hafez'),
				'type' => \Elementor\Controls_Manager::MEDIA,

			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend
	 */

	protected function render()
	{

		$settings = $this->get_settings_for_display();

		$image_src = $settings['image']['url'];

?>

		<div class="fwc_presentation">
			<div class="wrapper">
				<div class="presentation_container">
					<div class="data_container">
						<?php if ($settings['sectionid']) {
							echo '<div class="scrollToBlock" id="' . esc_attr($settings['sectionid']) . '"></div>';
						} ?>
						<?php if ($settings['title']) { ?><h2 class="title fadeInElement"><?php echo esc_html($settings['title']) ?></h2><?php } ?>

						<?php if ($settings['description']) { ?><div class="presentation_description fadeInElement"><?php echo wp_kses_post($settings['description']); ?></div><?php } ?>

						<?php if (!empty($settings['buttob_link']['url'])) { ?>
							<a href="<?php echo esc_url($settings['buttob_link']['url']); ?>" <?php echo (!empty($settings['buttob_link']['nofollow']) ? 'rel="nofollow"' : 'rel="follow"'); ?> <?php echo (!empty($settings['buttob_link']['is_external']) ? 'target="_blank"' : 'target="_self"'); ?> class="button __big fadeInElement">
								<?php
								if (!empty($settings['button_text'])) {
									echo esc_html($settings['button_text']);
								} else {
									esc_html_e('Get Consiltation', 'hafez');
								} ?>
							</a>
						<?php } ?>
					</div>
					<div class="image_container">
						<?php if (!empty($image_src)) {
							echo '<img src="' . esc_url($image_src) . '" alt="' . esc_attr($settings['title']) . '" class="fadeInElement"/>';
						} ?>
						<div class="decor_color">
							<div class="decor_1"></div>
							<div class="decor_2"></div>
							<div class="decor_3"></div>
							<div class="decor_4"></div>
							<div class="decor_5"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="decor">
				<div class="decor_item decor_1"></div>
				<div class="decor_item decor_2"></div>
				<div class="decor_item decor_3"></div>
				<div class="decor_item decor_4"></div>
			</div>
		</div>


<?php

	}
}
