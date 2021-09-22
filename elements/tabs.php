<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Themo_Widget_Tabs extends Widget_Base {

    var $totalTabChoices = 30;

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $modified = filemtime(THEMO_PATH.'js/thmv-tabs.js');
        wp_register_script('thmv-tabs', THEMO_URL . 'js/thmv-tabs.js', ['elementor-frontend'], $modified, true);
    }

    public function get_script_depends() {
        return ['thmv-tabs'];
    }

    private function getParentClassName() {
        return 'elementor-widget-' . $this->get_name();
    }

    public function get_name() {
        return 'themo-tabs';
    }

    public function get_title() {
        return __('Themovation Tabs', 'th-widget-pack');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return ['themo-elements'];
    }

    public function get_keywords() {
        return ['tabs', 'accordion', 'toggle'];
    }

    protected function register_controls() {
        $this->start_controls_section(
                'section_tabs',
                [
                    'label' => __('Tabs', 'elementor'),
                ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'tab_title', [
            'label' => __('Title', 'th-widget-pack'),
            'type' => Controls_Manager::TEXT,
            'placeholder' => 'Lorem Ipsum',
            'default' => 'Lorem Ipsum',
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ]
                ]
        );
        $repeater->add_control(
                'thmv_tab_ordering',
                [
                    'label' => __('Ordering', 'th-widget-pack'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
        );
        for ($i = 0; $i < $this->totalTabChoices; $i++) {

            $repeater->add_control(
                    'thmv_tab_item_title' . $i, [
                'label' => __('Title', 'th-widget-pack'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Lorem Ipsum',
                'default' => ($i == 0 ? 'Lorem Ipsum' : ''),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                    ]
            );
            $repeater->add_control(
                    'thmv_tab_item_price' . $i, [
                'label' => __('Price', 'th-widget-pack'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Lore Ipsum',
                'default' => ($i == 0 ? '$30' : ''),
                'dynamic' => [
                    'active' => true,
                ],
                    ]
            );

            $array = [
                'label' => __('Content', 'th-widget-pack'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ];
            if ($i == 0) {
                $array['default'] = __('Tab Content', 'th-widget-pack');
            } else {
                unset($array['default']);
            }
            $repeater->add_control(
                    'thmv_tab_item_content' . $i, $array);
        }

        $this->add_control(
                'tabs',
                [
                    'label' => __('Tabs Items', 'elementor'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ tab_title }}}',
                ]
        );
        $this->add_control(
                'thmv_style',
                [
                    'label' => __('Choose style', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style_1',
                    'options' => [
                        'style_1' => __('Style 1', 'th-widget-pack'),
                        'style_2' => __('Style 2', 'th-widget-pack'),
                    ],
                ]
        );

        $this->add_responsive_control(
                'columns',
                [
                    'label' => __('Columns', 'th-widget-pack'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => __('Default', 'th-widget-pack'),
                        '1' => __('1', 'th-widget-pack'),
                        '2' => __('2', 'th-widget-pack'),
                        '3' => __('3', 'th-widget-pack'),
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_tabs_style',
                [
                    'label' => __('Tabs', 'elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'active_item_border',
                [
                    'label' => __('Active Tab Border Width', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-title:after' => 'height: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'thmv_style' => 'style_2',
                    ],
                ]
        );
        $this->add_control(
                'active_item_border_color',
                [
                    'label' => __('Active Tab Border Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-title:after' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => 'style_2',
                    ],
                ]
        );
        
        $this->add_control(
                'tabs_background_color',
                [
                    'label' => __('Tab Area Background Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tabs-wrapper' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'thmv_style' => 'style_2',
                    ],
                ]
        );
        

        $this->add_control(
                'heading_title',
                [
                    'label' => __('Title', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_control(
                'tab_color',
                [
                    'label' => __('Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-title' => 'color: {{VALUE}}',
                        ', {{WRAPPER}} .thmv-tab-title a' => 'color: {{VALUE}}',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY,
                    ],
                ]
        );

        $this->add_control(
                'tab_active_color',
                [
                    'label' => __('Active Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tabs .thmv-tab-title.active' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .thmv-tabs .thmv-tab-title:hover' => 'color: {{VALUE}}',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                ]
        );
        $this->add_control(
                'tab_active_background_color',
                [
                    'label' => __('Active Background Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tabs.style_1 .thmv-tab-title.active' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .thmv-tabs.style_1 .thmv-tab-title:hover' => 'background-color: {{VALUE}}',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_ACCENT,
                    ],
                    'condition' => [
                        'thmv_style' => 'style_1',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tab_typography',
                    'selector' => '{{WRAPPER}} .thmv-tab-title',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                    ],
                ]
        );

        $this->add_control(
                'heading_content',
                [
                    'label' => __('Content', 'elementor'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'background_color',
                [
                    'label' => __('Background Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-desktop-title.elementor-active' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .thmv-tabs-content-wrapper' => 'background-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'heading_color',
                [
                    'label' => __('Heading Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-heading' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_TEXT,
                    ],
                ]
        );
        $this->add_control(
                'price_color',
                [
                    'label' => __('Price Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-price' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_TEXT,
                    ],
                ]
        );
        $this->add_control(
                'content_color',
                [
                    'label' => __('Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .thmv-tab-text p' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_TEXT,
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'selector' => '{{WRAPPER}} .thmv-tab-content',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ],
                ]
        );

        $this->end_controls_section();
    }

    private function setTab(&$tabItemsList, $list, &$j, $i) {
        $fields = ['thmv_tab_item_title' => 'title', 'thmv_tab_item_price' => 'price', 'thmv_tab_item_content' => 'content'];
        $found = false;
        foreach ($fields as $field => $key) {
            $fieldName = $field . $i;
            if (!empty($list[$fieldName])) {
                $tabItemsList[$j][$key] = $list[$fieldName];
                $found = true;
            }
        }

        if ($found) {
            $j++;
        }
    }

    /**
     * 
     * @param type $settings settings
     * @param type $columnField columns field name
     * @param type $attribute attribute name
     */
    private function setupColumns($settings, $columnField, $attribute) {
        $this->add_render_attribute($attribute, 'class', '');
        $cols = [$columnField, $columnField . '_tablet', $columnField . '_mobile'];
//        echo "<pre>";print_r($settings);exit;
        foreach ($cols as $col) {
            if (isset($settings[$col])) {
                if (empty($settings[$col])) {
                    $colPercentage = 'default';
                } else {
                    $colPercentage = floor(100 / $settings[$col]);
                }

                $device = str_replace([$columnField, '_'], "", $col);
                $device .= strpos($col, '_') ? '-' : '';
                $this->add_render_attribute($attribute, 'class', 'thmv-column-' . $device . $colPercentage);
            }
        }
    }

    private function setupTabs($list, $ordering = false) {
        $tabItemsList = [];
        $j = 0;
        if (!empty(trim($ordering))) {
            $orderingArr = explode(',', trim($ordering));
            foreach ($orderingArr as $i) {
                $this->setTab($tabItemsList, $list, $j, $i);
            }
        } else {
            for ($i = 0; $i < $this->totalTabChoices; $i++) {
                $this->setTab($tabItemsList, $list, $j, $i);
            }
        }

        return $tabItemsList;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        
        $tabs = $this->get_settings_for_display('tabs');
        $allSettings = $this->get_settings_for_display();

        $id_int = substr($this->get_id_int(), 0, 3);

        $a11y_improvements_experiment = Plugin::$instance->experiments->is_feature_active('a11y_improvements');
        $style = $allSettings['thmv_style'];
        $this->add_render_attribute('thmv-tabs', 'class', array('thmv-tabs', $style));

        $columns_attribute = 'thmv_column';
        $this->setupColumns($allSettings, 'columns', $columns_attribute);
        $this->add_render_attribute($columns_attribute, 'class', 'thmv-content-block');
        
        $tabs_content_bg_color = !empty($allSettings['background_color']);
        ?>
        <div <?php echo $this->get_render_attribute_string('thmv-tabs'); ?>>
            <div class="thmv-tabs-wrapper" role="tablist" >
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                    $tab_title = $a11y_improvements_experiment ? $item['tab_title'] : $item['tab_title'];

                    $this->add_render_attribute($tab_title_setting_key, [
                        'id' => 'thmv-tab-title-' . $id_int . $tab_count,
                        'class' => ['thmv-tab-title', 'thmv-tab-desktop-title', (1 === $tab_count ? 'active' : '')],
                        'data-tab' => $index,
                        'role' => 'tab',
                        'tabindex' => 1 === $tab_count ? '0' : '-1',
                    ]);
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?>><?php echo $tab_title; ?></div>
                <?php endforeach; ?>
            </div>
            <div class="thmv-tabs-content-wrapper <?=$tabs_content_bg_color ? 'has-bg' : ''?>" role="tablist" aria-orientation="vertical">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $tab_title_mobile_setting_key = $this->get_repeater_setting_key('tab_title_mobile', 'tabs', $tab_count);

                    $this->add_render_attribute($tab_content_setting_key, [
                        'id' => 'thmv-tab-content-' . $id_int . $tab_count,
                        'class' => ['thmv-tab-content', 'elementor-clearfix', (1 === $tab_count ? 'active' : '')],
                        'data-tab' => $index,
                        'role' => 'tabpanel',
                        'tabindex' => '0',
                    ]);

                    $this->add_render_attribute($tab_title_mobile_setting_key, [
                        'class' => ['thmv-tab-title', 'thmv-tab-mobile-title', (1 === $tab_count ? 'active' : '')],
                        'data-tab' => $index,
                        'role' => 'tab',
                        'tabindex' => 1 === $tab_count ? '0' : '-1',
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');

                    $allFields = $this->setupTabs($item, $item['thmv_tab_ordering']);
                    ?>

                    <?php
                    if ($style === 'style_1'):
                        ?>
                        <div <?php echo $this->get_render_attribute_string($tab_title_mobile_setting_key); ?>><?php echo $item['tab_title']; ?></div>
                    <?php endif; ?>
                    <div <?php echo $this->get_render_attribute_string($tab_content_setting_key); ?>>
                        <?php
                        foreach ($allFields as $tabContent) {
                            $title = isset($tabContent['title']) ? $tabContent['title'] : false;
                            $price = $tabContent['price'] ? $tabContent['price'] : false;
                            $content = $tabContent['content'] ? $tabContent['content'] : false;
                            ?>
                            <div <?php echo $this->get_render_attribute_string($columns_attribute); ?> <?php echo empty($content) ? 'data-no-text="1"' : '' ?>>
                                <?php if (!empty($title) || !empty($price)) : ?>
                                    <div class="thmv-title-price-block">
                                        <?php if (!empty($title)): ?>
                                            <h4 class="thmv-tab-heading"><?php echo esc_html($title) ?></h4>
                                        <?php endif; ?>
                                        <?php if (!empty($price)): ?>
                                            <div class="thmv-tab-price price-tablet"><?php echo esc_html($price) ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($content)): ?>
                                    <div class="thmv-tab-text">
                                        <p><?php echo esc_html($content) ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($price)): ?>
                                    <div class="thmv-tab-price price-phone"><?php echo esc_html($price) ?></div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render tabs widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {
        
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new Themo_Widget_Tabs());
