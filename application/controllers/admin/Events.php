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
        $data['events'] = $this->db->get('events')->result_array();
        $data['title'] = 'Events';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/events/event');
        $this->load->view('admin/layouts/footer');
    }

    public function publish()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->db->get('events')->result_array();
        $data['title'] = 'Events Publish';
        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/events/publish');
        $this->load->view('admin/layouts/footer');
    }

    public function create()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['category'] = $this->db->get('category')->result_array();
        $data['title'] = 'Buat Event';

        // Ambil nilai dari tombol yang diklik
        $action = $this->input->post('action');

        // Jika tombol 'submit' atau 'save_draft' diklik
        if ($action == 'submit' || $action == 'save_draft') {
            // Konfigurasi upload file
            $config['upload_path'] = 'assets/frontend/img/events';
            $config['allowed_types'] = '*'; // Sesuaikan dengan jenis file yang diizinkan
            $config['max_size'] = 2000;
            $config['file_name'] = get_management('title_web') . uniqid();

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
            $date_start = $this->input->post('date_start');
            $date_finish = $this->input->post('date_finish');
            $time_start = $this->input->post('time_start');
            $time_finish = $this->input->post('time_finish');
            $price = htmlspecialchars($this->input->post('price'));
            $kuota = htmlspecialchars($this->input->post('kuota'));
            $location = htmlspecialchars($this->input->post('location'));
            $url_location = htmlspecialchars($this->input->post('url_location'));
            $type_event = $this->input->post('type_event');
            $label = htmlspecialchars($this->input->post('label'));

            $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

            // Set aturan validasi
            if ($action == 'save_draft') {
                $this->form_validation->set_rules('title', 'Judul Event', 'required|is_unique[events.title]', [
                    'required' => 'Judul Event harus diisi.',
                    'is_unique' => 'Judul events sudah ada!'
                ]);
            } elseif ($action == 'submit') {
                $this->form_validation->set_rules('title', 'Judul Event', 'required|is_unique[events.title]', [
                    'required' => 'Judul Event harus diisi.',
                    'is_unique' => 'Judul events sudah ada!'
                ]);
                $this->form_validation->set_rules('id_category', 'Kategori Event', 'required');
                $this->form_validation->set_rules('description', 'Deskripsi Event', 'required');
                $this->form_validation->set_rules('snk', 'Syarat & Ketentuan Event', 'required');
                $this->form_validation->set_rules('date', 'Tanggal Event', 'required');
                $this->form_validation->set_rules('date_start', 'Tanggal Mulai Event', 'required');
                $this->form_validation->set_rules('date_finish', 'Tanggal Selesai Event', 'required');
                $this->form_validation->set_rules('price', 'Harga Event', 'required');
                $this->form_validation->set_rules('kuota', 'Kuota Tiket Event', 'required');
            }

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
                'date_start' => $date_start,
                'date_finish' => $date_finish,
                'time_start' => $time_start,
                'time_finish' => $time_finish,
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
                $this->load->view('admin/layouts/header', $data);
                $this->load->view('admin/layouts/navbar');
                $this->load->view('admin/layouts/sidebar');
                $this->load->view('admin/events/create');
                $this->load->view('admin/layouts/footer');
            } else {
                $this->db->insert('events', $save);
                set_pesan('Events berhasil ' . ($action == 'submit' ? 'ditambahkan!' : 'disimpan sebagai draft!'));
                redirect('admin/events');
            }
        } else {
            // Jika tombol tidak diklik, tampilkan form create
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/events/create');
            $this->load->view('admin/layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->db->get_where('events', ['id_events' => $id])->row_array();
        $data['category'] = $this->db->get('category')->result_array();
        $data['title'] = 'Edit Event';

        // Ambil nilai dari tombol yang diklik
        $action = $this->input->post('action');

        // Jika tombol 'publish' atau 'save_draft' diklik
        if ($action == 'publish' || $action == 'save_draft') {
            // Konfigurasi upload file
            $config['upload_path'] = './assets/frontend/img/events/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 2000;
            $config['file_name'] = get_management('title_web') . uniqid();

            $this->upload->initialize($config);

            // Lakukan upload file
            if ($this->upload->do_upload('image_events')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
            } elseif ($action == 'publish') {
                // $error = $this->upload->display_errors();
                // set_pesan('Gambar gagal di upload: ' . $error, false);
                // redirect('admin/events/edit/' . $id);
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
            if ($action == 'save_draft') {
                $this->form_validation->set_rules('title', 'Judul Event', 'required', [
                    'required' => 'Judul Event harus diisi.'
                ]);
            } elseif ($action == 'publish') {
                $this->form_validation->set_rules('title', 'Judul Event', 'required', [
                    'required' => 'Judul Event harus diisi.'
                ]);
                // $this->form_validation->set_rules('id_category', 'Kategori Event', 'required');
                $this->form_validation->set_rules('description', 'Deskripsi Event', 'required');
                $this->form_validation->set_rules('snk', 'Syarat & Ketentuan Event', 'required');
                $this->form_validation->set_rules('date', 'Tanggal Event', 'required');
                $this->form_validation->set_rules('date_start', 'Tanggal Mulai Event', 'required');
                $this->form_validation->set_rules('date_finish', 'Tanggal Selesai Event', 'required');
                $this->form_validation->set_rules('price', 'Harga Event', 'required');
                $this->form_validation->set_rules('kuota', 'Kuota Tiket Event', 'required');
            }

            // Aturan validasi berdasarkan jenis lokasi
            if ($type_event == 'offline') {
                $this->form_validation->set_rules('location', 'Nama Tempat', 'required');
                $this->form_validation->set_rules('url_location', 'URL Lokasi', 'required');
            } elseif ($type_event == 'online') {
                $this->form_validation->set_rules('label', 'Label Platform', 'required');
            }

            // Lakukan validasi
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/layouts/header', $data);
                $this->load->view('admin/layouts/navbar');
                $this->load->view('admin/layouts/sidebar');
                $this->load->view('admin/events/edit', $data);
                $this->load->view('admin/layouts/footer');
            } else {
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
                    'status' => ($action == 'publish') ? 'published' : 'draft',
                    'image' => $file_name,
                    'date_created' => time()
                ];

                $this->db->where('id_events', $id);
                $this->db->update('events', $save);
                set_pesan('Events berhasil ' . ($action == 'publish' ? 'Event dipublish!' : 'disimpan!'));
                redirect('admin/events');
            }
        } else {
            // Jika tombol tidak diklik, tampilkan form edit
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/events/edit', $data);
            $this->load->view('admin/layouts/footer');
        }
    }

    public function category()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['category'] = $this->db->get('category')->result_array();
        $data['title'] = 'Kategori Event';

        $this->form_validation->set_rules('name_category', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/events/kategori');
            $this->load->view('admin/layouts/footer');
        } else {
            $action = $this->input->post('action');

            if ($action == 'submit') {
                $name_category = $this->input->post('name_category');
                $slug_category = strtolower(str_replace(' ', '-', $name_category));
                $save = [
                    'name_category' => $name_category,
                    'slug_category' => $slug_category,
                    'date_created' => time()
                ];

                $this->db->insert('category', $save);
                set_pesan('Kategori berhasil di tambah!');
                redirect('admin/events/category');
            } elseif ($action == 'simpan') {
                $id_category = $this->input->post('id_category');
                $name_category = $this->input->post('name_category');
                $slug_category = strtolower(str_replace(' ', '-', $name_category));

                $update = [
                    'name_category' => $name_category,
                    'slug_category' => $slug_category,
                ];

                $this->db->where('id_category', $id_category);
                $this->db->update('category', $update);
                set_pesan('Kategori berhasil di ubah!');
                redirect('admin/events/category');
            }
        }
    }

    public function deleteCategory($id)
    {
        if (!$this->session->email) {
            redirect('login');
        }

        // Hapus kategori berdasarkan ID
        $this->db->where('id_category', $id);
        $result = $this->db->delete('category');

        if ($result) {
            // Kategori berhasil dihapus
            set_pesan('Kategori telah berhasil dihapus.');
        } else {
            // Gagal menghapus kategori
            set_pesan('Gagal menghapus kategori.', false);
        }

        // Redirect ke halaman kategori
        redirect('admin/events/category');
    }

    public function deleteEvents($id)
    {
        if (!$this->session->email) {
            redirect('login');
        }

        // Hapus kategori berdasarkan ID
        $this->db->where('id_events', $id);
        $result = $this->db->delete('events');

        if ($result) {
            // Kategori berhasil dihapus
            set_pesan('Event telah berhasil dihapus.');
        } else {
            // Gagal menghapus Events
            set_pesan('Gagal menghapus event.', false);
        }

        // Redirect ke halaman kategori
        redirect('admin/events');
    }
}
