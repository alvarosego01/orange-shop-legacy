<?php 
if(!function_exists("paginate")){
  include 'pagination.php'; //incluir el archivo de paginación
} 
  function borrarPlan($idPlan){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("DELETE FROM planes WHERE idplan = '".$idPlan."'");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
   function agregarPlan($namePlan,$precio,$time){
	  $idPlan = uniqid();
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("INSERT INTO planes(idplan, nombre, precio, plazo) VALUES ('".$idPlan."', '".$namePlan."', '".$precio."', '".$time."'); ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
    function modificarPlan($namePlan,$precio,$time,$idPlan){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("UPDATE planes SET nombre='".$namePlan."', precio='".$precio."', plazo='".$time."' WHERE idplan='".$idPlan."' ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
  function borrarCategoria($idCat){		
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("DELETE FROM categorias WHERE idcategoria = '".$idCat."'");
	  pg_query($dbconn,$query) or die('!!ERROR-Esta categoria esta asociada a varios productos');
	  pg_close($dbconn);
  }
  
   function agregarCategoria($nameCat){
	  $idPlan = uniqid();
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("INSERT INTO categorias (idcategoria, nombre) VALUES ('".$idPlan."', '".$nameCat."'); ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");

	  // FIJATE AQUI PUSE ESTO... ESTO LO QUE HACE ES CREAR AUTOMATICAMENTE UNA SUB CATEGORIA AL MOMENTO DE CREAR UNA CATEGORIA BASE COMO TAL
	  // ESTO PARA QUE EXISTA Y LOS BUSCADORES FUNCIONEN AUNQUE NO MUESTREN NADA PORQUE EL NOMBRE DEFAULT DE LAS SUB CATEGORIAS ES UN ESPACIO EN BLANCO
	  // SI VAS A AÑADIR LA OPCION DE PONER SUB CATEGORIAS LO QUE TIENES QUE HACER ES VALIDAR POR CLAVES FORANEAS

	//por ejemplo ve, al momento en que tu crees cualquier categoria pues se le creara tambien una sub categoria pasandole el mismo codigo como clave foranea pero con nombre vacio... los buscadores de categoria lo trabajaran pero no se vera nada escrito pues son nombres vacios ..

	  // si despues a esa categoria yo le quiero crear sub categorias REALES O QUE SI QUIERO QUE SE VEAN pues lo que tienes que hacer es crear otra funcion parecida a estas y buscar con clave foranea la categoria que le quieres adicionar sub categorias
	  $idsub=uniqid();
	   $query = ("INSERT INTO subcategoria (idsubcategoria,idcat) VALUES ('".$idsub."','".$idPlan."'); ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
    function modificarCategoria($nameCat,$idCat){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("UPDATE categorias SET nombre='".$nameCat."' WHERE idcategoria='".$idCat."' ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
  function banUnban($name,$status){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("UPDATE usuario SET estatus=".$status." WHERE nombre = '".$name."'");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
  function getUsuarios(){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	   
	  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	  $per_page = 9; //la cantidad de registros que desea mostrar
	  $adjacents  = 0; //brecha entre páginas después de varios adyacentes
	  $offset = ($page - 1) * $per_page;
	  $count_query   = pg_query($dbconn,"SELECT count(*) AS numrows FROM usuario");
	  if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
	  $total_pages = ceil($numrows/$per_page);
	  
	  $query = sprintf("SELECT nombre,estatus FROM usuario GROUP BY nombre,estatus LIMIT $per_page OFFSET $offset");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		  $resultado_status = $filas['estatus'];
		  $resultado_status==2? $icono='ok glyphicon glyphicon-ok-sign':$icono='ban glyphicon glyphicon-remove-sign';
		  
		  echo '<li class="list-group-item">';
		  echo	'<label >'. $resultado_name . '</label>';
		  echo		'<div class="pull-right action-buttons">';
		  echo			"<a  onclick =changeBan('" .$resultado_name."'," .$resultado_status.") id='" .$resultado_name."' class='" .$icono."'></a>";
		  echo		'</div>';
		  echo'</li>';	
	} 
	  echo paginate('usuarios', $page, $total_pages, $adjacents);
	  pg_close($dbconn);
  }
  
   function getPlanes(){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  
	  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	  $per_page = 9; //la cantidad de registros que desea mostrar
	  $adjacents  = 0; //brecha entre páginas después de varios adyacentes
	  $offset = ($page - 1) * $per_page;
	  $count_query   = pg_query($dbconn,"SELECT count(*) AS numrows FROM usuario");
	  if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
	  $total_pages = ceil($numrows/$per_page);
	  
	  $query = sprintf("SELECT nombre,idplan FROM planes GROUP BY nombre,idplan LIMIT $per_page OFFSET $offset");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		  $resultado_id = $filas['idplan'];
		  
		  echo '<li class="list-group-item">';
		  echo	'<label>'. $resultado_name . '</label>';
		  echo		'<div class="pull-right action-buttons">';
		  echo			"<a onclick =cambiarPlan('".$resultado_id."')><span class='glyphicon glyphicon-pencil'></span></a>";
		  echo			"<a onclick =borrarPlan('" .$resultado_id."') class='trash'><span class='glyphicon glyphicon-trash'></span></a>";
		  echo		'</div>';
		  echo'</li>';	
	} 
	  pg_close($dbconn);
  }
  
   function getCategorias(){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  
	  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	  $per_page = 8; //la cantidad de registros que desea mostrar
	  $adjacents  = 0; //brecha entre páginas después de varios adyacentes
	  $offset = ($page - 1) * $per_page;
	  $count_query   = pg_query($dbconn,"SELECT count(*) AS numrows FROM usuario");
	  if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
	  $total_pages = ceil($numrows/$per_page);
	  
	  $query = sprintf("SELECT nombre,idcategoria FROM categorias GROUP BY nombre,idcategoria LIMIT $per_page OFFSET $offset");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		  $resultado_id = $filas['idcategoria'];
		  
		  echo '<li class="list-group-item">';
		  echo	'<label>'. $resultado_name . '</label>';
		  echo		'<div class="pull-right action-buttons">';
		  echo			"<a onclick =cambiarCategoria('" .$resultado_id."')><span class='glyphicon glyphicon-pencil'></span></a>";
		  echo			"<a onclick =borrarCategoria('" .$resultado_id."') class='trash'><span class='glyphicon glyphicon-trash'></span></a>";
		  echo		'</div>';
		  echo'</li>';	
	} 
	  echo paginate('categorias', $page, $total_pages, $adjacents);
	  echo "<a class='btn btn-primary btn3d botonPublicacion' style='float:right;' onclick='agregarCategoria()'>Agregar</a>";

	  pg_close($dbconn);
  }
  
  
  function agregarUsuarioD($name,$lastname,$email,$tlf,$clave,$ci){
	  $idPlan = uniqid();
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("INSERT INTO usuario(rifcedula, nombre,apellido,password) VALUES ('".$ci."', '".$name."','".$lastname."','".$clave."'); ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  
	  $idCont = 'Cont'.uniqid();
	  $query2 = "INSERT INTO contacto(idcontacto,email,telefono) VALUES('" . $idCont . "', '" . $email . "', '" . $tlf . "')";
	  $resultado2 = pg_query($dbconn,$query2) or die("Error en la Consulta SQL");
	  
	  $query3 = "UPDATE usuario set idcontacto='$idCont' where rifcedula='$ci'";
	  $resultado3 = pg_query($dbconn,$query3) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
   function borrarUsuarioEnD($id){		
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("DELETE FROM usuario WHERE rifcedula = '".$id."'");
	  pg_query($dbconn,$query) or die('!!ERROR-Esta categoria esta asociada a varios productos');
	  pg_close($dbconn);
  }
  
   function modificarUserEnD($name,$lastname,$email,$tlf,$clave,$id,$rango,$plan){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  
	  $querySel2 = ("SELECT idplan FROM planes WHERE nombre='".$plan."' ");
	  $resultadoSel2 = pg_query($dbconn,$querySel2) or die("Error en la Consulta SQL");
	  $filas2 = pg_fetch_array($resultadoSel2);
	  
	  $query = ("UPDATE usuario SET nombre='".$name."', apellido='".$lastname."',password='".$clave."', rango='".$rango."', plan='".$filas2['idplan']."' WHERE rifcedula='".$id."' ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");

	  $querySel = ("SELECT idcontacto FROM usuario WHERE rifcedula='".$id."' ");
	  $resultadoSel = pg_query($dbconn,$querySel) or die("Error en la Consulta SQL");
	  $filas = pg_fetch_array($resultadoSel);

	  $query2 = ("UPDATE contacto SET email='".$email."', telefono='".$tlf."' WHERE idcontacto='".$filas['idcontacto']."' ");
	  $resultado2 = pg_query($dbconn,$query2) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
  function modificarPlanUserEnD($name,$id){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	  $query = ("SELECT idplan FROM planes WHERE nombre='".$name."' ");
	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	  $filas = pg_fetch_array($resultado);

	  $query2 = ("UPDATE usuario SET plan='".$filas['idplan']."' WHERE rifcedula='".$id."' ");
	  $resultado2 = pg_query($dbconn,$query2) or die("Error en la Consulta SQL");
	  pg_close($dbconn);
  }
  
  function getUsuariosD(){
	  $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
	   
	  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	  $per_page = 9; //la cantidad de registros que desea mostrar
	  $adjacents  = 0; //brecha entre páginas después de varios adyacentes
	  $offset = ($page - 1) * $per_page;
	  $count_query   = pg_query($dbconn,"SELECT count(*) AS numrows FROM usuario");
	  if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
	  $total_pages = ceil($numrows/$per_page);
	  
	  $query = sprintf("SELECT nombre,rifcedula FROM usuario GROUP BY nombre,rifcedula LIMIT $per_page OFFSET $offset");

	  $resultado = pg_query($dbconn,$query) or die("Error en la Consulta SQL");
	   while($filas = pg_fetch_array($resultado)) {
		  $resultado_name = $filas['nombre'];
		  $resultado_id = $filas['rifcedula'];
		  
		  echo '<li class="list-group-item">';
		  echo	'<label >'. $resultado_name . '</label>';
		  
			
		
		  echo '<div class="pull-right action-buttons">';
		  
		 
		
		echo "<button id='".$resultado_id."' class='btn btn-default dropdown-toggle' type='button'  data-toggle='dropdown' >Planes</button>";
			echo "<ul id='".$resultado_id."D' class='dropdown-menu'>";
           
		   $queryP = ("SELECT planes.nombre FROM planes");
			$resultadoP = pg_query($dbconn,$queryP) or die("Error en la Consulta SQL");
  
			while($filasP = pg_fetch_array($resultadoP)) {
			$resultado_nameP = $filasP['nombre'];
			echo '<a class="list-group-item">' .$resultado_nameP. '</a>';
			}
		echo '</ul>';
		
		  echo			"<a  onclick =modificarEnuserD('".$resultado_id."') class='glyphicon glyphicon-pencil'></a>";
		  echo			"<a  onclick =borrarEnUserD('" .$resultado_id."') class='trash glyphicon glyphicon-trash'></a>";
		  // echo			"<a onclick =cambiarPlanUserD('" .$resultado_id."') class='flag glyphicon glyphicon-th-list'></a>";
		  echo		'</div>';
		  echo'</li>';

		// echo   "<script type='text/javascript'>";   
		// echo "$('".$resultado_id."D').click(function(){";
		// echo	"$('".$resultado_id."').text($(this).text());";
		// echo "});";		  
		// echo "</script>";		  
		 
	} 
	  echo paginate('usuarionEnD', $page, $total_pages, $adjacents);
	  echo "<a class='btn btn-primary btn-lg btn3d botonPublicacion' style='width:500px; margin-left:400px; float:right;' onclick='agregarUserEnD()'>Agregar</a>";
	  pg_close($dbconn);
  }
  
  //AGREGAR USER D
   if(isset($_POST['agregarUserD'])) {
	   $action = $_POST['agregarUserD'];
	   $name = $_POST['nombre'];
	   $lastname = $_POST['AapellidoD'];
	   $email = $_POST['AemailD'];
	   $tlf = $_POST['AtlfD'];
	   $clave = $_POST['AclaveD'];
	   $ci = $_POST['cedula'];
	   
	   if(!empty($_POST['nombre'])&& !empty($_POST['cedula']) && !empty($_POST['AapellidoD']) && !empty($_POST['AemailD']) && !empty($_POST['AtlfD']) && !empty($_POST['AclaveD']))
			echo ''.$name.'';
	   else
			echo 'ninguno - ERROR: rellene los campos solicitados';
		
	   if($action == 'true' && !empty($_POST['nombre']) && !empty($_POST['cedula']) && !empty($_POST['AapellidoD']) && !empty($_POST['AemailD']) && !empty($_POST['AtlfD']) && !empty($_POST['AclaveD'])){
		  agregarUsuarioD($name,$lastname,$email,$tlf,$clave,$ci);
		  echo '<script type="text/javascript">load(1,"usuarionEnD");</script>';
	   }
	 $action=null;
	} 
	
  //MODIFICAR USER EN D
  if(isset($_POST['cambiarUserD'])) {
	   $action = $_POST['cambiarUserD'];
	   $name = $_POST['nombreenUserD'];
	   $lastname = $_POST['apellidoD'];
	   $email = $_POST['emailD'];
	   $tlf = $_POST['tlfD'];
	   $clave = $_POST['claveD'];
	   $rango = $_POST['rangoD'];
	   $plan = $_POST['planD'];
	   $id = $_POST['idUsr'];
	   
	   if(!empty($_POST['nombreenUserD']) && !empty($_POST['apellidoD']) && !empty($_POST['emailD']) && !empty($_POST['tlfD']) && !empty($_POST['claveD']) && !empty($_POST['rangoD']) && !empty($_POST['planD']))
			echo 'Se ha modificado con exito al usuario';
	   else
			echo 'ninguno - ERROR: rellene los campos solicitados';
		
	   if($action == 'true' && !empty($_POST['nombreenUserD']) && !empty($_POST['apellidoD']) && !empty($_POST['emailD']) && !empty($_POST['tlfD']) && !empty($_POST['claveD']) && !empty($_POST['rangoD']) && !empty($_POST['planD'])){
		  modificarUserEnD($name,$lastname,$email,$tlf,$clave,$id,$rango,$plan);
		  echo '<script type="text/javascript">load(1,"usuarionEnD");</script>';
	   }
	 $action=null;
	} 
	
	//BORRAR EN USER D
   if(isset($_POST['borrarUserD']) && isset($_POST['idEnUserD'])) {
	   $action = $_POST['borrarUserD'];
	   $id = $_POST['idEnUserD'];
	 
	   echo ' ';
		
	   if($action == 'true'){
		  borrarUsuarioEnD($id);
		  echo '<script type="text/javascript">load(1,"usuarionEnD");</script>';
	   }
	 $action=null;
	} 
	
  
  //AGREGAR PLAN CHECK
   if(isset($_POST['agregar'])) {
	   $action = $_POST['agregar'];
	   $name = $_POST['nombre'];
	   $price = $_POST['price'];
	   $plazo = $_POST['plazo'];
	   
	   if(!empty($_POST['nombre'])&& !empty($_POST['price']) && !empty($_POST['plazo']))
			echo ''.$name.' con precio de: '.$price.' y plazo: '.$plazo.'';
	   else
			echo 'ninguno - ERROR: rellene los campos solicitados';
		
	   if($action == 'true' && !empty($_POST['nombre']) && !empty($_POST['price']) && !empty($_POST['plazo'])){
		  agregarPlan($name,$price,$plazo);
		  echo '<script type="text/javascript">load(1,"planes");</script>';
	   }
	 $action=null;
	} 
	
	//CAMBIAR PLAN CHECK
	 if(isset($_POST['cambiar'])) {
	   $action = $_POST['cambiar'];
	   $name = $_POST['nombre'];
	   $price = $_POST['price'];
	   $plazo = $_POST['plazo'];
	   $id = $_POST['idplan'];
	   
	   if(!empty($_POST['nombre'])&& !empty($_POST['price']) && !empty($_POST['plazo']) && !empty($_POST['idplan']))
			echo ''.$name.' con precio de: '.$price.' y plazo: '.$plazo.'';
	   else
			echo 'ninguno - ERROR: rellene los campos solicitados';
		
	   if($action == 'true' && !empty($_POST['nombre']) && !empty($_POST['price']) && !empty($_POST['plazo'])){
		  modificarPlan($name,$price,$plazo,$id);
		  echo '<script type="text/javascript">load(1,"planes");</script>';
	   }
	 $action=null;
	} 
	
	//BORRAR PLAN CHECK
   if(isset($_POST['borrar']) && isset($_POST['nombrePlan'])) {
	   $action = $_POST['borrar'];
	   $name = $_POST['nombrePlan'];
	 
	   echo ' ';
		
	   if($action == 'true'){
		  borrarPlan($name);
		  echo '<script type="text/javascript">load(1,"planes");</script>';
	   }
	 $action=null;
	} 
	
	//AGREGAR CATEGORIA CHECK
   if(isset($_POST['agregarCat'])) {
	   $action = $_POST['agregarCat'];
	   $name = $_POST['nombreCategoria'];
	   
	   if(!empty($_POST['nombreCategoria']))
			echo ''.$name.'';
	   else
			echo 'ninguno - ERROR: rellene los campos solicitados';
		
	   if($action == 'true' && !empty($_POST['nombreCategoria'])){
		  agregarCategoria($name);
		  echo '<script type="text/javascript">load(1,"categorias");</script>';
	   }
	 $action=null;
	} 
	
	//CAMBIAR CATEGORIA CHECK
	 if(isset($_POST['cambiarCaT'])) {
	   $action = $_POST['cambiarCaT'];
	   $name = $_POST['nombreCategoria'];
	   $id = $_POST['idCat'];
	   
	   if(!empty($_POST['nombreCategoria']))
			echo ''.$name.'';
	   else
			echo 'ninguno - ERROR: rellene los campos solicitados';
		
	   if($action == 'true' && !empty($_POST['nombreCategoria'])){
		  modificarCategoria($name,$id);
		  echo '<script type="text/javascript">load(1,"categorias");</script>';
	   }
	 $action=null;
	} 
	
	//BORRAR CATEGORIA CHECK
   if(isset($_POST['borrarCategoria']) && isset($_POST['nombreCategoria'])) {
	   $action = $_POST['borrarCategoria'];
	   $name = $_POST['nombreCategoria'];
	 
	   echo ' ';
		
	   if($action == 'true'){
		  borrarCategoria($name);
		  echo '<script type="text/javascript">load(1,"categorias");</script>';
	   }
	 $action=null;
	} 
	
	//BAN O UNBAN USUARIOS
   if(isset($_POST['change']) && isset($_POST['nombre'])) {
	   $action = $_POST['change'];
	   $name = $_POST['nombre'];
	   $status = $_POST['stat'];
	   echo ''.$status.' del usuario: '.$name.'';
	   if($action == 'true'){
		  banUnban($name,$status);
		  echo '<script type="text/javascript">','load(1,"usuarios");','</script>';
	   }
	 $action=null;
	}  
	
	//ACTUALIZA LOS PANELES
	if(isset($_POST['action'])) {
	   $action = $_POST['action'];
	   if($action == 'usuarios'){
		  getUsuarios();
	   }
	   else if($action == 'planes'){
		   getPlanes();
	   }
	   else if($action == 'categorias'){
		   getCategorias();
	   }
	   else if($action == 'usuarionEnD'){
		  getUsuariosD();
	   }
	 $action=null;
	} 
?>
