<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Themo_Widget_Course_Guide extends Widget_Base {

	public function get_name() {
		return 'themo-course-guide';
	}

	public function get_title() {
		return __( 'Course Guide', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'themo-elements' ];
	}

	private function get_courses_list() {
		$portfolio = array();

		$loop = new \WP_Query( array(
			'post_type' => array('themo_portfolio'),
			'posts_per_page' => -1
		) );

		$portfolio['none'] = __('None', 'elementor');

		while ( $loop->have_posts() ) : $loop->the_post();
			$id = get_the_ID();
			$title = get_the_title();
			$portfolio[$id] = $title;
		endwhile; wp_reset_query();

		return $portfolio;
	}

	private function get_courses_group_list() {
		$portfolio_group = array();

		$portfolio_group['none'] = __( 'None', 'elementor' );

		$taxonomy = 'themo_project_type';

		$tax_terms = get_terms( $taxonomy );

		foreach( $tax_terms as $item ) {
			$portfolio_group[$item->term_id] = $item->name;
		}

		return $portfolio_group;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'elementor' ),
			]
		);

		$this->add_control(
			'filter',
			[
				'label' => __( 'Show filter bar', 'elementor' ),
				'type' => Controls_Manager::CHECKBOX,
				'default' => false,
			]
		);

		$this->add_control(
			'individual',
			[
				'label'   => __( 'Select Individually', 'elementor' ),
				'type'    => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'default' => 'none',
				'options' => $this->get_courses_list()
			]
		);

		$this->add_control(
			'group',
			[
				'label'   => __( 'Select by Group', 'elementor' ),
				'type'    => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'default' => 'none',
				'options' => $this->get_courses_group_list()
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order by', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date Published', 'elementor' ),
					'menu_order' => __( 'Drag and Drop', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Number of Columns to show', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'2' => __( '2', 'elementor' ),
					'3' => __( '3', 'elementor' ),
					'4' => __( '4', 'elementor' ),
					'5' => __( '5', 'elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		global $th_folio_count;
		$folio_id = 'th-portfolio-' . ++$th_folio_count;

		switch( $settings['columns'] ) {
			case 2:
				$portfolio_row = ' two-columns';
				$portfolio_item = array('th-portfolio-item', 'item', 'col-sm-6');
				break;
			case 3:
				$portfolio_row = ' three-columns';
				$portfolio_item = array('th-portfolio-item', 'item', 'col-md-4', 'col-sm-6');
				break;
			case 4:
				$portfolio_row = ' four-columns';
				$portfolio_item = array('th-portfolio-item', 'item', 'col-md-3', 'col-sm-6');
				break;
			case 5:
				$portfolio_row = ' five-columns';
				$portfolio_item = array('th-portfolio-item', 'item', 'col-md-2', 'col-sm-6');
				break;
			default:
				$portfolio_row = '';
				$portfolio_item = array();
		}
		?>

        <?php
        $th_uid = uniqid('th-portfolio-content-');
        ?>
		<div id="<?php echo $th_uid; ?>" class="th-portfolio">

			<?php if ( $settings['filter'] ) : ?>

				<div id="filters" class="th-portfolio-filters">
					<span><?php echo __( 'Sort:', 'themovation-widgets' ); ?></span>
					<a href="#" data-filter="*" class="current"><?php echo __( 'All', 'themovation-widgets' ); ?></a>
					<?php
					$taxonomy = 'themo_project_type';
					$tax_terms = get_terms( $taxonomy );
					foreach ( $tax_terms as $tax_term ) {
						echo '<a href="#" data-filter="#'.$th_uid.' .p-' . $tax_term->slug . '">' . $tax_term->name .'</a>';
					}
					?>
				</div>

			<?php endif; ?>

			<div id="th-portfolio-row" class="th-portfolio-row row portfolio_content <?php echo $portfolio_row; ?>">

				<?php
				$args = array();
				if ( $settings['individual'] ) {
					if ( in_array( 'none', $settings['individual'] ) ) {
						$settings['individual'] = array_diff( $settings['individual'], array( 'none' ) );
					}
					if ( $settings['individual'] ) {
						$post_ids = $settings['individual'];
						$args['post__in'] = $post_ids;
					}
				}
				$args['post_type'] = array( 'themo_portfolio' );
				if ( $settings['group'] ) {
					if ( in_array( 'none', $settings['group'] ) ) {
						$settings['group'] = array_diff( $settings['group'], array( 'none' ) );
					}
					if ( $settings['group'] ) {
						$project_type_id = $settings['group'];
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'themo_project_type',
								'field'    => 'term_id',
								'terms'    => $project_type_id,
							),
						);
					}
				}
				if ( $settings['order'] == 'date' ) {
					$args['orderby'] = 'date';
				} elseif ( $settings['order'] == 'menu_order' ) {
					$args['orderby'] = 'menu_order';
					$args['order'] = 'ASC';
				}
				// The Query
				$query = new \WP_Query( $args );

				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
                        // get post format
						$format = get_post_format();
                        if ( false === $format ) {
                            $format = '';
                        }

                        // default settings
                        $link_url = get_the_permalink();
                        $link_title = get_the_title();
                        $link_target_markup = false;
                        $img_src = false;
                        $alt_text = '';

                        // Link post type options
                        if(isset($format) && $format == 'link'){

                            $link_url = get_post_meta( get_the_ID(), '_format_link_url', true);
                            $link_title = get_post_meta( get_the_ID(), '_format_link_title', true);
                            $link_target = get_post_meta( get_the_ID(), '_format_link_target');

                            if(!$link_url > ""){
                                $link_url = get_the_permalink();
                            }

                            // Link Target
                            if(isset($link_target[0][0]) && $link_target[0][0] == "_blank"){
                                $link_target_markup = "target='_blank'";
                            }

                            // Custom Title
                            if(!$link_title > "") {
                                $link_title=get_the_title();
                            }
                        }

                        //Image post type options
                        if(isset($format) && $format == 'image') {

                            // Get Project Format Options
                            $project_thumb_alt_img = get_post_meta( get_the_ID(), '_holes_image', false);

                            if (isset($project_thumb_alt_img[0]) && $project_thumb_alt_img[0] > "") {
                                $alt = false;
                                $img_src = themo_return_metabox_image($project_thumb_alt_img[0], null, "th_img_md_square", true, $alt);
                                $alt_text = $alt;
                                // Default lightbox url
                                $link_url = themo_return_metabox_image($project_thumb_alt_img[0], null, "th_img_xl", true, $alt);
                            }

                            // lightbox mark up
                            $link_url_tmp = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'th_img_xl');
                            if(isset($link_url_tmp[0])){
                                $link_url = $link_url_tmp[0];
                            }
                            //echo $link_url;
                            $link_target_markup = ' data-toggle=lightbox data-gallery=multiimages';
                            $link_title = the_title_attribute('echo=0') ;
                        }

						$terms = get_the_terms( get_the_ID(), 'themo_project_type' );
						if ( $terms && ! is_wp_error( $terms ) ) :
							$filtering_links = array();
							foreach ( $terms as $term ) {
								$filtering_links[] = 'p-' . $term->slug;
							}
						endif;
						$classes = array_merge( $portfolio_item, $filtering_links );
						?>
						<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
							<div class="th-port-wrap">
								<?php
                                if(isset($img_src) &&  $img_src > ""){
                                    echo '<img class="img-responsive port-img" src="'.esc_url($img_src).'" alt="'.esc_attr($alt_text).'">';
                                }else{
                                    if ( has_post_thumbnail(get_the_ID()) ) {
                                        $featured_img_attr = array('class'	=> "img-responsive port-img");
                                        echo get_the_post_thumbnail(get_the_ID(),"th_img_md_square",$featured_img_attr);
                                    }
                                }
                                ?>
								<div class="th-port-overlay"></div>
								<div class="th-port-inner">
									<div class="th-port-center">
										<!--i class="th-port-icon glyphicons glyphicons-lightbulb"></i-->
										<h3 class="th-port-title"><?php the_title(); ?></h3>

                                        <?php
                                        $automatic_post_excerpts = 'on';
                                        if ( function_exists( 'ot_get_option' ) ) {
                                            $automatic_post_excerpts = ot_get_option( 'themo_automatic_post_excerpts', 'on' );
                                        }
                                        if($automatic_post_excerpts === 'off'){
                                            $content = apply_filters( 'the_content', get_the_content() );
                                            $content = str_replace( ']]>', ']]&gt;', $content );
                                            if($content != ""){
                                                echo '<p class="th-port-sub">'.$content.'</p>';
                                            }
                                        }else{
                                            $excerpt = apply_filters( 'the_excerpt', get_the_excerpt() );
                                            $excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
                                            $excerpt = str_replace('<p', '<p class="th-port-sub"', $excerpt);
                                            if($excerpt != ""){
                                                echo $excerpt;
                                            }
                                        }
                                        ?>
                                        ?>
									</div>
                                    <?php echo '<a href="'. esc_url($link_url) . '" class="th-port-link" ' .esc_html($link_target_markup) . ' title="'.esc_attr($link_title).'"></a>'; ?>
								</div>
							</div>
						</div>
						<?php
					}
				} else {
					echo '<div class="alert">';
					_e('Sorry, no results were found.', 'themovation-widgets');
					echo '</div>';
					get_search_form();
				}
				// Restore original Post Data
				wp_reset_postdata();
				?>

			</div>

		</div>

		<?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Themo_Widget_Course_Guide() );
