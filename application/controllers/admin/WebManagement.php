<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebManagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    // controllers/Admin.php

    public function info()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Info Website';

        $this->form_validation->set_rules('title_web', 'Judul Website', 'trim|required');
        $this->form_validation->set_rules('sub_title', 'Sub Judul Website', 'trim|required');
        $this->form_validation->set_rules('description_web', 'Deskripsi Website', 'trim|required');

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
                    $new_image = $this->upload->data();
                    $file_name = $new_image['file_name'];
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
                'logo_web'        => $file_name,
                'instagram'       => htmlspecialchars('https://', $this->input->post('instagram')),
                'facebook'        => htmlspecialchars('https://', $this->input->post('facebook'))
            ];

            $this->db->update('setting', $data);
            set_pesan('Berhasil update info website!');
            redirect('admin/webmanagement/info');
        }
    }

    public function wagw()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['wagw'] = $this->db->get('wagw')->result_array();
        $data['title'] = 'Integrasi WhatsApp';

        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('number', 'Nomor WhatsApp', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/setting/wa');
            $this->load->view('admin/layouts/footer');
        } else {
            $name_device = htmlspecialchars($this->input->post('name'));
            $number_device = htmlspecialchars($this->input->post('number'));

            $data = [
                'name' => $name_device,
                'number' => $number_device,
                'status' => 'disconnect',
                'date_expired' => time(),
                'date_created' => time(),
            ];

            $this->db->insert('wagw', $data);
            set_pesan('Perangkat berhasil ditambah!');
            redirect('admin/webmanagement/wagw');
        }
    }
}
