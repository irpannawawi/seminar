<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partnership extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Partnership';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/partners');
        $this->load->view('admin/layouts/footer');
    }
}
