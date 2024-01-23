<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('send_email')) {
    function send_email($data)
    {
        $ci = &get_instance();
        $mailer = $ci->integrasi->mailer();

        // PHPMailer object
        $mail = new PHPMailer(true);

        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = $mailer['mail_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $mailer['mail_address'];
        $mail->Password = $mailer['mail_password'];
        $mail->Port = $mailer['mail_port'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Recipients
        $mail->setFrom($mailer['mail_address'], $mailer['mail_name']);
        $mail->addAddress($data['email']); // Penerima
        $mail->addReplyTo($mailer['mail_reply'], $mailer['mail_name']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $data['title'];
        $mail->Body = '<p><strong>Halo ' . $data['name'] . '</strong><br>Terima kasih telah melakukan pembayaran tiket <strong>"' . $data['title'] . '"</strong>, Berikut detail pemesanan Anda:</p>
        <p>Invoice: <strong>' . $data['idOrder'] . '</strong><br>Nama Event: <strong>' . $data['title'] . '</strong><br>Waktu Pelaksanaan: <strong>' . tanggal($data['waktu']) . '</strong><br>Jumlah Tiket: <strong>' . $data['qty_requested'] . '</strong><br>Status: <strong>LUNAS</strong></p>
        <p>Silahkan gunakan QR Code untuk absensi di acara</p>
        <p>Terimas Kasih,</p>';

        //Attachments
        if ($data['qr_code']) {
            $mail->addAttachment($data['qr_code'], 'QR Absensi.png');
        } else {
        }

        // Clear output buffer
        ob_clean();
        // Send email
        $mail->send();
    }
}
