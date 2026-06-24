<?php 


	session_start();

		// Primero hay que hacer la conexion a la base de datos 
		$conn =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
          $ced=$_SESSION['cedula'];

     $cantidadcomprar = pg_escape_string($_POST['cantidadcomprar']);
     $idproducto= pg_escape_string($_POST['idproducto']);
     $idvendedor= pg_escape_string($_POST['idvendedor']);
     $banco= pg_escape_string($_POST['banco']);
     $metodoenvio= pg_escape_string($_POST['envio']);
      

//fncion de numero aleatorio para generar la clave de compra
 function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
 }
  $idcompra = 'comp'. generarCodigo(7);

  $fechac= date('d-m-Y');

  $datosadicionalesquery="select precio from productos where idproducto='$idproducto'";
  $r = pg_query($conn,$datosadicionalesquery) or die("Error en en la busqueda de datos adicionales de la compra o producto");
  $datosadicionales=pg_fetch_array($r);

  $costo=$cantidadcomprar*$datosadicionales['precio'];

  $estado='Pagado y por evaluar';
  $rifcedul=$ced;


$queri =" select idcategoria from categorias where idcategoria=(select categori from productos where idproducto = '$idproducto')";
$res = pg_query($conn,$queri) or die('error buscando categoria');
 $catt=pg_fetch_array($res);
 
 $que="update categorias set ctvend=ctvend+$cantidadcomprar where idcategoria='".$catt['idcategoria']."' ";
 $q = pg_query($conn,$que) or die('eerror insertando ctvend');
 
  // Consulta segura para evitar inyecciones SQL.
  $query = "INSERT INTO compras(idcompra,fechac,costo,estado,cantidad,rifcedul,idprodu,modoenvio) VALUES('" . $idcompra . "', '" . $fechac . "', '" . $costo . "', '" . $estado . "','" . $cantidadcomprar . "','" . $rifcedul . "', '" . $idproducto . "', '" . $metodoenvio . "')";

 $resultado = pg_query($conn,$query) or die('no puede ser menor la cantidad, <a href="../userA.php">regresar</a>.<br/>');



/*
--------------------------------------------------- DISPARADOR-------------------------------------------------

CREATE OR REPLACE FUNCTION validarcantidad() RETURNS trigger AS $$
  BEGIN
      IF (NEW.cantidad > (select stock from productos where idproducto=NEW.idprodu))  THEN
          RAISE EXCEPTION 'no puede ser menor la cantidad';
        ELSIF (NEW.cantidad <= (select stock from productos where idproducto=NEW.idprodu)) THEN
            update productos set stock=stock-NEW.cantidad,cantvend=cantvend+NEW.cantidad where idproducto=NEW.idprodu;
      END IF;
    
      RETURN NEW;
  END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER validarcantidad BEFORE INSERT OR UPDATE ON compras
  FOR EACH ROW EXECUTE PROCEDURE validarcantidad();


--------------------------------------------------- DISPARADOR-------------------------------------------------



*/





	    pg_close($conn);
 	header("HTTP/1.1 302 Moved Temporarily");
		header("Location: ../userA.php");


 ?>