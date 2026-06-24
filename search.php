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
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/userA.css" rel="stylesheet">

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
            <li class="active" ><a href="search.php"><span class="glyphicon icon-nav glyphicon-shopping-cart"></span></a></li>
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
    <!-- <p style="font-size:26px;text-align: center;"><b>Resultado de busqueda para:</b></p> -->
        <div class="row">

            <div class="col-md-3">
                 <!--<img src="assets/logo2.png" class="img-logo">-->
                    
             <div class="panel2 panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-list"></span>Categorias<a href="#">
                        </h3>
                     </div>
                    <div id="listaCategoria" class="list-group" style="border: 1px solid #000;">
                        <?php include("consultas/getCategorias.php"); ?> 
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <!-- <div id="loader" class="text-center"> <img src="assets/ajax-loader.gif"></div> -->
                    <div class="outer_div"></div><!-- Datos ajax Final -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jQuery v1.12.4.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/search.js"></script>
	<script type="text/javascript">   
	function getURLParameter(name) {
		return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
	}
	
	var busq = getURLParameter('busq');
	var pre = getURLParameter('val');
	var cat = getURLParameter('cat');
	load(1);
	</script>
</script>
</body>

</html>
