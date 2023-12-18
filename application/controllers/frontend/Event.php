<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function detail($id_event, $slug)
    {
        $data['event'] = $this->db->get_where('events', ['id_events' => $id_event, 'slug' => $slug])->row_array();
        if (!$data['event']) {
            show_404();
        }
        $data['title'] = $data['event']['title'];

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/events/event_detail');
        $this->load->view('frontend/layout/footer');
    }

    public function checkout()
    {
        $data['title'] = 'Checkout';

        $this->load->view('frontend/layout/header', $data);
        $this->load->view('frontend/events/checkout');
        $this->load->view('frontend/layout/footer');
    }
}
