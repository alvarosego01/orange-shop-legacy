<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registro</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/registro.css" rel="stylesheet">
    <link href="css/boton3D.css" rel="stylesheet">
  </head>
  <body>
	
		<div class="container">
			<div class="row main">
				<div class="main-login main-center2">
					<form class="form-horizontal" method="POST" action="consultas/registro.php">
						<h2 class="form-signin-heading">Bienvenido!</h2>
						<label for="name" class="sr-only">Nombre</label>
						<input type="text" id="inputName" class="form-control" name="name" placeholder="Ingrese Nombre" required autofocus>

						<input type="text" id="inputLastname" class="form-control" name="lastname" placeholder="Ingrese Apellido" required autofocus>
						<div class="input-group">
							<input type="name" id="inputCedula" class="form-control" name="cedula" placeholder="Ingrese Cedula o Riff" required autofocus>
							<span id="Info" class="input-group-addon danger"></span>
						</div>
						
						<input type="text" id="inputCountry" class="form-control" name="country" placeholder="Ingrese Pais" required autofocus>
						<input type="text" id="inputEstado" class="form-control" name="estado" placeholder="Ingrese Estado" required autofocus>
						<input type="text" id="inputParroquia" class="form-control" name="parroquia" placeholder="Ingrese Parroquia" required autofocus>
						<input type="text" id="inputCiudad" class="form-control" name="ciudad" placeholder="Ingrese Ciudad" required autofocus>
						<input type="text" id="inputDireccion" class="form-control" name="Direccion" placeholder="Ingrese Dirección" required autofocus>
						
						<label for="inputEmail" class="sr-only">Email</label>
						<div class="input-group">
							<input type="text" id="inputEmail" class="form-control" name="email" placeholder="Dirección de Email" required autofocus>
							<span id="Inf" class="input-group-addon danger"></span>
						</div>
						
						<label for="inputPassword" class="sr-only">Clave</label>
						<input type="text" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
						<button id="send"  class="btn btn-primary btn-lg btn3d btn-block btn-block"  type="submit">Registrarse</button>
						<a class="btn btn-success btn-lg btn3d btn-block btn-block" href="index.html">Login</a>
					</form>
				</div>
			</div>
		</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jQuery v1.12.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">

  $('#inputCedula').blur(function(){
    
    $('#Info').html('<img src="assets/ajax-loader.gif" alt="" />').fadeOut(1000);

    var cedu = $('input#inputCedula').val();  
    <!-- alert(cedu); -->
    var dataString = 'cedu='+cedu;
    
    $.ajax({
            type: "POST",
            url: "consultas/verificarUsuario.php",
            data: dataString,
            success: function(data) {
				if(data==1){
					 $('#Info').fadeIn(1000).html('Disponible');
					 $('#Info').removeClass('danger');
					 $('#Info').addClass('success');
						 if ($("#Info").hasClass("success") && $("#Inf").hasClass("success")) {
							$('#send').prop('disabled', false);
						 }
				 }
				else if(data==0){
					 $('#Info').fadeIn(1000).html('No Disponible');
					 $('#Info').removeClass('success');
					 $('#Info').addClass('danger');
					 $('#send').prop('disabled', true);
				 }
            }
        });
    }); 
  </script>
  
 <script type="text/javascript">   
     $('#inputEmail').blur(function(){
    
    $('#Inf').html('<img src="assets/ajax-loader.gif" alt="" />').fadeOut(1000);

    var maa = $('input#inputEmail').val();  
    <!-- alert(maa); -->
    var datast = 'maa='+maa;
    
    $.ajax({
            type: "POST",
            url: "consultas/validaremailregistro.php",
            data: datast,
            success: function(data) {
				if(data==1){
					 $('#Inf').fadeIn(1000).html('Disponible');
					 $('#Inf').removeClass('danger');
					 $('#Inf').addClass('success');
						 if ($("#Info").hasClass("success") && $("#Inf").hasClass("success")) {
							$('#send').prop('disabled', false);
						 }
				 }
				else if(data==0){
					 $('#Inf').fadeIn(1000).html('No Disponible');
					 $('#Inf').removeClass('success');
					 $('#Inf').addClass('danger');
					 $('#send').prop('disabled', true);
				 }
            }
        });
    }); 
 

</script>
  </body>
</html>