<?php 
    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

  session_start();

   // Obtengo los datos cargados en el formulario de subida de producto
  $nombre = pg_escape_string($_POST['nombre']);
  $categoria = pg_escape_string($_POST['categorias']);
  $precio = pg_escape_string($_POST['precio']);
  $stock = pg_escape_string($_POST['inventario']);
  $reseña = pg_escape_string($_POST['reseña']);
  $antiguedad = pg_escape_string($_POST['nuevousado']);

   $ced=$_SESSION['cedula'];

     function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
 }
  $idproducto = 'Prod'. generarCodigo(7);
   



 
 
 
 // si no existe la direccion a la que quiero guardar las fotos pues la creo aqui con esto ( no confio mucho en esta funcion pero aparecieron los datos dentro de recursosUSA)
   if(!is_dir("fotoproductos/"))
        mkdir("fotoproductos/", 0777);
     








// Como el combobox de seleccion de categoria viene dado como (categoria---subcategoria) introducido por un array entonces se requiere separar ambos para identificar el id de categorias que se requiere incluir en productos
// list($cate, $subcate) = explode(" ", $categoria);
  $queri="select idcategoria from categorias where nombre='$categoria'";
    $resultado = pg_query($dbconn,$queri) or die("Error en extraccion de categorias");
// una vez encontrado el id de categorias que se requiere incluir en la informacion de producto se procede a  incluirlo   
   $idcat=pg_fetch_array($resultado);

//Como el producto tiene una fecha incicial necesitamos saber cuando va a caducar asi que se realizan los calculos




 
   $plazoplan ="select plazo from planes where idplan=(select plan from usuario where rifcedula='$ced')";
   $resultadoplan = pg_query($plazoplan) or die('Query failed: ' . pg_last_error());
   $plazofinal = pg_fetch_array($resultadoplan);
   $plaz=$plazofinal['plazo'];




   $fechaini= date('d-m-Y');



    $fechasumada = date('d-m-Y', strtotime($fechaini . "+$plaz days"));

    



    $querirango="select rango from usuario where rifcedula='$ced'";
    $resuquerirango= pg_query($querirango) or die ('fallo al buscar el rango'.pg_last_error());
    $rangoo=pg_fetch_array($resuquerirango);
    $raango=$rangoo['rango'];

  // Consulta segura para evitar inyecciones SQL.
  $query = "INSERT INTO productos(idproducto,nombreproducto,resena,plazoini,plazofin,stock,precio,categori,idusuario,rangousuario,antiguedad) VALUES('" . $idproducto . "','" . $nombre . "', '" . $reseña . "', '" . $fechaini . "', '" . $fechasumada . "', '" . $stock . "', '" . $precio . "', '" . $idcat['idcategoria'] . "', '" . $ced . "', '" . $raango . "', '" . $antiguedad . "')";
    $resultado = pg_query($dbconn,$query) or die("error insertando datos de productos");







    // Recibo los datos de la imagennes y si existen se cargan.. si no pues no.. 
    $nombre1 = $_FILES['archivo1']['name'];
   if($nombre1 &&  move_uploaded_file($_FILES['archivo1']['tmp_name'],"fotoproductos/".$nombre1)){
             
    $sql = "INSERT into fotos (idproducto,fotoproductos,numerofoto) values ('" . $idproducto . "','" . $nombre1 . "',1)";
    $resultado = pg_query($dbconn,$sql) or die("error insertando datos de fotos");

  }


     $nombre2 = $_FILES['archivo2']['name'];
   if($nombre2 &&  move_uploaded_file($_FILES['archivo2']['tmp_name'],"fotoproductos/".$nombre2)){
          $sql = "INSERT into fotos (idproducto,fotoproductos,numerofoto) values ('" . $idproducto . "','" . $nombre2 . "',2)";
    $resultado = pg_query($dbconn,$sql) or die("error insertando datos de fotos");

  }



     
        $nombre3 = $_FILES['archivo3']['name'];
   if($nombre3 &&  move_uploaded_file($_FILES['archivo3']['tmp_name'],"fotoproductos/".$nombre3)){
  $sql = "INSERT into fotos (idproducto,fotoproductos,numerofoto) values ('" . $idproducto . "','" . $nombre3 . "',3)";
    $resultado = pg_query($dbconn,$sql) or die("error insertando datos de fotos");

  }

               $nombre4 = $_FILES['archivo4']['name'];
   if($nombre4 &&  move_uploaded_file($_FILES['archivo4']['tmp_name'],"fotoproductos/".$nombre4)){
                      $sql = "INSERT into fotos (idproducto,fotoproductos,numerofoto) values ('" . $idproducto . "','" . $nombre4 . "',4)";
    $resultado = pg_query($dbconn,$sql) or die("error insertando datos de fotos");

  }

                    $nombre5 = $_FILES['archivo5']['name'];
   if($nombre5 &&  move_uploaded_file($_FILES['archivo5']['tmp_name'],"fotoproductos/".$nombre5)){
                        $sql = "INSERT into fotos (idproducto,fotoproductos,numerofoto) values ('" . $idproducto . "','" . $nombre5 . "',5)";
    $resultado = pg_query($dbconn,$sql) or die("error insertando datos de fotos");

  }

                       $nombre6 = $_FILES['archivo6']['name'];
   if($nombre6 &&  move_uploaded_file($_FILES['archivo6']['tmp_name'],"fotoproductos/".$nombre6)){
                              $sql = "INSERT into fotos (idproducto,fotoproductos,numerofoto) values ('" . $idproducto . "','" . $nombre6 . "',6)";
    $resultado = pg_query($dbconn,$sql) or die("error insertando datos de fotos");

  }

      // hasta aqui la subida de fotos          
  







	    pg_close($dbconn);
		header("HTTP/1.1 302 Moved Temporarily");
		header("Location: ../userA.php");
   

 ?>

