
	function changeBan(name,status) {
		  // alert(status);
		  var estado=status;
		  if(estado==1){
			 estado =1;
		  }
		  else if(estado ==2){
			estado =3;
		  }
		  else {
			 estado =2;
		  }
		  		  // alert(estado);

		   $.ajax({
		   url: "consultas/userBconsultas.php",
		   type: "POST",
		   data: {change: 'true', nombre: name,stat: estado},
		   success: function(output){
				bootbox.alert({
					message: "Ha cambiado el status de: "+status+' a '+output,
					// className: 'blue'
				}); 		
			}
		});
    }
	
	function borrarPlan(name) {
		  // alert(status);
		   $.ajax({
		   url: "consultas/userBconsultas.php",
		   type: "POST",
		   data: {borrar: 'true',nombrePlan: name},
		   success: function(output){
				bootbox.alert({
					message: "Ha borrado el plan"+output,
					// className: 'blue'
				}); 		
			}
		});
    }	
	
	function agregarPlan() {
		
		bootbox.confirm(
		"<form id='infos' class='form-horizontal' method='POST' action=''>\
		<input type='text' id='nombre' class='form-control' name='nombre' placeholder='Ingrese Nombre' required autofocus/><br/>\
		<input type='text' id='precio' class='form-control' name='precio' placeholder='Ingrese Precio' required/><br/>\
		<input type='text' id='plazo' class='form-control' name='plazo' placeholder='Ingrese Plazo' required/><br/>\
		</form>"
		, 
		function(result) {
			if(result){
				var name = $('#infos').find('input[name="nombre"]').val();
				var precio = $('#infos').find('input[name="precio"]').val();
				var time = $('#infos').find('input[name="plazo"]').val();
				$.ajax({
				   url: "consultas/userBconsultas.php",
				   type: "POST",
				   data: {agregar: 'true', nombre:name, price: precio,plazo: time},
				   success: function(output){
					   bootbox.alert({
							message: "Ha agregado el plan: "+output
						}); 
				  }
				});
			}
				
		});		   
    }
	
	function cambiarPlan(id) {
		
		bootbox.confirm(
		"<form id='infos' class='form-horizontal' method='POST' action=''>\
		<input type='text' id='nombre' class='form-control' name='nombre' placeholder='Ingrese Nombre' required autofocus/><br/>\
		<input type='text' id='precio' class='form-control' name='precio' placeholder='Ingrese Precio' required/><br/>\
		<input type='text' id='plazo' class='form-control' name='plazo' placeholder='Ingrese Plazo' required/><br/>\
		</form>"
		, 
		function(result) {
			if(result){
				var name = $('#infos').find('input[name="nombre"]').val();
				var precio = $('#infos').find('input[name="precio"]').val();
				var time = $('#infos').find('input[name="plazo"]').val();
				$.ajax({
				   url: "consultas/userBconsultas.php",
				   type: "POST",
				   data: {cambiar: 'true', nombre:name, price: precio,plazo: time,idplan:id},
				   success: function(output){
					   bootbox.alert({
							message: "Ha campiado el plan: "+output
						}); 
				  }
				});
			}
				
		});		   
    }
	
	
	
	function agregarCategoria() {
		
		bootbox.confirm(
		"<form id='infos2' class='form-horizontal' method='POST' action=''>\
		<input type='text' id='nombre' class='form-control' name='nombre' placeholder='Ingrese Nombre' required autofocus/><br/>\
		</form>"
		, 
		function(result) {
			if(result){
				var name = $('#infos2').find('input[name="nombre"]').val();
				$.ajax({
				   url: "consultas/userBconsultas.php",
				   type: "POST",
				   data: {agregarCat: 'true', nombreCategoria:name},
				   success: function(output){
					   bootbox.alert({
							message: "Ha agregado la categoria: "+output
						}); 
				  }
				});
			}
				
		});		   
    }
	
	function borrarCategoria(name) {
		  // alert(status);
		   $.ajax({
		   url: "consultas/userBconsultas.php",
		   type: "POST",
		   data: {borrarCategoria: 'true',nombreCategoria: name},
		   success: function(output){
				bootbox.alert({
					message: "Ha borrado la categoria"+output,
					// className: 'blue'
				}); 		
			}
		});
    }
	
	function cambiarCategoria(id) {
		
		bootbox.confirm(
		"<form id='infos2' class='form-horizontal' method='POST' action=''>\
		<input type='text' id='nombre' class='form-control' name='nombre' placeholder='Ingrese Nombre' required autofocus/><br/>\
		</form>"
		, 
		function(result) {
			if(result){
				var name = $('#infos2').find('input[name="nombre"]').val();
				$.ajax({
				   url: "consultas/userBconsultas.php",
				   type: "POST",
				   data: {cambiarCaT: 'true',nombreCategoria:name,idCat:id},
				   success: function(output){
					   bootbox.alert({
							message: "Ha campiado la categoria a: "+output
						}); 
				  }
				});
			}
				
		});		   
    }
	
	function modificarEnuserD(idusr) {
		// alert(idusr);
		bootbox.confirm(
		"<form id='infos2D' class='form-horizontal' method='POST' action=''>\
		<input type='text' id='nombre' class='form-control' name='nombre' placeholder='Ingrese Nombre' required autofocus/><br/>\
		<input type='text' id='apellido' class='form-control' name='apellido' placeholder='Ingrese Nuevo Apellido' required autofocus/><br/>\
		<input type='text' id='email' class='form-control' name='email' placeholder='Ingrese Nuevo Email' required autofocus/><br/>\
		<input type='text' id='tlf' class='form-control' name='tlf' placeholder='Ingrese Nuevo Telefono' required autofocus/><br/>\
		<input type='text' id='clave' class='form-control' name='clave' placeholder='Ingrese Nuevo Password' required autofocus/><br/>\
		<input type='text' id='rango' class='form-control' name='rango' placeholder='Ingrese Nuevo Rango' required autofocus/><br/>\
		<input type='text' id='plan' class='form-control' name='plan' placeholder='Ingrese Nuevo Plan' required autofocus/><br/>\
		</form>"
		, 
		function(result) {
			if(result){
				var name = $('#infos2D').find('input[name="nombre"]').val();
				var apellido = $('#infos2D').find('input[name="apellido"]').val();
				var email = $('#infos2D').find('input[name="email"]').val();
				var tlf = $('#infos2D').find('input[name="tlf"]').val();
				var clave = $('#infos2D').find('input[name="clave"]').val();
				var rango = $('#infos2D').find('input[name="rango"]').val();
				var plan = $('#infos2D').find('input[name="plan"]').val();
				
				$.ajax({
				   url: "consultas/userBconsultas.php",
				   type: "POST",
				   data: {cambiarUserD: 'true',nombreenUserD:name,apellidoD:apellido,emailD:email,tlfD:tlf,claveD:clave,rangoD:rango,idUsr:idusr,planD:plan},
				   success: function(output){
					   bootbox.alert({
							message: ""+output
						}); 
				  }
				});
			}
				
		});		   
    }
	
	function borrarEnUserD(id) {
		  // alert(status);
		   $.ajax({
		   url: "consultas/userBconsultas.php",
		   type: "POST",
		   data: {borrarUserD: 'true',idEnUserD: id},
		   success: function(output){
				bootbox.alert({
					message: "Ha borrado al Usuario"+output,
					// className: 'blue'
				}); 		
			}
		});
    }
	
	function agregarUserEnD() {
		
		bootbox.confirm(
		"<form id='infos' class='form-horizontal' method='POST' action=''>\
		<input type='text' id='nombre' class='form-control' name='nombre' placeholder='Ingrese Nombre' required autofocus/><br/>\
		<input type='text' id='apellido' class='form-control' name='apellido' placeholder='Ingrese Nuevo Apellido' required autofocus/><br/>\
		<input type='text' id='email' class='form-control' name='email' placeholder='Ingrese Nuevo Email' required autofocus/><br/>\
		<input type='text' id='tlf' class='form-control' name='tlf' placeholder='Ingrese Nuevo Telefono' required autofocus/><br/>\
		<input type='text' id='clave' class='form-control' name='clave' placeholder='Ingrese Nuevo Password' required autofocus/><br/>\
		<input type='text' id='cedula' class='form-control' name='cedula' placeholder='Ingrese Cedula' required/><br/>\
		</form>"
		, 
		function(result) {
			if(result){
				var name = $('#infos').find('input[name="nombre"]').val();
				var apellido = $('#infos').find('input[name="apellido"]').val();
				var email = $('#infos').find('input[name="email"]').val();
				var tlf = $('#infos').find('input[name="tlf"]').val();
				var clave = $('#infos').find('input[name="clave"]').val();
				var ci = $('#infos').find('input[name="cedula"]').val();
				$.ajax({
				   url: "consultas/userBconsultas.php",
				   type: "POST",
				   data: {agregarUserD: 'true', nombre:name,AapellidoD:apellido,AemailD:email,AtlfD:tlf,AclaveD:clave,cedula: ci},
				   success: function(output){
					   bootbox.alert({
							message: "Ha agregado al usuario: "+output
						}); 
				  }
				});
			}
				
		});		   
    }
	
	    
	function load(page,panel){
		// alert(panel);
		$.ajax({
			url:'consultas/userBconsultas.php',
			type: "POST",
		    data: {action: panel, 'page': page},
			success:function(data){
				// alert(data);
				if(panel=='usuarios'){
					$(".outer_div").html(data).fadeIn('slow');
				}
				else if(panel=='planes'){
					$(".outer_div2").html(data).fadeIn('slow');
				}
				else if(panel=='categorias'){
					$(".outer_div3").html(data).fadeIn('slow');
				}
				else if(panel=='usuarionEnD'){
					// alert(data);
					$("#tab4").find(".outer_divUserD").html(data).fadeIn('slow');
				}
			}
		})
	}
	
		
	$('#buscar').click(function(){
		var busqueda = $('input#busqueda').val();
		if(busqueda=="")
			busqueda='""';
		var valor = $('#rang').val();
		var catg = $('#categorias').text();
		 window.location = 'search.php?busq='+busqueda+'+&val='+valor+'+&cat='+catg;
	});
  
