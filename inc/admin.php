<?php

// Register settings
add_action('admin_init', 'my_plugin_register_settings');

function my_plugin_register_settings() {
    register_setting(
        'my-plugin-settings-group', // Option group (must match the settings_fields() call)
        'my_plugin_option' // Option name
    );

    add_settings_section(
        'my-plugin-settings-section',
        'Основные настройки',
        'my_plugin_settings_section_callback',
        'my-plugin-settings'
    );

    add_settings_field(
        'my-plugin-option-field',
        'Опция',
        'my_plugin_option_field_callback',
        'my-plugin-settings',
        'my-plugin-settings-section'
    );
}

// Render settings page
function my_plugin_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Настройки My Plugin</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my-plugin-settings-group'); // Option group
            do_settings_sections('my-plugin-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Output settings section description
function my_plugin_settings_section_callback() {
    echo '<p>Описание настроек</p>';
}

// Output settings field
function my_plugin_option_field_callback() {
    $current_user = wp_get_current_user();
    $option = get_user_meta($current_user->ID, 'my_plugin_option', true);
    echo '<input type="text" name="my_plugin_option" value="' . esc_attr($option) . '">';
}

// Add options page to admin menu
add_action('admin_menu', 'my_plugin_add_settings_page');

function my_plugin_add_settings_page() {
    add_menu_page(
        'Настройки My Plugin',
        'My Plugin',
        'manage_options',
        'my-plugin-settings',
        'my_plugin_render_settings_page'
    );
}

// Whitelist options
add_filter('option_page_capability_my-plugin-settings-group', 'my_plugin_settings_capability');

function my_plugin_settings_capability($capability) {
    return 'manage_options';
}


// Сохраняем настройки в usermeta
add_action('admin_init', 'my_plugin_save_settings');

function my_plugin_save_settings() {
    if (isset($_POST['my_plugin_option'])) {
        $current_user = wp_get_current_user();
        $option_value = sanitize_text_field($_POST['my_plugin_option']);
        update_user_meta($current_user->ID, 'my_plugin_option', $option_value);
    }
}

