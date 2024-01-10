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
        // var_dump($data['transaksi']);
        // die;
        $data['title'] = 'Tiket';
        $data['status'] = [
            'Tertunda' => '<span class="badge badge-warning">Tertunda</span>',
            'Refund' => '<span class="badge badge-secondary">Refund</span>',
            'Lunas' => '<span class="badge badge-success">Lunas</span>',
            'Dibatalkan' => '<span class="badge badge-danger">Dibatalkan</span>',
            'Proses' => '<span class="badge badge-info">Proses</span>',
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

    public function buktiTf($id)
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $id_user =  $data['users']['id_user'];

        // Periksa apakah transaksi dengan ID tertentu ditemukan
        $data['transaksi'] = $this->Leader_model->getTransaksi($id_user, $id);
        $bukti_tf = $data['transaksi'][0]['bukti_tf'];

        if (!$data['transaksi']) {
            $error = "Transaksi tidak ditemukan.";
            set_pesan($error, false);
            redirect('leader/tiket');
        }

        $config['upload_path'] = FCPATH . 'assets/backend/dist/img/bukti_tf/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2014;
        $config['file_name'] = uniqid() . date('Y-m-d');

        $this->upload->initialize($config);

        if ($this->upload->do_upload('bukti_tf')) {
            $old_image = $bukti_tf;
            if ($old_image && file_exists($config['upload_path'])) {
                unlink(FCPATH . 'assets/backend/dist/img/bukti_tf/' . $old_image);
            }
            $new_image = $this->upload->data('file_name');

            $this->db->set('bukti_tf', $new_image);
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi');
        } else {
            $error = $this->upload->display_errors();
            set_pesan($error, false);
            redirect('leader/tiket');
        }

        set_pesan('Bukti transfer berhasil diupload');
        redirect('leader/tiket');
    }
}
