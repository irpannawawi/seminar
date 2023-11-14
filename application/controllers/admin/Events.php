<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // $this->load->model('Events_model', 'events');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();

        $data['title'] = 'Events Publish';
        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/layouts/footer');
    }

    public function create()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();

        // Ambil nilai dari tombol yang diklik
        $action = $this->input->post('action');

        // Jika tombol 'submit' atau 'save_draft' diklik
        if ($action == 'submit' || $action == 'save_draft') {
            // Konfigurasi upload file
            $config['upload_path'] = 'assets/frontend/img/events';
            $config['allowed_types'] = '*'; // Sesuaikan dengan jenis file yang diizinkan
            $config['max_size'] = 2000;
            $config['file_name'] = 'acaraku.com-' . uniqid();

            $this->upload->initialize($config);

            // Lakukan upload file
            if ($this->upload->do_upload('image_events')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
            } else {
                // Jika upload gagal, tidak masalah, file tidak wajib diisi
                $file_name = null;
            }

            $title = htmlspecialchars($this->input->post('title'));
            $categories = is_array($this->input->post('id_category')) ? implode(', ', $this->input->post('id_category')) : '';
            $description = $this->input->post('description');
            $snk = $this->input->post('snk');
            $date = $this->input->post('date');
            $date_start = $this->input->post('date_start');
            $date_finish = $this->input->post('date_finish');
            $price = htmlspecialchars($this->input->post('price'));
            $kuota = htmlspecialchars($this->input->post('kuota'));
            $location = htmlspecialchars($this->input->post('location'));
            $url_location = htmlspecialchars($this->input->post('url_location'));
            $type_event = $this->input->post('type_event');
            $label = htmlspecialchars($this->input->post('label'));

            $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

            // Set aturan validasi
            $this->form_validation->set_rules('title', 'Judul Event', 'required|is_unique[events.title]', [
                'required' => 'Judul Event harus diisi.',
                'is_unique' => 'Judul events sudah ada!'
            ]);

            // Aturan validasi berdasarkan jenis lokasi
            if ($type_event == 'offline') {
                $this->form_validation->set_rules('location', 'Nama Tempat', 'required');
                $this->form_validation->set_rules('url_location', 'URL Lokasi', 'required');
            } elseif ($type_event == 'online') {
                $this->form_validation->set_rules('label', 'Label', 'required');
            }

            $save = [
                'title' => $title,
                'slug' => strtolower(str_replace(' ', '-', $title)),
                'id_category' => $categories,
                'description' => $description,
                'snk' => $snk,
                'date' => $date,
                'date_start' => $date_start,
                'date_finish' => $date_finish,
                'type_event' => $type_event,
                'kuota' => $kuota,
                'location' => $location,
                'price' => $price,
                'url_location' => $url_location,
                'label' => $label,
                'status' => ($action == 'submit') ? 'published' : 'draft',
                'image' => $file_name,
                'date_created' => time()
            ];

            // Lakukan validasi
            if ($this->form_validation->run() == FALSE) {
                $data['title'] = 'Buat Event';
                $this->load->view('admin/layouts/header', $data);
                $this->load->view('admin/layouts/navbar');
                $this->load->view('admin/layouts/sidebar');
                $this->load->view('admin/events/create');
                $this->load->view('admin/layouts/footer');
            } else {
                $this->db->insert('events', $save);
                set_pesan('Events berhasil ' . ($action == 'submit' ? 'ditambahkan!' : 'disimpan sebagai draft!'));
                redirect('admin');
            }
        } else {
            // Jika tombol tidak diklik, tampilkan form create
            $data['title'] = 'Buat Event';
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/events/create');
            $this->load->view('admin/layouts/footer');
        }
    }
}
