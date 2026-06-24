<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();
 
  // Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];
   
  // Consulta segura para evitar inyecciones SQL.
  $query = sprintf("select email,password FROM contacto,usuario WHERE email='$email' AND password='$password' ");

  $resultado = pg_query($dbconn, $query) or die("Error en la Consulta SQL");


  // Verificando si el usuario existe en la base de datos.
  if(pg_num_rows($resultado) == 0){
	   pg_close($dbconn);
	   echo 'El email o password es incorrecto, <a href="../index.html">vuelva a intenarlo</a>.<br/>';
  }else{
	   // Guardo en la sesión el email del usuario.
           $query = "select rifcedula FROM usuario,contacto WHERE email='$email' and usuario.idcontacto=contacto.idcontacto";
         
           $resultado= pg_query($query) or die('Query failed: ' . pg_last_error());
           $ced =  pg_fetch_array($resultado);
	    pg_close($dbconn);
		$_SESSION['cedula'] = $ced[0];
		header("Location: principal.php");
  }
?>

