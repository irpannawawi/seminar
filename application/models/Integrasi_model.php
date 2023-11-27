<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Integrasi_model extends CI_Model
{
    public function wagw()
    {
        return $this->db->get('wagw')->row_array();
    }
    public function setting()
    {
        return $this->db->get('setting')->row_array();
    }

    public function get_profile()
    {
        $wagw = $this->db->get('wagw')->row_array();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $wagw['link_device'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $wagw['token']
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // Decode respons JSON
        $api_response = json_decode($response, true);

        return $api_response;
    }
}
