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

    public function countAllTransaksi($keyword)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('transaksi');
        $this->db->join('events', 'events.id_events = transaksi.events_id', 'left');
        $this->db->join('peserta', 'peserta.id_peserta = transaksi.peserta_id', 'left');
        $this->db->join('users', 'users.id_user = transaksi.user_id', 'left');

        if ($keyword) {
            $this->db
                ->group_start()
                ->like('id_order', $keyword)
                ->or_like('title', $keyword)
                ->or_like('name', $keyword)
                ->group_end();
        }
        $this->db->order_by('id_transaksi', 'DESC');

        return $this->db->get()->row()->total;
    }

    public function getTransaksiLeader($limit = null, $offset = null, $keyword = null)
    {
        $this->db->select('transaksi.*, events.*, peserta.name AS peserta_name, users.name AS user_name');
        $this->db->from('transaksi');
        $this->db->join('events', 'events.id_events = transaksi.events_id', 'left');
        $this->db->join('peserta', 'peserta.id_peserta = transaksi.peserta_id', 'left');
        $this->db->join('users', 'users.id_user = transaksi.user_id', 'left');

        if ($keyword) {
            $this->db->group_start();
            $this->db->like('transaksi.id_order', $keyword);
            $this->db->or_like('events.title', $keyword);
            $this->db->or_like('peserta.name', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('transaksi.id_transaksi', 'DESC');
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }
}
