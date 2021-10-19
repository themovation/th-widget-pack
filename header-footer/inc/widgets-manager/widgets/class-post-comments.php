<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace THHF\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

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
     * Retrieve the widget icon.
     *
     * @since 1.3.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'thhf-icon-post-comments';
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
                    'label' => __('<b>Note</b>', 'header-footer-elementor'),
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __('This uses the comment template from the active theme.','header-footer-elementor'),
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



        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $comments = 'Comments not shown in the preview mode.';
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
