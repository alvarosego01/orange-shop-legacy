<?php include("consultas/bloqueoDeSeguridad.php");?> 
<?php include("consultas/userCconsultas.php"); ?> 

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
            <li><a href="search.php"><span class="glyphicon icon-nav glyphicon-shopping-cart"></span></a></li>
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
<div class="outer_div">
      <div class="col-xs-6 col-sm-3 placeholder">
	  
        <div class="panel panel-primary">
		    <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-stats"></span>Top 10<a href="#"><span
                            class="glyphicon glyphicon-new-window"></span></a>
                    </h3>
             </div>

        <div class="container-fluid">
			<ul class="list-group">
				<?php consultaTop(); ?> 
            </ul>
		</div>
 </div>
</div>

<div class="col-xs-6 col-sm-3 placeholder">
	<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
		<span class="glyphicon glyphicon-stats"></span>Categorias<a href="#"><span
			  class="glyphicon glyphicon-new-window"></span></a>
		</h3>
    </div>  

      <div class="container-fluid">
	  <div id="resultado"></div>
			<ol class="list-group lista" id="lista">
				<?php categorias(true); ?> 
			</ol> 
		<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick="setItems()"><span class="glyphicon glyphicon-arrow-up"></span></a>
		<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick="setItems2()"><span class="glyphicon glyphicon-arrow-down"></span></a>
		</div>               
</div>
</div>

<div class="col-xs-6 col-sm-3 placeholder">

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
		<span class="glyphicon glyphicon-stats"></span>Ingresos<a href="#"><span
			  class="glyphicon glyphicon-new-window"></span></a>
		</h3>
    </div>  

      <div class="container-fluid">
		<ol class="list-group lista2" id="lista2">
			<?php ingresos(true); ?> 
		</ol>
		<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick="setIngresos()"><span class="glyphicon glyphicon-arrow-up"></span></a>
		<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick="setIngresos2()"><span class="glyphicon glyphicon-arrow-down"></span></a>
	 </div>
               
</div>

</div>

</div>
</div>
 <!-- jQuery -->
   <script src="js/jQuery v1.12.4.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/order.js"></script> 
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