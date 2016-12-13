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
		return 'posts-grid';
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
					'{{WRAPPER}} .th-team-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-team-member-bio',
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
					'{{WRAPPER}} .th-team-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-team-member-bio',
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
					'{{WRAPPER}} .th-team-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-team-member-bio',
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
					'{{WRAPPER}} .th-team-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .th-team-member-bio',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		// WP_Query arguments
		$args = array (
			'post_type' => array( 'post' ),
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

		// The Query
		$query = new \WP_Query( $args );
		// The Loop
		if ( $query->have_posts() ) { ?>

			<section class="masonry-blog">
				<div class="container">
					<div class="mas-blog row">

						<?php while ( $query->have_posts() ) { $query->the_post(); ?>

							<?php $format = get_post_format() ? get_post_format() : 'standard'; ?>

							<div class="mas-blog-post col-lg-4 col-md-4 col-sm-6">
								<?php get_template_part('templates/content', $format); ?>
							</div>

						<?php } ?>

					</div>
				</div>
			</section>
			<?php

		} else {
			esc_html_e('Sorry, no results were found.', 'themovation-widgets');
		}

		wp_reset_postdata();
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Blog() );
