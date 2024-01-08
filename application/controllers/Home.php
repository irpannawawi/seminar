<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        // Ambil data dari tabel events
        $data['events'] = $this->db
            ->order_by('date_created', 'desc')
            ->get('events')->result_array();

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/home', $data);
        $this->load->view('frontend/layout/footer');
    }
}
