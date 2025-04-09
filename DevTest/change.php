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
    $status=$_POST['status'] ?? '';
    

    //actualizar el ticket seleccionado para que sea modificado
    $sql="UPDATE `tickets` SET `Status`='{$status}' WHERE `idTickets`='{$ticketId}'";
    $result = $linkConexion->query($sql);

    if (!$result) {
        die("Query failed: " . $linkConexion->error);
    }
    else{
        //enviar un mail de notificacion al usuario cuando es realizado
        $mail = new PHPMailer(true);
        
       

        try {
            
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME']; 
            $mail->Password = $_ENV['MAIL_PASSWORD']; 
            $mail->Port =  $_ENV['MAIL_PORT'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            
            
            $mail->setFrom( $_ENV['MAIL_FROM_ADDRESS'],  $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($userEmail, 'Receiver');
            if($status==2){
                $mail->Subject = 'Ticket is now In progress';
                $mail->Body = "your ticket with id {$ticketId} is now In progess";
           }
           else if($status==3){
                $mail->Subject = 'Ticket is now Completed';
                $mail->Body = "your ticket with id {$ticketId} is now Completed";
           }
            
            $mail->send();
            echo 'Email sent!';
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }
    header("Location: agentPage.php");
exit;



