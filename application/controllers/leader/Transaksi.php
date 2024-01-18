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
        $this->load->model('Integrasi_model', 'integrasi');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Transaksi';

        // Handling search
        $keyword = $this->input->post('keyword');

        // Pagination config
        $config['total_rows'] = $this->leader->count_all_transaksi($keyword);
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        // Get current page offset
        $data['offset'] = $this->uri->segment(4);
        $limit = $config['per_page'];

        // Get transactions
        $data['transaksi'] = $this->leader->getTransaksiLeader($limit, $data['offset'], $keyword);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('leader/layouts/header', $data);
        $this->load->view('leader/layouts/navbar');
        $this->load->view('leader/layouts/sidebar');
        $this->load->view('leader/transaksi/transaksi', $data);
        $this->load->view('leader/layouts/footer');
    }

    public function add()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Tambah Transaksi';
        $user_id = $this->session->id_user;
        $data['events'] = $this->leader->getEventTransaksi($user_id);
        $setting = $this->db->get('setting')->row_array();

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
                $nowa = $this->input->post('nowa');
                $name = $this->input->post('name');
                $event_id = $this->input->post('event');
                $email = $this->input->post('email');
                $domisili = $this->input->post('domisili');

                $peserta_data = array(
                    'events_id' => $event_id,
                    'name' => $name,
                    'nowa' => $nowa,
                    'email' => $email,
                    'date_participate' => date('Y-m-d'),
                    'domisili' => $domisili
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
                    'events_id' => $event_id,
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
                $this->db->set('tiket_terjual', 'tiket_terjual + ' . $qty_requested, FALSE);
                $this->db->update('partnership');

                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    set_pesan('Gagal tambah peserta', false);
                } else {
                    $this->db->trans_commit();
                    set_pesan('Berhasil tambah peserta');
                }

                // Memastikan data ditemukan
                $query = $this->db->get_where('events', array('id_events' => $event_id));
                if ($query->num_rows() > 0) {
                    $event_title = $query->row()->title;
                    $waktu = $query->row()->date_start;
                    $type_event = $query->row()->type_event; // Menambahkan ini
                }
                $whatsapp = '';

                // Menambahkan informasi ke variabel WhatsApp
                $whatsapp = $nowa . '|' . $name . '|' . $event_title . '|' . $idOrder . '|' . $waktu . '|' . $qty_requested;

                if ($type_event == 'offline') {
                    sendWhatsappQR($whatsapp, 'Wa qr');
                } else {
                    sendWhatsapp($whatsapp, $setting['sukses_bayar']);
                    send_email($email, $event_title);
                }

                redirect($_SERVER['HTTP_REFERER']);
            } else {
                set_pesan('Kuota tiket tidak mencukupi!', false);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}
