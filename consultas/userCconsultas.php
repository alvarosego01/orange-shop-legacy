<?php  
  function consultaTop(){
	  $numTop=1;
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = sprintf("SELECT categorias.nombre FROM categorias GROUP BY categorias.nombre ORDER BY SUM(categorias.ctvend) DESC LIMIT 10");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		  
		  echo '<li class="list-group-item">';
		  echo	'<label>' . $numTop . '.' . $resultado_name . '</label>';
		  echo		'<div class="pull-left action-buttons">';
		  echo			'<a href="#" class="flag"><span class="glyphicon glyphicon-star"></span></a>';
		  echo		'</div>';
		  echo'</li>';	
		  $numTop++;
	}  
	  pg_close($dbconn);
  }
  
   function categorias($upORdown){
	  $descORasc =$upORdown? 'DESC':'ASC'; 
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = sprintf("SELECT categorias.nombre FROM categorias GROUP BY categorias.nombre ORDER BY SUM(categorias.ctvend) $descORasc LIMIT 9");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  $numTop = 1;

	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		 
		 echo '<li class="list-group-item">';
		 echo '<label>'.$numTop.'.'.$resultado_name.'</label>';                       			
		 echo '</li>';
		 $numTop++;
	}  
	  pg_close($dbconn);
  }
  
   function ingresos($upORdown){
	  
	  $descORasc =$upORdown? 'DESC':'ASC'; 
	  
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = sprintf("SELECT categorias.nombre,SUM(productos.precio*productos.cantvend) FROM productos INNER JOIN categorias ON productos.categori= categorias.idcategoria GROUP BY categorias.nombre ORDER BY 2 $descORasc LIMIT 9");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  $numTop =1;
	  
	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		  $ing_dinero = $filas['sum'];
		 
		 echo '<li class="list-group-item">';
		 echo	'<label>' . $numTop . '.' . $resultado_name . '-' . $ing_dinero . ' BS.F </label>';                       			
		 echo '</li>';
		 $numTop++;
	}  
	  pg_close($dbconn);
  }
  
   if(isset($_POST['ascODesc'])) {
	   $action = $_POST['ascODesc'];
	   if($action == 'false')
		categorias(false);
	   else
		categorias(true);
	 $action=null;
	}  
	
   else if(isset($_POST['ascODescIng'])) {
	   $action2 = $_POST['ascODescIng'];
	   if($action2 == 'false')
		ingresos(false);
	   else
		ingresos(true);
	$action2=null;
	}  


?>