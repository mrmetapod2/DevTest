<?php
session_start();
require_once "conexion.inc.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //extraigo los datos del psot
    
    $ticketName = $_POST['TicketName'];
    $ticketType = $_POST['TicketType'];
    $mode = $_POST['ModeOfTransport'];
    $origin = $_POST['CountryOrigin'];
    $destination = $_POST['CountryDestination'];
    $userID = $_POST['UserID'];
    

    // subo el archivo adjunto
    if (isset($_FILES['Document']) && $_FILES['Document']['error'] === UPLOAD_ERR_OK) {

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
                $sql ="INSERT INTO tickets (TicketName, TicketType, ModeOfTransport, CountryOrigin, CountryDestination, User_UserID, Document, Status ) VALUES ('{$ticketName}', {$ticketType}, '{$mode}', '{$origin}', '{$destination}', '{$userID}', '{$uploadPath}',1)";
                $result = $linkConexion->query($sql);
                //se envia un mail a todos los agentes informadoles del nuevo ticket
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = '47e41fee27bc84'; // usuario Mailtrap
                    $mail->Password = '1ea45e35d51691'; // contraseña Mailtrap
                    $mail->Port = 2525; // mailtrap pone multiples opciones
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                    $mail->setFrom('from@example.com', 'DevTest');
                    $result = $linkConexion->query("SELECT UserEmail FROM user WHERE UserTypes_idType = 2");
                    while ($row = $result->fetch_assoc()) {
                        $mail->addAddress($row['UserEmail']);
                    }
                    

                    $mail->Subject = "New ticket Notification";
                    $mail->Body = "new ticket '{$ticketName}' has been submitted by user ID: '{$userID}'.";

                    $mail->send();
                    echo 'Email sent!';
                } catch (Exception $e) {
                    echo "Mailer Error: {$mail->ErrorInfo}";
                }
                
                
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "File upload error.";
    }
} else {
    echo "Invalid request.";
}

header("Location: userTicket.php");
exit;
?>
