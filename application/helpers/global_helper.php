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

if (!function_exists('tanggal')) {
    function tanggal($tanggal)
    {
        $ubahTanggal = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecahTanggal = explode('-', $ubahTanggal);
        $tanggal = $pecahTanggal[2];
        $bulan = $pecahTanggal[1];
        $tahun = $pecahTanggal[0];
        $namaHari = nama_hari(date('l', mktime(0, 0, 0, $bulan, $tanggal, $tahun)));
        return $namaHari . ', ' . $tanggal . ' ' . bulan_panjang($bulan) . ' ' . $tahun;
    }
}
if (!function_exists('tgl')) {
    function tgl($tanggal)
    {
        $ubahTanggal = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecahTanggal = explode('-', $ubahTanggal);
        $tanggal = $pecahTanggal[2];
        $bulan = bulan_panjang($pecahTanggal[1]);
        $tahun = $pecahTanggal[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}
if (!function_exists('bulan_panjang')) {
    function bulan_panjang($bulan)
    {
        switch ($bulan) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
        }
    }
}
if (!function_exists('nama_hari')) {
    function nama_hari($hari)
    {
        if ($hari == 'Sunday') {
            return 'Minggu';
        } elseif ($hari == 'Monday') {
            return 'Senin';
        } elseif ($hari == 'Tuesday') {
            return 'Selasa';
        } elseif ($hari == 'Wednesday') {
            return 'Rabu';
        } elseif ($hari == 'Thursday') {
            return 'Kamis';
        } elseif ($hari == 'Friday') {
            return 'Jumat';
        } elseif ($hari == 'Saturday') {
            return 'Sabtu';
        }
    }
}

function output_json($data) //ini untuk mengubah data menjadi json
{
    $ci = get_instance();
    $ci->output->set_content_type('application/json')->set_output(json_encode($data));
}
if (!function_exists('status_transaksi')) {
    function status_transaksi($status)
    {
        $status_data = [
            'Tertunda' => '<span class="badge badge-warning">Tertunda</span>',
            'Refund' => '<span class="badge badge-secondary">Refund</span>',
            'Lunas' => '<span class="badge badge-success">Lunas</span>',
            'Dibatalkan' => '<span class="badge badge-danger">Dibatalkan</span>',
            'Proses' => '<span class="badge badge-info">Proses</span>',
        ];

        return isset($status_data[$status]) ? $status_data[$status] : '<span class="badge badge-secondary">Undefined</span>';
    }
}

if (!function_exists('status_absensi')) {
    function status_absensi($status)
    {
        $status_data = [
            'Hadir' => '<span class="badge badge-success">Hadir</span>',
            'Tidak Hadir' => '<span class="badge badge-warning">Tidak Hadir</span>',
        ];

        return isset($status_data[$status]) ? $status_data[$status] : '<span class="badge badge-secondary">Undefined</span>';
    }
}

// if (!function_exists('total_tiket')) {
//     function total_tiket($column_name)
//     {
//         $ci = &get_instance();
//         $ci->load->database();

//         $user_id = $ci->session->id_user; // Mengambil user_id dari session

//         $ci->db->select_sum($column_name, 'total_tiket');
//         $ci->db->where('user_id', $user_id);

//         $query = $ci->db->get('partnership');

//         return $query->row()->total_tiket;
//     }
// }
