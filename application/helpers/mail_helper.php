<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('send_email')) {
    function send_email($recive, $subject)
    {
        $ci = &get_instance();
        $mailer = $ci->integrasi->mailer();

        // PHPMailer object
        $mail = new PHPMailer(true);

        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host     = $mailer['mail_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $mailer['mail_address'];
        $mail->Password = $mailer['mail_password'];
        $mail->Port     = $mailer['mail_port'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Recipients
        $mail->setFrom($mailer['mail_address'], $mailer['mail_name']);
        $mail->addAddress($recive); // Penerima
        $mail->addReplyTo($mailer['mail_reply'], $mailer['mail_name']);

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = 'testing';

        // Send recive
        if (!$mail->send()) {
            log_message('error', 'Failed to send email: ' . $mail->ErrorInfo);
            set_pesan($mail->ErrorInfo, false);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            log_message('debug', 'Email sent successfully');
            set_pesan('Berhasil kirim pesan!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
