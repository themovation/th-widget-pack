<?php
/*
Widget Name: Themovation Button
Description: A button with different styles including graphic and add to cart.
Author: Themovation
Author URI: themovation.com
*/

class Themovation_SO_WB_Button_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'th-button',

			__('Themovation Button', 'themovation-widgets'),

			array(
				'description' => __('A button with different styles including graphic and add to cart.', 'themovation-widgets'),
				'help'        => '',
			),

			array(
			),

			array(
				'button' => array(
					'type' => 'section',
					'label' => __('Button' , 'themovation-widgets'),
					'hide' => true,
					'fields' => array(

						'button_type'    => array(
							'type'    => 'select',
							'default' => 'button',
							'label'   => __('Button Type', 'themovation-widgets'),
							'options' => array(
								'button' => __('Button', 'themovation-widgets'),
								'add-to-cart' => __('Add to Cart', 'themovation-widgets'),
								'graphic' => __('Graphic Button', 'themovation-widgets'),
							),
						),

						'button_text' => array(
							'type' => 'text',
							'label' => __('Button Text', 'themovation-widgets'),
							'placeholder' => __('Click here', 'themovation-widgets'),
						),

						'button_style'    => array(
							'type'    => 'radio',
							'default' => 'standard',
							'label'   => __('Button Style', 'themovation-widgets'),
							'options' => array(
								'standard' => __('Standard', 'themovation-widgets'),
								'ghost' => __('Ghost', 'themovation-widgets'),
								'cta' => __('Call to Action', 'themovation-widgets'),
							),
						),

						'button_icon' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Icon_Widget',
							'label' => __('Button Icon', 'themovation-widgets'),
							'hide' => false
						),

						'button_link' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Link_Widget',
							'label' => __('Button Link', 'themovation-widgets'),
							'hide' => false
						),

						'product_button'    => array(
							'type'    => 'select',
							'default' => 'standard',
							'label'   => __('Product Button', 'themovation-widgets'),
							'options' => array(),
						),

						'product_sku' => array(
							'type' => 'text',
							'label' => __('Product Sku', 'themovation-widgets'),
							'placeholder' => __('sku-123', 'themovation-widgets'),
						),

						'button_graphic' => array(
							'type' => 'media',
							'library' => 'image',
							'label' => __('Button Graphic', 'themovation-widgets'),
						),

						'graphic_link' => array(
							'type' => 'widget',
							'class' => 'Themovation_SO_WB_Link_Widget',
							'label' => __('Link', 'themovation-widgets'),
							'hide' => false
						),

					)
				)
			),

			plugin_dir_path(__FILE__)
		);
	}

	// Creating an array of WooCommerce products
	function get_woocommerce_product_list() {
		$products = array();
		$loop = new WP_Query( array(
			'post_type' => array('product'),
			'posts_per_page' => -1
		) );

		while ( $loop->have_posts() ) : $loop->the_post();
			$id = get_the_ID();
			$title = get_the_title();
			$products[$id] = $title;
		endwhile; wp_reset_query();
		return $products;
	}

	function modify_form( $form ) {
		$form['button']['fields']['product_button']['options'] = $this->get_woocommerce_product_list();
		return $form;
	}

	function get_template_name($instance) {
		return 'button';
	}

	function get_style_name($instance) {
		return '';
	}

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_style( 'themo-button', siteorigin_widget_get_plugin_dir_url('th-button') . 'styles/button.css', array(), INKED_SO_WIDGETS );

		parent::enqueue_frontend_scripts( $instance );
	}
}
siteorigin_widget_register('th-button', __FILE__, 'Themovation_SO_WB_Button_Widget');
