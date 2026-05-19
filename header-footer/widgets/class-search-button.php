<?php

namespace HFE\WidgetsManager\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class Aloha_Search_Button extends SearchButton\Search_Button {

    public function get_name() {
        return 'thhf-search-button';
    }

    public function get_custom_help_url() {
        return ALOHA_WIDGETS_HELP_URL_PREFIX . $this->get_name();
    }

    public function get_icon() {
        return 'th-editor-icon-search';
    }

    public function get_categories() {
        return ['themo-site'];
    }

    public function get_script_depends() {
        return ['aloha-hfe-widgets-js'];
    }

    protected function register_search_style_controls(): void {
        parent::register_search_style_controls();
        $this->update_control('placeholder', ['condition' => []]);
        $this->update_control('input_placeholder_color', ['condition' => []]);
        $this->update_control('input_placeholder_hover_color', ['condition' => []]);
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
                'input',
                [
                    'placeholder' => $settings['placeholder'],
                    'class' => 'hfe-search-form__input',
                    'type' => 'search',
                    'name' => 's',
                    'title' => __('Search', 'header-footer-elementor'),
                    'value' => get_search_query(),
                ]
        );

        $this->add_render_attribute(
                'container',
                [
                    'class' => ['hfe-search-form__container'],
                    'role' => 'tablist',
                ]
        );
        ?>
        <form class="hfe-search-button-wrapper" role="search" action="<?php echo home_url(); ?>" method="get">
            <?php if ('icon' === $settings['layout']) { ?>
                <div class = "hfe-search-icon-toggle">
                    <?php \Elementor\Icons_Manager::render_icon($settings['search_icon'], ['aria-hidden' => 'true']); ?>
                </div>
                <div class="hfe-search-form-wrapper">
                    <input <?php echo $this->get_render_attribute_string('input'); ?>>
                    <div class="hfe-search-overlay-close"><?php esc_html_e('Close', 'header-footer-elementor'); ?></div>
                </div>
            <?php } else { ?>
                <div <?php echo wp_kses_post($this->get_render_attribute_string('container')); ?>>
                    <?php if ('text' === $settings['layout']) { ?>
                        <input <?php echo $this->get_render_attribute_string('input'); ?>>
                        <button id="clear" type="reset">
                            <i class="fas fa-times clearable__clear" aria-hidden="true"></i>
                        </button>
                    <?php } else { ?>
                        <input <?php echo $this->get_render_attribute_string('input'); ?>>
                        <button id="clear-with-button" type="reset">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                        <button class="hfe-search-submit" type="submit">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>
                    <?php } ?>
                </div>
            <?php } ?>
        </form>
        <?php
    }

}
