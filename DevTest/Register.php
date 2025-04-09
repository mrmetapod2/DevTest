<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<?php
    require 'vendor\autoload.php';
    //inicio conexcion con la BDD
    require_once "conexion.inc.php";
    //uso el mailer para enviar emails
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    //usar el enviroment
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    ?>

    <h2>Register</h2>

    <form action="Register.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="Email">Email:</label><br>
        <input type="Email" id="Email" name="Email" required><br><br>

        <label>Account Type:</label><br>
        <input type="radio" id="user" name="account_type" value="User" required>
        <label for="user">User</label><br>

        <input type="radio" id="agent" name="account_type" value="Agent">
        <label for="agent">Agent</label><br><br>

        <input type="submit" value="Register">
        
    </form>
    <form action="LogIn.php">
        <input type="submit" value="Login">
    </form>
    <?php
    //me aseguro que el usuario haya apretado register
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';
        $email = $_POST['Email'] ?? '';
        $acc_type = $_POST['account_type'] ?? '';
       
        //obtengo los datos ingresados
       

        // valido la contraseña para que sea segura
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $length    = strlen($pass) >= 8;

        if (!$uppercase || !$lowercase || !$number || !$length) {
            //si no es segura informo al usuario para cambiarla
            die("Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.");
        }

        //la hasheo para extra proteccion 
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

        //añado el usuario a la BDD dependiendo si es usuario o agente
        if($acc_type=="User"){
            $sql = "INSERT INTO `user` (`UserName`, `UserPass`, `UserEmail`) VALUES ('{$user}', '{$hashed_pass}', '{$email}')";
        }
        else if($acc_type=="Agent"){
            $sql = "INSERT INTO `user` (`UserName`, `UserPass`, `UserEmail`, `UserTypes_idType`) VALUES ('{$user}', '{$hashed_pass}', '{$email}', '2')";
        }
        else{
            //si no aviso si hay un problema
            die("Must have an account type");
        }
        $result = $linkConexion->query($sql);

       //envio un mail de notificacion usando mailtrap como demo
       

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
            $mail->addAddress($email, 'Receiver');
            
            $mail->Subject = 'Account registtration succesful';
            $mail->Body = "the account of the user '{$user}' has been registered succesfully.";
            
            $mail->send();
            echo 'Email sent!';
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }
    ?>

</body>
</html>