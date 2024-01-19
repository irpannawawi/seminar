<?php defined('BASEPATH') or exit('No direct script access allowed');

function generateQRCode($data, $filename)
{
    $CI = &get_instance();
    $CI->load->library('ciqrcode');

    $path = 'assets/backend/dist/img/peserta_offline/';
    $file_path = $path . $filename . '.png';

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $params['data'] = $data;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = $file_path;

    $CI->ciqrcode->generate($params);

    return $file_path;
}
