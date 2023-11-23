<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events_model extends CI_Model
{
    public function eventspeserta($event_id)
    {
        $this->db->select('nowa');
        $this->db->from('peserta');
        $this->db->where('events_id', $event_id);
        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }
}
