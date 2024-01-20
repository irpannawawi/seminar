<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
    public function get_absensi($id_events)
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('events', 'absensi.events_id = events.id_events');
        $this->db->join('peserta', 'absensi.peserta_id = peserta.id_peserta');
        $this->db->join('transaksi', 'absensi.order_id = transaksi.id_order');
        $this->db->where('absensi.events_id', $id_events);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataByIdOrder($id_order)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('events', 'events.id_events = transaksi.events_id', 'left');
        $this->db->join('peserta', 'peserta.id_peserta = transaksi.peserta_id', 'left');
        $this->db->join('users', 'users.id_user = transaksi.user_id', 'left');
        $this->db->where('transaksi.id_order', $id_order);

        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query->row_array();
    }

    public function insert($data)
    {
        $this->db->insert('absensi', $data);

        return $this->db->affected_rows();
    }

    public function cekAbsensi($id_order)
    {
        $this->db->where('order_id', $id_order);
        $query = $this->db->get('absensi');

        return $query->row();
    }
}
