<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_GoogleMaps extends Widget_Base {

	public function get_name() {
		return 'themo-google-maps';
	}

	public function get_title() {
		return __( 'Google Maps', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_map',
			[
				'label' => __( 'Map', 'th-widget-pack' ),
			]
		);

		$default_address = __( 'London Eye, London, United Kingdom', 'th-widget-pack' );
		$this->add_control(
			'address',
			[
				'label' => __( 'Map Address', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_address,
				'default' => $default_address,
				'label_block' => true,
			]
		);

		$this->add_control(
			'zoom',
			[
				'label' => __( 'Zoom Level', 'th-widget-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
			]
		);

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ultra_light' => __( 'Ultra Light with Labels', 'th-widget-pack' ),
                    'light_dream' => __( 'Light Dream', 'th-widget-pack' ),
                    'shades_of_gray' => __( 'Shades of Gray', 'th-widget-pack' ),
                    'subtle_grayscale' => __( 'Subtle Grayscale', 'th-widget-pack' ),
                    'standard' => __( 'Standard', 'th-widget-pack' ),
                    'retro' => __( 'Retro', 'th-widget-pack' ),
                ],
                'default' => 'ultra_light',
            ]
        );

		$this->add_control(
			'api',
			[
				'label' => __( 'Google Maps API', 'th-widget-pack' ),
				'description' => __( '<a href="https://developers.google.com/maps/documentation/static-maps/" target="_blank">Get an API key</a>', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'th-widget-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 300,
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-google-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'prevent_scroll',
			[
				'label' => __( 'Prevent Scroll', 'th-widget-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'th-widget-pack' ),
				'label_off' => __( 'No', 'th-widget-pack' ),
				'selectors' => [
					'{{WRAPPER}} iframe' => 'pointer-events: none;',
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
			'section_text_block',
			[
				'label' => __( 'Text Block', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'th-widget-pack' ),
				'default' => __( 'Company Co.', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'business_address',
			[
				'label' => __( 'Business Address', 'th-widget-pack' ),
				'default' => __( "1366 Main Street\nancouver Canada\nV8V 3K6", 'th-widget-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hours',
			[
				'label' => __( 'Hours', 'th-widget-pack' ),
				'default' => __( "Monday to Friday: 10am - 6pm\nSaturday: 11am - 4pm\nSunday: Closed", 'th-widget-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_1_text',
			[
				'label' => __( 'Link 1 Text', 'th-widget-pack' ),
				'default' => __( 'Call Us', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_1_url',
			[
				'label' => __( 'Link 1 URL', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                'default' => [
                    'url' => 'tel:222-2222',
                ],
			]
		);

		$this->add_control(
			'link_2_text',
			[
				'label' => __( 'Link 2 Text', 'th-widget-pack' ),
                'default' => __( 'Email Us', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_2_url',
			[
				'label' => __( 'Link 2 URL', 'th-widget-pack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'th-widget-pack' ),
                'default' => [
                    'url' => 'mailto:info@companyco.com',
                ],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		// global $th_map_id;
		// $map_id = 'th-map-' . ++$th_map_id;

		$map_id = 'map';

		if ( empty( $settings['address'] ) ) return;

		if ( 0 === absint( $settings['zoom']['size'] ) ) $settings['zoom']['size'] = 10;

		if ( '' === $settings['api'] ) $settings['api'] = 'AIzaSyDb-ldlvqnIEXdh6maZVaonnw05xVAttQw';

		// styles

        switch ($settings['style']) {
            case 'ultra_light':
                $th_map_style = '&maptype=roadmap&style=element:labels.icon%7Cvisibility:off&style=element:labels.text.fill%7Ccolor:0x333333%7Csaturation:-100%7Clightness:30&style=element:labels.text.stroke%7Ccolor:0xffffff%7Clightness:16%7Cvisibility:on&style=feature:administrative%7Celement:geometry.fill%7Ccolor:0xfefefe%7Clightness:20&style=feature:administrative%7Celement:geometry.stroke%7Ccolor:0xfefefe%7Clightness:17%7Cweight:1.2&style=feature:landscape%7Celement:geometry%7Ccolor:0xf5f5f5%7Clightness:20&style=feature:poi%7Celement:geometry%7Ccolor:0xf5f5f5%7Clightness:21&style=feature:poi.park%7Celement:geometry%7Ccolor:0xdedede%7Clightness:21&style=feature:road.arterial%7Celement:geometry%7Ccolor:0xffffff%7Clightness:18&style=feature:road.highway%7Celement:geometry.fill%7Ccolor:0xffffff%7Clightness:17&style=feature:road.highway%7Celement:geometry.stroke%7Ccolor:0xffffff%7Clightness:29%7Cweight:0.2&style=feature:road.local%7Celement:geometry%7Ccolor:0xffffff%7Clightness:16&style=feature:transit%7Celement:geometry%7Ccolor:0xf2f2f2%7Clightness:19&style=feature:water%7Celement:geometry%7Ccolor:0xe9e9e9%7Clightness:17';
            break;
            case 'subtle_grayscale':
                $th_map_style = '&maptype=roadmap&style=feature:administrative%7Csaturation:-100&style=feature:administrative.province%7Cvisibility:off&style=feature:landscape%7Csaturation:-100%7Clightness:65%7Cvisibility:on&style=feature:poi%7Csaturation:-100%7Clightness:50%7Cvisibility:simplified&style=feature:road%7Csaturation:-100&style=feature:road.arterial%7Clightness:30&style=feature:road.highway%7Cvisibility:simplified&style=feature:road.local%7Clightness:40&style=feature:transit%7Csaturation:-100%7Cvisibility:simplified&style=feature:water%7Celement:geometry%7Chue:0xffff00%7Csaturation:-97%7Clightness:-25&style=feature:water%7Celement:labels%7Csaturation:-100%7Clightness:-25';
            break;
            case 'shades_of_gray':
                $th_map_style = '&maptype=roadmap&style=element:labels.icon%7Cvisibility:off&style=element:labels.text.fill%7Ccolor:0x000000%7Csaturation:-100%7Clightness:40&style=element:labels.text.stroke%7Ccolor:0x000000%7Clightness:16%7Cvisibility:on&style=feature:administrative%7Celement:geometry.fill%7Ccolor:0x000000%7Clightness:20&style=feature:administrative%7Celement:geometry.stroke%7Ccolor:0x000000%7Clightness:17%7Cweight:1.2&style=feature:landscape%7Celement:geometry%7Ccolor:0x000000%7Clightness:20&style=feature:poi%7Celement:geometry%7Ccolor:0x000000%7Clightness:21&style=feature:road.arterial%7Celement:geometry%7Ccolor:0x000000%7Clightness:18&style=feature:road.highway%7Celement:geometry.fill%7Ccolor:0x000000%7Clightness:17&style=feature:road.highway%7Celement:geometry.stroke%7Ccolor:0x000000%7Clightness:29%7Cweight:0.2&style=feature:road.local%7Celement:geometry%7Ccolor:0x000000%7Clightness:16&style=feature:transit%7Celement:geometry%7Ccolor:0x000000%7Clightness:19&style=feature:water%7Celement:geometry%7Ccolor:0x000000%7Clightness:17';
            break;
            case 'light_dream':
                $th_map_style = '&maptype=roadmap&style=feature:landscape%7Chue:0xFFBB00%7Csaturation:43.400000000000006%7Clightness:37.599999999999994%7Cgamma:1&style=feature:poi%7Chue:0x00FF6A%7Csaturation:-1.0989010989011234%7Clightness:11.200000000000017%7Cgamma:1&style=feature:road.arterial%7Chue:0xFF0300%7Csaturation:-100%7Clightness:51.19999999999999%7Cgamma:1&style=feature:road.highway%7Chue:0xFFC200%7Csaturation:-61.8%7Clightness:45.599999999999994%7Cgamma:1&style=feature:road.local%7Chue:0xFF0300%7Csaturation:-100%7Clightness:52%7Cgamma:1&style=feature:water%7Chue:0x0078FF%7Csaturation:-13.200000000000003%7Clightness:2.4000000000000057%7Cgamma:1';
            break;
            case 'retro':
                $th_map_style = '&maptype=roadmap&style=element:geometry%7Ccolor:0xebe3cd&style=element:labels.text.fill%7Ccolor:0x523735&style=element:labels.text.stroke%7Ccolor:0xf5f1e6&style=feature:administrative%7Celement:geometry.stroke%7Ccolor:0xc9b2a6&style=feature:administrative.land_parcel%7Celement:geometry.stroke%7Ccolor:0xdcd2be&style=feature:administrative.land_parcel%7Celement:labels.text.fill%7Ccolor:0xae9e90&style=feature:landscape.natural%7Celement:geometry%7Ccolor:0xdfd2ae&style=feature:poi%7Celement:geometry%7Ccolor:0xdfd2ae&style=feature:poi%7Celement:labels.text.fill%7Ccolor:0x93817c&style=feature:poi.park%7Celement:geometry.fill%7Ccolor:0xa5b076&style=feature:poi.park%7Celement:labels.text.fill%7Ccolor:0x447530&style=feature:road%7Celement:geometry%7Ccolor:0xf5f1e6&style=feature:road.arterial%7Celement:geometry%7Ccolor:0xfdfcf8&style=feature:road.highway%7Celement:geometry%7Ccolor:0xf8c967&style=feature:road.highway%7Celement:geometry.stroke%7Ccolor:0xe9bc62%7Cvisibility:simplified&style=feature:road.highway.controlled_access%7Celement:geometry%7Ccolor:0xe98d58&style=feature:road.highway.controlled_access%7Celement:geometry.stroke%7Ccolor:0xdb8555&style=feature:road.local%7Celement:labels.text.fill%7Ccolor:0x806b63&style=feature:transit.line%7Celement:geometry%7Ccolor:0xdfd2ae&style=feature:transit.line%7Celement:labels.text.fill%7Ccolor:0x8f7d77&style=feature:transit.line%7Celement:labels.text.stroke%7Ccolor:0xebe3cd&style=feature:transit.station%7Celement:geometry%7Ccolor:0xdfd2ae&style=feature:water%7Celement:geometry.fill%7Ccolor:0xb9d3c2&style=feature:water%7Celement:labels.text.fill%7Ccolor:0x92998d';
            break;
            default:
                $th_map_style = '&maptype=roadmap';
        }

		// url encode the address
		$address = urlencode( $settings['address'] );
		?>
		<div class="th-google-map">
			<div class="map-info">
				<h3><?php echo esc_html( $settings['title'] ) ?></h3>
				<?php echo wpautop( esc_html( $settings['business_address'] ) ); ?>
				<?php echo wpautop( esc_html( $settings['hours'] ) ); ?>
				<?php if ( $settings['link_1_url'] ) : ?>
					<a href="<?php echo esc_url( $settings['link_1_url']['url'] ) ?>">
						<?php echo esc_html( $settings['link_1_text'] ) ?>
					</a>
				<?php endif; ?>
				<?php if ( $settings['link_2_url'] ) : ?>
					<a href="<?php echo esc_url( $settings['link_2_url']['url'] ) ?>">
						<?php echo esc_html( $settings['link_2_text'] ) ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<style>
			.th-google-map {
				background-image: url( "https://maps.googleapis.com/maps/api/staticmap?center=<?php echo esc_url( $address ) ?>&zoom=<?php echo esc_attr( $settings['zoom']['size'] ) ?>&key=<?php echo esc_attr( $settings['api'] ) ?>&size=2048x2048&scale=2&format=png<?php echo $th_map_style; ?>" );


			}

		</style>

		<?php

        function th_inline_styles() {
            $th_custom_css = "/* Hello from Gooogle Maps Widget */";
            wp_add_inline_style( 'roots_app_2', $th_custom_css );
        }
        add_action( 'wp_enqueue_scripts', 'th_inline_styles', 101 );
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_GoogleMaps() );
