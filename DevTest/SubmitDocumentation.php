<?php
require 'vendor\autoload.php';
require_once "conexion.inc.php";
//uso el mailer para enviar emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//usar el enviroment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$ticketId=$_POST["ticketId"];
// se ve si hubo un error o no
if ($_FILES['Document']['error'] === UPLOAD_ERR_OK) {

    $fileTmp = $_FILES['Document']['tmp_name'];
    $fileName = basename($_FILES['Document']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    //me encargo que el archivo esta permitido
    if (in_array($fileExt, $allowed)) {
        //lo añado a una directory de archivos
        $uploadDir = "uploads/";
        //si no existe la uploadDir es creada
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        //se crea una id unica para el documento
        $newFileName = uniqid("ticket_", true) . "." . $fileExt;
        //se forma el filepath verdadero
        $uploadPath = $uploadDir . $newFileName;
        //se sube el archivo a uploads
        if (move_uploaded_file($fileTmp, $uploadPath)) {
            // es insertado a la base de datos
            $sql="INSERT INTO `documents`( `documentLocation`, `idTicket`) VALUES ('{$uploadPath}','{$ticketId}')";
                $result = $linkConexion->query($sql);
                //se envia un mail a todos los agentes informadoles del nuevo ticket
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->isHTML(true);
                    $mail->Host = $_ENV['MAIL_HOST'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['MAIL_USERNAME']; 
                    $mail->Password =  $_ENV['MAIL_PASSWORD']; 
                    $mail->Port =$_ENV['MAIL_PORT']; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
                    //se añaden todos los agentes al email
                    $result = $linkConexion->query("SELECT UserEmail FROM user WHERE UserTypes_idType = 2");
                    while ($row = $result->fetch_assoc()) {
                        $mail->addAddress($row['UserEmail']);
                    }
                    

                    $mail->Subject = "Added documentation Notification";
                    $mail->Body = "Extra documentation was added to the ticket with ID '{$ticketId}'";

                    $mail->send();
                    echo 'Email sent!';
                } catch (Exception $e) {
                    echo "Mailer Error: {$mail->ErrorInfo}";
                }
                
        }
    }
}