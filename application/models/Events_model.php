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

    public function getEventSB()
    {
        $currentDate = date('Y-m-d');

        $this->db->select('*');
        $this->db->from('events');
        $this->db->where("date_finish >=", $currentDate);
        $this->db->order_by('date_finish', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getEvent($event_id)
    {
        $query = "SELECT * FROM events WHERE id_events = $event_id";
        return $this->db->query($query)->row_array();
    }

    public function pesertabyevent($event_id)
    {
        $this->db->where('events_id', $event_id);
        return $this->db->get('peserta')->result_array();
    }

    public function getStatusTransaksi($peserta_id)
    {
        // Anda perlu menambahkan logika untuk mendapatkan status transaksi berdasarkan peserta_id
        // Misalnya, jika Anda menyimpan status transaksi di dalam tabel transaksi, lakukan query ke sana
        $status_transaksi = $this->db
            ->select('status_transaksi')
            ->where('peserta_id', $peserta_id)
            ->get('transaksi')
            ->row_array();

        return isset($status_transaksi['status_transaksi']) ? $status_transaksi['status_transaksi'] : '';
    }
    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }
}
