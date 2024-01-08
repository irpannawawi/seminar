<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Events_model');
    }

    public function detail($id_event, $slug)
    {
        $data['event'] = $this->db->get_where('events', ['id_events' => $id_event, 'slug' => $slug])->row_array();
        if (!$data['event']) {
            show_404();
        }
        $data['title'] = $data['event']['title'];

        // Konversi nilai category_id dari JSON ke array
        $categoryIds = json_decode($data['event']['id_category']);

        // Ambil nama kategori berdasarkan category_id
        $this->db->select('name_category');
        $this->db->from('category');
        $this->db->where_in('id_category', $categoryIds);
        $query = $this->db->get();

        // Ambil hasil query
        $categories = $query->result();

        // Simpan hasil ke dalam data event
        $data['event']['categories'] = $categories;

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/events/event_detail');
        $this->load->view('frontend/layout/footer');
    }

    public function checkout()
    {
        $data['title'] = 'Checkout';

        // Ambil data dari URL
        $eventId = $this->input->get('id_events');
        $quantity = $this->input->get('quantity');

        // Validasi data, jika kosong redirect ke halaman lain atau berikan pesan error
        if (empty($eventId) || empty($quantity)) {
            redirect('/'); // Ganti dengan URL halaman lain jika diperlukan
        }

        // Ambil data event dari model berdasarkan $eventId
        $data['event'] = $this->db->get_where('events', ['id_events' => $eventId])->row_array();
        $data['rekening'] = $this->db->get('rekening')->result_array();

        // Passing data ke view
        $data['quantity'] = $quantity;
        $data['subtotal'] = $data['event']['price'] * $data['quantity'];

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap harus diisi.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', [
            'required' => 'Email harus diisi.',
            'valid_email' => 'Email tidak valid'
        ]);
        $this->form_validation->set_rules('nowa', 'No WhatsApp', 'required|numeric|max_length[13]|min_length[11]', [
            'required' => 'No WhatsApp harus diisi.',
            'numeric' => 'No WhatsApp harus berisi angka',
            'max_length' => 'No WhatsApp harus 11 - 13 angka',
            'min_length' => 'No WhatsApp harus 11 - 13 angka',
        ]);
        $this->form_validation->set_rules('domisili', 'Domisili', 'required|trim', [
            'required' => 'Domisili harus diisi.'
        ]);
        $this->form_validation->set_rules('bank', 'Bank', 'required|trim', [
            'required' => 'Metode Pembayaran wajib dipilih!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('frontend/layout/header', $data);
            $this->load->view('frontend/events/checkout');
            $this->load->view('frontend/layout/footer');
        } else {
            // Ambil data peserta dari form
            $peserta_data = array(
                'events_id' => $this->input->post('events_id'),
                'name' => $this->input->post('name'),
                'nowa' => $this->input->post('nowa'),
                'email' => $this->input->post('email'),
                'date_participate' => date('Y-m-d'),
                'domisili' => $this->input->post('domisili')
            );

            // Simpan data peserta ke dalam tabel 'peserta'
            $this->db->insert('peserta', $peserta_data);
            $peserta_id = $this->db->insert_id(); // Ambil ID peserta yang baru saja diinsert


            // Mengenerate ID Transaksi
            $number = str_pad(rand(100000000000, 999999999999), 13);
            $idOrder = 'TS' . $number;


            // Ambil data transaksi dari form
            $transaksi_data = array(
                'id_order' => $idOrder,
                'peserta_id' => $peserta_id,
                'events_id' => $this->input->post('events_id'),
                'bank_transfer' => $this->input->post('bank'),
                'date_transaksi' => date('Y-m-d'),
                'bukti_transfer' => $this->input->post('bukti_transfer'), // Sesuaikan dengan nama input form untuk bukti transfer
                'code_promo' => $this->input->post('code_promo') ?? '',
                'tiket' => $this->input->post('tiket'),
                'nominal' => $this->input->post('nominal'),
                'status_transaksi' => 'Tertunda' // Sesuaikan dengan status awal transaksi
            );

            // Simpan data transaksi ke dalam tabel 'transaksi'
            $this->db->insert('transaksi', $transaksi_data);

            // Redirect ke halaman atau tampilkan pesan sukses
            redirect('/'); // Ganti dengan path yang sesuai
        }
    }

    public function verify()
    {
        $this->load->view('frontend/layout/header');
        $this->load->view('frontend/events/pembayaran');
        $this->load->view('frontend/layout/footer');
    }
}
