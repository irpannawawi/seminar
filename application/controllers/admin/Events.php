<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Integrasi_model', 'integrasi');
        $this->load->model('Events_model', 'events');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->db
            ->where('status', 'published')
            ->order_by('date_created', 'DESC')
            ->get('events')->result_array();
        $data['title'] = 'Data Events';

        // Menggabungkan data events dan peserta
        $data['event_peserta'] = [];
        foreach ($data['events'] as $event) {
            $event_id = $event['id_events'];
            $data['event_peserta'][$event_id]['event'] = $event;
            $data['event_peserta'][$event_id]['peserta'] = $this->events->pesertabyevent($event_id);
        }

        $this->form_validation->set_rules('pesan', 'Isi Pesan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/events/event');
            $this->load->view('admin/layouts/footer');
        } else {
            $message = $this->input->post('pesan');
            $event_id = $this->input->post('id_events');

            $pesertaEvent = $this->events->pesertabyevent($event_id);
            $whatsapp = '';
            foreach ($pesertaEvent as $peserta) {
                $nowa = $peserta['nowa'];
                $name = $peserta['name'];
                $whatsapp .= $nowa . '|' . $name . ',';
            }

            // Hapus koma di akhir string
            $whatsapp = rtrim($whatsapp, ',');

            $this->sendMessage($whatsapp, $message);
        }
    }

    public function publish()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->db
            ->where('status', 'published')
            ->order_by('date_created', 'DESC')
            ->get('events')->result_array();
        $data['title'] = 'Events Publish';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/events/publish');
        $this->load->view('admin/layouts/footer');
    }

    public function draft()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->db
            ->where('status', 'draft')
            ->order_by('date_created', 'DESC')
            ->get('events')->result_array();
        $data['title'] = 'Events Draft';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/events/draft');
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
            $config['allowed_types'] = 'jpeg|png|jpg'; // Sesuaikan dengan jenis file yang diizinkan
            $config['max_size'] = 2000;
            $config['file_name'] = uniqid();

            $this->upload->initialize($config);

            // Lakukan upload file
            if ($this->upload->do_upload('image_events')) {
                $file_name = $this->upload->data('file_name');
                $this->db->set('image', $file_name);
            } else {
                // Jika upload gagal, tidak masalah, file tidak wajib diisi
                $file_name = null;
            }

            $title = htmlspecialchars($this->input->post('title'));
            $categories_json = json_encode($this->input->post('id_category'));
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
            if (empty($price)) {
                $price = 'FREE';
            }

            // Set aturan validasi
            if ($action == 'save_draft') {
                $this->form_validation->set_rules('title', 'Judul Event', 'required|is_unique[events.title]', [
                    'required' => 'Judul Event harus diisi.'
                ]);
            } elseif ($action == 'submit') {
                $this->form_validation->set_rules('title', 'Judul Event', 'required|is_unique[events.title]', [
                    'required' => 'Judul Event harus diisi.'
                ]);
                $this->form_validation->set_rules('id_category[]', 'Kategori Event', 'required');
                $this->form_validation->set_rules('description', 'Deskripsi Event', 'required');
                $this->form_validation->set_rules('snk', 'Syarat & Ketentuan Event', 'required');
                $this->form_validation->set_rules('date_start', 'Tanggal Mulai Event', 'required');
                $this->form_validation->set_rules('date_finish', 'Tanggal Selesai Event', 'required');
                $this->form_validation->set_rules('time_start', 'Jam Mulai Event', 'required');
                $this->form_validation->set_rules('time_finish', 'Jam Selesai Event', 'required');
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
                'id_category' => $categories_json,
                'description' => $description,
                'snk' => $snk,
                'date_start' => $date_start,
                'date_finish' => $date_finish,
                'time_start' => $time_start,
                'time_finish' => $time_finish,
                'type_event' => $type_event,
                'kuota' => $kuota,
                'sisa_kuota' => $kuota,
                'location' => $location,
                'price' => $price,
                'url_location' => $url_location,
                'label' => $label,
                'status' => ($action == 'submit') ? 'published' : 'draft',
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
                redirect('admin/events/create');
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

        // Konversi nilai category_id dari JSON ke array
        $categoryIds = json_decode($data['events']['id_category']);

        $this->db->select('name_category');
        $this->db->from('category');
        $this->db->where_in('id_category', $categoryIds);
        $query = $this->db->get();

        $categories = $query->result();
        $data['categories'] = $categories;

        // Ambil nilai dari tombol yang diklik
        $action = $this->input->post('action');

        // Jika tombol 'publish' atau 'save_draft' diklik
        if ($action == 'publish' || $action == 'save_draft') {
            $title = htmlspecialchars($this->input->post('title'));
            $categories = json_encode($this->input->post('id_category'));
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
            if (empty($price)) {
                $price = 'FREE';
            }

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
                $this->form_validation->set_rules('date_start', 'Tanggal Mulai Event', 'required');
                $this->form_validation->set_rules('date_finish', 'Tanggal Selesai Event', 'required');
                $this->form_validation->set_rules('time_start', 'Jam Mulai Event', 'required');
                $this->form_validation->set_rules('time_finish', 'Jam Selesai Event', 'required');
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
                    'date_start' => $date_start,
                    'date_finish' => $date_finish,
                    'time_start' => $time_start,
                    'time_finish' => $time_finish,
                    'type_event' => $type_event,
                    'kuota' => $kuota,
                    'sisa_kuota' => $kuota,
                    'location' => $location,
                    'price' => $price,
                    'url_location' => $url_location,
                    'label' => $label,
                    'status' => ($action == 'publish') ? 'published' : 'draft',
                    'date_created' => time()
                ];

                $upload_image = $_FILES['image_events']['name'];
                if ($upload_image) {
                    $config['upload_path'] = './assets/frontend/img/events/';
                    $config['allowed_types'] = '*';
                    $config['max_size']      = 2048; // 2MB
                    $config['file_name'] = get_setting('title_web') . uniqid();

                    $this->upload->initialize($config);

                    // Lakukan upload file
                    if ($this->upload->do_upload('image_events')) {
                        $upload_data = $this->upload->data('file_name');
                        $this->db->set('image', $upload_data);
                    } else {
                        // Handle error upload jika diperlukan
                        $error = $this->upload->display_errors();
                        // Tambahkan log atau pesan kesalahan sesuai kebutuhan
                        set_pesan('Gagal mengupload file: ' . $error, false);
                        redirect('admin/events/edit/' . $id);
                    }
                }

                $this->db->where('id_events', $id);
                $this->db->update('events', $save);
                set_pesan('Events berhasil ' . ($action == 'publish' ? 'Event dipublish!' : 'disimpan!'));
                redirect('admin/events/publish');
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

        // Ambil nama file gambar event sebelum menghapus record dari database
        $this->db->select('image');
        $this->db->where('id_events', $id);
        $query = $this->db->get('events');
        $row = $query->row_array();

        // Pemeriksaan untuk memastikan $row tidak null sebelum mengakses propertinya
        if ($row !== null) {
            // Hapus record dari database
            $this->db->where('id_events', $id);
            $result = $this->db->delete('events');

            if ($result) {
                // Jika record berhasil dihapus, hapus juga gambar dari folder
                $gambar_path = FCPATH . 'assets/frontend/img/event/' . $row['image'];
                if (file_exists($gambar_path)) {
                    unlink($gambar_path);
                }

                // Event berhasil dihapus
                set_pesan('Event telah berhasil dihapus.');
            } else {
                // Gagal menghapus event
                set_pesan('Gagal menghapus event.', false);
            }
        } else {
            // ID event tidak ditemukan
            set_pesan('Event tidak ditemukan.', false);
        }

        // Redirect ke halaman event
        redirect('admin/events/publish');
    }

    private function sendMessage($whatsapp, $message)
    {
        $wagw = $this->integrasi->wagw();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $wagw['link_send'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $whatsapp,
                'message' => $message,
                'url' => 'https://md.fonnte.com/images/wa-logo.png',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $wagw['token']
            ),
        ));

        $response = curl_exec($curl);
        // Sebelum encode

        if ($response === false) {
            // Handle cURL error
            set_pesan('Error during cURL request: ' . curl_error($curl), false);
        } else {
            // Decode respons JSON
            $api_response = json_decode($response, true);

            if ($api_response['status'] == true) {
                set_pesan($api_response['detail']);
            } else {
                set_pesan('Kirim gagal: ' . $api_response['reason'], false);
            }
        }

        curl_close($curl);

        redirect('admin/events');
    }
}
