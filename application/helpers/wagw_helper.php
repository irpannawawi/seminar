<?php

if (!function_exists('sendWhatsapp')) {
    function sendWhatsapp($whatsapp, $message)
    {
        // Dapatkan instance CI
        $CI = &get_instance();

        // Dapatkan konfigurasi wagw dari integrasi
        $wagw = $CI->integrasi->wagw();

        // Set URL dan data untuk cURL
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $wagw['link_send'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $whatsapp,
                'message' => $message,
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $wagw['token']
            ),
        ));

        // Lakukan request cURL
        $response = curl_exec($curl);

        if ($response === false) {
            // Handle cURL error
            set_pesan('Error during cURL request: ' . curl_error($curl), false);
        } else {
            // Decode respons JSON
            $api_response = json_decode($response, true);

            if ($api_response['status'] == true) {
                log_message('debug', 'WhatsApp message sent successfully');
                set_pesan($api_response['detail']);
            } else {
                log_message('error', 'Failed to send WhatsApp message');
                set_pesan('Kirim gagal: ' . $api_response['reason'], false);
            }
        }

        curl_close($curl);
    }
}
