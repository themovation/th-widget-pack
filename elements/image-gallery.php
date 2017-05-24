<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Image_Gallery extends Widget_Base {

	public function get_name() {
		return 'themo-image-gallery';
	}

	public function get_title() {
		return __( 'Image Gallery', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-insert-image';
	}

    public function get_categories() {
        return [ 'themo-elements' ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_gallery',
			[
				'label' => __( 'Image Gallery', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'wp_gallery',
			[
				'label' => __( 'Add Images', 'th-widget-pack' ),
				'type' => Controls_Manager::GALLERY,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
                //'include' => [ 'thumbnail','medium','large','th_img_sm_landscape','th_img_sm_portrait','th_img_sm_square','th_img_sm_standard','th_img_md_landscape','th_img_md_portrait','th_img_md_square'],

                'name' => 'thumbnail',
				'exclude' => [ 'custom','themo-logo','th_img_xs','th_img_lg','th_img_xl','th_img_xxl','themo_team','themo_brands','full'],
			]
		);

		$gallery_columns = range( 1, 6 );
		$gallery_columns = array_combine( $gallery_columns, $gallery_columns );

		$this->add_control(
			'gallery_columns',
			[
				'label' => __( 'Columns', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 4,
				'options' => $gallery_columns,
			]
		);

		$this->add_control(
			'gallery_link',
			[
				'label' => __( 'Link to', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'file',
				'options' => [
					'file' => __( 'Media File', 'th-widget-pack' ),
					'attachment' => __( 'Attachment Page', 'th-widget-pack' ),
					'none' => __( 'None', 'th-widget-pack' ),
				],
			]
		);

		$this->add_control(
			'gallery_rand',
			[
				'label' => __( 'Ordering', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'th-widget-pack' ),
					'rand' => __( 'Random', 'th-widget-pack' ),
				],
				'default' => '',
			]
		);

        $this->add_control(
            'image_stretch',
            [
                'label' => __( 'Image Stretch', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'no' => __( 'No', 'th-widget-pack' ),
                    'yes' => __( 'Yes', 'th-widget-pack' ),
                ],
            ]
        );

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'th-widget-pack' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => __( 'Caption', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'gallery_display_caption',
			[
				'label' => __( 'Display', 'th-widget-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'' => __( 'Show', 'th-widget-pack' ),
					'none' => __( 'Hide', 'th-widget-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-text' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'th-widget-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'th-widget-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'th-widget-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'th-widget-pack' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'th-widget-pack' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .image-title' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .caption' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .image-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icaption' => 'color: {{VALUE}};',
				],
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( ! $settings['wp_gallery'] ) {
			return;
		}

        $gallery_class = false;
        if ( 'yes' === $settings['image_stretch'] ) {
            $gallery_class = 'th-image-stretch';
        }

		$ids = wp_list_pluck( $settings['wp_gallery'], 'id' );

		$this->add_render_attribute( 'shortcode', 'ids', esc_attr(implode( ',', $ids )) );
		$this->add_render_attribute( 'shortcode', 'size', esc_attr($settings['thumbnail_size']) );

		if ( $settings['gallery_columns'] ) {
			$this->add_render_attribute( 'shortcode', 'columns', esc_attr($settings['gallery_columns']) );
		}

		if ( $settings['gallery_link'] ) {
			$this->add_render_attribute( 'shortcode', 'link', esc_attr($settings['gallery_link']) );
		}

		if ( ! empty( $settings['gallery_rand'] ) ) {
			$this->add_render_attribute( 'shortcode', 'orderby', esc_attr($settings['gallery_rand']) );
		}
		?>
		<div class="elementor-image-gallery <?php echo esc_attr($gallery_class); ?>">
			<?php echo do_shortcode( '[gallery ' . sanitize_text_field($this->get_render_attribute_string( 'shortcode' )) . ']' ); ?>
		</div>
		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Image_Gallery() );
