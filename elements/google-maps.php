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

		//$default_address = __( 'New York City, NY, United States', 'th-widget-pack' );


		$default_latitude = 49.293753;
		$default_logitude = -123.053398;
		// $this->add_control(
		// 	'address',
		// 	[
		// 		'label' => __( 'Map Address', 'th-widget-pack' ),
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => $default_address,
		// 		'default' => $default_address,
		// 		'label_block' => true,
		// 	]
		// );

		$this->add_control(
			'latitude',
			[
				'label' => __( 'Map Address : Latitude', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_latitude,
				'default' => $default_latitude,
				'label_block' => true,
			]
		);

		$this->add_control(
			'longitude',
			[
				'label' => __( 'Map Address : Longitude', 'th-widget-pack' ),
                'description' => __( '<a href="http://www.latlong.net/" target="_blank">Find your Latitude & Longitude</a>', 'th-widget-pack' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_logitude,
				'default' => $default_logitude,
				'label_block' => true,
			]
		);

		$this->add_control(
			'zoom',
			[
				'label' => __( 'Zoom Level', 'th-widget-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
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
                    'standard' => __( 'Standard', 'th-widget-pack' ),
                    'ultra_light' => __( 'Ultra Light', 'th-widget-pack' ),
                    'light_dream' => __( 'Light Dream', 'th-widget-pack' ),
                    'shades_of_gray' => __( 'Shades of Gray', 'th-widget-pack' ),
                    'subtle_grayscale' => __( 'Subtle Grayscale', 'th-widget-pack' ),
                    'retro' => __( 'Retro', 'th-widget-pack' ),
                    'apple_esque' => __( 'Apple-esque', 'th-widget-pack' ),
                    'blue_essence' => __( 'Blue Essence', 'th-widget-pack' ),
                ],
                'default' => 'standard',
            ]
        );



		$this->add_control(
			'api',
			[
				'label' => __( 'Google Maps API', 'th-widget-pack' ),
				'description' => __( '<a href="https://developers.google.com/maps/documentation/javascript/" target="_blank">Create an API key</a>', 'th-widget-pack' ),
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
					'size' => 400,
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .th-map' => 'height: {{SIZE}}{{UNIT}};',
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
				'default' => __( "1366 Main Street\nVancouver Canada\nV8V 3K6", 'th-widget-pack' ),
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

        $this->add_control(
            'header_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'th-widget-pack' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .map-info' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'left: 50px; right: auto;',
                    'center' => 'left: 50%; transform: translate(-50%, 0);',
                    'right' => 'left: auto; right: 50px;',
                ],
                'default' => 'left',
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		global $th_map_id;
		$map_id = 'th-map-' .  ++$th_map_id;

		if ( 0 === absint( $settings['zoom']['size'] ) ) $settings['zoom']['size'] = 12;
		if ( '' === $settings['api'] ) $settings['api'] = 'AIzaSyDb-ldlvqnIEXdh6maZVaonnw05xVAttQw';
		if ( '' === $settings['latitude'] ) $settings['latitude'] = 49.293753;
		if ( '' === $settings['longitude'] ) $settings['longitude'] = -123.053398;

		// styles

        switch ($settings['style']) {
            case 'ultra_light':
                $th_map_style =  '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}],';
            break;
            case 'subtle_grayscale':
                $th_map_style = '[{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}],';
            break;
            case 'shades_of_gray':
                $th_map_style = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}],';
            break;
            case 'light_dream':
                $th_map_style = '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}],';
            break;
            case 'retro':
                $th_map_style = '[{"elementType":"geometry","stylers":[{"color":"#ebe3cd"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#523735"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f1e6"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"color":"#dcd2be"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ae9e90"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#93817c"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#a5b076"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#447530"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#f5f1e6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#f8c967"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#e9bc62"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#e98d58"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#db8555"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#806b63"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"transit.line","elementType":"labels.text.fill","stylers":[{"color":"#8f7d77"}]},{"featureType":"transit.line","elementType":"labels.text.stroke","stylers":[{"color":"#ebe3cd"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#b9d3c2"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#92998d"}]}],';
            break;
            case 'blue_essence':
                $th_map_style = '[{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}],';
            break;
            case 'apple_esque':
                $th_map_style = '[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}],';
            break;
            default:
                $th_map_style = false;
        }
		?>

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

		<div class="th-map" id="<?php echo $map_id ?>" data-map-api="<?php echo $settings['api'] ?>" data-map-latitude="<?php echo esc_attr( $settings['latitude'] ) ?>" data-map-longitude="<?php echo esc_attr( $settings['longitude'] ) ?>" data-map-zoom="<?php echo esc_attr( $settings['zoom']['size'] ) ?>" data-map-scroll="<?php echo ( $settings['prevent_scroll'] == 'yes' ? "false" : "true" ); ?>" data-map-style="<?php if( isset( $th_map_style ) ) echo $th_map_style; ?>"></div>

		<?php wp_enqueue_script( 'themo-google-map' ); ?>

		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_GoogleMaps() );
