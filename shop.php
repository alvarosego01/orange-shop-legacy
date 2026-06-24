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
            <li class="active"><a href="#"><span class="glyphicon icon-nav glyphicon-home"></span></a></li>
            <li><a href="search.php"><span class="glyphicon icon-nav glyphicon-shopping-cart"></span></a></li>
            <li><a href="<?php echo $rangoURL;?>"><span class="glyphicon icon-nav glyphicon-user"></span></a></li>
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

        <div class="row">

	   <div class="col-md-3">
				<img src="assets/logo2.png" class="img-logo">
                    
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

                <div class="row carousel-holder">

                    <div class="col-md-12">
                       
					   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item active">
							  <img src="assets/bg1.jpg">
							</div>
							<div class="item">
							  <img src="assets/bg2.jpg">
							</div>
							<div class="item">
							  <img src="assets/bg3.jpg">
							</div>
						  </div>

						  <!-- Controls -->
						  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
						</div>
					   
                    </div>

                </div>

                <div class="row">
                    <div class="outer_div">

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img class="zoom" src="assets/producto.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="#">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img class="zoom" src="assets/producto.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$64.99</h4>
                                <h4><a href="#">Second Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img  class="zoom" src="assets/producto.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$74.99</h4>
                                <h4><a href="#">Third Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img class="zoom" src="assets/producto.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$84.99</h4>
                                <h4><a href="#">Fourth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img class="zoom" src="assets/producto.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$94.99</h4>
                                <h4><a href="#">Fifth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>

                     <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img class="zoom" src="assets/producto.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$94.99</h4>
                                <h4><a href="#">Fifth Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>

                </div>
				</div><!-- Datos ajax Final -->
            </div>

        </div>

    </div>
    <script src="js/jQuery v1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/search.js"></script>
 <script type="text/javascript"> 
	
	loadCategoria(1,'Computadoras');

	</script>
</body>

</html>
