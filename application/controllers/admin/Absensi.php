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

    // In your controller
    public function getdataScan()
    {
        $id_order = $this->input->post('id_order');
        var_dump($id_order);
        die;
        try {
            // Use your model to get data based on id_order
            $data = $this->penjualan->getDataByIdOrder($id_order);

            if ($data) {
                // Return the data as JSON
                echo json_encode(array('success' => true, 'data' => $data));
            } else {
                // Data not found
                echo json_encode(array('success' => false, 'message' => 'Data not found.'));
            }
        } catch (Exception $e) {
            // Log the error or handle it accordingly
            log_message('error', 'Error in getdataScan: ' . $e->getMessage());

            // Return an error message
            echo json_encode(array('success' => false, 'message' => 'An error occurred.'));
        }
    }
}
