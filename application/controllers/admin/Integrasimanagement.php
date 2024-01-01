<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Integrasimanagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Integrasi_model', 'integrasi');
    }

    public function wagw()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['wagw'] = $this->integrasi->wagw();
        $data['title'] = 'Integrasi WhatsApp';

        $api_response = $this->integrasi->get_profile();

        if ($api_response['status']) {
            $data['infodevice'] = $api_response;

            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/setting/wa');
            $this->load->view('admin/layouts/footer');
        } else {
            set_pesan('Error: ' . $api_response['reason'], false);
            redirect('admin/integrasimanagement/wagw');
        }
    }

    public function savewagw()
    {
        $data =
            [
                'link_send' => $this->input->post('link_send', true),
                'format_message' => $this->input->post('format_message', true),
                'link_qr' => $this->input->post('link_qr', true),
                'link_device' => $this->input->post('link_device', true)
            ];
        $this->db->update('wagw', $data);
        set_pesan('Berhasil update integrasi');
        redirect('admin/integrasimanagement/wagw');
    }

    public function generate_qr()
    {
        // Implementasikan logika untuk mendapatkan QR code dari API Foonte
        $wagw = $this->integrasi->wagw();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $wagw['link_qr'],
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
        // Kirim respons dalam bentuk JSON ke view
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function disconnect()
    {
        $wagw = $this->integrasi->wagw();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/disconnect',
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
        // Sebelum encode

        if ($response === false) {
            // Handle cURL error
            set_pesan('Error during cURL request: ' . curl_error($curl), false);
        } else {
            // Decode respons JSON
            $api_response = json_decode($response, true);

            if ($api_response && isset($api_response['status'])) {
                if ($api_response['status'] == true) {
                    set_pesan($api_response['detail']);
                } else {
                    set_pesan($api_response['detail'], false);
                }
            } else {
                set_pesan('Error decoding API response', false);
            }
        }

        curl_close($curl);

        redirect('admin/integrasimanagement/wagw');
    }
}
