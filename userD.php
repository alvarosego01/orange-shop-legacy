<?php include("consultas/bloqueoDeSeguridad.php");?> 
<?php include("recursosUSA/ProcesosyfuncionesUSA.php");?> 
<?php include("consultas/userBconsultas.php"); ?> 
<?php include("consultas/userCconsultas.php"); ?> 
<?php    	
?>
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
    <link href="css/userd.css" rel="stylesheet">
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
            <li class="active"><a href="userC.php"><span class="glyphicon icon-nav glyphicon-user"></span></a></li>
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

	<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Menu SuperUsuario</h3>
                    <span class="pull-right">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Información</a></li>
                            <li><a href="#tab2" data-toggle="tab">Planes</a></li>
                            <li><a href="#tab3" data-toggle="tab">Top 10</a></li>
                            <li><a href="#tab4" data-toggle="tab">Usuarios</a></li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
								<div class="ajustar-Panel panel-primary">
									<div class="panel-heading">
											<h3 class="panel-title">
												<span class="glyphicon glyphicon-user"></span>Informacion de Contacto<a href="#"><span
													class="glyphicon glyphicon-new-window"></span></a>
											</h3>
									 </div>

								  <div class="alinear" id="fotoperfil">
								   <?php 
										$ced=$_SESSION['cedula'];
								   mostrarfoto($ced); ?>
								</div>
	
								<div class="container-fluid">
								<div class="span8  centrar-texto">
								<h5>Nombre:   <?php datosUSA(0); ?>  </h5>
								<h5>Apellido:   <?php datosUSA(1); ?>  </h5>
								<h5>Plan:  <?php plan(); ?>   <span class="glyphicon glyphicon-tower flag"></span></h5>
								<h5>CI:   <?php datosUSA(2); ?>  </h5>
								<h5>Email: <?php datosUSA(3); ?>   </h5>
								<h5>Telefono:   <?php datosUSA(4); ?>   </h5>
							    <h5>Tipo de usuario:   <?php datosUSA(5); ?>   </h5>
							    <h5>Estatus:   <?php datosUSA(6); ?>   </h5>
								<h5>Pais:   <?php datosUSA(7); ?>   </h5>
								<h5>Estado:   <?php datosUSA(8); ?>   </h5>
								<h5>Parroquia:   <?php datosUSA(9); ?>   </h5>
								<h5>Ciudad:   <?php datosUSA(10); ?>   </h5>
								<h5>Dirección:   <?php datosUSA(11); ?>   </h5>							  
							</div>
							<div class="span2">
								<div class="btn-group botonOpciones">
									<a class="dropdown-toggle btn btn-primary btn-lg btn3d btn-block" data-toggle="dropdown" href="#">
										Opciones 
										<span class="icon-cog icon-white"></span><span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="shop.php">Home</a></li>
										<li><a href="#" data-toggle="modal" data-target="#exampleModal">Modificar</a></li>
										<li><a href="#" data-toggle="modal" data-target="#infobanco">Información bancaria</a></li>
										<li><a href="gestorevaluaciones.php"  >Gestor de evaluaciones</a></li>
										<li><a href="consultas/cerrar-sesion.php">Salir</a></li>
									</ul>
										</div>
									</div>
							   </div>
						 </div>
						 
						 <div class="ajustar-Panel2 panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">
								<span class="glyphicon glyphicon-star"></span>Compras<a href="#"><span
									  class="glyphicon glyphicon-new-window"></span></a>
								</h3>
							</div>  

						       <div class="container-fluid">
								<ol class="list-group">
								<div class="outer_divc">				   
									<?php  mostrarcompras();?>				   
							   </div>
							   </ol>
							</div>          
						</div>
						 
						 
						 <div class="ajustar-Panel3 panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">
								<span class="glyphicon glyphicon-star"></span>Publicaciones<a href="#"><span
									  class="glyphicon glyphicon-new-window"></span></a>
								</h3>
							</div>  

						     <div class="container-fluid">
							 <ol class="list-group">
								<div class="outer_divp">
									<?php publicacion();?>   
								</div>
								</ol>
							</div>         
						</div>
						 
						 
						</div>
						
                        <div class="tab-pane" id="tab2">
						
						<div class="panel-primary">
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
							<a onclick ="agregarPlan()" class="btn btn-primary btn3d " style="float:right" >Agregar</a>
							</div>                 
						</div>

						</div>
                        <div class="tab-pane" id="tab3">
						
						       <div class="ajustar-Panel panel-primary">
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
						 
						 	<div class="panel-primary  ajustar-Panel2 ">
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
									<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick='setItems();'><span class="glyphicon glyphicon-arrow-up"></span></a>
									<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick='setItems2();'><span class="glyphicon glyphicon-arrow-down"></span></a>
									</div>    
							</div> 
							
							
							<div class="ajustar-Panel3 panel-primary">
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
									<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick='setIngresos();'><span class="glyphicon glyphicon-arrow-up"></span></a>
									<a class="btn btn-primary btn3d" style="float:right; margin-top:10px;" onclick='setIngresos2();'><span class="glyphicon glyphicon-arrow-down"></span></a>
								 </div> 
							</div>
						</div>
  
						  <div class="tab-pane" id="tab4">
						  <div class="panel-primary">
									<div class="panel-heading">
											<h3 class="panel-title">
												<span class="glyphicon glyphicon-stats"></span>Gestion de Usuarios<a href="#"><span
													class="glyphicon glyphicon-new-window"></span></a>
											</h3>
									 </div>
									
									<div class="container-fluid">
										<ul class="list-group">
										<div class="outer_divUserD">
											<?php getUsuariosD(); ?> 
										</div>
										 </ul>
									</div>
								</div>
						  </div>
						  
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	   <div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-4 col-sm-6 col-xs-12">
			   <form enctype="multipart/form-data" class="formulario">
        <label>Sube una imagen</label><br />
        <input name="archivo" type="file" id="imagen" /><br /><br />
        <input type="button" value="Subir imagen" /><br />
    </form>
    <!--div para visualizar mensajes-->
    <div class="messages"></div><br /><br />
			</div>
			<!-- edit form column -->
			<div class="col-md-8 col-sm-6 col-xs-12">
			  <h3>Modificación de información personal</h3>
           
			  <form class="form-horizontal" role="form" method="POST" action="./recursosUSA/modificaciondedatosdeusuario.php">
				<div class="form-group">
				  <label class="col-lg-3 control-label">Nombre:</label>
				  <div class="col-lg-8">
					<input name='modifnombre' id="modifnombre" class="form-control" value="Escriba su nuevo nombre" type="text">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-lg-3 control-label">Apellido:</label>
				  <div class="col-lg-8">
					<input name='modifapellido' id="modifapellido" class="form-control" value="Escriba su nuevo apellido" type="text">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-lg-3 control-label">Email:</label>
				  <div class="col-lg-8">
					<input name='modifemail' id="modifemail" class="form-control" value="Ingrese su nuevo e-mail" type="text">
				  </div>
				</div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Telefono:</label>
                  <div class="col-lg-8">
                    <input name='modiftelefono' id="modtelefono" class="form-control" value="Escriba su numero telefonico" type="text">
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-lg-3 control-label">Pais:</label>
                  <div class="col-lg-8">
                    <input name='modifpais' id="modifpais" class="form-control" value="Escriba su nuevo pais" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Estado:</label>
                  <div class="col-lg-8">
                    <input name='modifestado' id="modifestado" class="form-control" value="Escriba su nuevo estado" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Parroquia:</label>
                  <div class="col-lg-8">
                    <input name='modifparroquia' id="modifparroquia" class="form-control" value="Escriba su nueva parroquia" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Ciudad:</label>
                  <div class="col-lg-8">
                    <input name='modifciudad' id="modiciudad" class="form-control" value="Escriba su nueva ciudad" type="text">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-lg-3 control-label">Direccion:</label>
                  <div class="col-lg-8">
                    <input name='modifdireccion' id="modiciudad" class="form-control" value="Escriba su nueva ciudad" type="text">
                  </div>
                </div>
				<div class="form-group">
				  <label class="col-md-3 control-label">Password:</label>
				  <div class="col-md-8">
					<input name='modifpassword' id="modifpassword" class="form-control" type="password" >
				  </div>
				</div>
			</div>
		  </div>
		 </div>
		   
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-primary btn-lg btn3d btn-block btn-block" data-dismiss="modal">Cerrar</button>
     <button class="btn btn-primary btn-lg btn3d btn-block btn-block" type="submit" >Guardar</button>
</form>
      </div>
         
    </div>
  </div>
</div> 


<div class="modal fade" id="planesCambioD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div class="container-fluid">
    <div class="row">  
      <div class="col-md-8 col-sm-6 col-xs-12">
        <h3>Cambiar por los siguientes planes:</h3>
		<span class="input-group-btn">
            <button id="Planes" class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" >Planes</button>
            <ul id="busqP" class="dropdown-menu">
            <?php include("consultas/getPlanes.php"); ?> 
            </ul>
          </span>
      </div>
      </div>
     </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-lg btn3d btn-block btn-block" data-dismiss="modal">Cerrar</button>
      </div>     
    </div>
  </div>
</div>


<div class="modal fade" id="evaluaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gestor de evaluaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div class="container-fluid">
    <div class="row">  
      <div class="col-md-8 col-sm-6 col-xs-12">
        <h3>Evaluaciones hechas y recibidas</h3>
      </div>
      </div>
     </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-lg btn3d btn-block btn-block" data-dismiss="modal">Cerrar</button>
      </div>     
    </div>
  </div>
</div>


 <div class="modal fade" id="infobanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar o añadir bancos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
       <div class="container-fluid">
        <div class="row">
           


            <div class="col-md-8 col-sm-6 col-xs-12">

         


              <h3>Modificación de información bancaria</h3>
            <form class="form-horizontal" role="form" method="POST" action="./recursosUSA/eliminarcuentabancaria.php">
            <div class=" col-lg-12 form-group">
        <label class="col-lg-2" for="ProductType">Bancos Registrados</label>
        <div class="col-lg-4">
  


        <select id="cuentasbanco" name="c" class="form-control product-type">
          <option>Seleccione</option>

                  
                     <?php
                   // codigo php que funciona para actualizar la lista de categorias disponibles para que el usuario pueda seleccionar una en cada updateo de productos  
                      $conn =pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");

                        $ced=$_SESSION['cedula'];
          
        $queri="select nombrebanco,numerocuenta,tipo from banco,contacto where contactobanco=idcontacto and idcontacto=(select usuario.idcontacto from usuario,contacto where usuario.idcontacto=contacto.idcontacto and rifcedula='$ced')";
         $resut = pg_query($queri) or die('Query failed: ' . pg_last_error());

         while($fil=pg_fetch_array($resut)){
            echo'<option value="'.$fil['nombrebanco'].'--'.$fil['numerocuenta'].'--'.$fil['tipo'].'"> '.$fil['nombrebanco'].'--'.$fil['numerocuenta'].'--'.$fil['tipo'].'</option>';
            }
             pg_close($conn);
                    ?>

        </select>
            
        </div>
      </div>
       <button class="btn btn-primary btn-lg btn3d btn-block btn-block" type="submit" >Eliminar cuenta</button>
</form>      
              <form class="form-horizontal" role="form" method="POST" action="./recursosUSA/anadircuentabancaria.php">
                <div class="form-group">
                 <h3>Añada una nueva cuenta bancaria</h3>
                  <label class="col-lg-3 control-label">Ingrese nombre de banco</label>
                  <div class="col-lg-8">
                    <input name='nombrebanco' id="idnombrebanco" class="form-control" value="Escriba su nuevo nombre" type="text">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-lg-3 control-label">Ingrese numero de banco</label>
                  <div class="col-lg-8">
                    <input name='numerocuenta' id="idnumerocuenta" class="form-control" value="Escriba su nuevo numero de cuenta" type="text">
                  </div>
                </div>

                 <div class=" col-lg-12 form-group">
              <label class="col-lg-2" >¿Ahorro o Corriente?</label>
              <div class="col-lg-4">
    

<INPUT type = radio name = tipocuenta value = "Corriente" > Corriente
<INPUT type = radio name = tipocuenta value = "Ahorro" > Ahorro



              
              </div>
            </div>



               
      <div class="modal-footer">
      
       <button class="btn btn-primary btn-lg btn3d btn-block btn-block" type="submit" >+Añadir cuenta</button>
        
        <button type="button" class="btn btn-primary btn-lg btn3d btn-block btn-block" data-dismiss="modal">Cerrar</button>




       </form>
      </div>
         
    </div>
  </div>

</div>
</div>
</div>
</div>
</div>

 
 <!-- jQuery -->
   <script src="js/jQuery v1.12.4.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/bootbox.min.js"></script>
   <script src="js/order.js"></script> 
   <script src="js/userB.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
	</body>

</html>