<?php
namespace ThWidgetPack\Modules\Megamenu;

use ThWidgetPack;

defined( 'ABSPATH' ) || exit;

class Init{

	public $dir;
	
	public $url;
		
	public static $menuitem_settings_key = 'elementskit_menuitem_settings';
	public static $megamenu_settings_key = 'megamenu_settings';
	
    public function __construct(){

        // get current directory path
        $this->dir = dirname(__FILE__) . '/';

        // get current module's url
		$this->url = plugins_url('/', __FILE__);
		
		// enqueue scripts
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_styles'] );
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

		// include all necessary files
		$this->include_files();

		new Options();
	}
	
	public function include_files(){
		//include $this->dir . 'rest-api.php';
		include $this->dir . 'api.php';
		include $this->dir . 'cpt-api.php';
		include $this->dir . 'options.php';
		include $this->dir . 'walker-nav-menu.php';

		// $backward_class_file = ElementsKit_Lite::plugin_dir() . 'compatibility/backward/walker-nav-menu-backward-compatiblity.php';
		// if(file_exists($backward_class_file)){
		// 	include $backward_class_file;
		// }
	}

	public function enqueue_styles() {
		$screen = get_current_screen();
		if($screen->base == 'nav-menus'){
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'fonticonpicker', $this->url . 'assets/css/jquery.fonticonpicker.css', false, THEMO_VERSION );
			wp_enqueue_style( 'elementskit-menu-admin-style', $this->url . 'assets/css/admin-style.css', false, THEMO_VERSION );
		}
	}

	public function enqueue_scripts(){
		$screen = get_current_screen();
		if($screen->base == 'nav-menus'){
			wp_enqueue_script( 'fonticonpicker', $this->url . 'assets/js/jquery.fonticonpicker.min.js', array( 'jquery'), THEMO_VERSION, true );
			wp_enqueue_script( 'elementskit-menu-admin-modal-script', $this->url . 'assets/js/admin-modal.js', array( 'jquery' ), THEMO_VERSION, true );
			wp_enqueue_script( 'elementskit-menu-admin-script', $this->url . 'assets/js/admin-script.js', array( 'jquery', 'wp-color-picker', 'elementskit-menu-admin-modal-script' ), THEMO_VERSION, true );
		}
	}
}