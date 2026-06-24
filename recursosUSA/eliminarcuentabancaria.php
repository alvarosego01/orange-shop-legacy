<?php 
    
  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();

   // Obtengo los datos cargados en el formulario de subida de producto
  $nombrebanco = pg_escape_string($_POST['c']);
 
list($nombre, $numero, $tipo) = explode("--", $nombrebanco);

       $ced=$_SESSION['cedula'];
              
              $query="SELECT  contactobanco from banco,contacto,usuario where usuario.idcontacto=(select idcontacto from usuario where rifcedula='$ced') and contactobanco=contacto.idcontacto limit 1";
              $resultado = pg_query($dbconn,$query) or die("error buscando el idcontacto");
              $cont=pg_fetch_array($resultado);
              $contacto=$cont['contactobanco'];



        $queri="DELETE FROM  banco where contactobanco='$contacto' and nombrebanco='$nombre' and numerocuenta='$numero' ";
    $resultado = pg_query($dbconn,$queri) or die("error eliminando el banco");


	    pg_close($dbconn);
		header("HTTP/1.1 302 Moved Temporarily");
		header("Location: ../userA.php");
   

 ?>