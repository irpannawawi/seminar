<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader_model extends CI_Model
{
    public function getEventTransaksi($user_id)
    {
        $this->db->select('events.*');
        $this->db->from('partnership');
        $this->db->join('transaksi', 'partnership.user_id = transaksi.user_id AND partnership.events_id = transaksi.events_id', 'inner');
        $this->db->join('events', 'partnership.events_id = events.id_events', 'inner');
        $this->db->where('partnership.user_id', $user_id);
        $this->db->where('transaksi.status_transaksi', 'Lunas');
        $this->db->where('events.date_finish >=', date('Y-m-d'));
        $this->db->group_by('events.id_events');

        return $this->db->get()->result_array();
    }

    public function getTransaksi($id_user)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('events', 'transaksi.events_id = events.id_events');
        $this->db->join('rekening', 'transaksi.bank_transfer = rekening.name_bank');
        $this->db->where('transaksi.user_id', $id_user);
        $this->db->order_by('id_transaksi', 'DESC');

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
