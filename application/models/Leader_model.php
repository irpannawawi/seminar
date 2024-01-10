<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leader_model extends CI_Model
{
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
}
