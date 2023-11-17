<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function usermanagement()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_role', 'users.role_id = users_role.id_role');
        $query = $this->db->get();
        return $query->result_array();
    }
}
