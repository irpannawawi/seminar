<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->email) {
            if ($this->session->role_id == 1) {
                redirect('admin'); // apabila sudah login masuk ke role admin/dashboard
            } else {
                redirect('users'); // apabila sudah login masuk ke role users/dashboard
            }
        }

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login - Tiket Seminar';
            $this->load->view('auth/login', $data);
        } else {
            // validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email'));
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        // cek user email
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];

                $this->session->set_userdata($data);

                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('users');
                }
            } else {
                set_pesan('Password salah!', false);
                redirect('login');
            }
        } else {
            set_pesan('Email tidak ada!', false);
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        set_pesan('Anda telah keluar dari sistem');
        redirect('login');
    }

    public function registration()
    {
        if ($this->session->email) {
            if ($this->session->role_id == 1) {
                redirect('admin'); // apabila sudah login masuk ke role admin/dashboard
            } else {
                redirect('users'); // apabila sudah login masuk ke role users/dashboard
            }
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar!',
            'valid_email' => 'Email tidak benar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirm Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!'
        ]);

        $data['title'] = 'Registration - Tiket Seminar';
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/registration', $data);
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);

            $data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);
            set_pesan('Selamat, akun Anda telah dibuat!');
            redirect('login');
        }
    }
}
