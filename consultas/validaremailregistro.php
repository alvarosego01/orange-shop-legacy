<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();

 
   if(pg_escape_string($_POST['maa'])){
     // Obtengo los datos cargados en el formulario de login.
  $m = pg_escape_string($_POST['maa']);
  // Consulta segura para evitar inyecciones SQL.

  $queri = ("SELECT email FROM contacto WHERE email = '".$m."' ");
  $resultad = pg_query($dbconn,$queri) or die("Error en la Consulta SQL");
  $contr = pg_num_rows($resultad);
  
  // Verificando si el usuario existe en la base de datos.
  if ($contr==0) {
      echo 1;
   }
   else{
     echo 0;
   }
      
   }


pg_close($dbconn);
?>

