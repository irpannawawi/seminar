<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader_model extends CI_Model
{
    public function getEventTransaksi($id_leader)
    {
        $this->db->select('events.*');
        $this->db->from('partnership');
        $this->db->join('events', 'partnership.events_id = events.id_events');
        $this->db->where('partnership.id_leader', $id_leader);
        $this->db->where('events.date_finish >=', date('Y-m-d')); // Tampilkan hanya yang date_finish >= waktu sekarang

        return $this->db->get()->result_array();
    }
    public function getTransaksi($id_user)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('events', 'transaksi.events_id = events.id_events');
        $this->db->join('rekening', 'transaksi.bank_transfer = rekening.name_bank');
        $this->db->where('transaksi.user_id', $id_user);
        $this->db->order_by('date_transaksi', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

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

    public function getTransaksiLeader($limit = null, $offset = null, $keyword = null)
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
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }
}
