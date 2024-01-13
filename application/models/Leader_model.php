<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader_model extends CI_Model
{
    public function count_all_transaksi($keyword)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('transaksi');
        $this->db->join('events', 'transaksi.events_id = events.id_events');
        $this->db->join('peserta', 'transaksi.peserta_id = peserta.id_peserta');

        if ($keyword) {
            $this->db->group_start();
            $this->db->like('id_order', $keyword);
            $this->db->or_like('title', $keyword);
            $this->db->or_like('name', $keyword);
            $this->db->group_end();
        }

        return $this->db->get()->row()->total;
    }

    public function getTransaksiLeader($limit, $start, $keyword = null)
    {
        $this->db->select('transaksi.*, events.title, peserta.name');
        $this->db->from('transaksi');
        $this->db->join('events', 'transaksi.events_id = events.id_events');
        $this->db->join('peserta', 'transaksi.peserta_id = peserta.id_peserta');

        if ($keyword) {
            $this->db->group_start();
            $this->db->like('transaksi.id_order', $keyword);
            $this->db->or_like('events.title', $keyword);
            $this->db->or_like('peserta.name', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('transaksi.date_transaksi', 'DESC');
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }
}
