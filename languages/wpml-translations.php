<?php
namespace Elementor;

use Elementor\Themo_Widget_Appointments as Appointment;
use Elementor\Themo_Widget_Button as Button;
use Elementor\Themo_Widget_CallToAction as CtoA;
use Elementor\Themo_Widget_Formidable as Form;
use Elementor\Themo_Widget_GoogleMaps as Map;
use Elementor\Themo_Widget_Header as Header;
use Elementor\Themo_Widget_Feature_bar as FeatureBar;
use Elementor\Themo_Widget_Info_Card as InfoCard;
use Elementor\Themo_Widget_Itinerary as Itinerary;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Elementor_Translate {

	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action( 'init', [ $this, 'add_wpml_support' ] );
	}

	private function widgets_with_items() {
		//require THEMO_PATH . '/languages/wpml-itinerary.php';
	}

	private function includes() {
		require_once THEMO_PATH . '/elements/appointments.php';
		require_once THEMO_PATH . '/elements/button.php';
		require_once THEMO_PATH . '/elements/call-to-action.php';
		require_once THEMO_PATH . '/elements/formidable-form.php';
		require_once THEMO_PATH . '/elements/google-maps.php';
		require_once THEMO_PATH . '/elements/header.php';
		require_once THEMO_PATH . '/elements/info-bar.php';
		require_once THEMO_PATH . '/elements/info-card.php';
		//require_once THEMO_PATH . '/elements/itinerary.php';
	}

	public function add_wpml_support() {
		$this->includes();
		$this->widgets_with_items();
		$appointments = new Appointment();
		$appointments->add_wpml_support();
		$button = new Button();
		$button->add_wpml_support();
		$ctoa = new CtoA();
		$ctoa->add_wpml_support();
		$form = new Form();
		$form->add_wpml_support();
		$map = new Map();
		$map->add_wpml_support();
		$header = new Header();
		$header->add_wpml_support();
		$featbar = new FeatureBar();
		$featbar->add_wpml_support();
		$infocard = new InfoCard();
		$infocard->add_wpml_support();
		// $itinerary = new Itinerary();
		// $itinerary->add_wpml_support();
	}
}

new Themo_Elementor_Translate();
