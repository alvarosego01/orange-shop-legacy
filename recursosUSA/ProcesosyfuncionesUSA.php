<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	
	function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul style="float:right;"  class="pagination no-margin pagination-large">';
	
	// previous label

	if($page==1) {
		$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li><span><a href='javascript:void(0);' onclick=load(1,'" .$reload."')>$prevlabel</a></span></li>";
	}else {
		$out.= "<li><span><a href='javascript:void(0);' onclick=load(".($page-1).",'" .$reload."')>$prevlabel</a></span></li>";

	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= "<li><a href='javascript:void(0);' onclick=load(1,'" .$reload."')>1</a></li>";
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "<li><a>...</a></li>";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li><a href='javascript:void(0);' onclick=load(1,'" .$reload."')>$i</a></li>";
		}else {
			$out.= "<li><a href='javascript:void(0);' onclick=load(".$i.",'" .$reload."')>$i</a></li>";
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "<li><a>...</a></li>";
	}

	// last

	if($page<($tpages-$adjacents)) {
		$out.= "<li><a href='javascript:void(0);' onclick=load($tpages,'" .$reload."')>$tpages</a></li>";
	}

	// next

	if($page<$tpages) {
		$out.= "<li><span><a href='javascript:void(0);' onclick=load(".($page+1).",'" .$reload."')>$nextlabel</a></span></li>";
	}else {
		$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}

      function datosUSA($lin){// muestra los datos en el panel inicial del usuario a
          
		// Primero hay que hacer la conexion a la base de datos 
		$conn =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
          $ced=$_SESSION['cedula'];
// Guardas la consulta en una variable 
           $query="select nombre,apellido,rifcedula,email,telefono,rango,estatus,pais,estado,parroquia,ciudad,direccion,plan from usuario,contacto where rifcedula='$ced' and usuario.idcontacto=contacto.idcontacto"; 
           $result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Ejecutas la consulta y guardas el resultado en una variable 
//$result=pg_exec($conn,$query); 

// Asi obtienes el número de filas de la consulta 
		$cont=pg_numrows($result); 


		$fila =  pg_fetch_array($result);
             
          
            if(($fila[5]=='a')and($lin==5)){
               $fila[$lin]='Usuario regular';
            }
            if(($fila[5]=='b')and($lin==5)){
                $fila[$lin]='Administrador';
            }
            if(($fila[5]=='c')and($lin==5)){
                $fila[$lin]='Gerente';
            }
             if(($fila[5]=='d')and($lin==5)){
                $fila[$lin]='Super Usuario';
            }

             
              if(($fila[6]==1)and($lin==6)){
               $fila[$lin]='En revision';
           }
              if(($fila[6]==2)and($lin==6)){
               $fila[$lin]='Activo';
           }
               if(($fila[6]==3)and($lin==6)){
               $fila[$lin]='Bloqueado';
           }

		
		echo $fila[$lin]; 
		pg_close($conn);
    }

    function plan(){
        $con =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
// Guardas la consulta en una variable 


            $queri="select planes.nombre from usuario,planes where  plan=idplan"; 
           $resul = pg_query($queri) or die('error consulta de plan' . pg_last_error());
           

    $plan =  pg_fetch_array($resul);
    echo $plan[0];
    pg_close($con);
    }


function eliminarproducto($action){ // funcion que elimina los productos
   

    
    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
    $query = sprintf("delete from productos where idproducto='$action'");
      $resultado = pg_query($dbconn,$query) or die("Error eliminando producto");

   pg_close($dbconn);

}

 if(isset($_POST['pro'])) { // funcion que proviene del ajax y que procede a eliminar y posteriormente a re construir las publicaciones 
     

  
     $action = $_POST['pro'];

  
      eliminarproducto($action);
      publicacion();
  
  }  

function publicacion(){//Funcion que construye todos los elementos publicados del usuario
    

    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
     $ced=$_SESSION['cedula'];
    $query = sprintf("select idproducto,nombreproducto,stock,cantvend,precio from productos,usuario where idusuario='$ced' and rifcedula=idusuario");

    $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
  




  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 5; //la cantidad de registros que desea mostrar
    $adjacents  = 0; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    $count_query   = pg_query($dbconn,"SELECT count(*) AS numrows FROM productos where idusuario='$ced'");
    if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);

 $ced=$_SESSION['cedula'];
 $query = sprintf("select idproducto,nombreproducto,stock,cantvend,precio from productos,usuario where idusuario='$ced' and rifcedula=idusuario LIMIT $per_page OFFSET $offset");

    $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
  




     while($filas = pg_fetch_array($resultado)) {
      $idpro = $filas['idproducto'];
      $nombrepro=$filas['nombreproducto'];
      $stock=$filas['stock'];
      $cantvend=$filas['cantvend'];
      $precio=$filas['precio'];
      
    

      echo '<br>';
      echo '<li class="list-group-item" name="idprod">';
       echo '<label"> ' .$nombrepro. ' </label>';
     echo '<div class="pull-right action-buttons">';
                 echo '<a href="productInfo.php?pro='.$idpro.'" ><span class="glyphicon glyphicon-pencil"></span></a>';
                 echo "<a class=\"trash\" onclick=\"public('$idpro');\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
			echo '</div>';
      echo '</li>';
        echo '<div class="pull-right action-buttons">';
                 echo '<h9><span class="label label-warning">Precio: ' .$precio. ' Bs.F</span></h9>';
                 echo '<h9><span class="label label-warning">Vendido: ' .$cantvend. '</span></h9>';
                 echo '<h9><span class="label label-warning">Disponible: ' .$stock. '</span></h9>';
			echo '</div>';

  }  
    echo paginate('Publicaciones', $page, $total_pages, $adjacents);
	echo "<a href='uploadProduct.php' class='btn btn-primary btn-lg btn3d botonPublicacion' float:right;'>+Publicación</a>";

    pg_close($dbconn);
}
     



 

 if(isset($_POST['idcompr'])){ // funcion que proviene del ajax y que procede a eliminar y actualizar las compras aun en proceso 

  
     $idcompra = $_POST['idcompr'];
     $comentario = $_POST['comentario'];
     $evaluacion = $_POST['evaluacion'];
     $idprodu = $_POST['idprodu'];

      evaluarvendedor($idcompra,$comentario,$evaluacion,$idprodu);
      mostrarcompras();
  
  }  



function evaluarvendedor($idcompra,$comentario,$puntos,$producto){// carga el comentario evaluativo del comprador-vendedor

  $conn =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
          $ced=$_SESSION['cedula'];



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


 $query="INSERT INTO evalv(ideval,comentario,puntuacion,rifcedc,produ,rifcedv,rangov) VALUES('" . $idevalv . "', '" . $comentario . "', '" . $puntos . "', '" . $ced . "', '" . $idcompra . "','" . $idvendedor . "','" . $rangovend . "')";
 $resultado = pg_query($conn,$query) or die("Error cargando evaluacion");



   $query="UPDATE compras SET estado = 'FINALIZADO' WHERE idcompra='$idcompra'";
    $resultado = pg_query($conn,$query) or die("Error modificando el estado de la compra");

pg_close($conn);


}




function mostrarcompras(){ // muestra las compras en el centro del panel de usuario A

$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
    



     $ced=$_SESSION['cedula'];


    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 5; //la cantidad de registros que desea mostrar
    $adjacents  = 0; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    $count_query   = pg_query($dbconn,"SELECT count(*) AS numrows FROM compras where estado='Pagado y por evaluar' and rifcedul='$ced'");
    if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);




$query = sprintf("select idcompra,costo,cantidad,estado,nombreproducto,idprodu from compras,productos where idprodu=idproducto and compras.rifcedul='$ced' LIMIT $per_page OFFSET $offset ");

    $resultado = pg_query($dbconn,$query) or die("Errror buscndo datos de compra");

  

     while($filas = pg_fetch_array($resultado)){
    
    $idcompra=$filas['idcompra'];
    $costo=$filas['costo'];
    $cantidad=$filas['cantidad'];
    $estado=$filas['estado'];
    $nombreproducto=$filas['nombreproducto'];
    $idprodu=$filas['idprodu'];


      
if($estado=='Pagado y por evaluar'){



 echo '     <li class="list-group-item">';
echo '                         <label>';
echo '                              '.$nombreproducto.'--Costo--'.$costo.' Bs.F';
echo '                          </label>';
  echo '<input type="hidden" name="idprodu" id="producto" value="'.$idprodu.'" />'; 
                           
  echo '  <div class="row">';
   echo ' <div class="col-md-12">';
  echo '  <form class="formtest">';
 echo ' <button type="button" class="btaval btn btn-primary btn3d" data-toggle="collapse" data-target="#'.$idcompra.'" onClick="esconder(this)">Producto recibido?</button>';
   echo '              <div id="'.$idcompra.'" class="collapse">';
     echo '               <div class="col-md-12  ">';
echo ' <textarea cols="40" id="co'.$idcompra.'" name="comment" value="" placeholder="Evalua al vendedor" rows="3"></textarea>';
   

echo '  <h6>Calificacion</h6>';
   echo '<select id="ev'.$idcompra.'" name="eval" class="form-control product-type"  ">';
echo '  <option value="Excelente">Excelente</option>';
echo '  <option value="Buena">Buena</option>';
echo '  <option value="Regular">Regular</option>';
echo '  <option value="Mala">Mala</option></select>';
               
                  

                  
  echo '       <div class="text-right">';
   echo "<a href=\"#\" onclick=\"vercompras('$idcompra');\">  <button class=\"btn-success btaval btn btn3d\" data-toggle=\"collapse\"> <i class=\"fa fa-reply\"></i> enviar </button></a>";

   echo ' <span class="btn btn-danger btn-success btaval btn3d" data-toggle="collapse" data-target="#'.$idcompra.'" onClick="mostrar()">Cancelar <i class="fa fa-times"></i> </span>';
   echo '</div></div> </div></form></div></div> </li>';

}  
}
  echo paginate('Compras', $page, $total_pages, $adjacents);
  pg_close($dbconn);
}




if(isset($_POST['action'])) {
     $action = $_POST['action'];
   echo '<script type="text/javascript">eeeee</script>';
     if($action == 'Publicaciones'){
       publicacion();
     }
     else if($action == 'Compras'){
       mostrarcompras();
     }  
     else if($action == 'Porvendedor'){
     porvendedor();
     }  
     else if($action == 'Porcomprador'){
   
            porcomprador();

     }
   $action=null;
  } 

 










function porvendedor(){ // muestra el comentario de evaluacion al vendedor en el gestor de evaluaciones


    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
     $ced=$_SESSION['cedula'];




    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 5; //la cantidad de registros que desea mostrar
    $adjacents  = 0; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    $count_query   = pg_query($dbconn,"SELECT  count(*) as numrows from evalv where rifcedv='$ced'");
    if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);







    $query = sprintf("select ideval,comentario,puntuacion,rifcedc,produ,rifcedv,rangov,fechac from evalv,compras where produ=idcompra and rifcedv='$ced' LIMIT $per_page OFFSET $offset ");

    $resultado = pg_query($dbconn,$query) or die("Errror buscando datos de la evaluacion de vendedor");



while($filas = pg_fetch_array($resultado)) {
      $comentario = $filas['comentario'];
            $puntuacion = $filas['puntuacion'];
                  $idcomprador = $filas['rifcedc'];
                    $idcompra = $filas['produ'];
                    $idvendedor = $filas['rifcedv'];
                    $fecha=$filas['fechac'];
                    $ideval=$filas['ideval'];

$queri = sprintf("select idcompra from compras where idcompra='$idcompra'");

    $estadoquery = pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $r=pg_fetch_array($estadoquery);
       $estado=$r['idcompra'];


       $queri = sprintf("select nombre from usuario where rifcedula='$idcomprador'");

    $c1= pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $c=pg_fetch_array($c1);
       $comprador=$c['nombre'];

     $queri = sprintf("select nombre from usuario where rifcedula='$ced'");

    $vend= pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $ve=pg_fetch_array($vend);
       $vendedor=$ve['nombre'];



 $queri=sprintf("select costo,nombreproducto,estado from compras,productos where idprodu=idproducto and  idcompra='$idcompra'");

    $info= pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $i=pg_fetch_array($info);
       $costo=$i['costo']; $nombreproducto=$i['nombreproducto']; $estado=$i['estado'];


      echo '<br>';
      echo '<li class="list-group-item" >';
       echo '<label>Producto: ' .$nombreproducto. ' </label>';
            echo '<div class="pull-right action-buttons">';


echo ' <div class="row">';
   echo ' <div class="col-md-12">';
  echo '  <form class="formtest">';
                if($estado=='FINALIZADO'){
                 echo '<a href="#" data-toggle="collapse" data-target="#'.$ideval.'"><span class="glyphicon glyphicon-pencil" ></span></a>';
                }
                            

 

   echo '              <div id="'.$ideval.'" class="collapse">';
     echo '               <div class="col-md-12  ">';
echo ' <textarea cols="40" id="res'.$idcompra.'" name="respuesta" value="" placeholder="Evalua al comprador" rows="3"></textarea>';

echo '  <h6>Calificacion</h6>';
echo '<select id="eva'.$idcompra.'" name="evalcomp" class="form-control product-type"  ">';
echo '  <option value="Excelente">Excelente</option>';
echo '  <option value="Buena">Buena</option>';
echo '  <option value="Regular">Regular</option>';
echo '  <option value="Mala">Mala</option></select>';  
                  

                  
  echo '       <div class="text-right">';
   echo "<a href=\"#\" onclick=\"respondercomprador('$idcompra');\">  <button class=\"btn-success btaval btn btn3d\" data-toggle=\"collapse\"> <i class=\"fa fa-reply\"></i> Enviar </button></a>";

   echo ' <span class="btn btn-danger btn-success btaval btn3d" data-toggle="collapse" data-target="#'.$ideval.'" onClick="mostrar()">Cancelar <i class="fa fa-times"></i> </span>';
 

   echo '</div></div> </div></form></div></div>';

  

                               echo '</div>';
    echo '<div><p name="comentario" id="comentario">Comentario: '.$comentario.'</p></div>';
             echo '<div style="float:right; ">';
                      echo '<h9><span class="label label-warning">Ingreso: ' .$costo. ' Bs.F</span></h9>';
                      echo '<h9><span class="label label-warning">fecha: ' .$fecha. '</span></h9>';
                      echo '<h9><span class="label label-warning">Comprador: ' .$comprador. '</span></h9>';
                      echo '<h9><span class="label label-warning">Valoracion: ' .$puntuacion. '</span></h9>';




             echo '</div> </li>';



  }  
 
  echo paginate('Porvendedor', $page, $total_pages, $adjacents);
  pg_close($dbconn);

 




}







 if(isset($_POST['idcompraa'])){ // funcion ajax que da respuesta de evaluacion al comprador y ademas elimina la posibilidad de volver a responder
 
  
     $idcompraa = $_POST['idcompraa'];
     $comentarioo = $_POST['comentarioo'];
     $evaluacionn = $_POST['evaluacionn'];
 

      respuestacomprador($idcompraa,$comentarioo,$evaluacionn);
      porvendedor();
  
  }  


function respuestacomprador($idcompraa,$comentarioo,$evaluacionn){//cargar comentario al comprador



    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
     $ced=$_SESSION['cedula'];

    $query = sprintf("UPDATE compras SET estado = 'CERRADO' WHERE idcompra='$idcompraa'");

    $resultado = pg_query($dbconn,$query) or die("Errror modificando el estado de compra");

     


 function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
 }
  $idevalp = 'evalp'. generarCodigo(7);

       

    $query = "select rango from usuario where rifcedula='$ced'";

    $resultado = pg_query($dbconn,$query) or die("Errror buscando el rango del vendedor que responde");

    $ra=pg_fetch_array($resultado);


    $query ="INSERT INTO evalp(ideval,comentario,puntuacion,rifven,rangoven) VALUES('" . $idevalp . "', '" . $comentarioo . "', '" . $evaluacionn . "', '" . $ced . "', '" . $ra['rango'] . "')";

    $resultado = pg_query($dbconn,$query) or die("Errror cargando el comentario de respuesta de vendedor-comprador");



    $query = sprintf("UPDATE compras SET evalp = '$idevalp' WHERE idcompra='$idcompraa'");

    $resultado = pg_query($dbconn,$query) or die("Errror enlazando el comentario de respuesta con la compra realizada");
    


    pg_close($dbconn);


}






function porcomprador(){



    $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
     $ced=$_SESSION['cedula'];

   
 $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 5; //la cantidad de registros que desea mostrar
    $adjacents  = 0; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    $count_query   = pg_query($dbconn,"SELECT count(*) as numrows from evalp,compras where rifcedul='$ced' and evalp=ideval ");
    if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);



    $query = "select ideval,comentario,puntuacion,rifven,rangoven,idcompra,fechac from evalp,compras where rifcedul='$ced' and evalp=ideval LIMIT $per_page OFFSET $offset";

    $resultado = pg_query($dbconn,$query) or die("Errror buscando datos de la evaluacion de comprador");



while($filas = pg_fetch_array($resultado)) {
      $comentario = $filas['comentario'];
            $puntuacion = $filas['puntuacion'];
                  $idvendedor = $filas['rifven'];
                    $rangoven = $filas['rangoven'];
                    $ideval = $filas['ideval'];
                    $idcompra=$filas['idcompra'];
                    $fecha=$filas['fechac'];
               

$queri = sprintf("select idcompra from compras where idcompra='$idcompra'");

    $estadoquery = pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $r=pg_fetch_array($estadoquery);
       $estado=$r['idcompra'];


       $queri = sprintf("select nombre from usuario where rifcedula='$idvendedor'");

    $c1= pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $c=pg_fetch_array($c1);
       $vendedor=$c['nombre'];

     $queri = sprintf("select nombre from usuario where rifcedula='$ced'");

    $vend= pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $ve=pg_fetch_array($vend);
       $comprador=$ve['nombre'];



 $queri=sprintf("select costo,nombreproducto,estado from compras,productos where idprodu=idproducto and  idcompra='$idcompra'");

    $info= pg_query($dbconn,$queri) or die("Errror buscando datos de la evaluacion de vendedor");

       $i=pg_fetch_array($info);
       $costo=$i['costo']; $nombreproducto=$i['nombreproducto']; $estado=$i['estado'];


      echo '<br>';
      echo '<li class="list-group-item" >';
       echo '<label>Producto: ' .$nombreproducto. ' </label>';
            echo '<div class="pull-right action-buttons">';


echo ' <div class="row">';
   echo ' <div class="col-md-12">';
  echo '  <form class="formtest">';
                if($estado=='FINALIZADO'){
                 echo '<a href="#" data-toggle="collapse" data-target="#'.$ideval.'"><span class="glyphicon glyphicon-pencil" ></span></a>';
                }
                            

 

   echo '              <div id="'.$ideval.'" class="collapse">';
     echo '               <div class="col-md-12  ">';
echo ' <textarea cols="40" id="respuesta" name="respuesta" value="" placeholder="Evalua al comprador" rows="3"></textarea>';
    echo '<input type="radio" name="evalcomp" id="evalcompu" value="Excelente">Excelente<input type="radio" name="evalcomp" id="evalcompu" value="Buena">Buena<input type="radio" name="evalcomp" id="evalcompu" value="Regular">Regular<input type="radio" name="evalcomp" id="evalcompu" value="Mala">Mala';
               
                  

                  
  echo '       <div class="text-right">';
   echo "<a href=\"#\" onclick=\"respondercomprador('$idcompra');\">  <button class=\"btn-success btaval btn btn3d\" data-toggle=\"collapse\"> <i class=\"fa fa-reply\"></i> Enviar </button></a>";

   echo ' <span class="btn btn-danger btn-success btaval btn3d" data-toggle="collapse" data-target="#'.$ideval.'" onClick="mostrar()">Cancelar <i class="fa fa-times"></i> </span>';
 

   echo '</div></div> </div></form></div></div>';

  

                               echo '</div>';
    echo '<div><p name="comentario" id="comentario">Comentario: '.$comentario.'</p></div>';
             echo '<div style="float:right; ">';
                      echo '<h9><span class="label label-warning">Ingreso: ' .$costo. ' Bs.F</span></h9>';
                      echo '<h9><span class="label label-warning">fecha: ' .$fecha. '</span></h9>';
                      echo '<h9><span class="label label-warning">Vendedor: ' .$vendedor. '</span></h9>';
                      echo '<h9><span class="label label-warning">Valoracion: ' .$puntuacion. '</span></h9>';




             echo '</div> </li>';



  }  
 

    echo paginate('Porcomprador', $page, $total_pages, $adjacents);

    pg_close($dbconn);

}



function mostrarfoto($ced){



       $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");



        $query="select fotousuario from usuario where rifcedula='$ced'";
        $resultado = pg_query($dbconn,$query) or die("almacenando foto");


        $filas = pg_fetch_array($resultado);








     echo '<img lass="avatar img-circle img-thumbnail" alt="avatar" src="fotoperfil/'.$filas['fotousuario'].'" class="img-circle centrar-imagen">';
    pg_close($dbconn);

}

?>


















