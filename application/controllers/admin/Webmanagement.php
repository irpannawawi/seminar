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
                $config['file_name'] = get_setting('title_web') . uniqid();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('logo_web')) {
                    $old_logo_path = 'assets/backend/dist/img/' . get_setting('logo_Web');
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
            $this->db->update('setting', $data);
            $this->db->update('wagw', $wagw);
            set_pesan('Berhasil update info website!');
            redirect('admin/webmanagement/info');
        }
    }

    public function pesan()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['setting'] = $this->integrasi->setting();
        $data['title'] = 'Pesan Setting Pendaftaran';

        if ($this->input->post()) {
            // Jika ada input post, lakukan update
            $update_data = [
                'sukses_bayar' => $this->input->post('sukses_bayar', true),
                'sukses_bayar_email' => $this->input->post('sukses_bayar_email', true),
            ];
            $this->db->update('setting', $update_data);
            set_pesan('Berhasil update format pesan');
            redirect('admin/webmanagement/pesan');
        } else {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/setting/pesan');
            $this->load->view('admin/layouts/footer');
        }
    }

    public function other()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Setting Website';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/setting/other');
        $this->load->view('admin/layouts/footer');
    }
}
