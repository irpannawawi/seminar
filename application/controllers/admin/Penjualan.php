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

        $action = $this->input->post('action');
        $id = $this->input->post('id_transaksi');

        $this->form_validation->set_rules('status_transaksi', 'Status Transaksi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/penjualan/transaksi');
            $this->load->view('admin/layouts/footer');
        } else {
            if ($action == 'leader') {
                // Pengecekan apakah sudah ada data pada kolom 'events_id' berdasarkan 'user_id'
                $user_id = $this->input->post('user_id');
                // $role_id = $this->input->post('role_id');
                $events_id = $this->input->post('events_id', true);
                $existingPartnership = $this->db->get_where('partnership', ['user_id' => $user_id, 'events_id' => $events_id])->row_array();

                if (!$existingPartnership) {
                    // Jika belum ada, lakukan insert
                    $transaksi_status = $this->input->post('status_transaksi');
                    if ($transaksi_status == 'Lunas') {
                        // Insert ke tabel partnership jika status_transaksi adalah "Lunas"
                        $partnership = [
                            'role_id' => 2,
                            'user_id' => $user_id,
                            'events_id' => $events_id,
                            'kuota_tiket' => $this->input->post('tiket', true),
                        ];
                        $this->db->insert('partnership', $partnership);
                        $id_leader = $this->db->insert_id();
                    }

                    $transaksi = [
                        'status_transaksi' => $this->input->post('status_transaksi'),
                        'leader_id' => $id_leader,
                        'tiket' => $this->input->post('tiket', true)
                    ];
                    $this->db->where('id_transaksi', $id);
                    $this->db->update('transaksi', $transaksi);

                    set_pesan('Berhasil update transaksi!');
                    redirect('admin/penjualan/transaksi');
                } else {
                    // Jika sudah ada, tampilkan pesan atau lakukan aksi lain sesuai kebutuhan
                    set_pesan('Gagal update transaksi! Data sudah ada.', false);
                    redirect('admin/penjualan/transaksi');
                }
            }
        }
    }
}
