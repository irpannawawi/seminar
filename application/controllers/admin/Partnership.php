<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partnership extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Partner_model', 'partner');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['partner'] = $this->partner->get_partnership_data();
        $data['events'] = $this->partner->getEventSB();
        $data['title'] = 'Partnership';

        $this->load->view('admin/layouts/header', $data);
        $this->load->view('admin/layouts/navbar');
        $this->load->view('admin/layouts/sidebar');
        $this->load->view('admin/partners');
        $this->load->view('admin/layouts/footer');
    }

    public function get_partnership_data($id_events)
    {
        $data['partner'] = $this->partner->get_partnership_by_event($id_events);

        header('Content-Type: application/json');
        echo json_encode($data['partner']);
    }
}
