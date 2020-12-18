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
				'label' => __( 'Layout', 'th-widget-pack' ),
			]
		);

		$this->add_control(
			'post_count',
			[
				'label' => __( 'Number of posts to display', 'th-widget-pack' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'default' => 10,
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$this->add_control(
			'post_categories',
			[
				'label'   => __( 'Category Filter', 'th-widget-pack' ),
				'type'    => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'default' => 'all',
				'options' => $this->get_blog_categories_list()
			]
		);

        $this->add_control(
            'post_image_size',
            [
                'label' => __( 'Image Size', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'th_img_sm_standard',
                'options' => [
                    'th_img_sm_standard' => __( 'Standard', 'th-widget-pack' ),
                    'th_img_sm_landscape' => __( 'Landscape', 'th-widget-pack' ),
                    'th_img_sm_portrait' => __( 'Portrait', 'th-widget-pack' ),
                    'th_img_sm_square' => __( 'Square', 'th-widget-pack' ),
                    'th_img_lg' => __( 'Large', 'th-widget-pack' ),
                ],
                /*'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'background-size: {{VALUE}}',
                ]*/
            ]
        );

        $this->add_control(
            'post_columns',
            [
                'label' => __( 'Max. Number of Columns', 'th-widget-pack' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3-col',
                'options' => [
                    '2-col' => __( '2 Columns', 'th-widget-pack' ),
                    '3-col' => __( '3 Columns', 'th-widget-pack' ),
                    '4-col' => __( '4 Columns', 'th-widget-pack' ),
                    '5-col' => __( '5 Columns', 'th-widget-pack' ),
                ],
                /*'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'background-size: {{VALUE}}',
                ]*/
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title a' => 'color: {{VALUE}};',
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
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => __( 'Meta', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Meta Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __( 'Typography', 'th-widget-pack' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .post-meta',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label' => __( 'Excerpt', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .entry-content p' => 'color: {{VALUE}};',
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
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_read_more',
			[
				'label' => __( 'Read More', 'th-widget-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __( 'Read More Color', 'th-widget-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .entry-content p a' => 'color: {{VALUE}};',
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
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_style_border',
            [
                'label' => __( 'Appearance', 'th-widget-pack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'blog_section_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
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
				'label' => __( 'Border Radius', 'elementor' ),
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
