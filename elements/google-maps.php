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
		$default_latitude = 51.503324;
		$default_logitude = -0.119543;
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
		global $th_map_id;
		$map_id = 'th-map-' . ++$th_map_id;

		// $map_id = 'map';

		if ( empty( $settings['address'] ) ) return;

		if ( 0 === absint( $settings['zoom']['size'] ) ) $settings['zoom']['size'] = 10;

		if ( '' === $settings['api'] ) $settings['api'] = 'AIzaSyB8l2MZuaD3n75dnMm0_OOx2QEv_lnWpmw';

		// url encode the address
		$address = urlencode( $settings['address'] );
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

		<div class="th-map" id="<?php echo esc_attr( $map_id ) ?>"></div>

		<script>
		    var map;
		    function initMap() {
		        map = new google.maps.Map(document.getElementById("<?php echo esc_attr( $map_id ) ?>"), {
		            center: {lat: <?php echo esc_attr( $settings['latitude'] ) ?>, lng: <?php echo esc_attr( $settings['longitude'] ) ?>},
		            zoom: <?php echo esc_attr( $settings['zoom']['size'] ) ?>,
		            disableDefaultUI: true,
		            <?php if( $settings['prevent_scroll'] == 'yes' ) echo 'scrollwheel:  false'; ?>
		        } );
		    }
		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $settings['api'] ) ?>&callback=initMap" async defer></script>

		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_GoogleMaps() );
