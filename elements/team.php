<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Team extends Widget_Base {

	public function get_name() {
		return 'themo-team';
	}

	public function get_title() {
		return __( 'Team', 'elementor' );
	}

	public function get_icon() {
		return 'person';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_about',
			[
				'label' => __( 'About', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter title here', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->add_control(
			'job',
			[
				'label' => __( 'Job Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'CEO', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link',
			[
				'label' => __( 'Link', 'elementor' ),
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __( 'Link URL', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'new_window',
			[
				'label' => __( 'Open in a new window', 'elementor' ),
				'type' => Controls_Manager::CHECKBOX,
				'default' => false,
			]
		);

		$this->add_control(
			'lightbox',
			[
				'label' => __( 'Lightbox', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'off',
				'options' => [
					'off' => __( 'Off', 'elementor' ),
					'on' => __( 'On', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'lightbox_width',
			[
				'label' => __( 'Lightbox width (px)', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'elementor' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social',
			[
				'label' => __( 'Social Icons', 'elementor' ),
			]
		);

		$this->add_control(
			'social',
			[
				'label' => __( 'Social Icons', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'url' => 'http://your-link.com'
					]
				],
				'fields' => [
					[
						'name' => 'icon',
						'label' => __( 'Icon', 'elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'graphic_image',
						'label' => __( 'Graphic Image', 'elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'url',
						'label' => __( 'Link URL', 'elementor' ),
						'type' => Controls_Manager::URL,
						'placeholder' => 'http://your-link.com',
						'default' => [
							'url' => '',
						],
						'separator' => 'before',
						'label_block' => true,
					],
					[
						'name' => 'new_window',
						'label' => __( 'Open in a new window', 'elementor' ),
						'type' => Controls_Manager::CHECKBOX,
						'default' => false,
						'label_block' => true,
					],
					[
						'name' => 'lightbox',
						'label' => __( 'Lightbox', 'elementor' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'off',
						'options' => [
							'off' => __( 'Off', 'elementor' ),
							'on' => __( 'On', 'elementor' ),
						],
						'label_block' => true,
					],
					[
						'name' => 'lightbox_width',
						'label' => __( 'Lightbox width (px)', 'elementor' ),
						'type' => Controls_Manager::NUMBER,
						'default' => '',
						'label_block' => true,
					]
				],
				'title_field' => '{{{ icon }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Background', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => '',
			]
		);

		$this->add_control(
			'background_contrast',
			[
				'label' => __( 'Contrast', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark' => __( 'Dark Text', 'elementor' ),
					'light' => __( 'Light Text', 'elementor' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

	}

	protected function _content_template() {
		?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Team() );
