<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Testimonial extends Widget_Base {

	public function get_name() {
		return 'themo-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __( 'Testimonial', 'elementor' ),
			]
		);

		$this->add_control(
			'testimonial_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => __( '“Amazing trip; Great whitewater, food, and awesome guides. We had an amazing trip. Big group, but easily accommodated by Thrillz Co. The food was amazing, the weather was perfect, and the rafting was fun”', 'elementor' ),
				'placeholder' => __( '“Amazing trip; Great whitewater, food, and awesome guides. We had an amazing trip. Big group, but easily accommodated by Thrillz Co. The food was amazing, the weather was perfect, and the rafting was fun”', 'elementor' ),
			]
		);

        $this->add_control(
            'star_rating',
            [
                'label' => __( 'Star Rating', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'range' => [
                    'px' => [
                        'min' => .5,
                        'max' => 5,
                        'step' => .5,
                    ],
                ],
                /*'selectors' => [
                    '{{WRAPPER}} .box' => 'data-blah: {{SIZE}};',
                ],*/
            ]
        );

		$this->add_control(
			'testimonial_image',
			[
				'label' => __( 'Add Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonial_name',
			[
				'label' => __( 'Name', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Doug Martin',
				'placeholder' => 'Doug Martin',
			]
		);

		$this->add_control(
			'testimonial_job',
			[
				'label' => __( 'Job', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Adventurer',
				'placeholder' => 'Adventurer',
			]
		);

		$this->add_control(
			'testimonial_image_position',
			[
				'label' => __( 'Image Position', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'aside',
				'options' => [
					'aside' => __( 'Aside', 'elementor' ),
					'top' => __( 'Top', 'elementor' ),
				],
				'condition' => [
					'testimonial_image[url]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'testimonial_alignment',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left'    => [
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

		// Content
		$this->start_controls_section(
			'section_style_testimonial_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_content_color',
			[
				'label' => __( 'Content Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-content' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementor-testimonial-content',
			]
		);*/

		$this->end_controls_section();

		// Image
		/*$this->start_controls_section(
			'section_style_testimonial_image',
			[
				'label' => __( 'Image', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'testimonial_image[url]!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img',
				'condition' => [
					'testimonial_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'testimonial_image[url]!' => '',
				],
			]
		);

		$this->end_controls_section();*/

		// Name
		$this->start_controls_section(
			'section_style_testimonial_name',
			[
				'label' => __( 'Name', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-name' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-testimonial-name',
			]
		);*/

		$this->end_controls_section();

		// Job
		$this->start_controls_section(
			'section_style_testimonial_job',
			[
				'label' => __( 'Job', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'job_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-job' => 'color: {{VALUE}};',
				],
			]
		);

		/*$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elementor-testimonial-job',
			]
		);*/

		$this->end_controls_section();
	}

	protected function render() {

	    $settings = $this->get_settings();


		$this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-wrapper' );
        $this->add_render_attribute( 'wrapper', 'class', 'th-testimonial-w' );

		if ( $settings['testimonial_alignment'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-text-align-' . esc_attr( $settings['testimonial_alignment'] ) );
		}

		$this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-meta' );

		/*if ( $settings['testimonial_image']['url'] ) {
			$this->add_render_attribute( 'meta', 'class', 'elementor-has-image' );
		}*/

        if ( isset($settings['testimonial_image']['id']) && $settings['testimonial_image']['id'] > "") {

            if ( $settings['testimonial_image']['id'] ) $image = wp_get_attachment_image( $settings['testimonial_image']['id'], 'th_img_sm_square', false, array( 'class' => 'th-team-member-image' ) );

        }elseif ( ! empty( $settings['testimonial_image']['url'] ) ) {
            $this->add_render_attribute( 'image', 'src', esc_url( $settings['testimonial_image']['url'] ) );
            $this->add_render_attribute( 'image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['testimonial_image'] ) ) );
            $this->add_render_attribute( 'image', 'title', esc_attr( Control_Media::get_image_title( $settings['testimonial_image'] ) ) );
            $this->add_render_attribute( 'image', 'class', 'th-team-member-image' );
            $image = '<img ' . $this->get_render_attribute_string( 'image' ) . '>';
        }

		if ( $settings['testimonial_image_position'] ) {
			$this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-image-position-' . esc_attr( $settings['testimonial_image_position'] ) );
		}

		$has_content = ! ! $settings['testimonial_content'];

		$has_image = ! ! $settings['testimonial_image']['url'];

		$has_name = ! ! $settings['testimonial_name'];

		$has_job = ! ! $settings['testimonial_job'];

		if ( ! $has_content && ! $has_image && ! $has_name && ! $has_job ) {
			return;
		}

        if ( $settings['star_rating']['size'] ) {
		    $th_rating = $settings['star_rating']['size'];
            $th_rating = $th_rating*10;
            $th_rating = sprintf("%02d", $th_rating);
            $this->add_render_attribute( 'star-rating', 'class', 'th-star-rating th-star-' . esc_attr( $th_rating ) );
        }
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $has_content ) : ?>
				<div class="elementor-testimonial-content"><?php echo esc_html( $settings['testimonial_content'] ); ?></div>
			<?php endif; ?>

            <div class="th-quote">
            <div <?php echo $this->get_render_attribute_string( 'star-rating' ); ?>>
                <span class="th-star-1 glyphicons"></span>
                <span class="th-star-2 glyphicons"></span>
                <span class="th-star-3 glyphicons"></span>
                <span class="th-star-4 glyphicons"></span>
                <span class="th-star-5 glyphicons"></span>
            </div>
            </div>

			<?php if ( $has_image || $has_name || $has_job ) : ?>
			<div <?php echo $this->get_render_attribute_string( 'meta' ); ?>>
				<div class="elementor-testimonial-meta-inner">
                    <?php if ( isset( $image ) ) : ?>
                        <div class="elementor-testimonial-image">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

					<?php if ( $has_name || $has_job ) : ?>
					<div class="elementor-testimonial-details">
						<?php if ( $has_name ) : ?>
							<div class="elementor-testimonial-name"><?php echo esc_html( $settings['testimonial_name'] ); ?></div>
						<?php endif; ?>

						<?php if ( $has_job ) : ?>
							<div class="elementor-testimonial-job"><?php echo esc_html( $settings['testimonial_job'] ); ?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Testimonial() );
