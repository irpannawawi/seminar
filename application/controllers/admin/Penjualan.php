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
        // $data['transaksi'] = $this->penjualan->getPenjualan();

        // Handling search
        $keyword = $this->input->post('keyword');

        // Pagination config
        $config['base_url'] = base_url('admin/penjualan/transaksi');
        $config['total_rows'] = $this->penjualan->countAllTransaksi($keyword);
        $config['per_page'] = 2;

        $this->pagination->initialize($config);

        // Get current page offset
        $data['offset'] = $this->uri->segment(4);
        $limit = $config['per_page'];

        // Get transactions
        $data['transaksi'] = $this->penjualan->getTransaksiLeader($limit, $data['offset'], $keyword);
        $data['pagination'] = $this->pagination->create_links();

        $action = $this->input->post('action');
        $this->form_validation->set_rules('status_transaksi', 'Status Transaksi', 'trim|required');
        $this->form_validation->set_rules('tiket', 'Tiket', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/penjualan/transaksi');
            $this->load->view('admin/layouts/footer');
        } else {
            $id_transaksi = $this->input->post('id_transaksi');
            $kuota_tiket = $this->input->post('tiket', true);
            $status_transaksi = $this->input->post('status_transaksi');
            $user_id = $this->input->post('user_id');
            // $role_id = $this->input->post('role_id');
            $events_id = $this->input->post('events_id', true);

            if ($action == 'leader') {
                $existingPartnership = $this->db->get_where('partnership', ['user_id' => $user_id, 'events_id' => $events_id])->row_array();

                if (!$existingPartnership) {
                    if ($status_transaksi == 'Lunas') {
                        $partnership = [
                            'role_id' => 2,
                            'user_id' => $user_id,
                            'events_id' => $events_id,
                            'kuota_tiket' => $kuota_tiket,
                            'tiket_terjual' => 0
                        ];
                        $this->db->insert('partnership', $partnership);
                        $id_leader = $this->db->insert_id();
                    }
                } else {
                    // Jika partnership sudah ada, tambahkan $kuota_tiket ke nilai yang sudah ada
                    $new_kuota_tiket = $existingPartnership['kuota_tiket'] + $kuota_tiket;

                    // Update nilai kuota_tiket di tabel partnership
                    $this->db->where('id_leader', $existingPartnership['id_leader']);
                    $this->db->update('partnership', ['kuota_tiket' => $new_kuota_tiket]);

                    $id_leader = $existingPartnership['id_leader'];
                }

                $transaksi = [
                    'status_transaksi' => $status_transaksi,
                    'leader_id' => $id_leader,
                    'tiket' => $kuota_tiket
                ];
                $this->db->where('id_transaksi', $id_transaksi);
                $this->db->update('transaksi', $transaksi);

                set_pesan('Berhasil update transaksi!');
                redirect('admin/penjualan/transaksi');
            }
        }
    }

    public function update_trx($trxId)
    {
        $status = $this->input->post('status_transaksi');
        $trx = $this->db->where('id_order', $trxId)
        ->set('status_transaksi', $status)
        ->update('transaksi');
        return redirect('/admin/penjualan/transaksi');
    }
}
