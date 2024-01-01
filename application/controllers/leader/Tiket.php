<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Leader_model');
    }
    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $id_user =  $data['users']['id_user'];
        $data['transaksi'] = $this->Leader_model->getTransaksi($id_user);
        $data['title'] = 'Tiket';
        $data['status'] = [
            'Tertunda' => '<span class="badge badge-warning">Tertunda</span>',
            'Refund' => '<span class="badge badge-info">Refund</span>',
            'Lunas' => '<span class="badge badge-success">Lunas</span>',
            'Dibatalkan' => '<span class="badge badge-danger">Dibatalkan</span>',
        ];

        $this->load->view('leader/layouts/header', $data);
        $this->load->view('leader/layouts/navbar');
        $this->load->view('leader/layouts/sidebar');
        $this->load->view('leader/tiket');
        $this->load->view('leader/layouts/footer');
    }

    public function deleteTiket($id)
    {
        if (!$this->session->email) {
            redirect('login');
        }

        $update = [
            'status_transaksi' => 'Dibatalkan'
        ];

        $this->db->where('id_order', $id);
        $result = $this->db->update('transaksi', $update);

        if ($result) {
            set_pesan('Event berhasil dibatalkan.');
        } else {
            set_pesan('Event gagal dibatalkan.', false);
        }

        // Redirect ke halaman kategori
        redirect('leader/tiket');
    }
}
