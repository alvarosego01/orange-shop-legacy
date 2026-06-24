<?php    
	if(!isset($_SESSION)) {
	   session_start(); 
	}
    if(!isset( $_SESSION['rango'])){
		$rangoURL = 'index.html';
	}
	else{
		$rangoLetra = $_SESSION['rango'];
		$rangoURL = 'user'.$rangoLetra.'.php';
	}	
?>

<?php include("recursosUSA/ProcesosyfuncionesUSA.php");?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orange Shop</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
	<link href="css/userA.css" rel="stylesheet">
    <link href="css/uploadProduct.css" rel="stylesheet">
    <link href="css/boton3D.css" rel="stylesheet">
   <script src="js/order.js" type="text/javascript"></script> 

</head>
<body>

<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="shop.php"><span class="glyphicon icon-nav glyphicon-home"></span></a></li>
            <li><a href="search.php"><span class="glyphicon icon-nav glyphicon-shopping-cart"></span></a></li>
            <li  class="active"><a href="userA.php"><span class="glyphicon icon-nav glyphicon-user"></span></a></li>
          </ul>
		  
		   <div class="input-group">
          <input id="busqueda" type="text" class="form-control" placeholder="Buscar...">
    
          <span class="input-group-btn">
            <button id="buscar" class="btn btn-default" type="button">Ir</button>
            <button id="categorias" class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" >Categorias</button>
            <ul id="busq" class="dropdown-menu">
            <?php include("consultas/getCategorias.php"); ?> 
            </ul>
          </span>
        
        </div><!-- /input-group -->
        <div class="range">
            <input id="rang" type="range" name="range" min="100" max="100000" value="100" onchange="range.value=value+'-Bs.F'"><output id="range">100-Bs.F</output> 
         </div>
		
			  
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Page Content -->
	<div class="container">

		<div class="clearfix"></div>
			<div class="row">
				<div><ul class="nav nav-tabs col-lg-12" role="tablist">
					<li class="active"><a href="#Product_main" role="tab" data-toggle="tab">Producto</a></li>
					<li class=""><a href="#Product_Images" role="tab" data-toggle="tab">Imagenes</a></li>
					<li class=""><a href="#Product_Summary"  role="tab" data-toggle="tab">Descripción</a></li>
				</ul></div> 
				<div class="clearfix"></div>
				<div class="Product_Content tab-content">
					<div id="Product_main" class="tab-pane active">
					<form class="form-horizontal" enctype="multipart/form-data" action="./recursosUSA/publicarproducto.php" method="POST">
		  <fieldset>
			<div class="col-lg-12 form-group margin50">
			  <label class="col-lg-2"  for="Name">Nombre</label>
			  <div class="col-lg-4">
				<input type="text" id="nom" name="nombre" placeholder="" class="form-control name">
			  </div>
			</div>
		 
			<div class=" col-lg-12 form-group">
			  <label class="col-lg-2" for="ProductType">Categoria</label>
			  <div class="col-lg-4">
	


				<select id="catego" name="categorias" class="form-control product-type">
			

                   <?php
                   // codigo php que funciona para actualizar la lista de categorias disponibles para que el usuario pueda seleccionar una en cada updateo de productos  
                      $conn =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");
          
        $queri="select nombre,nombresubcat from categorias,subcategoria where categorias.idsub=idsubcategoria";
         $resut = pg_query($queri) or die('Query failed: ' . pg_last_error());

         while($fil=pg_fetch_array($resut)){
            echo'<option value="'.$fil['nombre'].'--'.$fil['nombresubcat'].'"> '.$fil['nombre'].'--'.$fil['nombresubcat'].'</option>';
            }
             pg_close($conn);
                    ?>
				</select>
	          
			  </div>
			</div>
	
			<h3>Información</h3>
			
			 <div class="col-lg-12 form-group">
			  <label class="col-lg-2" for="Price">Precio</label>
			  <div class="col-lg-4">
				<input type="text" id="prec" name="precio" placeholder="" class="form-control price" onkeypress="return numeros(event)">
			  </div>
			</div>




<div class=" col-lg-12 form-group">
			  <label class="col-lg-2" for="ProductType">¿Nuevo o usado?</label>
			  <div class="col-lg-4">
	


				<select id="nueu" name="nuevousado" class="form-control product-type">
				


					<option>Nuevo</option>

                    <option>Usado</option>



				</select>



	          
			  </div>
			</div>


			

			
			<div class="col-lg-12 form-group">
			  <label class="col-lg-2" for="CurrentInventory">En Inventario</label>
			  <div class="col-lg-4">
				<input type="text" id="inve" name="inventario" placeholder="" class="form-control current-inventory" onkeypress="return numeros(event)">

			  </div>
			</div>
			<div class="col-lg-12 form-group">
			  <label class="col-lg-2" for="Colors">Fecha de publicación</label>
			  <div class="col-lg-4">
				<label type="date" id="fini" name="fechaini" class="col-lg-2"><?php echo date("Y-n-j"); ?></label>
			  </div>
			</div>
		  </fieldset>
	





					</div>            
					<div id="Product_Images" class="tab-pane"><div class="col-lg-12 form-group margin50">
			<label class="col-sm-2" for="FilenameOverride">Nombre de la Imagen</label>
			<div class="col-sm-4">
	
			</div>
		  </div>
					  <div class="col-lg-12 form-group">


						
 
        <label>Imagen principal</label><br />
        <input name="archivo1" type="file" id="foto1" /><br /><br />
   
    
 
        <label>Sube una imagen 2</label><br />
        <input name="archivo2" type="file" id="foto2" /><br /><br />
     
   
        <label>Sube una imagen 3</label><br />
        <input name="archivo3" type="file" id="foto3" /><br /><br />
       
 
    
        <label>Sube una imagen 4</label><br />
        <input name="archivo4" type="file" id="foto4" /><br /><br />
     
 
  
        <label>Sube una imagen 5</label><br />
        <input name="archivo5" type="file" id="foto4" /><br /><br />
        
 
        <label>Sube una imagen 6</label><br />
        <input name="archivo6" type="file" id="foto6" /><br /><br />
     








					  </div>	  
					  
			</div>
					<div id="Product_Summary" class="tab-pane">
			<div class="col-lg-12 form-group margin50">
			<label class="col-sm-2" for="Summary">Información</label>
			<div class="col-sm-4">
			 <textarea class="form-control summary" id="rese" name="reseña"></textarea>
			</div>
		  </div></div>
		  
		<div>
			<div class="Product_Button col-lg-offset-6">
				<a href="<?php echo $rangoURL;?>" class="btn btn-danger btn-lg btn3d"><i class=""></i><strong>Cancelar</strong></a>
				<button id="send" class="btn btn-primary btn-lg btn3d" type="submit"><i class=""></i><strong>Guardar</strong></a>
			</div>
		</div>
		
		</div>
		</div>
		</div>
    <!-- jQuery -->
    <script src="js/jQuery v1.12.4.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	 <script type="text/javascript"> 
	
	$('.dropdown-menu a').click(function(){
		$('#categorias').text($(this).text());
	});
	
	$('#buscar').click(function(){
		var busqueda = $('input#busqueda').val();
		if(busqueda=="")
			busqueda='""';
		var valor = $('#rang').val();
		var catg = $('#categorias').text();
		 window.location = 'search.php?busq='+busqueda+'+&val='+valor+'+&cat='+catg;
	});
	</script>

</body>

</html>
