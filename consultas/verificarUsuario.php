<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();
 
  if(pg_escape_string($_REQUEST['cedu'])){
     // Obtengo los datos cargados en el formulario de login.
  $ci = pg_escape_string($_REQUEST['cedu']);
  // Consulta segura para evitar inyecciones SQL.

  $query = ("SELECT rifcedula FROM usuario WHERE rifcedula = '".$ci."' ");
  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
  $contar = pg_num_rows($resultado);
 
  // Verificando si el usuario existe en la base de datos.
   if ($contar==0) {
      echo 1;
   }
   else{
	   echo 0;
   }
      
   }

pg_close($dbconn);
?>

