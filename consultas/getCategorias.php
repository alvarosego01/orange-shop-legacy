<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");


  $query = ("SELECT categorias.nombre FROM categorias");
  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
  
   while($filas = pg_fetch_array($resultado)) {
	 $resultado_name = $filas['nombre'];
	 echo '<a class="list-group-item">' .$resultado_name. '</a>';
   }
  pg_close($dbconn);

?>