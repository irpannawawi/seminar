<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('frontend/layout/header');
        $this->load->view('frontend/home');
        $this->load->view('frontend/layout/footer');
    }
}
