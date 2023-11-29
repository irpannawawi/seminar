<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partner_model extends CI_Model
{
    public function get_partnership_data()
    {
        // Join antara tabel partnership, users, dan users_role
        $this->db->select('*');
        $this->db->from('partnership');
        $this->db->join('users', 'users.id_user = partnership.user_id');
        $this->db->join('users_role', 'users_role.id_role = partnership.role_id');

        $query = $this->db->get();

        // Mengembalikan hasil query
        return $query->result_array();
    }
}
