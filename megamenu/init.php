<?php
namespace ThWidgetPack\Modules\Megamenu;

use ThWidgetPack;

defined( 'ABSPATH' ) || exit;

class Init{

	public $dir;
	
	public $url;
	
    public function __construct(){

        // get current directory path
        $this->dir = dirname(__FILE__) . '/';

        // get current module's url
		$this->url = plugins_url('/', __FILE__);
		
		// enqueue scripts
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_frontend_styles'] );
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_styles'] );
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

		// include all necessary files
		$this->include_files();

		new Options();
	}
	
	
	public function include_files(){
		include $this->dir . 'api.php';
		include $this->dir . 'options.php';
		include $this->dir . 'walker-nav-menu.php';
	}

	// scripts for common end, admin & frontend
    public function common_js(){
		ob_start(); ?>

		var thwidgetpack = {
            resturl: '<?php echo get_rest_url() . 'thwidgetpack/v1/'; ?>',
        }

		<?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

	public function enqueue_frontend_styles() {
		wp_enqueue_style( 'main-menu', $this->url . 'assets/css/main-menu.css', false, THEMO_VERSION );
		wp_enqueue_script( 'widget-script', $this->url . 'assets/js/widget-script.js', array( 'jquery'), THEMO_VERSION, true );
	}

	public function enqueue_styles() {
		$screen = get_current_screen();
		if($screen->base == 'nav-menus'){
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'fonticonpicker', $this->url . 'assets/css/jquery.fonticonpicker.css', false, THEMO_VERSION );
			wp_enqueue_style( 'thwidgetpack-menu-admin-style', $this->url . 'assets/css/admin-style.css', false, THEMO_VERSION );
		}
	}

	public function enqueue_scripts(){
		$screen = get_current_screen();
		if($screen->base == 'nav-menus'){
			wp_enqueue_script( 'fonticonpicker', $this->url . 'assets/js/jquery.fonticonpicker.min.js', array( 'jquery'), THEMO_VERSION, true );
			wp_enqueue_script( 'thwidgetpack-menu-admin-modal-script', $this->url . 'assets/js/admin-modal.js', array( 'jquery' ), THEMO_VERSION, true );
			wp_enqueue_script( 'thwidgetpack-menu-admin-script', $this->url . 'assets/js/admin-script.js', array( 'jquery', 'wp-color-picker', 'thwidgetpack-menu-admin-modal-script' ), THEMO_VERSION, true );
			// wp_localize_script( 'thwidgetpack-menu-admin-script', 'frontend_ajax_object',
			// 	array( 
			// 		'resturl' => get_rest_url() . 'thwidgetpack/v1/',
			// 	)
			// );

			$js = $this->common_js();
        	wp_add_inline_script('thwidgetpack-menu-admin-script', $js);
		}
	}
}