<?php 

    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();

   // Obtengo los datos cargados en el formulario de subida de producto
  $nombrebanco = pg_escape_string($_POST['nombrebanco']);
  $numerocuenta = pg_escape_string($_POST['numerocuenta']);
  $tipocuenta = pg_escape_string($_POST['tipocuenta']);


       $ced=$_SESSION['cedula'];
              
              $query="select idcontacto from usuario where rifcedula='$ced'";
              $resultado = pg_query($dbconn,$query) or die("error buscando el idcontacto");
              $cont=pg_fetch_array($resultado);




        $queri="INSERT INTO banco(contactobanco,nombrebanco,numerocuenta,tipo)values('" . $cont['idcontacto'] . "','" . $nombrebanco . "','" . $numerocuenta . "','" . $tipocuenta . "')";
    $resultado = pg_query($dbconn,$queri) or die("error insertando datos de banco ");


	    pg_close($dbconn);
		header("HTTP/1.1 302 Moved Temporarily");
		header("Location: ../userA.php");
   



 ?>