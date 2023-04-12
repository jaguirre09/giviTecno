<?php


namespace App\Http\Apis;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailSendApi
{
    /**
     * @param array|null $customVars Custom vars from router
     * @return string return data to front app
     */
    public function index(?array $customVars): string
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = $_ENV['MAILER_HOST'];
            $mail->Username = $_ENV['MAILER_USER'];
            $mail->Password = $_ENV['MAILER_PASS'];
            //$mail->SMTPSecure = $_ENV['MAILER_SMTP_SECURE'];
            $mail->Port = $_ENV['MAILER_PORT'];
            $mail->SMTPAuth = true;
            $mail->setFrom($_ENV['MAILER_USER'], 'KPI Match');
            $mail->addAddress('Juan.Aguirre@g2mcol.co', 'KPI Match');
            $mail->addAddress($customVars[1], 'Startup');


            $mail->isHTML(false);
            $mail->Subject = 'Mensaje nuevo desde KPI Match';
            $mail->Body =
                "<div style='background-color:#DADADA;padding: 40px; border-radius:20px'>
        <h1 style='background-color:#592A6C;color:#FF484F;padding:10px 20px;text-align:center;border-radius: 12px'>
        Bienvenidos
        </h1>
        <div style='padding:20px;color: #1d3854'>
            Confirma tu cuenta con el siguiente código <b style='color: #0a53be'>$customVars[0]</b>
        </div>
    </div>";
            $mail->AltBody =
                'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return '<script> alert("Message has been sent")</script>';
        } catch (Exception $e) {
            return "<script> alert('Message has been sent $mail->ErrorInfo')</script> ";
        }
    }
}