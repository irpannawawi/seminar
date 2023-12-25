<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('events', 'events.id_events = transaksi.events_id');
        $this->db->join('peserta', 'peserta.id_peserta = transaksi.peserta_id');

        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query->result_array();
    }
}
