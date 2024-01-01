<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekening extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['rekening'] = $this->db->get('rekening')->result_array();
        $data['title'] = 'Rekening Setting';

        // get bank
        $data_json = file_get_contents('assets/backend/dist/js/bank.json');
        $bank = json_decode($data_json, true);
        $data['bank'] = $bank;

        $this->form_validation->set_rules('name_rekening', 'Nama Rekening', 'trim|required');
        $this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'trim|required');
        $this->form_validation->set_rules('name_bank', 'Nama Bank', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/setting/rekening');
            $this->load->view('admin/layouts/footer');
        } else {
            $data = [
                'name_rekening' => htmlspecialchars($this->input->post('name_rekening', true)),
                'nomor_rekening' => htmlspecialchars($this->input->post('nomor_rekening', true)),
                'name_bank' => $this->input->post('name_bank', true),
                'code' => $this->input->post('code', true),
                'image' => 'mastercard.png',
            ];

            $this->db->insert('rekening', $data);
            set_pesan('Berhasil tambah rekening');
            redirect('admin/rekening');
        }
    }

    public function editrekening()
    {
        $this->form_validation->set_rules('name_rekening', 'Nama Rekening', 'trim|required');
        $this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header');
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/setting/rekening');
            $this->load->view('admin/layouts/footer');
        } else {
            $id = $this->input->post('id_rekening');
            $data = [
                'name_rekening' => htmlspecialchars($this->input->post('name_rekening', true)),
                'nomor_rekening' => htmlspecialchars($this->input->post('nomor_rekening', true)),
                'name_bank' => $this->input->post('name_bank', true),
                'image' => 'mastercard.png',
            ];

            $this->db->where('id_rekening', $id);
            $this->db->update('rekening', $data);
            set_pesan('Berhasil edit rekening');
            redirect('admin/rekening');
        }
    }

    public function deleterekening($id)
    {
        if (!$this->session->email) {
            redirect('login');
        }

        $this->db->where('id_rekening', $id);
        $this->db->delete('rekening');
        set_pesan('Berhasil hapus rekening');
        redirect('admin/rekening');
    }
}
