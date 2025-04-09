<?php
session_start();
require_once "conexion.inc.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/vendor/autoload.php';
//usar el enviroment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //extraigo los datos del psot
    
    $ticketName = $_POST['TicketName'];
    $ticketType = $_POST['TicketType'];
    $mode = $_POST['ModeOfTransport'];
    $origin = $_POST['CountryOrigin'];
    $destination = $_POST['CountryDestination'];
    $userID = $_POST['UserID'];
    

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
                $sql ="INSERT INTO tickets (TicketName, TicketType, ModeOfTransport, CountryOrigin, CountryDestination, User_UserID,  Status ) VALUES ('{$ticketName}', {$ticketType}, '{$mode}', '{$origin}', '{$destination}', '{$userID}', 1)";
                $result = $linkConexion->query($sql);
                $lastId = $linkConexion->insert_id;
                
                $sql="INSERT INTO `documents`( `documentLocation`, `idTicket`) VALUES ('{$uploadPath}','{$lastId}')";
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
                    

                    $mail->Subject = "New ticket Notification";
                    $mail->Body = "new ticket '{$ticketName}' has been submitted by user ID: '{$userID}'.";

                    $mail->send();
                    
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
