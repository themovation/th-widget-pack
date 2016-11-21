<?php

abstract class Themovation_Widget_Base extends SiteOrigin_Widget {

	function initialize() {}

	function icon_form_fields( $style = true ) {
		$icon = array(
			'icon' => array(
				'type' => 'icon',
				'label' => __('Icon', 'themovation-widgets'),
			),

			'style'    => array(
				'type'    => 'select',
				'default' => 'standard',
				'label'   => __('Icon Style', 'themovation-widgets'),
				'options' => array(
					'standard' => __('Standard', 'themovation-widgets'),
					'circle' => __('Circle', 'themovation-widgets'),
					'border' => __('Bordered', 'themovation-widgets'),
				),
			),

			'image' => array(
				'type' => 'media',
				'fallback' => false,
				'label' => __('Select a graphic icon', 'themovation-widgets'),
				'default'     => '',
				'library' => 'image',
				'description' => __('Replaces the icon with your own graphic icon', 'themovation-widgets'),
			),
		);

		if ( $style == false ) {
			unset( $icon['style'] );
			return $icon;
		} else {
			return $icon;
		}
	}

	function link_form_fields() {
		return array(
			'url' => array(
				'type' => 'link',
				'label' => __('Link URL', 'themovation-widgets'),
			),

			'new_window' => array(
				'type' => 'checkbox',
				'default' => false,
				'label' => __('Open in a new window', 'themovation-widgets'),
			),

			'lightbox'    => array(
				'type'    => 'select',
				'default' => 'off',
				'label'   => __('Open in lightbox', 'themovation-widgets'),
				'state_emitter' => array(
					'callback' => 'select',
					'args' => array( 'lightbox' )
				),
				'options' => array(
					'off' => __('Off', 'themovation-widgets'),
					'on' => __('On', 'themovation-widgets'),
				),
			),

			'lightbox_width' => array(
				'type' => 'number',
				'label' => __('Lightbox width (px)', 'themovation-widgets'),
				'state_handler' => array(
					'lightbox[on]' => array('show'),
					'lightbox[off]' => array('hide'),
				),
			),
		);
	}

	function button_1_form_fields() {
		return array(
			'button_type'    => array(
				'type'    => 'select',
				'default' => 'button',
				'label'   => __('Button Type', 'themovation-widgets'),
				'options' => array(
					'button' => __('Button', 'themovation-widgets'),
					'add-to-cart' => __('Add to Cart', 'themovation-widgets'),
					'graphic' => __('Graphic Button', 'themovation-widgets'),
				),
				'state_emitter' => array(
					'callback' => 'select',
					'args' => array( 'button_type_1' )
				),
			),

			'button_text' => array(
				'type' => 'text',
				'label' => __('Button Text', 'themovation-widgets'),
				'placeholder' => __('Click here', 'themovation-widgets'),
				'state_handler' => array(
					'button_type_1[button]' => array('show'),
					'button_type_1[add-to-cart]' => array('hide'),
					'button_type_1[graphic]' => array('hide'),
				),
			),

			'button_style'    => array(
				'type'    => 'select',
				'default' => 'standard',
				'label'   => __('Button Style', 'themovation-widgets'),
				'options' => array(
					'standard' => __('Standard', 'themovation-widgets'),
					'ghost' => __('Ghost', 'themovation-widgets'),
					'cta' => __('Call to Action', 'themovation-widgets'),
				),
				'state_handler' => array(
					'button_type_1[button]' => array('show'),
					'button_type_1[add-to-cart]' => array('hide'),
					'button_type_1[graphic]' => array('hide'),
				),
			),

			'button_icon' => array(
				'type' => 'section',
				'label' => __('Button Icon' , 'themovation-widgets'),
				'hide' => true,
				'fields' => $this->icon_form_fields(),
				'state_handler' => array(
					'button_type_1[button]' => array('show'),
					'button_type_1[add-to-cart]' => array('hide'),
					'button_type_1[graphic]' => array('hide'),
				),
			),

			'button_link' => array(
				'type' => 'section',
				'label' => __('Button Link' , 'themovation-widgets'),
				'hide' => true,
				'fields' => $this->link_form_fields(),
				'state_handler' => array(
					'button_type_1[button]' => array('show'),
					'button_type_1[add-to-cart]' => array('hide'),
					'button_type_1[graphic]' => array('hide'),
				),
			),

			'product_button'    => array(
				'type'    => 'select',
				'default' => 'standard',
				'label'   => __('Product Button', 'themovation-widgets'),
				'options' => $this->get_woocommerce_product_list(),
				'state_handler' => array(
					'button_type_1[button]' => array('hide'),
					'button_type_1[add-to-cart]' => array('show'),
					'button_type_1[graphic]' => array('hide'),
				),
			),

			'product_sku' => array(
				'type' => 'text',
				'label' => __('Product Sku', 'themovation-widgets'),
				'placeholder' => __('sku-123', 'themovation-widgets'),
				'state_handler' => array(
					'button_type_1[button]' => array('hide'),
					'button_type_1[add-to-cart]' => array('show'),
					'button_type_1[graphic]' => array('hide'),
				),
			),

			'button_graphic' => array(
				'type' => 'media',
				'library' => 'image',
				'label' => __('Button Graphic', 'themovation-widgets'),
				'state_handler' => array(
					'button_type_1[button]' => array('hide'),
					'button_type_1[add-to-cart]' => array('hide'),
					'button_type_1[graphic]' => array('show'),
				),
			),

			'graphic_link' => array(
				'type' => 'section',
				'label' => __('Link' , 'themovation-widgets'),
				'hide' => true,
				'fields' => $this->link_form_fields(),
				'state_handler' => array(
					'button_type_1[button]' => array('hide'),
					'button_type_1[add-to-cart]' => array('hide'),
					'button_type_1[graphic]' => array('show'),
				),
			),
		);
	}

	function button_2_form_fields() {
		return array(
			'button_type'    => array(
				'type'    => 'select',
				'default' => 'button',
				'label'   => __('Button Type', 'themovation-widgets'),
				'options' => array(
					'button' => __('Button', 'themovation-widgets'),
					'add-to-cart' => __('Add to Cart', 'themovation-widgets'),
					'graphic' => __('Graphic Button', 'themovation-widgets'),
				),
				'state_emitter' => array(
					'callback' => 'select',
					'args' => array( 'button_type_2' )
				),
			),

			'button_text' => array(
				'type' => 'text',
				'label' => __('Button Text', 'themovation-widgets'),
				'placeholder' => __('Click here', 'themovation-widgets'),
				'state_handler' => array(
					'button_type_2[button]' => array('show'),
					'button_type_2[add-to-cart]' => array('hide'),
					'button_type_2[graphic]' => array('hide'),
				),
			),

			'button_style'    => array(
				'type'    => 'select',
				'default' => 'standard',
				'label'   => __('Button Style', 'themovation-widgets'),
				'options' => array(
					'standard' => __('Standard', 'themovation-widgets'),
					'ghost' => __('Ghost', 'themovation-widgets'),
					'cta' => __('Call to Action', 'themovation-widgets'),
				),
				'state_handler' => array(
					'button_type_2[button]' => array('show'),
					'button_type_2[add-to-cart]' => array('hide'),
					'button_type_2[graphic]' => array('hide'),
				),
			),

			'button_icon' => array(
				'type' => 'section',
				'label' => __('Button Icon' , 'themovation-widgets'),
				'hide' => true,
				'fields' => $this->icon_form_fields(),
				'state_handler' => array(
					'button_type_2[button]' => array('show'),
					'button_type_2[add-to-cart]' => array('hide'),
					'button_type_2[graphic]' => array('hide'),
				),
			),

			'button_link' => array(
				'type' => 'section',
				'label' => __('Button Link' , 'themovation-widgets'),
				'hide' => true,
				'fields' => $this->link_form_fields(),
				'state_handler' => array(
					'button_type_2[button]' => array('show'),
					'button_type_2[add-to-cart]' => array('hide'),
					'button_type_2[graphic]' => array('hide'),
				),
			),

			'product_button'    => array(
				'type'    => 'select',
				'default' => 'standard',
				'label'   => __('Product Button', 'themovation-widgets'),
				'options' => $this->get_woocommerce_product_list(),
				'state_handler' => array(
					'button_type_2[button]' => array('hide'),
					'button_type_2[add-to-cart]' => array('show'),
					'button_type_2[graphic]' => array('hide'),
				),
			),

			'product_sku' => array(
				'type' => 'text',
				'label' => __('Product Sku', 'themovation-widgets'),
				'placeholder' => __('sku-123', 'themovation-widgets'),
				'state_handler' => array(
					'button_type_2[button]' => array('hide'),
					'button_type_2[add-to-cart]' => array('show'),
					'button_type_2[graphic]' => array('hide'),
				),
			),

			'button_graphic' => array(
				'type' => 'media',
				'library' => 'image',
				'label' => __('Button Graphic', 'themovation-widgets'),
				'state_handler' => array(
					'button_type_2[button]' => array('hide'),
					'button_type_2[add-to-cart]' => array('hide'),
					'button_type_2[graphic]' => array('show'),
				),
			),

			'graphic_link' => array(
				'type' => 'section',
				'label' => __('Link' , 'themovation-widgets'),
				'hide' => true,
				'fields' => $this->link_form_fields(),
				'state_handler' => array(
					'button_type_2[button]' => array('hide'),
					'button_type_2[add-to-cart]' => array('hide'),
					'button_type_2[graphic]' => array('show'),
				),
			),
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

}
