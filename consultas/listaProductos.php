<?php

    $con=pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include 'pagination.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$busqueda = (isset($_REQUEST['busqueda']) && !empty($_REQUEST['busqueda']))?$_REQUEST['busqueda']:'';
		$rangoPrecio = (isset($_REQUEST['rango']) && !empty($_REQUEST['rango']))?$_REQUEST['rango']:100000;
		$categoria = (isset($_REQUEST['categoria']) && !empty($_REQUEST['categoria']))?$_REQUEST['categoria']:'';
		$per_page = 6; //la cantidad de registros que desea mostrar
		$adjacents  = 0; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = pg_query($con,"SELECT count(*) AS numrows FROM productos INNER JOIN categorias ON productos.categori= categorias.idcategoria AND productos.precio <=$rangoPrecio AND categorias.nombre='$categoria' AND LOWER(nombreproducto) LIKE '%$busqueda%'");
		if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'search.php';
		//consulta principal para recuperar los datos
		$query = pg_query($con,"SELECT productos.precio AS precio,nombreproducto AS nombre,productos.resena AS resena,idproducto As idpro FROM productos INNER JOIN categorias ON productos.categori= categorias.idcategoria AND productos.precio<=$rangoPrecio AND categorias.nombre='$categoria' AND LOWER(nombreproducto) LIKE '%$busqueda%' order by nombreproducto LIMIT $per_page OFFSET $offset");
				
		if ($numrows>0){
		
		while($row = pg_fetch_array($query)){
			
		//----------- añadi esta consulta que trae la foto correspondiente al producto
    $foto=$row['idpro'];
 $queri="select fotoproductos from fotos where idproducto='$foto'";
    $resultado = pg_query($con,$queri) or die("Al buscar informacion del producto");

    $f=pg_fetch_array($resultado);
    $fo=$f['fotoproductos'];

//------------------------------------------------------------------------------------		
		  echo '<div class="col-sm-4 col-lg-4 col-md-4">';
          echo '<div class="thumbnail">';
		  echo '<img class="zoom" src="recursosUSA/fotoproductos/'.$fo.' " alt="">';
          echo '<div class="caption">';
		  echo '<h4><a href="./productInfo.php?pro='.$row['idpro'].'">' .$row['nombre']. '</a></h4>';
		  echo '<h4 class="pull-right">' .$row['precio']. 'BS.F</h4>';
		  echo '<p>' .$row['resena']. '</p>';
	      echo '</div>';
		  echo '</div>';
		  echo '</div>';
		}
			echo paginate($reload, $page, $total_pages, $adjacents);
		} 
		else {
			echo '<div class="alert alert-warning alert-dismissable">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              echo '<h4>Aviso!!!</h4> No hay productos para esta busqueda';
            echo '</div>';
		}
	}
?>
