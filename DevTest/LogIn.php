<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <?php 
            //inicio conexcion con BDD
            session_start();
            require_once "conexion.inc.php";
            
        ?>
        <h2>Login</h2>

        <form action="login.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
            
        </form>
        <form action="Register.php">
            <input type="submit" value="Register">
        </form>
        <?php 
        //me aseguro que el usuario haya apretado login
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //obtengo los datos de los inputs
            $user = $_POST['username'] ?? '';
            $pass = $_POST['password'] ?? '';
            

            //obtengo los usuarios con el nombre de usuario
            $sql="SELECT * FROM `user` WHERE `UserName` = '{$user}'";

            $result = $linkConexion->query($sql);
            //voy atravez de todos los usuarios con ese nombre y observo si la contraseña coinside
            while ($row = $result->fetch_assoc()) {
                if (password_verify($pass, $row['UserPass'])) {
                    // si las contraseñas coinden el usuario es mandado a la pagina correspondiente con sus datos guardados en la session
                    $_SESSION['UserID'] = $row['UserID'];
                    $_SESSION['UserName'] = $row['UserName'];
                    $_SESSION['UserEmail'] = $row['UserEmail'];
                    $_SESSION['UserType'] = $row['UserTypes_idType'];

                    if ($row['UserTypes_idType'] == 1) {
                        header("Location: userTicket.php");
                    } elseif ($row['UserTypes_idType'] == 2) {
                        header("Location: agentPage.php");
                    } else {
                        echo "Unknown user type.";
                    }
                    

                    $found = true;
                    break;
                }
            }
        }


        ?>


    </body>
</html>