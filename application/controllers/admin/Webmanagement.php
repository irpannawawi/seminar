<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webmanagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Integrasi_model', 'integrasi');
    }

    // controllers/Admin.php

    public function info()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['wagw'] = $this->integrasi->wagw();
        $data['title'] = 'Info Website';

        $this->form_validation->set_rules('title_web', 'Judul Website', 'trim|required');
        $this->form_validation->set_rules('sub_title', 'Sub Judul Website', 'trim|required');
        $this->form_validation->set_rules('description_web', 'Deskripsi Website', 'trim|required');
        $this->form_validation->set_rules('token_wagw', 'Token WAGW', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/setting/info');
            $this->load->view('admin/layouts/footer');
        } else {

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['logo_web']['name'];

            if ($upload_image) {
                $config['upload_path']   = 'assets/backend/dist/img/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = 2048; // 2MB
                $config['file_name'] = get_management('title_web') . uniqid();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('logo_web')) {
                    $old_logo_path = 'assets/backend/dist/img/' . get_management('logo_Web');
                    if (file_exists($old_logo_path)) {
                        unlink($old_logo_path);
                    }
                    $upload_data = $this->upload->data('file_name');
                    $this->db->set('logo_web', $upload_data);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    set_pesan($error, false);
                }
            }
            $data = [
                'title_web'       => htmlspecialchars($this->input->post('title_web')),
                'sub_title'       => htmlspecialchars($this->input->post('sub_title')),
                'description_web' => $this->input->post('description_web'),
                'meta_google'     => $this->input->post('meta_google'),
                'instagram'       => $this->input->post('instagram'),
                'facebook'        => $this->input->post('facebook')
            ];
            $wagw = [
                'token' => $this->input->post('token_wagw', true)
            ];
            $this->db->update('wagw', $wagw);
            $this->db->update('setting', $data);
            set_pesan('Berhasil update info website!');
            redirect('admin/webmanagement/info');
        }
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
            redirect('admin/webmanagement/wagw');
        }
    }

    public function savewagw()
    {
        $data =
            [
                'link_send' => $this->input->post('link_send', true),
                'link_qr' => $this->input->post('link_qr', true),
                'link_device' => $this->input->post('link_device', true)
            ];
        $this->db->update('wagw', $data);
        set_pesan('Berhasil update integrasi');
        redirect('admin/webmanagement/wagw');
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

            if ($api_response['status'] == true) {
                set_pesan('Disconnect berhasil!');
            } else {
                set_pesan('Disconnect gagal: ' . $api_response['detail'], false);
            }
        }

        curl_close($curl);

        redirect('admin/webmanagement/wagw');
    }

    public function sendMessage()
    {
    }
}
