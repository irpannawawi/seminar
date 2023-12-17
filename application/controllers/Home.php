<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['event'] = $this->db->get('events')->result_array();

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/home');
        $this->load->view('frontend/layout/footer');
    }
}
