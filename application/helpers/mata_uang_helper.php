<?php
if (!function_exists('rupiah')) {
    function rupiah($price)
    {
        $hasil = "IDR " . number_format($price, 0, ",", ".");
        return $hasil;
    }
}
