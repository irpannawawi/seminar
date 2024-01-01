<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partnership extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Partner_model', 'partner');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['partner'] = $this->partner->get_partnership_data();
        $data['events'] = $this->partner->getEventSB();
        $data['title'] = 'Partnership';

        $this->form_validation->set_rules('kuota_tiket', 'Kuota Tiket', 'required|trim|numeric', [
            'numeric' => 'Tidak Boleh Input Selain Angka!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/partners');
            $this->load->view('admin/layouts/footer');
        } else {
            $this->_renewal();
        }
    }

    public function get_partnership_data($id_events)
    {
        $data['partner'] = $this->partner->get_partnership_by_event($id_events);

        header('Content-Type: application/json');
        echo json_encode($data['partner']);
    }

    private function _renewal()
    {
        // Jika validasi berhasil
        $id_leader = $this->input->post('id_leader', true);

        $leader_save = [
            'kuota_tiket' => htmlspecialchars($this->input->post('kuota_tiket', true)),
        ];

        $result_leader = [
            $this->db->where('id_leader', $id_leader),
            $this->db->update('partnership', $leader_save)
        ];

        if ($result_leader) {
            set_pesan('Kuota tiket berhasil diupdate');
        } else {
            set_pesan('Kuota tiket gagal diupdate', false);
        }
        redirect('admin/partnership');
    }
}
