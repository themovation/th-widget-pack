<?php
namespace ThWidgetPack\Elementor;

use Elementor\TemplateLibrary\Source_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Block_Library_Source extends Source_Base {

	public function get_id() {
		return 'thmv-block-library';
	}

	public function get_title() {
		return __( 'Block Library', 'th-widget-pack' );
	}

	public function register_data() {}

	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to Block Library' );
	}

	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to Block Library' );
	}

	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from Block Library' );
	}

	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from Block Library' );
	}

	public function get_items( $args = [] ) {
		$library_data = self::get_library_data();

		$templates = [];

		if ( ! empty( $library_data['templates'] ) ) {
			foreach ( $library_data['templates'] as $template_data ) {
				$templates[] = $this->prepare_template( $template_data );
			}
		}

		return $templates;
	}

	public function get_categories() {
		$library_data = self::get_library_data();

		return ( ! empty( $library_data['categories'] ) ? $library_data['categories'] : [] );
	}

	public function get_type_category() {
		$library_data = self::get_library_data();

		return ( ! empty( $library_data['type_category'] ) ? $library_data['type_category'] : [] );
	}

	/**
	 * Prepare template items to match model
	 *
	 * @param array $template_data
	 * @return array
	 */
	private function prepare_template( array $template_data ) {
		return [
			'template_id' => $template_data['id'],
			'title'       => $template_data['title'],
			'type'        => $template_data['type'],
			'thumbnail'   => $template_data['thumbnail'],
			'category'    => $template_data['category'],
			'url'         => $template_data['url'],
		];
	}

	/**
	 * 
	 * Get API URL by Theme Name
	 * 
	 * @return string
	 */
	public static function api_url_by_theme_name() {

		if ( get_template_directory() !== get_stylesheet_directory() ) {
			$theme_name = wp_get_theme()->parent()->get( 'Name' );
		} else {
			$theme_name = wp_get_theme()->get( 'Name' );
		}

		if ( 'Stratus' == $theme_name ) {
			$theme_url = 'stratus'; 
		} elseif ( 'Embark' == $theme_name ) {
			$theme_url = 'embark';
		} elseif ( 'Bellevue' == $theme_name ) {
			$theme_url = 'bellevue';
		} elseif ( 'Unplands' == $theme_name ) {
			$theme_url = 'unplands';
		} elseif ( 'Entrepreneur' == $theme_name ) {
			$theme_url = 'entrepreneur';
		} elseif ( 'Pursuit' == $theme_name ) {
			$theme_url = 'pursuit';
		} else {
			$theme_url = '';
		}

		return $theme_url;
	}

	/**
	 * Get library data from remote source and cache
	 *
	 * @param boolean $force_update
	 * @return array
	 */
	private static function request_library_data( $force_update = false ) {

		$library_cache_id = 'thmv_'.self::api_url_by_theme_name().'_cache_id';
                $multisite_path = self::get_current_multisite_path();//we store the dropdown value earlier when initiating the call
		$data = get_option( $library_cache_id );
                $url = self::get_library_url().'/wp-json/thmv/v1/library-config';
                if($multisite_path){
                    //when multisite is changed, it also has $force_update = true
                    $url.='?multisite_path='.$multisite_path;
                }
		if ( $force_update || false === $data ) {
			$timeout = ( $force_update ) ? 25 : 8;
			$response = wp_remote_get( $url , [
				'timeout' => $timeout,
			] );

			if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
                            update_option( $library_cache_id, [] );
				return false;
			}

			$data = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $data ) || ! is_array( $data ) ) {
				update_option( $library_cache_id, [] );
				return false;
			}

			update_option( $library_cache_id, $data, 'no' );
		}

		return $data;
	}

	/**
	 * Get library data
	 *
	 * @param boolean $force_update
	 * @return array
	 */
	public static function get_library_data( $force_update = false ) {

		$library_cache_id = 'thmv_'.self::api_url_by_theme_name().'_cache_id';

		self::request_library_data( $force_update );

		$data = get_option( $library_cache_id );

		if ( empty( $data ) ) {
			return [];
		}

		return $data;
	}
        
        
        public function set_current_multisite_path($path){
            update_option( 'thmv_library_last_site_path', $path);
        }
        /** Get currently stored lastly selected multisite path
         * 
         * @return boolean
         */
         public function get_current_multisite_path(){
            $multisite_list = self::get_multisite_list();
            if(is_array($multisite_list)){
                //we must have the last site path then
                $site_path = get_option( 'thmv_library_last_site_path');
                if(!$site_path){
                    //send the first one as the path
                    $current = $multisite_list[0]['path'];
                    update_option( 'thmv_library_last_site_path', $current);
                    return $current;
                }
                else {
                    //check it's in the current list
                    foreach($multisite_list as $site){
                        if($site['path']===$site_path){
                           return $site_path;
                        }
                    }
                }
               return false;
            }
            
        }
	/**
	 * Get remote template.
	 *
	 * Retrieve a single remote template from Elementor.com servers.
	 *
	 * @param int $template_id The template ID.
	 *
	 * @return array Remote template.
	 */
	public function get_item( $template_id ) {
		
		$templates = $this->get_items();

		return $templates[ $template_id ];
	}

	public static function request_template_data( $template_id ) {
		if ( empty( $template_id ) ) {
			return;
		}

		$body = [
			'home_url' => trailingslashit( home_url() ),
			'version' => THEMO_VERSION,
		];

                $multisite_path = self::get_current_multisite_path();//we store the dropdown value earlier when initiating the call
                $url = self::get_library_url().'/wp-json/thmv/v1/library/' . $template_id;
                if($multisite_path){
                    //when multisite is changed, it also has $force_update = true
                    $url.='?multisite_path='.$multisite_path;
                }
		$response = wp_remote_get(
			$url,
			[
				'body' => $body,
				'timeout' => 25
			]
		);

		return wp_remote_retrieve_body( $response );
	}

	/**
	 * Get remote template data.
	 *
	 * Retrieve the data of a single remote template
	 *
	 * @return array|\WP_Error Remote Template data.
	 */
	public function get_data( array $args, $context = 'display' ) {
		$data = self::request_template_data( $args['template_id'] );
                
		$data = json_decode( $data, true );

		if ( empty( $data ) || empty( $data['content'] ) ) {
			throw new \Exception( __( 'Template does not have any content', 'th-widget-pack' ) );
		}

		$data['content'] = $this->replace_elements_ids( $data['content'] );
		$data['content'] = $this->process_export_import_content( $data['content'], 'on_import' );

		$post_id = $args['editor_post_id'];
		$document = \Elementor\Plugin::instance()->documents->get( $post_id );

		if ( $document ) {
			$data['content'] = $document->get_elements_raw_data( $data['content'], true );
		}

		return $data;
	}
        
        public function get_library_url(){
           return 'https://library.themovation.com/'.self::api_url_by_theme_name();
        }
        /**
         * Reset stored data if library url changes
         * @return boolean
         */
        public function has_host_changed(){
            $library_url = self::get_library_url();
            $parse = parse_url($library_url);
            $host = $parse['host'];
            $existing_host = get_option( 'library_host', false);
            update_option( 'library_host', $host );//update to new host
            if($existing_host===$host){
                return false;
            }
            
            $library_cache_id = 'thmv_'.self::api_url_by_theme_name().'_cache_id';
            delete_option($library_cache_id);
            
            return true;
        }
        /**
	 * Get remote multisite list
	 *
	 * @return array|\WP_Error Remote Multisite list.
	 */
	public function get_multisite_list() {
           
		$existing_list = get_option( 'library_multisite_list', false);
                
                if(is_array($existing_list) && !self::has_host_changed()){
                    return $existing_list;
                }

                $body = [
			'home_url' => trailingslashit( home_url() ),
			'version' => THEMO_VERSION,
		];

		$response = wp_remote_get(
			self::get_library_url().'/wp-json/thmv/v1/library-multisite-list',
			[
				'body' => $body,
				'timeout' => 25
			]
		);

		$body = wp_remote_retrieve_body( $response );
                $data = json_decode( $body, true );

                //code means there's some error
                if ( isset($data['code']) || empty( $data ) || ! is_array( $data )  ) {
                        $data = false;
                }
                update_option( 'library_multisite_list', $data );
                
                return $data;
	}
        
}
