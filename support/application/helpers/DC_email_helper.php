<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_sae_mail'))
{
    function send_sae_mail($to_mail, $title, $content) {
        $mail = new SaeMail();
        $mail->clean();
        $mail->quickSend($to_mail, $title, $content, DC_SMTP_USER, DC_SMTP_PASS, DC_SMTP_HOST, DC_SMTP_PORT);
        return $mail->errno();
    }
}


