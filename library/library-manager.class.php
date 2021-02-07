<?php
namespace ThWidgetPack\Elementor;

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Block_Library_Manager {

	protected static $source = null;

	public static function init() {
		add_action( 'elementor/editor/footer', [ __CLASS__, 'print_template_views' ] );
		add_action( 'elementor/ajax/register_actions', [ __CLASS__, 'register_ajax_actions' ] );
		add_action( 'elementor/preview/enqueue_styles', [ __CLASS__, 'enqueue_preview_styles' ] );
	}

	public static function print_template_views() {
		include_once THEMO_PATH . 'library/templates.php';
	}

	public static function enqueue_preview_styles() {
		wp_enqueue_style( 'thmv-template-preview-style', THEMO_URL . 'css/th-preview.css', THEMO_VERSION );
	}

	/**
	 * Undocumented function
	 *
	 * @return Block_Library_Source
	 */
	public static function get_source() {
		if ( is_null( self::$source ) ) {
			self::$source = new Block_Library_Source();
		}

		return self::$source;
	}

	public static function register_ajax_actions( Ajax $ajax ) {
		$ajax->register_ajax_action( 'thmv_get_template_library_data', function( $data ) {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}

			if ( ! empty( $data['editor_post_id'] ) ) {
				$editor_post_id = absint( $data['editor_post_id'] );

				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found.', 'th-widget-pack' ) );
				}

				\Elementor\Plugin::instance()->db->switch_to_post( $editor_post_id );
			}

			$result = self::get_library_data( $data );

			return $result;
		} );

		$ajax->register_ajax_action( 'thmv_get_template_item_data', function( $data ) {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}

			if ( ! empty( $data['editor_post_id'] ) ) {
				$editor_post_id = absint( $data['editor_post_id'] );

				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found', 'th-widget-pack' ) );
				}

				\Elementor\Plugin::instance()->db->switch_to_post( $editor_post_id );
			}

			if ( empty( $data['template_id'] ) ) {
				throw new \Exception( __( 'Template id missing', 'th-widget-pack' ) );
			}

			$result = self::get_template_data( $data );

			return $result;
		} );
	}

	public static function get_template_data( array $args ) {
		$source = self::get_source();
		$data = $source->get_data( $args );
		return $data;
	}

	public static function get_library_data( array $args ) {
		$source = self::get_source();

		if ( ! empty( $args['sync'] ) ) {
			Block_Library_Source::get_library_data( true );
		}

		return [
			'templates' => $source->get_items(),
			'category' => $source->get_categories(),
			'type_category' => $source->get_type_category(),
		];
	}
}

Block_Library_Manager::init();
