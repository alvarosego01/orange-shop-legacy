<?php include("recursosUSA/ProcesosyfuncionesUSA.php");?> 


<!DOCTYPE html>
<html lang="en">
	<script src="js/jQuery v1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/order.js" type="text/javascript"></script> 
    <script type="text/javascript" src="js/functions.js"></script>
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
  <h6></h6>

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
            <li class="active"><a href="userA.php"><span class="glyphicon icon-nav glyphicon-user"></span></a></li>
          </ul>
  
        </div><!--/.nav-collapse -->
      </div>
    </nav>


	
<div class="row" style="margin-left: 1%;">
      <div class="col-xs-6 col-sm-3 placeholder" style="width: 50%; height: 40px; ">
	  
        <div class="panel panel-primary">
		    <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-stats"></span>Por Vendedor<a href="#"><span
                            class="glyphicon glyphicon-new-window"></span></a>
                    </h3>
             </div>

        <div class="container-fluid">
		

<ol class="list-group">
     <div class="outer_divvend">



      <?php 
              porvendedor();
           ?>


          </div>
        
      </ol> 

		</div>
 </div>
</div>







<div class="col-xs-6 col-sm-3 placeholder" style="width: 50%;  height: 40px;">

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
		<span class="glyphicon glyphicon-stats"></span>Por Comprador<a href="#"><span
			  class="glyphicon glyphicon-new-window"></span></a>
		</h3>
    </div>  

      <div class="container-fluid">
		<ol class="list-group">

   <div class="outer_divcomp">
     <?php 
              porcomprador();
           ?>
      


   </div>
 
		</ol>



	 </div>
               
</div>

</div>

</div>
	</body>

</html>