<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partner_model extends CI_Model
{
    public function get_partnership_data()
    {
        $this->db->select('*');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id_user = partnership.user_id');
        $this->db->join('users_role', 'users_role.id_role = partnership.role_id');
        $this->db->join('events', 'events.id_events = partnership.events_id');

        $query = $this->db->get();

        return $query->result_array();
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

    public function get_partnership_by_event($id_events)
    {
        $this->db->select('*');
        $this->db->from('partnership');
        $this->db->where('events_id', $id_events);
        $query = $this->db->get();

        return $query->result_array();
    }
}
