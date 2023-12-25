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

if (!function_exists('get_setting')) {
    function get_setting($column_name)
    {
        $CI = &get_instance();
        $CI->load->library('global_library');

        $managements = $CI->global_library->get_settings();

        return isset($managements[$column_name]) ? $managements[$column_name] : '';
    }
}

if (!function_exists('cek_trx')) {
    function cek_trx($status)
    {
        $CI = &get_instance();
        $CI->load->database();

        // Gunakan Query Builder untuk mengambil jumlah transaksi
        $CI->db->select('COUNT(id_transaksi) as total_trx');
        $CI->db->from('transaksi');
        $CI->db->where('status_transaksi', $status);
        $query = $CI->db->get();

        // Periksa apakah query berhasil dijalankan
        if ($query) {
            // Ambil hasil query
            $result = $query->row();

            // Ambil jumlah transaksi
            $total_trx = $result->total_trx;

            // Kembalikan jumlah transaksi
            echo '<span class="badge badge-warning right">' . $total_trx . '</span>';
        } else {
            // Jika query gagal, kembalikan false atau nilai default
            return false;
        }
    }
}
if (!function_exists('kodeunik')) {
    function kodeunik($length = 3)
    {
        // Menghasilkan angka acak dengan panjang 3 digit
        return str_pad(rand(1, 999), $length, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }

    function output_json($data) //ini untuk mengubah data menjadi json
    {
        $ci = get_instance();
        $ci->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
