<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Leader_model', 'leader');
    }
    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['title'] = 'Dashboard';
        $data['events'] = $this->leader->count_events();
        $data['transaksi'] = $this->leader->count_transaksi($this->session->id_user);
        $data['tiket'] = $this->leader->count_tiket($this->session->id_user);


        $this->load->view('leader/layouts/header', $data);
        $this->load->view('leader/layouts/navbar');
        $this->load->view('leader/layouts/sidebar');
        $this->load->view('leader/dashboard');
        $this->load->view('leader/layouts/footer');
    }
}
