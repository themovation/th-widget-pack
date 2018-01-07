<?php
namespace Elementor;

use Elementor\Themo_Widget_Formidable as Form;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Elementor_Translate {

	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action( 'init', [ $this, 'add_wpml_support' ] );
	}

	private function includes() {
		require_once THEMO_PATH . '/elements/formidable-form.php';
	}

	public function add_wpml_support() {
		$this->includes();
		$widget = new Form();
		$widget->add_wpml_support();
	}
}

new Themo_Elementor_Translate();
