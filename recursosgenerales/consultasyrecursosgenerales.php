<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

function fotosproductos1($idproducto){


          $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
 
 $query="select fotoproductos,numerofoto from fotos where fotos.idproducto='$idproducto' ";
        $resultado = pg_query($dbconn,$query) or die("Al buscar informacion del producto");
  
  while($filas = pg_fetch_array($resultado)) {
      $imagen=$filas['fotoproductos'];
      $numero=$filas['numerofoto'];
                if($numero==1){
              echo '<div class="tab-pane active" id="pic-'.$numero.'"><img src="recursosUSA/fotoproductos/'.$imagen.'" /></div> ';}
              else{
              echo '<div class="tab-pane" id="pic-'.$numero.'"><img src="recursosUSA/fotoproductos/'.$imagen.'" /></div>';
             }
}

}
function fotosproductos2($idproducto){


          $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
 
 $query="select fotoproductos,numerofoto from fotos  where idproducto='$idproducto'  ";
        $resultado = pg_query($dbconn,$query) or die("Al buscar informacion del producto");
  
  while($filas = pg_fetch_array($resultado)) {
      $imagen=$filas['fotoproductos'];
      $numero=$filas['numerofoto'];
                   if($numero==1){
            echo'    <li class="active"><a data-target="#pic-'.$numero.'" data-toggle="tab"><img src="recursosUSA/fotoproductos/'.$imagen.'" /></a></li> ';}
            else{
             echo '  <li><a data-target="#pic-'.$numero.'" data-toggle="tab"><img src="recursosUSA/fotoproductos/'.$imagen.'" /></a></li> ';
           }

}

}







function infproducto($idproducto){


          $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

             $ced=$_SESSION['cedula'];

   $query="select nombreproducto,resena,plazofin,stock,cantvend,precio,categori,idusuario,antiguedad from productos where idproducto='$idproducto'";
        $resultado = pg_query($dbconn,$query) or die("Al buscar informacion del producto");

  
          

           $filas = pg_fetch_array($resultado);

           $nombre=$filas['nombreproducto'];
           $resena=$filas['resena'];
           $plazofin=$filas['plazofin'];
           $stock=$filas['stock'];
           $cantvend=$filas['cantvend'];
           $precio=$filas['precio'];
           $categori=$filas['categori'];
           $antiguedad=$filas['antiguedad'];
           $idusuario=$filas['idusuario'];

     $querycategoria="select nombre from categorias where idcategoria='$categori'";
        $resulcategoria = pg_query($dbconn,$querycategoria) or die("Buscando categorias");

          $categ = pg_fetch_array($resulcategoria);

        
          $cat=$categ['nombre'];

       $buscausuario="select nombre,apellido from usuario where rifcedula='$idusuario'";
        $resulusuario = pg_query($dbconn,$buscausuario) or die("Buscando usuario vendedor");

        
          $vendedor = pg_fetch_array($resulusuario);

          $nombrevendedor=$vendedor['nombre'];
          $apellidovendedor=$vendedor['apellido'];


     $quericomprobante="select rifcedula from usuario,productos where idusuario=rifcedula and idproducto='$idproducto'";
        $resultadocomprobacion = pg_query($dbconn,$quericomprobante) or die("Buscando usuario vendedor");
     $comprobante = pg_fetch_array($resultadocomprobacion);


    echo  '<div class="preview col-md-6"> ';

              echo '<div class="preview-pic tab-content"> ';
         
                  fotosproductos1($idproducto);
    echo  '      </div> ';

            echo ' <ul class="preview-thumbnail nav nav-tabs"> ';
                 
                    fotosproductos2($idproducto);

            echo ' </ul> ';








    echo  '      </div> ';
    echo  '      <div class="details col-md-6"> ';
    echo  '        <h3 class="product-title">'.$nombre.'</h3> ';
    echo  '        <h6 class="product-title">Categoria:'.$cat.'</h6> ';
    echo  '        <p class="product-description">'.$resena.'</p> ';
    echo  '        <h4 class="price">Precio Actual: <span>'.$precio.' Bs.F</span></h4> ';
    echo  '        <h5 class="sizes">Estado del producto: ';
    echo  '          <span class="size" data-toggle="tooltip" title="small">'.$antiguedad.'</span> ';
    echo  '        </h5> ';
    echo  '          <h5 class="sizes">Vendidos: ';
    echo  '           <span class="size" data-toggle="tooltip" title="small">'.$cantvend.'</span> ';
    echo  '        </h5> ';
    echo  '          <h5 class="sizes">Vendedor: ';
    echo  '           <span class="size" data-toggle="tooltip" title="small">'.$nombrevendedor.' '.$apellidovendedor.'</span> ';
    echo  '        </h5> ';
    echo  '          <h5 class="sizes">Valido hasta: ';
    echo  '           <span class="size" data-toggle="tooltip" title="small">'.$plazofin.'</span> ';
    echo  '        </h5> ';
    echo  '        <div class="action"> ';

      if($comprobante['rifcedula']!=$ced){//configurar boton de compra
    echo  '    <a href="#" data-toggle="modal" data-target="#gestorcompra"><button class="add-to-cart btn btn-default" type="button" >Comprar<span class="glyphicon glyphicon-shopping-cart"></span></button></a>  ';
        }

    echo  '        </div> ';
    echo  '  </div> ';

    pg_close($dbconn);
}









function generargestorcompra($pro){// funcion que construye el gestor de confirmacion de compra

 //se busca informacion del comprador

          $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

             $ced=$_SESSION['cedula'];

        $query="select nombre,plan from usuario where rifcedula='$ced'";
        $resultado = pg_query($dbconn,$query) or die("al buscar informacion del comprador");
        
        $dato1=pg_fetch_array($resultado);
        $comprador=$dato1['nombre']; $plan1=$dato1['plan'];

        $buscarplan1="select nombre from planes where idplan='$plan1'";
        $resultado=pg_query($dbconn,$buscarplan1) or die("error al buscar nombre del plan 1");
        $datoo1=pg_fetch_array($resultado);
        $nombreplan1=$datoo1['nombre'];




     // ahora se busca informacion del vendedor

          $buscausuario="select nombre,plan,rifcedula from usuario,productos where rifcedula=(select idusuario from productos where idproducto='$pro') and idproducto='$pro'";
        $resulusuario = pg_query($dbconn,$buscausuario) or die("Buscando usuario vendedor");

        
          $vendedor = pg_fetch_array($resulusuario);

          $nombrevendedor=$vendedor['nombre'];
          $planvendedor=$vendedor['plan'];
          $rifvendedor=$vendedor['rifcedula'];


      $buscarplan2="select nombre from planes where idplan='$planvendedor'";
        $resultado=pg_query($dbconn,$buscarplan2) or die("error al buscar nombre del plan 2");
        $datoo2=pg_fetch_array($resultado);
        $nombreplan2=$datoo2['nombre'];


        // ahora se busca informacion del producto en cuestion.


$querypro="select nombreproducto,cantvend,precio,stock from productos where idproducto='$pro'";
        $resultado = pg_query($dbconn,$querypro) or die("Al buscar informacion del producto");

  
          

           $filas = pg_fetch_array($resultado);

  $producto=$filas['nombreproducto']; $cantvend=$filas['cantvend']; $precio=$filas['precio'];$stock=$filas['stock'];
        







 echo '<div style="float:left;" class="container "><div class="col-md-4 col-sm-6 col-xs-12" style=""> <div class="text-center">';
 echo '               <h5>Comprador:'.$comprador.'</h5>';
                


        $query="select fotousuario from usuario where rifcedula='$ced'";
        $resultado = pg_query($dbconn,$query) or die("almacenando foto");


        $filas = pg_fetch_array($resultado);








     echo '<img lass="avatar img-circle img-thumbnail" alt="avatar" src="fotoperfil/'.$filas['fotousuario'].'" class="img-circle centrar-imagen">';







 echo '               <h6>Miembro:'.$nombreplan1.'</h6>';
 echo '      </div></div>';
 echo '     <div class="col-md-4 col-sm-6 col-xs-12"><div class="text-center">';
 echo '                  <h5>Vendedor: '.$nombrevendedor.'</h5>';
             




        $query="select fotousuario from usuario where rifcedula='$rifvendedor'";
        $resultado = pg_query($dbconn,$query) or die("almacenando foto");


        $filas = pg_fetch_array($resultado);








     echo '<img lass="avatar img-circle img-thumbnail" alt="avatar" src="fotoperfil/'.$filas['fotousuario'].'" class="img-circle centrar-imagen">';




 echo '               <h6>Miembro: '.$nombreplan2.'</h6>';
 echo '      </div></div></div>';
 echo '     <div class="col-md-8 col-sm-6 col-xs-12">';
 echo '                 <h3>Producto</h3>';
 echo '    <form class="form-horizontal" role="form" method="POST" action="recursosgenerales/cargarcompra.php">';   
 echo '     <div class="form-group"><table class="table table-striped table-hover table-condensed table-responsive"><thead><tr><th>';
 echo '               Producto';
 echo '           </th><th>';
 echo '               Precio Bs.F';
 echo '           </th> <th>';
 echo '               Vendidos';
 echo '           </th> <th>';
 echo '               Cantidad disponible';
 echo '           </th> <th> ';
 echo '               Cantidad a comprar ';
 echo '           </th></tr></thead><tbody><tr><td>';
 echo '               '.$producto.'';  
 echo '           </td><td>';
 echo '               '.$precio.' ';
 echo '           </td><td>';
 echo '               '.$cantvend.' ';
 echo '           </td><td>';
 echo '                '.$stock.'';
 echo '          </td><td>';
 echo '<div class="col-lg-8"><input onkeypress="return numeros(event)" name="cantidadcomprar"  class="form-control" value="1" type="text"></div>';
 echo ' </td></tr></tbody></table></div>';

  
  echo '            <h3>Seleccione el banco deseado para cancelar su compra</h3>';
          
   echo '             <div class="col-lg-4">';
  
   echo '     <select id="cuentasbanco" name="banco" class="form-control product-type" style="float:left;text-align:center;">';
   
        $queri="select nombrebanco,numerocuenta,tipo from banco,contacto where contactobanco=idcontacto and idcontacto=(select usuario.idcontacto from usuario,contacto where usuario.idcontacto=contacto.idcontacto and rifcedula='$ced')";
         $resut = pg_query($queri) or die('Query failed: ' . pg_last_error());

         while($fil=pg_fetch_array($resut)){
            echo'<option value="'.$fil['nombrebanco'].'--'.$fil['numerocuenta'].'--'.$fil['tipo'].'"> '.$fil['nombrebanco'].'--'.$fil['numerocuenta'].'--'.$fil['tipo'].'</option>';
            }
             pg_close($conn);
         

      echo '  </select>';
            
  echo '   <h3>Seleccione el metodo de envio deseado</h3>';
   echo'  <select id="formaenvio" name="envio" class="form-control product-type" style="float:left;text-align:center;">';
    echo' <option>MRW</option>  <option>DOMESA</option>   <option>ZOOM</option>   <option>ENTREGA PERSONAL</option></select> ';  



    echo '    </div>';



 
          echo '  </div></div> </div></div><div class="modal-footer">';
          //variables necesarias para el paso de paigina 
    echo '<input type="hidden" name="idproducto" value="'.$pro.'" />';
      echo '<input type="hidden" name="idvendedor" value="'.$rifvendedor.'" />';
         
      echo '  <button class="btn btn-primary btn-lg btn3d btn-block btn-block" type="submit" >Comprar</button>';
  echo '      <button type="button" class="btn btn-primary btn-lg btn3d btn-block btn-block" data-dismiss="modal">Cancelar</button>';





echo '</form> </div>';




}













 ?>