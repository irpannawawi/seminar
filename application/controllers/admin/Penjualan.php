<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Penjualan_model', 'penjualan');
    }

    public function transaksi()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Transaksi';
        $data['transaksi'] = $this->penjualan->get_data();
        $data['status'] = [
            'Tertunda' => '<span class="badge badge-warning">Tertunda</span>',
            'Refund' => '<span class="badge badge-secondary">Refund</span>',
            'Lunas' => '<span class="badge badge-success">Lunas</span>',
            'Dibatalkan' => '<span class="badge badge-danger">Dibatalkan</span>',
            'Proses' => '<span class="badge badge-info">Proses</span>',
        ];

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/penjualan/transaksi');
        $this->load->view('admin/layouts/footer');
    }
}
