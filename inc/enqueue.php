<?php
// Подключаем CSS-файл плагина
function my_plugin_enqueue_styles()
{
    $plugin_dir = plugin_dir_url(dirname(__FILE__));
    wp_enqueue_style('vin-style', $plugin_dir . 'front/assets/css/style.css');
}

add_action('wp_enqueue_scripts', 'my_plugin_enqueue_styles');
