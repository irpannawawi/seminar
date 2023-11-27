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

    public function getEvent($event_id)
    {
        $query = "SELECT * FROM events WHERE id_events = $event_id";
        return $this->db->query($query)->row_array();
    }

    function pesertabyevent($event_id)
    {
        $this->db->where('events_id', $event_id);
        return $this->db->get('peserta')->result_array();
    }
}
