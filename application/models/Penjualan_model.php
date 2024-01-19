<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    public function getPenjualan()
    {
        $this->db->select('transaksi.*, events.*, peserta.name AS peserta_name, users.name AS user_name');
        $this->db->from('transaksi');
        $this->db->join('events', 'events.id_events = transaksi.events_id', 'left');
        $this->db->join('peserta', 'peserta.id_peserta = transaksi.peserta_id', 'left');
        $this->db->join('users', 'users.id_user = transaksi.user_id', 'left');
        $this->db->order_by('id_transaksi', 'DESC');

        $query = $this->db->get();

        // Mengembalikan hasil query
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
}
