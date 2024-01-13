<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Partner_model', 'partner');
        $this->load->model('Leader_model', 'leader');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Transaksi';

        // Handling search
        if ($this->input->post('search')) {
            $keyword = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword');
        }

        // Pagination config
        $config['total_rows'] = $this->leader->count_all_transaksi($keyword);
        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        // Get current page offset
        $data['start'] = $this->uri->segment(3);

        // Get transactions
        $data['transaksi'] = $this->leader->getTransaksiLeader($config['per_page'], $data['start'], $keyword);

        // Load views
        $this->load->view('leader/layouts/header', $data);
        $this->load->view('leader/layouts/navbar');
        $this->load->view('leader/layouts/sidebar');
        $this->load->view('leader/transaksi/transaksi', $data);
        $this->load->view('leader/layouts/footer');
    }

    public function search()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Tambah Transaksi';
        $keyword = $this->input->post('keyword');

        $data['transaksi'] = $this->leader->search_transaksi($keyword);
        $this->load->view('leader/layouts/header', $data);
        $this->load->view('leader/layouts/navbar');
        $this->load->view('leader/layouts/sidebar');
        $this->load->view('leader/transaksi/transaksi');
        $this->load->view('leader/layouts/footer');
    }

    public function add()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Tambah Transaksi';
        $data['events'] = $this->partner->getEventSB();

        $this->form_validation->set_rules('qty', 'Qty Tiket', 'required');
        $this->form_validation->set_rules('name', 'Nama Peserta', 'required');
        $this->form_validation->set_rules('nowa', 'Mail password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('domisili', 'Domisili', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('leader/layouts/header', $data);
            $this->load->view('leader/layouts/navbar');
            $this->load->view('leader/layouts/sidebar');
            $this->load->view('leader/transaksi/add');
            $this->load->view('leader/layouts/footer');
        } else {
            $partner = $this->db->get('partnership')->row_array();

            // Ambil nilai kuota_tiket dari database
            $kuota_tiket = $partner['kuota_tiket'];

            // Ambil nilai qty dari form
            $qty_requested = $this->input->post('qty');

            // Cek apakah kuota_tiket mencukupi
            if ($kuota_tiket >= $qty_requested) {
                $this->db->trans_start(); // Memulai transaksi database

                // Simpan data peserta ke dalam tabel 'peserta'
                $peserta_data = array(
                    'events_id' => $this->input->post('event'),
                    'name' => $this->input->post('name'),
                    'nowa' => $this->input->post('nowa'),
                    'email' => $this->input->post('email'),
                    'date_participate' => date('Y-m-d'),
                    'domisili' => $this->input->post('domisili')
                );
                $this->db->insert('peserta', $peserta_data);
                $peserta_id = $this->db->insert_id();

                // Mengenerate ID Transaksi
                $number = str_pad(rand(100000000000, 999999999999), 13);
                $idOrder = 'TS' . $number;

                // Ambil data transaksi dari form
                $transaksi_data = array(
                    'id_order' => $idOrder,
                    'peserta_id' => $peserta_id,
                    'events_id' => $this->input->post('event'),
                    'date_transaksi' => date('Y-m-d'),
                    'tiket' => $qty_requested,
                    'status_transaksi' => 'Lunas',
                    'by_order' => $this->session->role_id
                );

                // Simpan data transaksi ke dalam tabel 'transaksi'
                $this->db->insert('transaksi', $transaksi_data);

                // Update nilai kuota_tiket di tabel 'partnership'
                $this->db->where('id_leader', $partner['id_leader']);
                $this->db->set('kuota_tiket', 'kuota_tiket - ' . $qty_requested, FALSE);
                $this->db->update('partnership');

                $this->db->trans_complete(); // Menyelesaikan transaksi database

                if ($this->db->trans_status() === FALSE) {
                    // Jika terjadi kesalahan dalam transaksi, rollback
                    $this->db->trans_rollback();
                    set_pesan('Gagal tambah peserta');
                } else {
                    // Jika transaksi berhasil, commit
                    $this->db->trans_commit();
                    set_pesan('Berhasil tambah peserta');
                }

                redirect('leader/transaksi');
            } else {
                // Jika kuota_tiket tidak mencukupi, berikan pesan dan redirect
                set_pesan('Kuota tiket tidak mencukupi!', false);
                redirect('leader/transaksi/add');
            }
        }
    }
}
