<?php
  //usar el enviroment
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  //para el mysql instalado con Wamp, estos son los datos de conexion
  //$Host = '127.0.0.1';
  $Host = $_ENV["DB_HOST"];
  $User = $_ENV["DB_USERNAME"];
  $Password = $_ENV["DB_PASSWORD"];
  $BaseDeDatos=$_ENV["DB_DATABASE"];  

  //procedo al intento de conexion con esos parametros
  $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
  if ($linkConexion!=false) {
      
  }else {
      echo '<h3>Hubo algun error al intentar conectarse...</h3>';
  }
  ?>