<?php
// Подключаем CSS-файл плагина
function my_plugin_enqueue_styles()
{
    $plugin_dir = plugin_dir_url(dirname(__FILE__));
    wp_enqueue_style('vin-style', $plugin_dir . 'front/assets/css/style.css');
    wp_enqueue_script('main-script', $plugin_dir . 'front/assets/js/main.js',array('jquery'));

    // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
    wp_localize_script( 'main-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
}

add_action('wp_enqueue_scripts', 'my_plugin_enqueue_styles');
