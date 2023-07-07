<?php


// Добавляем настройки в меню админки
add_action('admin_menu', 'my_plugin_add_settings_page');

function my_plugin_add_settings_page() {
    add_menu_page(
        'Enter your Api Rapid Vin decode',
        'Vin API',
        'manage_options',
        'my-plugin-settings',
        'my_plugin_render_settings_page',
        'dashicons-admin-generic',
        99
    );
}

// Создаем страницу настроек
function my_plugin_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Enter your Api Rapid Vin decode</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my-plugin-settings');
            do_settings_sections('my-plugin-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Регистрируем настройки
add_action('admin_init', 'my_plugin_register_settings');

function my_plugin_register_settings() {
    register_setting(
        'my-plugin-settings',
        'my_plugin_option',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    add_settings_section(
        'my-plugin-settings-section',
        'General Settings',
        'my_plugin_settings_section_callback',
        'my-plugin-settings'
    );

    add_settings_field(
        'my-plugin-option-field',
        'Api Rapid',
        'my_plugin_option_field_callback',
        'my-plugin-settings',
        'my-plugin-settings-section'
    );
}

// Выводим описание секции настроек
function my_plugin_settings_section_callback() {
    echo '<p>You can find the api in rapid api.</p>';
}

// Выводим поле настроек
function my_plugin_option_field_callback() {
    $option = get_option('my_plugin_option');
    echo '<input type="text" name="my_plugin_option" value="' . esc_attr($option) . '">';
}
