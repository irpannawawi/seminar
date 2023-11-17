<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermanagement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Users_model', 'users');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['user'] = $this->users->usermanagement();
        $data['role'] = $this->users->get('users_role');
        $data['title'] = 'Akun Pengguna';
        $action = $this->input->post('action');
        $id = $this->input->post('id_user');

        if ($action == 'submit') {
            $this->form_validation->set_rules('name', 'Nama', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('role_id', 'Role Pengguna', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        } elseif ($action == 'simpan') {
            $this->form_validation->set_rules('name', 'Nama', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('role_id', 'Role Pengguna', 'trim|required');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/usermanagement/users');
            $this->load->view('admin/layouts/footer');
        } else {
            $name = htmlspecialchars($this->input->post('name'));
            $email = htmlspecialchars($this->input->post('email'));
            $password = htmlspecialchars(password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
            $role = htmlspecialchars($this->input->post('role_id'));
            $nohp = htmlspecialchars($this->input->post('no_hp'));

            $save = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role_id' => $role,
                'no_hp' => $nohp,
            ];

            if ($action == 'submit') {
                $this->db->insert('users', $save);
                set_pesan('Akun pengguna berhasil di tambah!');
                redirect('admin/usermanagement');
            } elseif ($action == 'simpan') {
                $this->db->where('id_user', $id);
                $this->db->update('users', $save);
                set_pesan('Role berhasil di ubah!');
                redirect('admin/usermanagement');
            }
        }
    }

    public function role()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->email])->row_array();
        $data['role'] = $this->db->get('users_role')->result_array();
        $data['title'] = 'Role Pengguna';

        $this->form_validation->set_rules('name_role', 'Nama Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layouts/header', $data);
            $this->load->view('admin/layouts/navbar');
            $this->load->view('admin/layouts/sidebar');
            $this->load->view('admin/usermanagement/role');
            $this->load->view('admin/layouts/footer');
        } else {
            $action = $this->input->post('action');
            $id_role = $this->input->post('id_role');
            $name_role = $this->input->post('name_role');
            $save = [
                'name_role' => $name_role,
            ];
            if ($action == 'submit') {
                $this->db->insert('users_role', $save);
                set_pesan('Role berhasil ditambah!');
                redirect('admin/usermanagement/role');
            } elseif ($action == 'simpan') {
                $this->db->where('id_role', $id_role);
                $this->db->update('users_role', $save);
                set_pesan('Role berhasil di ubah!');
                redirect('admin/usermanagement/role');
            }
        }
    }

    public function deleteuser($id)
    {
        if (!$this->session->email) {
            redirect('login');
        }

        // Hapus kategori berdasarkan ID
        $this->db->where('id_user', $id);
        $result = $this->db->delete('users');

        if ($result) {
            // Kategori berhasil dihapus
            set_pesan('Pengguna telah berhasil dihapus.');
        } else {
            // Gagal menghapus kategori
            set_pesan('Gagal menghapus Pengguna.', false);
        }

        // Redirect ke halaman kategori
        redirect('admin/usermanagement/user');
    }
}
