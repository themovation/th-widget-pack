<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Product Images widget
 *
 * HFE widget for Product Images.
 *
 * @since 1.3.0
 */
class Product_Images extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'thhf-product-images';
    }

    /**
     * get Plugin help URL
     * @return string help url
     */
    public function get_custom_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Product Images', 'header-footer-elementor');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'th-editor-icon-image-gallery';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['themo-woocommerce'];
    }

    /**
     * Register Product Images controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_controls() {
        $this->register_content_product_images_controls();
        $this->register_product_images_style_controls();
    }

    protected function register_product_images_style_controls() {
        $this->start_controls_section(
                'section_style_fields',
                [
                    'label' => __('Style', 'header-footer-elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'section_main_image',
                [
                    'label' => __('Image', 'header-footer-elementor'),
                    'type' => Controls_Manager::HEADING,
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'main_border',
                    'label' => __('Border', 'header-footer-elementor'),
                    'selector' => '{{WRAPPER}} .hfe-product-images-wrapper .flex-active-slide img',
                ]
        );
        $this->add_responsive_control(
                'main_border_radius',
                [
                    'label' => __('Border Radius', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-active-slide img' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'section_thumbnails',
                [
                    'label' => __('Thumbnails', 'header-footer-elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_responsive_control(
                'spacing',
                [
                    'label' => __('Top Margin', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'padding',
                [
                    'label' => __('Item Padding', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs li' => 'margin: 0; padding: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs' => 'width: auto; margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'thumbnail_border',
                    'label' => __('Border', 'header-footer-elementor'),
                    'selector' => '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs li img',
                ]
        );
        $this->add_responsive_control(
                'thumbnail_border_radius',
                [
                    'label' => __('Border Radius', 'header-footer-elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hfe-product-images-wrapper .flex-control-thumbs li img' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Product Images General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_product_images_controls() {
        $this->start_controls_section(
                'section_content_fields',
                [
                    'label' => __('Content', 'header-footer-elementor'),
                ]
        );
        $this->add_control(
                'note',
                [
                    //'label' => '<b>' . __('Note', 'header-footer-elementor') . '</b>',
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __('Displays Product Gallery.', 'header-footer-elementor'),
                ]
        );
        $this->end_controls_section();
    }

    private function renderGallery($imagePost) {
        $product = new \WC_product($imagePost->ID);

        $attachment_ids = $product->get_gallery_image_ids();

        $columns = apply_filters('woocommerce_product_thumbnails_columns', 4);

        echo '<div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-' . $columns . ' images">';
        $post_thumbnail_id = $product->get_image_id();
        echo '<figure class="woocommerce-product-gallery__wrapper">';
        if ($post_thumbnail_id) {
            $search = 'woocommerce-product-gallery__image';
            $html = str_replace($search, $search . ' flex-active-slide', wc_get_gallery_image_html($post_thumbnail_id, true));
        } else {
            $html = '<div class="woocommerce-product-gallery__image--placeholder flex-active-slide">';
            $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
            $html .= '</div>';
        }

        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

        echo '</figure>';

        if (count($attachment_ids)) {
            echo '<ol class="flex-control-nav flex-control-thumbs">';
        }
        foreach ($attachment_ids as $attachment_id) {
            $image = wp_get_attachment_image($attachment_id);
            echo '<li>' . $image . '</li>';
        }
        if (count($attachment_ids)) {
            echo '</ol>';
        }
        echo '</div>';
    }

    /**
     * Render post content widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function render() {

        if ('elementor-thhf' == get_post_type()) {
            //try to get a product with images from woocommerce
            $args = array(
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'desc',
                'post_type' => 'product',
                'meta_query' => array(
                    array(
                        'key' => '_product_image_gallery',
                        'value' => '',
                        'compare' => '!=',
                    ),
                )
            );

            $imageProduct = get_posts($args);
            if (count($imageProduct)) {
                $imagePost = $imageProduct[0];
                ob_start();
                $this->renderGallery($imagePost);
                $content = ob_get_clean();
                wp_enqueue_script('wc-single-product');
                wp_reset_postdata();
            } else {
                //try to search another one with a featured image
                $args = array(
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'desc',
                    'post_type' => 'product',
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'value' => '',
                            'compare' => '!=',
                        ),
                    )
                );
                $imageProduct = get_posts($args);
                if (count($imageProduct)) {
                    $imagePost = $imageProduct[0];
                    ob_start();
                    $this->renderGallery($imagePost);
                    $content = ob_get_clean();
                    wp_reset_postdata();
                } else {
                    $content = 'Please have at least one product with an image gallery setup in woocommerce.';
                }
            }
        } else if (get_post_type() == 'product') {
            global $product;
            $product = wc_get_product();
            ob_start();
            wc_get_template('single-product/product-image.php');
            $content = ob_get_clean();
        }
        ?>		
        <div class="hfe-product-images hfe-product-images-wrapper">
        <?php echo $content; ?>
        </div>
            <?php
        }

    }
    