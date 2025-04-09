<?php
  require_once __DIR__ . '/vendor/autoload.php';
  //usar el enviroment
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  
  $Host = $_ENV["DB_HOST"];
  $User = $_ENV["DB_USERNAME"];
  $Password = $_ENV["DB_PASSWORD"];
  $BaseDeDatos=$_ENV["DB_DATABASE"];  
  $Port=$_ENV["DB_PORT"];

  //procedo al intento de conexion con esos parametros
  $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos, $Port);
  if ($linkConexion!=false) {
      
  }else {
      echo '<h3>Hubo algun error al intentar conectarse...</h3>';
  }
  ?>