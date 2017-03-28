<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Image_Gallery extends Widget_Base {

	public function get_name() {
		return 'themo-image-gallery';
	}

	public function get_title() {
		return __( 'Image Gallery', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

    public function get_categories() {
        return [ 'themo-elements' ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_gallery',
			[
				'label' => __( 'Image Gallery', 'elementor' ),
			]
		);

		$this->add_control(
			'wp_gallery',
			[
				'label' => __( 'Add Images', 'elementor' ),
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
				'label' => __( 'Columns', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 4,
				'options' => $gallery_columns,
			]
		);

		$this->add_control(
			'gallery_link',
			[
				'label' => __( 'Link to', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'file',
				'options' => [
					'file' => __( 'Media File', 'elementor' ),
					'attachment' => __( 'Attachment Page', 'elementor' ),
					'none' => __( 'None', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'gallery_rand',
			[
				'label' => __( 'Ordering', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'elementor' ),
					'rand' => __( 'Random', 'elementor' ),
				],
				'default' => '',
			]
		);

        $this->add_control(
            'image_stretch',
            [
                'label' => __( 'Image Stretch', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'no' => __( 'No', 'elementor' ),
                    'yes' => __( 'Yes', 'elementor' ),
                ],
            ]
        );

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

        /*$this->start_controls_section(
            'section_gallery_images',
            [
                'label' => __( 'Images', 'elementor' ),
                'tab' => ntrols_Manager::TAB_STYLE,
            ]
        );

        /*$this->add_control(
            'image_spacing',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'Default', 'elementor' ),
                    'custom' => __( 'Custom', 'elementor' ),
                ],
                'prefix_class' => 'gallery-spacing-',
                'default' => '',
            ]
        );

        $columns_margin = is_rtl() ? '0 0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}};' : '0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}} 0;';
        $columns_padding = is_rtl() ? '0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};' : '0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0;';

        $this->add_control(
            'image_spacing_custom',
            [
                'label' => __( 'Image Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => false,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item' => 'padding:' . $columns_padding,
                    '{{WRAPPER}} .gallery' => 'margin: ' . $columns_margin,
                ],
                'condition' => [
                    'image_spacing' => 'custom',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Image Border', 'elementor' ),
                'selector' => '{{WRAPPER}} .gallery-item img',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .gallery-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();*/

		$this->start_controls_section(
			'section_caption',
			[
				'label' => __( 'Caption', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'gallery_display_caption',
			[
				'label' => __( 'Display', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'' => __( 'Show', 'elementor' ),
					'none' => __( 'Hide', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-text' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
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
				'label' => __( 'Text Color', 'elementor' ),
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

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .gallery-item .gallery-caption',
				'condition' => [
					'gallery_display_caption' => '',
				],
			]
		);*/

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

		$this->add_render_attribute( 'shortcode', 'ids', implode( ',', $ids ) );
		$this->add_render_attribute( 'shortcode', 'size', $settings['thumbnail_size'] );

		if ( $settings['gallery_columns'] ) {
			$this->add_render_attribute( 'shortcode', 'columns', $settings['gallery_columns'] );
		}

		if ( $settings['gallery_link'] ) {
			$this->add_render_attribute( 'shortcode', 'link', $settings['gallery_link'] );
		}

		if ( ! empty( $settings['gallery_rand'] ) ) {
			$this->add_render_attribute( 'shortcode', 'orderby', $settings['gallery_rand'] );
		}
		?>
		<div class="elementor-image-gallery <?php echo $gallery_class; ?>">
			<?php echo do_shortcode( '[gallery ' . $this->get_render_attribute_string( 'shortcode' ) . ']' ); ?>
		</div>
		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Image_Gallery() );