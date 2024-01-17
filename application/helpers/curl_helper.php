<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('curl_request')) {
    /**
     * Mengirim permintaan cURL dengan metode tertentu
     *
     * @param string $url     URL tujuan
     * @param string $method  Metode HTTP (GET, POST, PUT, DELETE, dll.)
     * @param array  $data    Data yang akan dikirim (opsional)
     * @param array  $headers Header permintaan (opsional)
     * @return mixed
     */
    function curl_request($url, $method = 'GET', $data = array(), $headers = array())
    {
        $ci = &get_instance();
        $ci->load->library('curl');

        $options = array(
            CURLOPT_URL             => $url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_ENCODING        => '',
            CURLOPT_USERAGENT       => 'CodeIgniter cURL Request',
            CURLOPT_AUTOREFERER     => true,
            CURLOPT_CONNECTTIMEOUT  => 120,
            CURLOPT_TIMEOUT         => 120,
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_CUSTOMREQUEST   => strtoupper($method),
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_HTTPHEADER      => $headers,
        );

        $ci->curl->initialize($options);
        $response = $ci->curl->execute();
        $ci->curl->close();

        return $response;
    }
}
