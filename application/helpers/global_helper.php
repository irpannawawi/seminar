<?php
function is_logged_in() //ini untuk mengecek apakah user sudah login atau belum
{
    $ci = get_instance();
    $ci->session->username || redirect('login');
}

function is_admin()
{
    $ci = get_instance();
    $role = $ci->session->get_userdata('login_session')['role'];

    $status  = true;

    if ($role != 'admin') {
        $status = false;
    }

    return $status;
}

function set_pesan($message, $tipe = true) //ini untuk menampilkan message
{
    $ci = get_instance();
    if ($tipe) {
        $ci->session->set_flashdata('success', $message);
    } else {
        $ci->session->set_flashdata('error', $message);
    }
}
