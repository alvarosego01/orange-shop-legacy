<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();
 
  // Obtengo los datos cargados en el formulario de login.
  $email = pg_escape_string($_POST['email']);
  $password = pg_escape_string($_POST['password']);
  $nombre = pg_escape_string($_POST['name']);   
  $lastname = pg_escape_string($_POST['lastname']);
  $cedula = pg_escape_string($_POST['cedula']);
  $country = pg_escape_string($_POST['country']);
  $direccion = pg_escape_string($_POST['Direccion']);
  $password = pg_escape_string($_POST['password']);
  $estado = pg_escape_string($_POST['estado']);
  $parroquia = pg_escape_string($_POST['parroquia']);
  $ciudad = pg_escape_string($_POST['ciudad']);

//fncion de numero aleatorio para generar la clave de contacto
 function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
 }
  $idcontacto = 'Cont'. generarCodigo(7);

  //Msj para el Email
  $mensaje = "Bienvenido, Gracias por Registrarte en Orange Shop\r\nPor Favor usa el siguiente enlace para verificar su cuenta:\r\nhttp://localhost:8080/Orange%20Shopv2/consultas/confirmarRegistro.php?contUsr=$idcontacto";
  $mensaje = wordwrap($mensaje, 70, "\r\n");

  // Consulta segura para evitar inyecciones SQL.
  $query = "INSERT INTO usuario(rifcedula,nombre,apellido,password) VALUES('" . $cedula . "', '" . $nombre . "', '" . $lastname . "', '" . $password . "')";

 $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL en usuarios");

 // se procesan los datos de contacto con su clave primaria generada 
  $query = "INSERT INTO contacto(idcontacto,pais,ciudad,estado,parroquia,direccion,email) VALUES('" . $idcontacto . "', '" . $country . "', '" . $ciudad . "', '" . $estado . "', '" . $parroquia . "', '" . $direccion . "', '" . $email . "')";
  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
   //se actualiza la clave foranea de usuarios con la clave primaria de contacto
  $query = "UPDATE usuario set idcontacto='$idcontacto' where rifcedula='$cedula'";
  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
  // Verificando si el usuario existe en la base de datos.
  if (!$resultado) {
      $errormessage = pg_last_error();
      echo "Error with query: " . $errormessage;
	  pg_close($dbconn);
      exit();
   }
   else{
	    mail($email, 'Confirmar su Cuenta en Orange Shop', $mensaje);
	    $_SESSION['cedula'] = $cedula;
	    pg_close($dbconn);
		header("HTTP/1.1 302 Moved Temporarily");
		header("Location: principal.php");
   }
?>

 