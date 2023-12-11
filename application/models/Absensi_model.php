<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
    public function get_absensi($id_events)
    {
        $this->db->select('absensi.*, events.title, peserta.name_peserta');
        $this->db->from('absensi');
        $this->db->join('events', 'absensi.id_events = events.id_events');
        $this->db->join('peserta', 'absensi.id_peserta = peserta.id_peserta');
        $this->db->where('absensi.id_events', $id_events);

        $query = $this->db->get();
        return $query->result_array();
    }
}
