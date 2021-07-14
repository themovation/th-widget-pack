<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Blog extends Widget_Base {

	public function get_name() {
		return 'themo-blog';
	}

	public function get_title() {
		return __( 'Blog', 'th-widget-pack' );
	}

	public function get_icon() {
		return 'eicon-gallery-masonry';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	public function get_help_url() {
		return 'https://help.themovation.com/' . $this->get_name();
	}
	
	private function get_blog_categories_list() {
		$categories = array('all' => __('All Categories', 'th-widget-pack'));
		$get_categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );

		foreach( $get_categories as $category ) {
			$id = $category->term_id;
			$name = $category->name;
			$categories[$id] = $name;
		}

		return $categories;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Posts', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'post_categories',
			[
				'label'   => __( 'Categories', 'th-widget-pack' ),
				'type'    => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'default' => 'all',
				'options' => $this->get_blog_categories_list()
			]
		);

        $this->add_control(
            'post_columns',
            [
                'label' => __( 'Columns', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3-col',
                'options' => [
                    '2-col' => __( '2 Columns', 'th-widget-pack' ),
                    '3-col' => __( '3 Columns', 'th-widget-pack' ),
                    '4-col' => __( '4 Columns', 'th-widget-pack' ),
                    '5-col' => __( '5 Columns', 'th-widget-pack' ),
                ],
                'condition' => [
                    'thmv_style' => [ 'style_1','style_3']
                ],
            ]
        );

        $this->add_control(
            'post_count',
            [
                'label' => __( 'Posts', 'th-widget-pack' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'thmv_link_text',
            [
                'label' => __( 'Link text', 'th-widget-pack' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Read More', 'th-widget-pack' ),
                'placeholder' => __( 'Read More', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __( 'Pagination', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'label_off',
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
            ]
        );

        $this->add_control(
            'pagination_msg',
            [
                'type'    => Controls_Manager::RAW_HTML,
                'raw' => __( '<small>(not supported on the Frontpage)</small>', 'your-plugin' ),
                'content_classes' => 'your-class',
                'separator' => 'none'
            ]
        );

        $this->add_control(
            'thmv_section_hide_data_heading',
            [
                'label' => __( 'Hide', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'thmv_hide_image',
            [
                'label' => __( 'Image', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],

            ]
        );

        $this->add_control(
            'thmv_hide_title',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],

            ]
        );

        $this->add_control(
            'thmv_hide_excerpt',
            [
                'label' => __( 'Excerpt', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],

            ]
        );

        $this->add_control(
            'thmv_hide_author',
            [
                'label' => __( 'Author', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],

            ]
        );

        $this->add_control(
            'thmv_hide_date',
            [
                'label' => __( 'Date', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],

            ]
        );

        $this->add_control(
            'thmv_hide_category',
            [
                'label' => __( 'Category', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_comments',
            [
                'label' => __( 'Comments', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],
                'condition' => [
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );

        $this->add_control(
            'thmv_hide_read_more',
            [
                'label' => __( 'Read more', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'th-widget-pack' ),
                'label_off' => __( 'No', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .element ' => 'display:none;',
                ],

            ]
        );

		$this->end_controls_section();

        /* STYLE - Layout */
        $this->start_controls_section(
            'thmv_section_layout',
            [
                'label' => __( 'Layout', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thmv_style',
            [
                'label' => __( 'Style', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => __( 'Style 1', 'th-widget-pack' ),
                    'style_2' => __( 'Style 2', 'th-widget-pack' ),
                    'style_3' => __( 'Style 3', 'th-widget-pack' ),
                ],
            ]
        );

        /*$this->add_responsive_control(
            'thmv_wrapper_text_align',
            [
                'label' => __( 'Content Align', 'th-widget-pack' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'th-widget-pack' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .thmv-wrapper-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );*/

        $this->end_controls_section();

        /* STYLE - Image */
        $this->start_controls_section(
            'thmv_section_image_style',
            [
                'label' => __( 'Image', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'thmv_hide_image' => '',
                ],
            ]
        );

        $this->add_control(
            'post_image_size',
            [
                'label' => __( 'Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'th_img_sm_standard',
                'options' => [
                    'th_img_sm_standard' => __( 'Standard', 'th-widget-pack' ),
                    'th_img_sm_landscape' => __( 'Landscape', 'th-widget-pack' ),
                    'th_img_sm_portrait' => __( 'Portrait', 'th-widget-pack' ),
                    'th_img_sm_square' => __( 'Square', 'th-widget-pack' ),
                    'th_img_lg' => __( 'Large', 'th-widget-pack' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thmv_section_content_style',
            [
                'label' => __( 'Content', 'th-widget-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        /* STYLE - Title */
        $this->add_control(
            'thmv_section_title_heading',
            [
                'label' => __( 'Title', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_hide_title' => '',
                ],
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title a' => 'color: {{VALUE}};',
				],
                'condition' => [
                    'thmv_hide_title' => '',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'th-widget-pack' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .post-title a',
                'condition' => [
                    'thmv_hide_title' => '',
                ],
			]
		);

        /* STYLE - Excerpt */
        $this->add_control(
            'thmv_section_excerpt',
            [
                'label' => __( 'Excerpt', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_hide_excerpt' => '',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => __( 'Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .entry-content p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_hide_excerpt' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => __( 'Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .entry-content p',
                'condition' => [
                    'thmv_hide_excerpt' => '',
                ],
            ]
        );

        /* STYLE - Meta */
        $this->add_control(
            'thmv_section_meta',
            [
                'label' => __( 'Meta', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
		$this->add_control(
			'author_color',
			[
				'label' => __( 'Author Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-meta' => 'color: {{VALUE}};',
				],
                'condition' => [
                    'thmv_hide_author' => '',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'label' => __( 'Author Typography', 'th-widget-pack' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .post-meta',
                'condition' => [
                    'thmv_hide_author' => '',
                ],
			]
		);

        $this->add_control(
            'date_color',
            [
                'label' => __( 'Date Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementors' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_hide_date' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => __( 'Date Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .post-elementors',
                'condition' => [
                    'thmv_hide_date' => '',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => __( 'Category Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementors' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_hide_category' => '',
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => __( 'Category Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .post-elementors',
                'condition' => [
                    'thmv_hide_category' => '',
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );

        $this->add_control(
            'category_comments',
            [
                'label' => __( 'Comments Color', 'th-widget-pack' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementors' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'thmv_hide_comments' => '',
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comments_typography',
                'label' => __( 'Comments Typography', 'th-widget-pack' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .post-elementors',
                'condition' => [
                    'thmv_hide_comments' => '',
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );


        /* STYLE - Read More */
        $this->add_control(
            'thmv_section_read_more',
            [
                'label' => __( 'Read more', 'th-widget-pack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'thmv_hide_read_more' => '',
                ],
            ]
        );

		$this->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .entry-content p a' => 'color: {{VALUE}};',
				],
                'condition' => [
                    'thmv_hide_read_more' => '',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'label' => __( 'Typography', 'th-widget-pack' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .entry-content p a',
                'condition' => [
                    'thmv_hide_read_more' => '',
                ],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_style_border',
            [
                'label' => __( 'Appearance', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'thmv_style' => [ 'style_3']
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_section_padding',
            [
                'label' => __( 'Padding', 'th-widget-pack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mas-blog-post .post-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_border',
            [
                'label' => __( 'Borders', 'th-widget-pack' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'th-widget-pack' ),
                'label_off' => __( 'Hide', 'th-widget-pack' ),
                'selectors' => [
                    '{{WRAPPER}} .mas-blog-post .post-inner' => 'border-width:1px',

                ],
            ]
        );

        $this->add_responsive_control(
			'blog_content_border_radius',
			[
				'label' => __( 'Border Radius', 'th-widget-pack' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'selectors' => [
					'{{WRAPPER}} .mas-blog-post .post-inner' => 'border-radius:{{VALUE}}px;',
                    '{{WRAPPER}} .mas-blog-post.format-video .post-inner, {{WRAPPER}} .mas-blog-post.format-image .post-inner,
                    {{WRAPPER}} .mas-blog-post.format-gallery .post-inner, {{WRAPPER}} .mas-blog-post.has-post-thumbnail .post-inner' => 'border-radius:0 0 {{VALUE}}px {{VALUE}}px;',
                    '{{WRAPPER}} .mas-blog-post .th-pkg-img img, {{WRAPPER}} .mas-blog-post.format-gallery .flexslider.gallery ul li a img,
                    {{WRAPPER}} .mas-blog-post.format-gallery .flexslider.gallery ul li img, {{WRAPPER}} .mas-blog-post a img.wp-post-image' => 'border-radius: {{VALUE}}px {{VALUE}}px 0 0;',
				],
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
	    $settings = $this->get_settings_for_display();

		// WP_Query arguments
		$args = array (
			'post_type' => array( 'post' ),
            'post_status'=>array( 'publish' ),
		);

		if ( $settings['post_categories'] != 'all' ) {
			if ( is_array( $settings['post_categories'] ) ) {
				if ( in_array( 'all', $settings['post_categories'] ) ) {
					$settings['post_categories'] = array_diff( $settings['post_categories'], array('all') );
				}

				$categories = implode( ', ', $settings['post_categories'] );
			} else {
				$categories = array( $settings['post_categories'] );
			}
			$args['cat'] = $categories;
		}

		if ( $settings['post_count'] ) {
			$args['posts_per_page'] = $settings['post_count'];
		}

        if ( isset( $settings['pagination'] ) && $settings['pagination'] == 'yes' ) {

            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
            elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
            else { $paged = 1; }

            if ( isset( $settings['post_count'] ) ) {
                $th_offset = ( $paged - 1 ) * $settings['post_count'];
            } else {
                $default_posts_per_page = get_option( 'posts_per_page' );
                $th_offset = ( $paged - 1 ) * $default_posts_per_page;
            }

            $args['paged'] = $paged;
            //$args['offset'] = $th_offset;
        }

		// The Query
        $use_bittersweet_pagination = false;
        if(is_front_page()) {
            $use_bittersweet_pagination=true;
        }

        $widget_wp_query = new \WP_Query( $args );
        global $wp_query;

        // Pagination fix
        $temp_query = $wp_query;
        $wp_query   = NULL;
        $wp_query   = $widget_wp_query;

		if ( $widget_wp_query->have_posts() ) { ?>

            <?php
            switch( $settings['thmv_style'] ) {
                case "style_1":
                    ?>
                    <h1>Post-style-1</h1>
                    <div class="thmv-post-styl-1">
                        <div class="thmv-column-3">
                            <div class="thme-grid-style-4">
                                <div class="thme-grid-img">
                                    <img class="img-fluid" src="Americas-Big-Little-Food-Town.png" alt="">
                                </div>
                                <div class="thme-info">
                                    <span class="thmv-subheading">Ryan - March 30,2017</span>
                                    <hr class="thmv-separator">
                                    <h3>America’s Big Little Food Town</h3>
                                    <p>The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the...</p>
                                    <a class="thmv-learn-btn thmv-w-100" href="#">Read More
                                        <svg width="19" height="10" viewBox="0 0 19 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4596 5.45962C18.7135 5.20578 18.7135 4.79422 18.4596 4.54038L14.323 0.403807C14.0692 0.149967 13.6576 0.149966 13.4038 0.403807C13.15 0.657648 13.15 1.06921 13.4038 1.32305L17.0808 5L13.4038 8.67696C13.15 8.9308 13.15 9.34235 13.4038 9.59619C13.6576 9.85004 14.0692 9.85004 14.323 9.5962L18.4596 5.45962ZM-5.68248e-08 5.65L18 5.65L18 4.35L5.68248e-08 4.35L-5.68248e-08 5.65Z" fill="#191B18"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="thmv-column-3">
                            <div class="thme-grid-style-4">
                                <div class="thme-grid-img">
                                    <img class="img-fluid" src="Americas-Big-Little-Food-Town-1.png" alt="">
                                </div>
                                <div class="thme-info">
                                    <span class="thmv-subheading">Ryan - March 30,2017</span>
                                    <hr class="thmv-separator">
                                    <h3>America’s Big Little Food Town</h3>
                                    <p>The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the...</p>
                                    <a class="thmv-learn-btn thmv-w-100" href="#">Read More
                                        <svg width="19" height="10" viewBox="0 0 19 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4596 5.45962C18.7135 5.20578 18.7135 4.79422 18.4596 4.54038L14.323 0.403807C14.0692 0.149967 13.6576 0.149966 13.4038 0.403807C13.15 0.657648 13.15 1.06921 13.4038 1.32305L17.0808 5L13.4038 8.67696C13.15 8.9308 13.15 9.34235 13.4038 9.59619C13.6576 9.85004 14.0692 9.85004 14.323 9.5962L18.4596 5.45962ZM-5.68248e-08 5.65L18 5.65L18 4.35L5.68248e-08 4.35L-5.68248e-08 5.65Z" fill="#191B18"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="thmv-column-3">
                            <div class="thme-grid-style-4">
                                <div class="thme-grid-img">
                                    <img class="img-fluid" src="Americas-Big-Little-Food-Town-2.png" alt="">
                                </div>
                                <div class="thme-info">
                                    <span class="thmv-subheading">Ryan - March 30,2017</span>
                                    <hr class="thmv-separator">
                                    <h3>America’s Big Little Food Town</h3>
                                    <p>The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the...</p>
                                    <a class="thmv-learn-btn thmv-w-100" href="#">Read More
                                        <svg width="19" height="10" viewBox="0 0 19 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4596 5.45962C18.7135 5.20578 18.7135 4.79422 18.4596 4.54038L14.323 0.403807C14.0692 0.149967 13.6576 0.149966 13.4038 0.403807C13.15 0.657648 13.15 1.06921 13.4038 1.32305L17.0808 5L13.4038 8.67696C13.15 8.9308 13.15 9.34235 13.4038 9.59619C13.6576 9.85004 14.0692 9.85004 14.323 9.5962L18.4596 5.45962ZM-5.68248e-08 5.65L18 5.65L18 4.35L5.68248e-08 4.35L-5.68248e-08 5.65Z" fill="#191B18"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- Post-style-1 start end--->
                <?php
                    break;

                case "style_2":
                    ?>
                    <h1>Post-style-2</h1>
                    <div class="thmv-post-styl-2">
                        <div class="thmv-prc-row">
                            <div class="thmv-column">
                                <div class="thme-grid-style-5">
                                    <div class="thme-grid-img">
                                        <img class="img-fluid" src="Creation-timelines.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="thmv-column">
                                <div class="thme-grid-style-5 right-col">
                                    <div class="thme-info">
                                        <span class="thmv-subheading">01/01/2021</span>
                                        <h3>Creation timelines for the standard lorem</h3>
                                        <p>The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the days before computerized design</p>
                                        <a class="thmv-learn-btn thmv-w-100" href="#">Read More
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M-0.000156792 8.92L-0.000156705 6.92L11.9998 6.92L6.49984 1.42L7.91984 -3.46194e-07L15.8398 7.92L7.91984 15.84L6.49984 14.42L11.9998 8.92L-0.000156792 8.92Z" fill="#171818"/>
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="thmv-prc-row">
                            <div class="thmv-column">
                                <div class="thme-grid-style-5">
                                    <div class="thme-grid-img">
                                        <img class="img-fluid" src="Creation-timelines-1.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="thmv-column">
                                <div class="thme-grid-style-5 right-col">
                                    <div class="thme-info">
                                        <span class="thmv-subheading">01/01/2021</span>
                                        <h3>Creation timelines for the standard lorem</h3>
                                        <p>The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the days before computerized design</p>
                                        <a class="thmv-learn-btn thmv-w-100" href="#">Read More
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M-0.000156792 8.92L-0.000156705 6.92L11.9998 6.92L6.49984 1.42L7.91984 -3.46194e-07L15.8398 7.92L7.91984 15.84L6.49984 14.42L11.9998 8.92L-0.000156792 8.92Z" fill="#171818"/>
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- Post-style--2 end--->
                <?php
                    break;

                case "style_3":
                    if ( isset( $settings['post_image_size'] ) &&  $settings['post_image_size'] > "" ) {
                        global $image_size, $masonry_template_key, $automatic_post_excerpts;
                        $image_size = $settings['post_image_size'];
                        $masonry_template_key = '-masonry';


                        if ( function_exists( 'get_theme_mod' ) ) {
                            $automatic_post_excerpts = get_theme_mod( 'themo_automatic_post_excerpts', true );
                        }
                        if(isset($automatic_post_excerpts) && $automatic_post_excerpts){
                            $automatic_post_excerpts = 'on';
                        }else{
                            $automatic_post_excerpts = 'off';
                        }
                    }

                    $th_section_class = "th-masonry-blog";
                    $th_post_classes = "col-sm-6 col-md-4";

                    if ( isset( $settings['post_columns'] ) &&  $settings['post_columns'] > "" ) {
                        switch ( $settings['post_columns'] ) {
                            case '2-col':
                                $th_section_class .= " th-blog-2-col";
                                $th_post_classes = "col-sm-6";
                                break;
                            case '4-col':
                                $th_section_class .= " th-blog-4-col";
                                $th_post_classes = "col-sm-6 col-md-4";
                                break;
                            case '5-col':
                                $th_section_class .= " th-blog-5-col";
                                $th_post_classes = "col-sm-6 col-md-4";
                                break;
                            default:
                                $th_section_class .= " th-blog-3-col";
                                $th_post_classes = "col-sm-6 col-md-4";
                        }
                    }
                    ?>
                    <section class="<?php echo esc_attr( $th_section_class ); ?>">

                        <div class="mas-blog row">
                            <div class="mas-blog-post-sizer <?php echo esc_attr($th_post_classes); ?>"></div>
                            <?php while ( $widget_wp_query->have_posts() ) { $widget_wp_query->the_post(); ?>

                                <?php $format = get_post_format() ? get_post_format() : 'standard';?>

                                <div <?php $th_post_classes = "mas-blog-post " . esc_attr( $th_post_classes ); post_class( esc_attr( $th_post_classes ) ); ?>>
                                    <?php get_template_part( 'templates/content', $format ); ?>
                                </div>

                            <?php } ?>

                            <?php
                            // Reset postdata
                            wp_reset_postdata();
                            ?>

                        </div>
                        <?php if ( isset( $settings['pagination'] ) &&  $settings['pagination'] == 'yes' && $widget_wp_query->max_num_pages > 1 ) { ?>
                            <div class="row">
                                <nav class="post-nav">
                                    <ul class="pager">
                                        <?php
                                        if( $use_bittersweet_pagination ) {
                                            th_bittersweet_pagination($widget_wp_query->max_num_pages);
                                        } else { ?>
                                            <li class="previous"><?php next_posts_link( esc_html__( '&larr; Older posts', 'th-widget-pack' ), $widget_wp_query->max_num_pages); ?></li>
                                            <li class="next"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'th-widget-pack' ) ); ?></li>
                                        <?php }?>
                                    </ul>
                                </nav>
                            </div>
                        <?php } ?>
                    </section>

                    <?php
                    break;
            }
		} else {
			esc_html_e( 'Sorry, no results were found.', 'th-widget-pack' );
		}

        // Reset main query object
        $wp_query = NULL;
        $wp_query = $temp_query;

        // Reset postdata
        wp_reset_postdata();

	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Blog() );
