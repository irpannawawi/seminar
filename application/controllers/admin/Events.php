<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/layouts/footer');
    }

    public function create()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/events/create');
        $this->load->view('admin/layouts/footer');
    }

    public function do_create()
    {
        // Ambil nilai dari tombol yang diklik
        $action = $this->input->post('action');
        if ($action == 'save_draft') {
            $this->save_as_draft();
        } elseif ($action == 'submit') {
            $this->submit_event();
        }
    }

    public function submit_event()
    {
        // upload file
        // $config['upload_path'] = FCPATH . 'assets/frontend/img/events';
        // $config['allowed_types'] = '*';
        // $config['max_size'] = 8192;
        // $config['file_name'] = 'acaraku.com-' . date('mY');

        // $this->upload->initialize($config);

        // if (!$this->upload->do_upload('image_events')) {
        //     $error = $this->upload->display_errors();
        //     set_pesan('File upload error:' . $error, false);
        //     redirect('admin/events/create');
        // }

        $title = $this->input->post('title');
        $categories = $this->input->post('id_category');
        $description = $this->input->post('description');
        $snk = $this->input->post('snk');
        $date = $this->input->post('date');
        $date_start = $this->input->post('date_start');
        $date_finish = $this->input->post('date_finish');
        $price = $this->input->post('price');
        $kuota = $this->input->post('kuota');
        $location = $this->input->post('location');
        $url_location = $this->input->post('url_location');
        $type_event = $this->input->post('type_event');
        $label = $this->input->post('label');

        $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

        // Set aturan validasi
        $this->form_validation->set_rules('title', 'Judul Event', 'required');
        $this->form_validation->set_rules('categories', 'Kategori Event', 'required');
        $this->form_validation->set_rules('description_event', 'Deskripsi Event', 'required');
        $this->form_validation->set_rules('snk_event', 'Syarat & Ketentuan Event', 'required');
        $this->form_validation->set_rules('date_event', 'Tanggal Event', 'required|valid_date');
        $this->form_validation->set_rules('date_start', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('date_finish', 'Jam Selesai', 'required');
        $this->form_validation->set_rules('price', 'Harga Tiket', 'required|numeric');
        $this->form_validation->set_rules('kuota', 'Kuota Tiket', 'required|numeric');
        $this->form_validation->set_rules('type_event', 'Type Event', 'required');

        // Aturan validasi berdasarkan jenis lokasi
        if ($type_event == 'offline') {
            $this->form_validation->set_rules('location', 'Nama Tempat', 'required');
            $this->form_validation->set_rules('url_location', 'URL Lokasi', 'required');
        } elseif ($type_event == 'online') {
            $this->form_validation->set_rules('label', 'Label', 'required');
        }

        $save = [
            'title' => $title,
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
            'status' => 'published',
            'date_created' => time()
        ];

        // Lakukan validasi
        if ($this->form_validation->run() == FALSE) {
            set_pesan('Events gagal ditambahkan!', false);
            redirect('admin/events/create');
        } else {
            $this->db->insert('events', $save);
            set_pesan('Events berhasil ditambahkan!');
            redirect('admin/events/create');
        }
    }

    public function save_as_draft()
    {
        // upload file
        // $config['upload_path'] = FCPATH . 'assets/frontend/img/events';
        // $config['allowed_types'] = '*';
        // $config['max_size'] = 8192;
        // $config['file_name'] = 'acaraku.com-' . date('mY');

        // $this->upload->initialize($config);

        // if (!$this->upload->do_upload('image_events')) {
        //     $error = $this->upload->display_errors();
        //     set_pesan('File upload error:' . $error, false);
        //     redirect('admin/events/create');
        // }

        $title = $this->input->post('title');
        $categories = $this->input->post('id_category');
        $description = $this->input->post('description');
        $snk = $this->input->post('snk');
        $date = $this->input->post('date');
        $date_start = $this->input->post('date_start');
        $date_finish = $this->input->post('date_finish');
        $price = $this->input->post('price');
        $kuota = $this->input->post('kuota');
        $location = $this->input->post('location');
        $url_location = $this->input->post('url_location');
        $type_event = $this->input->post('type_event');
        $label = $this->input->post('label');

        $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

        // Set aturan validasi
        $this->form_validation->set_rules('title', 'Judul Event', 'required');

        // Aturan validasi berdasarkan jenis lokasi
        if ($type_event == 'offline') {
            $this->form_validation->set_rules('location', 'Nama Tempat', 'required');
            $this->form_validation->set_rules('url_location', 'URL Lokasi', 'required');
        } elseif ($type_event == 'online') {
            $this->form_validation->set_rules('label', 'Label', 'required');
        }

        $save = [
            'title' => $title,
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
            'status' => 'draft',
            'date_created' => time()
        ];

        // Lakukan validasi
        if ($this->form_validation->run() == FALSE) {
            set_pesan('Events gagal disimpan!', false);
            redirect('admin/events/create');
        } else {
            $this->db->insert('events', $save);
            set_pesan('Events berhasil disimpan!');
            redirect('admin/events/create');
        }
    }
}
