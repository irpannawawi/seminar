<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Events_model', 'events');
        is_logged_in();
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->events->getEventSB();

        $data['title'] = 'Events';
        $data['rekening'] = $this->db->get('rekening')->result_array();

        $this->form_validation->set_rules('jml_tiket', 'Jumlah Tiket', 'numeric|trim|required');
        $this->form_validation->set_rules('bank_transfer', 'Bank Transfer', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('leader/layouts/header', $data);
            $this->load->view('leader/layouts/navbar');
            $this->load->view('leader/layouts/sidebar');
            $this->load->view('leader/events');
            $this->load->view('leader/layouts/footer');
        } else {
            $id_events = $this->input->post('id_events');
            $jmlTiket = $this->input->post('jml_tiket');

            // Cek ketersediaan tiket
            $availableTickets = $this->db->get_where('events', ['id_events' => $id_events])->row()->sisa_kuota;

            if ($availableTickets >= $jmlTiket) {
                // Jika tiket tersedia, lanjutkan transaksi
                // Mengenerate ID Transaksi
                $number = str_pad(rand(100000000000, 999999999999), 13);
                $idOrder = 'TS' . $number;

                $id_user = $data['users']['id_user'];
                $price = $this->input->post('price');
                $nominal = $price * $jmlTiket;

                $save = [
                    'id_order' => $idOrder,
                    'user_id' => $id_user,
                    'bank_transfer' => $this->input->post('bank_transfer'),
                    'events_id' => $id_events,
                    'tiket' => $jmlTiket,
                    'nominal' => $nominal,
                    'date_transaksi' => date('Y-m-d'),
                    'status_transaksi' => 'Tertunda',
                    'by_order' => 1
                ];

                $this->db->insert('transaksi', $save);
                set_pesan('Berhasil request, Silahkan Bayar!');
                redirect('leader/tiket');
            } else {
                // Jika tiket tidak tersedia, berikan pesan
                set_pesan('Maaf, tiket tidak tersedia.', false);
                redirect('leader/events');
            }
        }
    }
}
