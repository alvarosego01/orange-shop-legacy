<?php
   $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
  session_start();
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['cedula'])){
    // Le doy la bienvenida al usuario.
         $dato=$_SESSION['cedula'];
         $query = sprintf("select rango FROM usuario WHERE rifcedula='$dato' ");

         $resultado = pg_query($dbconn, $query) or die("Error en la Consulta SQL");
         $ra =  pg_fetch_array($resultado);
      
          if($ra['rango']=='a'){
			$_SESSION['rango']='A';
            pg_close($dbconn);
			header("Location: ../userA.php");
		  }
		  else if($ra['rango']=='b'){
		   $_SESSION['rango']='B';
           pg_close($dbconn);
		   header("Location: ../userB.php");
		 }
		 else if($ra['rango']=='c'){
		 $_SESSION['rango']='C';
           pg_close($dbconn);
		   header("Location: ../userC.php");
		 }
		 else if($ra['rango']=='d'){
		   $_SESSION['rango']='D';
           pg_close($dbconn);
		   header("Location: ../userD.php");
		 }
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily");
    header("Location: ../index.html");
  }
?>