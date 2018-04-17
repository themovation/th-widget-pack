<?php
namespace Elementor;

use Elementor\Themo_Widget_Slider as Slider;
use Elementor\Themo_Widget_Header as Header;
use Elementor\Themo_Widget_Button as Button;
use Elementor\Themo_Widget_CallToAction as CtoA;
use Elementor\Themo_Widget_Testimonial as Testimonial;
use Elementor\Themo_Widget_ServiceBlock as Service;
use Elementor\Themo_Widget_Formidable as Form;
use Elementor\Themo_Widget_Info_Card as InfoCard;
use Elementor\Themo_Widget_Team as Team;
use Elementor\Themo_Widget_Appointments as Appointment;
use Elementor\Themo_Widget_WP_Booking_System as Booking;
use Elementor\Themo_Widget_Feature_bar as FeatureBar;
use Elementor\Themo_Widget_RoomInfo as RoomInfo;
use Elementor\Themo_Widget_TourInfo as TourInfo;
use Elementor\Themo_Widget_Expand_list as ExpandList;
use Elementor\Themo_Widget_Itinerary as Itinerary;
use Elementor\Themo_Widget_GoogleMaps as Map;
use Elementor\Themo_Widget_Package as Package;
use Elementor\Themo_Widget_Pricing as Pricing;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Elementor_Translate {

	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action( 'init', [ $this, 'add_wpml_support' ] );
	}

	private function widgets_with_items() {
        require THEMO_PATH . '/languages/wpml-slider.php';
		require THEMO_PATH . '/languages/wpml-pricing.php';
		
		switch (THEMO_CURRENT_THEME) {
			case 'embark':
                require THEMO_PATH . '/languages/wpml-itinerary.php';
                require THEMO_PATH . '/languages/wpml-tour-info.php';
				break;

			case 'bellevue':
                require THEMO_PATH . '/languages/wpml-itinerary.php';
                require THEMO_PATH . '/languages/wpml-room-info.php';
				break;

			case 'stratus':
                require THEMO_PATH . '/languages/wpml-expand-list.php';
                require THEMO_PATH . '/languages/wpml-info-bar.php';
				break;

			case 'pursuit':
                require THEMO_PATH . '/languages/wpml-expand-list.php';
                require THEMO_PATH . '/languages/wpml-info-bar.php';
				break;

            case 'blockchain':
                require THEMO_PATH . '/languages/wpml-expand-list.php';
                require THEMO_PATH . '/languages/wpml-info-bar.php';
                break;

			case 'entrepreneur':
                require THEMO_PATH . '/languages/wpml-expand-list.php';
                require THEMO_PATH . '/languages/wpml-info-bar.php';
				break;
			
			default:
				# code...
				break;
		}
	}

	private function includes() {
        require_once THEMO_PATH . '/elements/slider.php';
        require_once THEMO_PATH . '/elements/header.php';
        require_once THEMO_PATH . '/elements/button.php';
        require_once THEMO_PATH . '/elements/call-to-action.php';
        require_once THEMO_PATH . '/elements/testimonial.php';
        require_once THEMO_PATH . '/elements/service-block.php';
        require_once THEMO_PATH . '/elements/formidable-form.php';
        require_once THEMO_PATH . '/elements/info-card.php';
        require_once THEMO_PATH . '/elements/team.php';
        require_once THEMO_PATH . '/elements/package.php';
        require_once THEMO_PATH . '/elements/pricing.php';
		require_once THEMO_PATH . '/elements/google-maps.php';
		
		switch (THEMO_CURRENT_THEME) {
			case 'embark':
				require_once THEMO_PATH . '/elements/itinerary.php';
				require_once THEMO_PATH . '/elements/tour-info.php';
				require_once THEMO_PATH . '/elements/appointments.php';
				break;

			case 'bellevue':
				require_once THEMO_PATH . '/elements/itinerary.php';
				require_once THEMO_PATH . '/elements/room-info.php';
				require_once THEMO_PATH . '/elements/wp-booking-system.php';
				break;

			case 'stratus':
				require_once THEMO_PATH . '/elements/expand-list.php';
				require_once THEMO_PATH . '/elements/info-bar.php';
				require_once THEMO_PATH . '/elements/appointments.php';
				break;

			case 'pursuit':
				require_once THEMO_PATH . '/elements/expand-list.php';
				require_once THEMO_PATH . '/elements/info-bar.php';
				require_once THEMO_PATH . '/elements/appointments.php';
				break;

            case 'blockchain':
                require_once THEMO_PATH . '/elements/expand-list.php';
                require_once THEMO_PATH . '/elements/info-bar.php';
                require_once THEMO_PATH . '/elements/appointments.php';
                break;

			case 'entrepreneur':
				require_once THEMO_PATH . '/elements/expand-list.php';
				require_once THEMO_PATH . '/elements/info-bar.php';
				require_once THEMO_PATH . '/elements/appointments.php';
				break;
			
			default:
				# code...
				break;
		}

	}

	public function add_wpml_support() {
		$this->includes();
		$this->widgets_with_items();
        $header = new Header();
        $header->add_wpml_support();
		$button = new Button();
		$button->add_wpml_support();
		$ctoa = new CtoA();
		$ctoa->add_wpml_support();
		$form = new Form();
		$form->add_wpml_support();
		$map = new Map();
		$map->add_wpml_support();
		$header = new Header();
		$infocard = new InfoCard();
		$infocard->add_wpml_support();
		$package = new Package();
		$package->add_wpml_support();
		$pricing = new Pricing();
		$pricing->add_wpml_support();
		$service = new Service();
		$service->add_wpml_support();
		$slider = new Slider();
		$slider->add_wpml_support();
		$team = new Team();
		$team->add_wpml_support();
		$testimonial = new Testimonial();
		$testimonial->add_wpml_support();

		switch (THEMO_CURRENT_THEME) {
			case 'embark':				
				$itinerary = new Itinerary();
				$itinerary->add_wpml_support();
				$tourinfo = new TourInfo();
				$tourinfo->add_wpml_support();
				$appointments = new Appointment();
				$appointments->add_wpml_support();
				break;

			case 'bellevue':				
				$itinerary = new Itinerary();
				$itinerary->add_wpml_support();
				$roominfo = new RoomInfo();
				$roominfo->add_wpml_support();
				$booking = new Booking();
				$booking->add_wpml_support();
				break;

			case 'stratus':
				$expandlist = new ExpandList();
				$expandlist->add_wpml_support();
				$header->add_wpml_support();
				$featbar = new FeatureBar();
				$featbar->add_wpml_support();
				$appointments = new Appointment();
				$appointments->add_wpml_support();
				break;

			case 'pursuit':
				$expandlist = new ExpandList();
				$expandlist->add_wpml_support();
				$header->add_wpml_support();
                $featbar = new FeatureBar();
                $featbar->add_wpml_support();
				$appointments = new Appointment();
				$appointments->add_wpml_support();
				break;

            case 'blockchain':
                $expandlist = new ExpandList();
                $expandlist->add_wpml_support();
                $header->add_wpml_support();
                $featbar = new FeatureBar();
                $featbar->add_wpml_support();
                $appointments = new Appointment();
                $appointments->add_wpml_support();
                break;

			case 'entrepreneur':
				$expandlist = new ExpandList();
				$expandlist->add_wpml_support();
				$header->add_wpml_support();
                $featbar = new FeatureBar();
                $featbar->add_wpml_support();
				$appointments = new Appointment();
				$appointments->add_wpml_support();
				break;
			
			default:
				# code...
				break;
		}
	}
}

new Themo_Elementor_Translate();
