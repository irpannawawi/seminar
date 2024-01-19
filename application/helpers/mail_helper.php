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
        $mail->Host     = $mailer['mail_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $mailer['mail_address'];
        $mail->Password = $mailer['mail_password'];
        $mail->Port     = $mailer['mail_port'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Recipients
        $mail->setFrom($mailer['mail_address'], $mailer['mail_name']);
        $mail->addAddress($data['email']); // Penerima
        $mail->addReplyTo($mailer['mail_reply'], $mailer['mail_name']);

        //Attachments
        if ($data['qr_code']) {
            $mail->addAttachment($data['qr_code'], "QR Absensi");
        } else {
        }

        //Content
        $mail->isHTML(true);
        $mail->Subject = $data['event_title'];
        $mail->Body    = 'testing';

        // Send recive
        if ($mail->send()) {
            return true;
        } else {
            echo $mail->ErrorInfo;
            exit;
        }
    }
}
