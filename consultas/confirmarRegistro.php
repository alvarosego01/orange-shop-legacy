<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

    if(!isset($_SESSION)) { 
        session_start(); 
    } 
	if (isset($_GET['contUsr'])){
		$id = $_GET['contUsr'];
	}
	
  $query = ("UPDATE usuario SET estatus=2 WHERE idcontacto = '$id' ");
  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
   pg_close($dbconn);
  // Verificando si el usuario existe en la base de datos.
   header("HTTP/1.1 302 Moved Temporarily");
   header("Location: ../index.html");

?>

