function load(page){
		var busqueda = $('input#busqueda').val()!='""'? $('input#busqueda').val():busq;	
		var valor = $('#rang').val()!=100? $('#rang').val():pre;
		var catg = $('#categorias').text()!='Categorias'? $('#categorias').text():cat;
		var parametros = {"action":"ajax","page":page,"busqueda":busqueda,"rango":valor,"categoria":catg};
		
		// alert(busqueda);
		// alert(valor);
		// alert(catg);
		$.ajax({
			url:'consultas/listaProductos.php',
			data: parametros,
			success:function(data){
				// alert(data);
				$(".outer_div").html(data).fadeIn('slow');
			}
		})
	}
	
	function loadCategoria(page,category){
		var valor = $('#rang').val();
		var parametros = {"action":"ajax","page":page,"categoria":category};
		$.ajax({
			url:'consultas/listaProductos.php',
			data: parametros,
			success:function(data){

				$(".outer_div").html(data).fadeIn('slow');
			}
		})
	}
	
	$('.dropdown-menu a').click(function(){
		$('#categorias').text($(this).text());
	});
	
	$('.list-group a').click(function(){
		loadCategoria(1,$(this).text());
	});
  
	$('#buscar').click(function(){
		load(1);
    });         