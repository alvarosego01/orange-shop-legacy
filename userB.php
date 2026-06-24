<?php include("consultas/bloqueoDeSeguridad.php");?> 
<?php include("consultas/userBconsultas.php"); ?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/userA.css" rel="stylesheet">
	<link href="css/boton3D.css" rel="stylesheet">

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
            <li><a href="#"><span class="glyphicon icon-nav glyphicon-shopping-cart"></span></a></li>
            <li class="active"><a href="#"><span class="glyphicon icon-nav glyphicon-user"></span></a></li>
          </ul>
	
        <div class="input-group">
          <input id="busqueda" type="text" class="form-control" placeholder="Buscar...">
    
          <span class="input-group-btn">
            <button id="buscar" class="btn btn-default" type="button">Ir</button>
            <button id="categorias" class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" >Categorias</button>
            <ul class="dropdown-menu">
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
	
<div class="row">
      <div class="col-xs-6 col-sm-3 placeholder">
	  
        <div class="panel panel-primary">
		    <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-user"></span>Usuarios<a href="#"><span
                            class="glyphicon glyphicon-new-window"></span></a>
                    </h3>
             </div>

        <div class="container-fluid">
			<ul class="list-group">
			<div class="outer_div">
                <?php getUsuarios(); ?> 
			</div>
             </ul>
		</div>
 </div>
</div>

<div class="col-xs-6 col-sm-3 placeholder">
	<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
		<span class="glyphicon glyphicon-star"></span>Planes<a href="#"><span
			  class="glyphicon glyphicon-new-window"></span></a>
		</h3>
    </div>  

      <div class="container-fluid">
                    <ul class="list-group">
					<div class="outer_div2">
						<?php getPlanes(); ?> 
					</div>  
                    </ul>
				<a onclick ="agregarPlan()" class="btn btn-primary btn3d botonPublicacion" style="float:right" >Agregar</a>
                </div>               
</div>
</div>

<div class="col-xs-6 col-sm-3 placeholder">

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
		<span class="glyphicon glyphicon-tags"></span>Categorias<a href="#"><span
			  class="glyphicon glyphicon-new-window"></span></a>
		</h3>
    </div>  

      <div class="container-fluid">
			<ul class="list-group">
				<div class="outer_div3">
					<?php getCategorias(); ?>
				</div>
			</ul>
      </div>
               
</div>

</div>

</div>
 <!-- jQuery -->
   <script src="js/jQuery v1.12.4.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/bootbox.min.js"></script>
   <script src="js/userB.js"></script>
    <script type="text/javascript"> 
   $('.dropdown-menu a').click(function(){
		$('#categorias').text($(this).text());
	});
   </script>
	</body>
</html>