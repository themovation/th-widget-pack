<script>
    var thwidgetpack_options_megamenu_markup = `
    <fieldset class="menu-settings-group thwidgetpack-options-megamenu" id="thwidgetpack-options-megamenu">
        <legend class="menu-settings-group-name attr-text-bold"><?php esc_html_e( "Widget Pack Megamenu", 'th-widget-pack' ); ?></legend>
        <div class="menu-settings-input checkbox-input">
        <input name="is_enabled" type="checkbox" <?php checked((isset($data['is_enabled']) ? $data['is_enabled'] : ''), '1'); ?> id="thwidgetpack-menu-metabox-input-is-enabled" class="thwidgetpack-menu-is-enabled" value="1">
            <label for="thwidgetpack-menu-metabox-input-is-enabled"><?php esc_html_e( "Enable this menu for Megamenu content", 'th-widget-pack' ); ?></label>
        </div>
    </fieldset>
    `;

    var thwidgetpack_megamenu_nonce = `<?php echo wp_create_nonce('wp_rest'); ?>`;

</script>