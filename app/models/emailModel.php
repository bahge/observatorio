<?php

namespace app\models;

use PHPMailer;
use Exception;

class emailModel{

    public function enviarEmail($dados){
        $email = $dados['email'];
        $msg = $dados['mensagem'];
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '6ee92b358eb697';                     // SMTP username
            $mail->Password   = '08b79d94128974';                               // SMTP password
            $mail->Port       = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('leandroteste@teste.com', 'Leandro');
            $mail->addAddress($email, $email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Contato - Vitrine Virtual';
            $mail->Body    = $msg;
            $mail->AltBody = $msg;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
}