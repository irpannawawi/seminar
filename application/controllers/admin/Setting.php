<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function info()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();
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
            $data = [
                'title_web' => $this->input->post('title_web'),
                'sub_title' => $this->input->post('sub_title'),
                'description_web' => $this->input->post('description_web'),
                'meta_google' => $this->input->post('meta_google'),
                'logo_web' => $this->input->post('logo_web'),
            ];
            $this->db->update('setting', $data);
            set_pesan('Berhasil update info website!');
            redirect('admin/setting/info');
        }
    }
}
