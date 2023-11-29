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
            $role = htmlspecialchars($this->input->post('role_id'));
            $password = $this->input->post('password', true);
            $password2 = $this->input->post('password2');
            $nohp = htmlspecialchars($this->input->post('no_hp'));

            $submit = [
                'name' => $name,
                'email' => $email,
                'role_id' => $role,
                'password' => htmlspecialchars(password_hash($password, PASSWORD_DEFAULT)),
                'no_hp' => $nohp,
                'date_created' => time(),
            ];

            if (!empty($password) && $password == $password2) {
                // Jika password tidak kosong dan password dan password2 cocok
                $save['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $save = [
                    'name' => $name,
                    'role_id' => $role,
                    'no_hp' => $nohp,
                ];
                $partner = [
                    'role_id' => $role,
                    'kuota_tiket' => 0,
                    'total_terjual' => 0,
                ];
            }

            if ($action == 'submit') {
                $this->db->insert('users', $submit);

                $user_id = $this->db->insert_id();
                $partner['user_id'] = $user_id;
                $this->db->insert('partnership', $partner);

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
        $this->db->delete('users');

        set_pesan('Pengguna telah berhasil dihapus.');
        redirect('admin/usermanagement');
    }
}
