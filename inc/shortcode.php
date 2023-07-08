<?php

// function that runs when shortcode is called
function wpb_vin_shortcode() {
    ob_start();
    // Ваш код для обработки шорткода

    // Путь к файлу, который нужно подключить
    $file_path = plugin_dir_path(__FILE__) . '/vinView.php';

    // Подключаем файл с помощью require_once
    require_once $file_path;

    // Возвращаем содержимое, которое нужно отобразить

    // Ваш код для формирования содержимого
    $output = ob_get_clean();

    return $output;
}
// register shortcode
add_shortcode('vindecoder', 'wpb_vin_shortcode');
