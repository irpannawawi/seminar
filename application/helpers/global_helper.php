<?php
function is_logged_in() //ini untuk mengecek apakah user sudah login atau belum
{
    $ci = get_instance();
    if (!$ci->session->email) {
        redirect('login');
    } else {
        $role_id = $ci->session->role_id;

        $status  = true;

        if ($role_id != 1) {
            $status = false;
        }

        return $status;
    }
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
