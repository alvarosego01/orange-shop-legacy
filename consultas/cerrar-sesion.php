<?php
  session_start();
  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  // Elimina la variable cedula en sesión.
  unset($_SESSION['cedula']); 
  // Elimina la sesion.

 
  pg_close();

  session_destroy();
  
  // Redirecciona a la página de login.
  header("HTTP/1.1 302 Moved Temporarily"); 
  header("Location: ../index.html");
?>

