<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Post Comments widget
 *
 * HFE widget for Post Comments.
 *
 * @since 1.3.0
 */
class Post_Comments extends Widget_Base {

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
        return 'thhf-post-comments';
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
        return __('Post Comments', 'header-footer-elementor');
    }

    /**
    * get Plugin help URL
    * @return string help url
    */
    public function get_custom_help_url() {
        return 'https://help.themovation.com/' . $this->get_name();
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
        return 'th-editor-icon-comments';
    }

    /**
     * Register Post Comments controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _register_controls() {
        $this->register_content_post_comments_controls();
        $this->register_post_comments_style_controls();
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
        return ['themo-single'];
    }

    /**
     * Register Post Comments General Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_content_post_comments_controls() {
        $this->start_controls_section(
                'section_general_fields',
                [
                    'label' => __('Comments', 'header-footer-elementor'),
                ]
        );

        $this->add_control(
                'note',
                [
                    'label' => '<b>' . __('Note', 'header-footer-elementor') . '</b>',
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __('This uses the comment template from the active theme.', 'header-footer-elementor'),
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Post Comments Style Controls.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function register_post_comments_style_controls() {
        
    }

    /**
     * Render post comments widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.3.0
     * @access protected
     */
    protected function render() {

        if ('elementor-thhf' == get_post_type()) {
            //get a product and use it
            $args = array(
                'posts_per_page' => 1,
                'orderby' => 'date',
                'post_type' => 'post',
            );

            $queryPosts = get_posts($args);
            if(count($queryPosts)){
                 global $post;
                 $post = $queryPosts[0];
                 setup_postdata($post);
                 $comments = comments_template();
                 wp_reset_postdata();
            }
            else {
                echo 'Please, create at least one post to see some content here.';
            }
        } else {
            $comments = comments_template();
        }
        ?>		
        <div class="hfe-post-comments hfe-post-comments-wrapper">

        <?php echo $comments; ?>

        </div>
        <?php
    }

    /**
     * Render post comments output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * Remove this after Elementor v3.3.0
     *
     * @since 1.3.0
     * @access protected
     */
    protected function _content_template() {
//		$this->content_template();
    }

}
