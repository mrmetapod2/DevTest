<?php
require 'vendor\autoload.php';
require_once "conexion.inc.php";
//uso el mailer para enviar emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//usar el enviroment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
    //tomar los datos del post de la pagina de agente
    $ticketId = $_POST['id'] ?? '';
    $userEmail= $_POST['email'] ?? '';
    $name= $_POST['name'] ?? '';
    

    
    
        //enviar un mail de notificacion al usuario cuando es realizado
        $mail = new PHPMailer(true);
        
       

        try {
            
            $mail->isSMTP();
            $mail->isHTML(true);
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME']; 
            $mail->Password = $_ENV['MAIL_PASSWORD']; 
            $mail->Port =  $_ENV['MAIL_PORT'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            
            
            $mail->setFrom( $_ENV['MAIL_FROM_ADDRESS'],  $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($userEmail, 'Receiver');
            $url= $_ENV['APP_URL'];
            $mail->Subject = 'Documentation requested for ticket';
            $mail->Body = "
                <p>Hello {$name},</p>
                <p>Your ticket with ID {$ticketId} requires additional documentation.</p>
                <p>
                    <a href='{$url}addDocumentation.php?ticketId={$ticketId}'>
                        Click here to upload documentation
                    </a>
                </p>
            ";
        
            
            $mail->send();
            echo 'Email sent!';
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    
    header("Location: agentPage.php");
exit;



