<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->email) {
            if ($this->session->userdata('role_id') == 1) {
                redirect('admin'); // apabila sudah login masuk ke role admin/dashboard
            } else {
                redirect('leader'); // apabila sudah login masuk ke role user/myprofile
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
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        // jika usernya ada
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
                    redirect('leader');
                }
            } else {
                set_pesan('password salah!', false);
                redirect('login');
            }
        } else {
            set_pesan('email tidak ada!', false);
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
        if ($this->session->userdata('email')) {
            redirect('admin/user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar!',
            'valid_email' => 'Email tidak benar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirm Password', 'required|trim|matches[password1]', [
            'matches' => 'Password tidak sama!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('registration');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT),
                'role_id' => 2,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);

            set_pesan('Selamat, akun Anda telah dibuat!. Silakan cek email aktifkan akun Anda');
            redirect('login');
        }
    }
}
