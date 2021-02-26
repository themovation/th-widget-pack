<?php 
namespace ThWidgetPack\Modules\Dynamic_Content;

defined( 'ABSPATH' ) || exit;

class Init{

    public static function get_url(){
        return plugins_url('/', __FILE__);
    }
    public static function get_dir(){
        return dirname(__FILE__) . '/';
    }

    public function __construct() {

        // Includes necessary files
        $this->include_files();
    }

    private function include_files(){
        // Controls_Manager
        include_once self::get_dir() . 'cpt.php';
        include_once self::get_dir() . 'cpt-api.php';
    }
}