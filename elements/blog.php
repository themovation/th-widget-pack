<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Blog extends Widget_Base {

	public function get_name() {
		return 'themo-blog';
	}

	public function get_title() {
		return __( 'Blog', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	private function get_blog_categories_list() {
		$categories = array('all' => __('All Categories', 'themovation-widgets'));
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
				'label' => __( 'Layout', 'elementor' ),
			]
		);

		$this->add_control(
			'post_count',
			[
				'label' => __( 'Number of posts to display', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'default' => 10,
			]
		);

		$this->add_control(
			'post_categories',
			[
				'label'   => __( 'Category Filter', 'elementor' ),
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
                'label' => __( 'Image Size', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'th_img_sm_standard',
                'options' => [
                    'th_img_sm_standard' => __( 'Standard', 'elementor' ),
                    'th_img_sm_landscape' => __( 'Landscape', 'elementor' ),
                    'th_img_sm_portrait' => __( 'Portrait', 'elementor' ),
                    'th_img_sm_square' => __( 'Square', 'elementor' ),
                    'th_img_lg' => __( 'Large', 'elementor' ),
                ],
                /*'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'background-size: {{VALUE}}',
                ]*/
            ]
        );

        $this->add_control(
            'post_columns',
            [
                'label' => __( 'Max. Number of Columns', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3-col',
                'options' => [
                    '2-col' => __( '2 Columns', 'elementor' ),
                    '3-col' => __( '3 Columns', 'elementor' ),
                    '4-col' => __( '4 Columns', 'elementor' ),
                    '5-col' => __( '5 Columns', 'elementor' ),
                ],
                /*'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'background-size: {{VALUE}}',
                ]*/
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __( 'Pagination', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'label_off',
                'label_on' => __( 'Yes', 'elementor' ),
                'label_off' => __( 'No', 'elementor' ),
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
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
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .post-title a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => __( 'Meta', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Meta Color', 'elementor' ),
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
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .post-meta',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label' => __( 'Excerpt', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'elementor' ),
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
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .entry-content p',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_read_more',
			[
				'label' => __( 'Read More', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __( 'Read More Color', 'elementor' ),
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
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .entry-content p a',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
	    $settings = $this->get_settings();



		// WP_Query arguments
		$args = array (
			'post_type' => array( 'post' ),
            'post_status'=>array('publish'),
		);

        
        if ( isset($settings['post_image_size']) &&  $settings['post_image_size'] > "") {
            global $image_size, $masonry_template_key, $automatic_post_excerpts;
            $image_size = $settings['post_image_size'];
            $masonry_template_key = '-masonry';

            $automatic_post_excerpts = 'on';
            if ( function_exists( 'ot_get_option' ) ) {
                $automatic_post_excerpts = ot_get_option( 'themo_automatic_post_excerpts', 'on' );
            }
        }

        $th_section_class = "masonry-blog";
        $th_post_classes = "col-sm-6 col-md-4";

        if ( isset($settings['post_columns']) &&  $settings['post_columns'] > "") {
            switch ($settings['post_columns']) {
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

        if ( isset($settings['pagination']) &&  $settings['pagination'] == 'yes' ) {


            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
            elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
            else { $paged = 1; }


            if(isset($settings['post_count'])) {
                $th_offset = ( $paged - 1 ) * $settings['post_count'];
            } else{
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

			<section class="<?php echo $th_section_class; ?>">
				<div class="container">

                    <div class="mas-blog row">
                        <div class="mas-blog-post-sizer <?php echo $th_post_classes; ?>"></div>
						<?php while ( $widget_wp_query->have_posts() ) { $widget_wp_query->the_post(); ?>

							<?php $format = get_post_format() ? get_post_format() : 'standard';?>

							<div <?php $th_post_classes = "mas-blog-post ".$th_post_classes; post_class($th_post_classes); ?>>
								<?php get_template_part('templates/content', $format); ?>
							</div>

						<?php } ?>

                        <?php
                        // Reset postdata
                        wp_reset_postdata();
                        ?>

					</div>
                    <?php if ( isset($settings['pagination']) &&  $settings['pagination'] == 'yes' && $widget_wp_query->max_num_pages > 1) { ?>
                    <div class="row">
                        <nav class="post-nav">
                            <ul class="pager">
                                <?php
                                if($use_bittersweet_pagination) {
                                    bittersweet_pagination();
                                } else { ?>
                                <li class="previous"><?php next_posts_link(esc_html__('&larr; Older posts', 'westwood'), $widget_wp_query->max_num_pages); ?></li>
                                <li class="next"><?php previous_posts_link(esc_html__('Newer posts &rarr;', 'westwood')); ?></li>
                               <?php }?>
                            </ul>
                        </nav>
                    </div>
                    <?php } ?>
				</div>
			</section>
			<?php

		} else {
			esc_html_e('Sorry, no results were found.', 'themovation-widgets');
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
