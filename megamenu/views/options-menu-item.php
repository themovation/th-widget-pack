<div class="attr-modal attr-fade" id="attr_menu_control_panel_modal" tabindex="-1" role="dialog">
    <div class="attr-modal-dialog attr-modal-dialog-centered" role="document">
        <div class="attr-modal-content ekit_menu_modal_content">
            <div class="attr-modal-header">
            <ul class="tb-nav tb-nav-tabs ekit_menu_control_nav" role="tablist">
                    <li role="presentation" id="attr_content_nav" class="attr-active"><a class="attr-nav-link" href="#attr_content_tab" aria-controls="attr_content_tab"
                            role="tab" data-attr-toggle="tab"><?php esc_html_e('Content', 'th-widget-pack'); ?></a></li>
                    <li role="presentation" id="attr_badge_nav"><a class="attr-nav-link" href="#attr_vertical_menu_setting_tab" aria-controls="attr_vertical_menu_setting_tab"
                            role="tab" data-attr-toggle="tab"><?php esc_html_e('Settings', 'th-widget-pack'); ?></a></li>
                </ul>
            </div>
            <div class="attr-modal-body ekit-wid-con">
                <div class="attr-tab-content">
                    <div role="tabpanel" class="attr-tab-pane attr-active" id="attr_content_tab">
                        <?php if(defined( 'ELEMENTOR_VERSION' )): ?>
                        <div class="switch-wrapper">
                            <input type="checkbox" value="1" id="thwidgetpack-menu-item-enable" />
                            <label for="thwidgetpack-menu-item-enable"><span><em></em></span></label>
                        </div>
                        <div id="thwidgetpack-menu-builder-warper">
                            <small
                                class="thwidgetpack-menu-mega-submenu enabled_item"><?php esc_html_e('Activated', 'th-widget-pack'); ?></small>
                            <small
                                class="thwidgetpack-menu-mega-submenu disabled_item"><?php esc_html_e('Deactivated', 'th-widget-pack'); ?></small>

                            <button disabled type="button" id="thwidgetpack-menu-builder-trigger"
                                class="thwidgetpack-menu-elementor-button button" data-attr-toggle="modal"
                                data-target="#thwidgetpack-menu-builder-modal">
                                <img src="<?php echo THEMO_URL . 'megamenu/assets/images/elementor-icon.png'; ?>"
                                    alt="Widget Pack megamenu" />
                                <?php esc_html_e('Edit Mega Menu', 'th-widget-pack'); ?>
                            </button>

                            <div id="mobile_submenu_content_type" class="widgetpack-labal widgetpack-labal-container">
                                <strong><?php esc_html_e('Mobile Submenu:', 'th-widget-pack'); ?></strong>
                                <span><input type="radio" name="content_type" checked value="builder_content"> <?php esc_html_e('builder content', 'th-widget-pack'); ?></span>
                                <span><input type="radio" name="content_type" value="submenu_list"> <?php esc_html_e('wp submenu list', 'th-widget-pack'); ?></span>
                            </div>
                        </div>
                        <?php else: ?>
                        <p class="no-elementor-notice">
                            <?php esc_html_e( 'This plugin requires Elementor page builder to edt megamenu items content', 'th-widget-pack' ); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div role="tabpanel" class="attr-tab-pane" id="attr_icon_tab">
                        <table class="option-table widgetpack-labal-container">
                            <tbody>
                                <tr>
                                    <td><strong><?php esc_html_e('Choose icon color', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text" value="#bada55" class="thwidgetpack-menu-wpcolor-picker"
                                            id="thwidgetpack-menu-icon-color-field" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><?php esc_html_e('Select icon', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright">
                                        <select id="thwidgetpack-menu-icon-field" class="thwidgetpack-menu-icon-picker">
                                            <option value=""><?php esc_html_e('No icon', 'th-widget-pack'); ?></option>
                                            <?php
                                    // foreach( self::get_icons() as $icon_class){
                                    //     echo "<option value='$icon_class'>'$icon_class'</option>";
                                    // }
                                ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="attr-tab-pane" id="attr_badge_tab">
                        <table class="option-table widgetpack-labal widgetpack-labal-container">
                            <tbody>
                                <tr>
                                    <td><strong><?php esc_html_e('Badge text', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text"
                                            placeholder="<?php esc_html_e('Badge Text', 'th-widget-pack'); ?>"
                                            id="thwidgetpack-menu-badge-text-field" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong><?php esc_html_e('Choose badge color', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text" class="thwidgetpack-menu-wpcolor-picker" value="#ffffff"
                                            id="thwidgetpack-menu-badge-color-field" />
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong><?php esc_html_e('Choose badge background', 'th-widget-pack'); ?></strong>
                                    </td>
                                    <td class="alignright">
                                        <input type="text" class="thwidgetpack-menu-wpcolor-picker" value="#bada55"
                                            id="thwidgetpack-menu-badge-background-field" />
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="attr-tab-pane" id="attr_vertical_menu_setting_tab">
                        <table class="option-table">
                            <tbody class="xs_menu_settings_panel">
                                <tr id="xs_megamenu_width_type">
                                    <td><strong><?php esc_html_e('Width:', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright ekit_width_lists">
                                        <input type="radio" name="width_type" id="width_type_default" value="default_width" checked>
                                        <label for="width_type_default"><?php esc_html_e('Default', 'th-widget-pack'); ?></label>
                                        <input type="radio" id="width_type_full" name="width_type" value="full_width">
                                        <label for="width_type_full"><?php esc_html_e('Full', 'th-widget-pack'); ?></label>
                                        <input type="radio" id="width_type_custom" name="width_type" value="custom_width">
                                        <label for="width_type_custom"><?php esc_html_e('Custom', 'th-widget-pack'); ?></label>
                                    </td>
                                </tr>
                                <tr class="menu-width-container">
                                    <td><strong><?php esc_html_e('Menu Width', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="text" placeholder="<?php esc_html_e('750px', 'th-widget-pack'); ?>" id="thwidgetpack-menu-vertical-menu-width-field" />
                                    </td>
                                </tr>
                                <tr id="vertical_megamenu_position_type">
                                    <td><strong><?php esc_html_e('Position:', 'th-widget-pack'); ?></strong></td>
                                    <td class="alignright">
                                        <input type="radio" id="position_type_top" name="position_type" value="top_position">
                                        <label for="position_type_top"><?php esc_html_e('Default', 'th-widget-pack'); ?></label>
                                        <input type="radio" name="position_type" id="position_type_relative" checked value="relative_position">
                                        <label for="position_type_relative"><?php esc_html_e('Relative', 'th-widget-pack'); ?></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="attr-modal-footer">
                <input type="hidden" id="thwidgetpack-menu-modal-menu-id">
                <input type="hidden" id="thwidgetpack-menu-modal-menu-has-child">
                <div class="clearfix ekit-modal-controls">
                    <div class="left-content">
                        <button class="btn-modal-close" type="button" data-dismiss="modal">
                            <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                                <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="right-content">
                        <span class='spinner'></span>
                        <?php echo get_submit_button(esc_html__('Save', 'th-widget-pack'), 'thwidgetpack-menu-item-save button-primary alignright','', false); ?>
                    </div>
                </div>
            </div>
            <span id="thwidgetpack-menu-modal-spinner" class='spinner'></span>
        </div>
    </div>
</div>

<div class="attr-modal attr-fade" id="thwidgetpack-menu-builder-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="attr-modal-dialog attr-modal-dialog-centered" role="document">
        <div class="attr-modal-content">
            <div class="attr-modal-body">
                <button class="ekit_close" type="button" data-dismiss="modal"><svg width="20" height="20"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <line fill="none" stroke="#fff" stroke-width="1.4" x1="1" y1="1" x2="19" y2="19"></line>
                        <line fill="none" stroke="#fff" stroke-width="1.4" x1="19" y1="1" x2="1" y2="19"></line>
                    </svg></button>
                <iframe id="thwidgetpack-menu-builder-iframe" src="" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>