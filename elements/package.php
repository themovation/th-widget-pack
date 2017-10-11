<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Package extends Widget_Base {

	public function get_name() {
		return 'themo-package';
	}

	public function get_title() {
		return __( 'Package', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_about',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'th-widget-pack' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);

        $this->add_control(
            'post_image_size',
            [
                'label' => __( 'Image Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'th_img_sm_standard',
                'options' => [
                    'th_img_sm_standard' => __( 'Standard', 'th-widget-pack' ),
                    'th_img_sm_landscape' => __( 'Landscape', 'th-widget-pack' ),
                    'th_img_sm_portrait' => __( 'Portrait', 'th-widget-pack' ),
                    'th_img_sm_square' => __( 'Square', 'th-widget-pack' ),
                    'th_img_lg' => __( 'Large', 'th-widget-pack' ),
                ],
            ]
        );

        $this->add_control(
            'pre_title',
            [
                'label' => __( 'Pre Title', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '25% Off', 'th-widget-pack' ),
                'placeholder' => __( '25% Off', 'th-widget-pack' ),
                'label_block' => true,
            ]
        );

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Package Title', 'th-widget-pack' ),
				'placeholder' => __( 'Package Title', 'th-widget-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => 'Maecenas tristique ullamcorper mauris, et elementum tortor.',
			]
		);

        $this->add_control(
            'package_text_align',
            [
                'label' => __( 'Content Align', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price',
			[
				'label' => __( 'Price', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$299', 'th-widget-pack' ),
				'placeholder' => __( '$299', 'th-widget-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price_text',
			[
				'label' => __( 'Price Text', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '/each', 'th-widget-pack' ),
				'placeholder' => __( '/each', 'th-widget-pack' ),
				'label_block' => true,
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_link',
			[
				'label' => __( 'Link', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __( 'Link URL', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
            'section_style_background',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pre_title_color',
            [
                'label' => __( 'Pre Title Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-package-pre-title' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'content_color',
            [
                'label' => __( 'Content Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-package-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_price',
            [
                'label' => __( 'Price', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label' => __( 'Price Text Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_background',
            [
                'label' => __( 'Price Background', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .th-pkg-info' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();



	}

	protected function render() {
		$settings = $this->get_settings();

		if ( ! empty( $settings['url']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', esc_url( $settings['url']['url'] ) );

			if ( ! empty( $settings['url']['is_external'] ) ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}
		}

		$this->add_render_attribute( 'front-icon-wrapper','class','icon-wrapper' );

		?>

		<article class="th-package">

			<?php if ( ! empty( $settings['url']['url'] ) ) : ?>
				<a class="th-pkg-click" <?php echo $this->get_render_attribute_string( 'link' ); ?>></a>
			<?php endif; ?>

			<div class="th-pkg-info">
				<?php if ( ! empty( $settings['price'] ) ) : ?>
					<h4><?php echo esc_html( $settings['price'] ) ?></h4>
				<?php endif;?>
				<?php if ( ! empty( $settings['price_text'] ) ) : ?>
					<span><?php echo esc_html( $settings['price_text'] ) ?></span>
				<?php endif;?>
			</div>

            <?php
            if ( empty( $settings['image']['url'] ) ) {
                return;
            }
            if ( isset( $settings['post_image_size'] ) && $settings['post_image_size'] > "" && isset( $settings['image']['id'] ) && $settings['image']['id'] > "" ) {
                $image_size = esc_attr( $settings['post_image_size'] );
                if ( $settings['image']['id'] ) $image = wp_get_attachment_image( $settings['image']['id'], $image_size, false, array( 'class' => '' ) );
            } elseif ( ! empty( $settings['image']['url'] ) ) {
                $this->add_render_attribute( 'image', 'src', esc_url( $settings['image']['url'] ) );
                $this->add_render_attribute( 'image', 'alt', esc_attr( Control_Media::get_image_alt( $settings['image'] ) ) );
                $this->add_render_attribute( 'image', 'title', esc_attr( Control_Media::get_image_title( $settings['image'] ) ) );
                $image = '<img ' . $this->get_render_attribute_string( 'image' ) . '>';
            }
            ?>
            <div class="th-pkg-img">
                <?php echo wp_kses_post( $image ) ; ?>
            </div>

			<div class="th-pkg-content">
                <?php if ( ! empty( $settings['pre_title'] ) ) : ?>
                    <div class="th-package-pre-title"><?php echo esc_html( $settings['pre_title'] ); ?></div>
                <?php endif; ?>
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h3><?php echo esc_html( $settings['title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $settings['content'] ) ) : ?>
					<div class="th-package-content">
						<?php echo wp_kses_post( $settings['content'] ); ?>
					</div>
				<?php endif; ?>
			</div>

		</article>

		<?php
	}

	protected function _content_template() {}

	/*
	 * <article class="th-package">
			<# if ( settings.url && settings.url.url ) { #>
				<a class="th-pkg-click"  href="{{ settings.url.url }}"></a>
			<# } #>
			<div class="th-pkg-info">
				<# if ( '' !== settings.price ) { #>
					<h4>{{{ settings.price }}}</h4>
				<# } #>
				<# if ( '' !== settings.price_text ) { #>
					<span>{{{ settings.price_text }}}</span>
				<# } #>
			</div>
            <# if ( '' !== settings.image.url ) {
                    var image = {
                    id: settings.image.id,
                    url: settings.image.url,
                    size: settings.image_size,
                    dimension: settings.image_custom_dimension,
                    model: editModel
                    };

                    var image_url = elementor.imagesManager.getImageUrl( image );

                    if ( ! image_url ) {
                    return;
                    }
                #>
				<div class="th-pkg-img">
					<img src="{{{ image_url }}}" />
				</div>
			<# } #>
			<div class="th-pkg-content">
	            <# if ( '' !== settings.pre_title ) { #>
					<div class="th-package-pre-title">{{{ settings.pre_title }}}</div>
				<# } #>
				<# if ( '' !== settings.title ) { #>
					<h3>{{{ settings.title }}}</h3>
				<# } #>
				<# if ( '' !== settings.content ) { #>
					<div class="th-package-content">
						{{{ settings.content }}}
					</div>
				<# } #>
			</div>
		</article>
	 * */
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Package() );
