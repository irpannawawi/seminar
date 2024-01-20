<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Events_model', 'events');
        $this->load->model('Absensi_model', 'absensi');
        $this->load->model('Penjualan_model', 'penjualan');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['events'] = $this->db
            ->where('status', 'published')
            ->order_by('date_created', 'DESC')
            ->get('events')->result_array();
        $data['title'] = 'Absensi';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/absensi/event');
        $this->load->view('admin/layouts/footer');
    }

    public function detail($id_events)
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['absensi'] = $this->absensi->get_absensi($id_events);
        // Ambil judul event dari salah satu baris hasil query
        if (!empty($data['absensi'])) {
            $data['title'] = 'Detail Absensi: ' . $data['absensi'][0]['title'];
        } else {
            $data['title'] = 'Detail Absensi: Data Masih Kosong';
        }

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/absensi/detail');
        $this->load->view('admin/layouts/footer');
    }

    public function insertAbsensi()
    {
        $id_order = $this->input->post('id_order');
        // Ambil data peserta dari tabel transaksi
        $dataPeserta = $this->absensi->getDataByIdOrder($id_order);
        $existingAbsensi = $this->absensi->cekAbsensi($id_order);

        if ($existingAbsensi) {
            $this->output->set_content_type('application/json');
            echo json_encode(['success' => false, 'message' => 'ID Order ' . $id_order . ' sudah terdaftar dalam absensi']);
            return;
        }

        if ($dataPeserta) {
            if ($dataPeserta['status_transaksi'] == 'Lunas') {
                $status_kehadiran = 'Hadir';
            } else {
                $status_kehadiran = 'Belum Lunas';
            }

            // Insert data ke tabel absensi
            $dataAbsensi = [
                'peserta_id' => $dataPeserta['peserta_id'],
                'events_id' => $dataPeserta['events_id'],
                'order_id' => $id_order,
                'date_absensi' => date('Y-m-d H:i:s'),
                'status_kehadiran' => $status_kehadiran
            ];

            if ($this->absensi->insert($dataAbsensi)) {
                $this->output->set_content_type('application/json');
                echo json_encode(['success' => true, 'message' => 'Absensi berhasil ditambahkan']);
            } else {
                $this->output->set_content_type('application/json');
                echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat insert absensi']);
            }
        } else {
            $this->output->set_content_type('application/json');
            echo json_encode(['success' => false, 'message' => 'INVC ' . $id_order . ' Tidak Ditemukan']);
        }
    }

    // In your controller
    // public function getdataScan()
    // {
    //     $id_order = $this->input->post('id_order');

    //     try {
    //         // Use your model to get data based on id_order
    //         $data = $this->penjualan->getDataByIdOrder($id_order);

    //         if ($data) {
    //             // Return the data as JSON
    //             echo json_encode(array('success' => true, 'data' => $data));
    //         } else {
    //             // Data not found
    //             echo json_encode(array('success' => false, 'message' => 'Data not found.'));
    //         }
    //     } catch (Exception $e) {
    //         // Log the error or handle it accordingly
    //         log_message('error', 'Error in getdataScan: ' . $e->getMessage());

    //         // Return an error message
    //         echo json_encode(array('success' => false, 'message' => 'An error occurred.'));
    //     }
    // }
}
