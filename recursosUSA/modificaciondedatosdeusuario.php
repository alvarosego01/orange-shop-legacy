<?php 
       
 
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
   session_start();

  // Obtengo los datos cargados en el formulario de login.
  $nwnombre = pg_escape_string($_POST['modifnombre']);
  $nwapellido = pg_escape_string($_POST['modifapellido']);
  $nwemail = pg_escape_string($_POST['modifemail']);   
  $nwtelefono = pg_escape_string($_POST['modiftelefono']);
  $nwpais = pg_escape_string($_POST['modifpais']);
  $nwestado = pg_escape_string($_POST['modifestado']);
  $nwparroquia = pg_escape_string($_POST['modifparroquia']);
  $nwciudad = pg_escape_string($_POST['modifciudad']);
  $nwdireccion=pg_escape_string($_POST['modifdireccion']);
  $nwpassword = pg_escape_string($_POST['modifpassword']);
  $ced=$_SESSION['cedula'];



 
  // Consulta segura para evitar inyecciones SQL.
  $query = "update usuario set nombre='$nwnombre',apellido='$nwapellido',password='$nwpassword' where rifcedula='$ced'";
    $resultado = pg_query($dbconn,$query) or die("error insertando modificaciones de  usuarios");
  $query = "update contacto set email='$nwemail',telefono='$nwtelefono',pais='$nwpais',estado='$nwestado',parroquia='$nwparroquia',ciudad='$nwciudad',direccion='$nwdireccion' where idcontacto=(select idcontacto from usuario where rifcedula='$ced')";
    $resultado = pg_query($dbconn,$query) or die("error insertando datos de modificaciones de contactos ");




	    pg_close($dbconn);
          header("HTTP/1.1 302 Moved Temporarily");
		header("Location: ../userA.php");





 ?>

