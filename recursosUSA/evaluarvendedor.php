<?php 
		session_start();

$conn =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
          $ced=$_SESSION['cedula'];

$comentario=pg_escape_string($_POST['comment']);
 $puntos=pg_escape_string($_POST['eval']);
 $producto=pg_escape_string($_POST['idprodu']);


      $query="select idusuario,rangousuario from productos where idproducto='$producto'";

        $resultado = pg_query($conn,$query) or die("al buscar informacion del vendedor");
        
        $dato1=pg_fetch_array($resultado);
     $idvendedor=$dato1['idusuario']; $rangovend=$dato1['rangousuario'];


        //fncion de numero aleatorio para generar la clave de evalv
 function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
 }
  $idevalv = 'evalv'. generarCodigo(7);


 $query="INSERT INTO evalv(ideval,comentario,puntuacion,rifcedc,produ,rifcedv,rangov) VALUES('" . $idevalv . "', '" . $comentario . "', '" . $puntos . "', '" . $ced . "', '" . $producto . "','" . $idvendedor . "','" . $rangovend . "')";

 $resultado = pg_query($conn,$query) or die("Error cargando evaluacion");






	    pg_close($conn);
 	header("HTTP/1.1 302 Moved Temporarily");
		header("Location: ../userA.php");
 ?>