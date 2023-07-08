<?php
add_action('wp_ajax_my_ajax_handler', 'my_ajax_handler');
add_action('wp_ajax_nopriv_my_ajax_handler', 'my_ajax_handler');
function my_ajax_handler()
{
    $api = '';
    $vin = $_POST['form_data'];
    // Выполните необходимую обработку данных

    if (!empty(get_option('my_plugin_option'))) {
        $api = get_option('my_plugin_option');
    }

    $curl = curl_init();


    curl_setopt_array($curl, [
        CURLOPT_URL => "https://vin-decoder19.p.rapidapi.com/vin_decoder_basic?vin=$vin",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: vin-decoder19.p.rapidapi.com",
            "X-RapidAPI-Key: $api"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);


    curl_close($curl);

    if ($err) {
        header('Content-Type: application/json');
        echo json_encode($err);
    } else {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    wp_die();
}
