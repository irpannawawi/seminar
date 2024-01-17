<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curl
{

    private $handle;

    public function __construct()
    {
        $this->handle = curl_init();
    }

    public function create($url)
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
    }

    public function post($data)
    {
        curl_setopt($this->handle, CURLOPT_POST, true);
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
    }

    public function get($data, $url)
    {
        $query_string = http_build_query($data);
        curl_setopt($this->handle, CURLOPT_URL, $url . '?' . $query_string);
    }

    public function http_header($headers)
    {
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $headers);
    }

    public function execute()
    {
        $response = curl_exec($this->handle);
        if ($response === FALSE) {
            die(curl_error($this->handle));
        }
        return $response;
    }

    public function __destruct()
    {
        curl_close($this->handle);
    }
}
