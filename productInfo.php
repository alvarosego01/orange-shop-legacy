

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orange Shop</title>
   <script src="js/order.js" type="text/javascript"></script> 
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
	<link href="css/userA.css" rel="stylesheet">
    <link href="css/productoInfo.css" rel="stylesheet">

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
            <li class="active"><a href="shop.php"><span class="glyphicon icon-nav glyphicon-home"></span></a></li>
            <li><a href="search.php"><span class="glyphicon icon-nav glyphicon-shopping-cart"></span></a></li>
            <li><a href="userA.php"><span class="glyphicon icon-nav glyphicon-user"></span></a></li>
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

    <!-- Page Content -->
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row" id="informacionproducto">
				   


                    <?php 
                    include("recursosgenerales/consultasyrecursosgenerales.php");
                     $pro=$_GET["pro"];
               
           
                    infproducto($pro);
          
                     
                    ?>





				</div>
			</div>
		</div>
	</div>







<div class="modal fade" id="gestorcompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Interfaz de Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      
       <div class="container-fluid">
        <div class="row" style="margin-right: 0px;margin-left: 15%;">
            <!-- left column -->
     
        <?php 
       generargestorcompra($pro);
         ?>

      

        

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
