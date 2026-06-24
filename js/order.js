

	  function setItems() {//ASC
		   $.ajax({
		   url: "./consultas/userCconsultas.php",
		   type: "POST",
		   data: {ascODesc: 'true'},
		   success: function(output){
			   console.log(output);
		   $("#lista").html(output);
			}
		});
    }
	
	   function setItems2() {//DESC
		 $.ajax({
		   url: "./consultas/userCconsultas.php",
		   type: "POST",
		   data: {ascODesc: 'false'},
		   success: function(output){
			   console.log(output);
		   $("#lista").html(output);
			}
		});
    }
	
	function setIngresos() {//ASC

		   $.ajax({
		   url: "./consultas/userCconsultas.php",
		   type: "POST",
		   data: {ascODescIng: 'true'},

		   success: function(output){
			   console.log(output);

		   $("#lista2").html(output);
			}
		});
    }
	
	   function setIngresos2() {//DESC
		 $.ajax({
		   url: "./consultas/userCconsultas.php",
		   type: "POST",
		   data: {ascODescIng: 'false'},
		   success: function(output){
			   console.log(output);
		   $("#lista2").html(output);
			}
		});

}

	var public = function (producto) {//Intento de codigo ajax que elimina y re carga las publicaciones 
		
         var pro =producto;
      
	     $.ajax({
		   url: "./recursosUSA/ProcesosyfuncionesUSA.php",
		   type: "POST",
		   data: {pro},
		   success: function(output){
			   console.log(output);
		   $(".outer_divp").html(output);
			}
		});
    }





    var vercompras=function(idcompra) {//Intento de codigo ajax que ajusta y elimina las compras finalizadas 


   
    var comentario = $("#co"+idcompra).val();
    var idprodu= $('#producto').val();
    var evaluacion=$('#ev'+idcompra).val();
    var idcompr=idcompra;
  
        
	     $.ajax({
		   url: "./recursosUSA/ProcesosyfuncionesUSA.php",
		   type: "POST",
		   data: {idcompr,comentario,evaluacion,idprodu},
		   success: function(output){
			   console.log(output);
		   $(".outer_divc").html(output);
			}
		});




        }



     var respondercomprador=function(idcompra){
    
      var comentarioo = $("#res"+idcompra).val();
    var evaluacionn= $('#eva'+idcompra).val();

    var idcompraa=idcompra;



  
        
	     $.ajax({
		   url: "./recursosUSA/ProcesosyfuncionesUSA.php",
		   type: "POST",
		   data: {comentarioo,evaluacionn,idcompraa},
		   success: function(output){
			   // console.log(output);
		   $(".outer_divvend").html(output);
			}
		});








     }













function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}



    



	function load(page,panel){
  //  alert(panel);
    $.ajax({
      url:'./recursosUSA/ProcesosyfuncionesUSA.php',
      type: "POST",
      data: {action: panel, 'page': page},
      success:function(data){
     // alert(page);
      
        if(panel=='Publicaciones'){
          $(".outer_divp").html(data).fadeIn('slow');
        }
        else if(panel=='Compras'){
          $(".outer_divc").html(data).fadeIn('slow');
      }
           else if(panel=='Porvendedor'){
          $(".outer_divvend").html(data).fadeIn('slow');
      }
           else if(panel=='Porcomprador'){

          $(".outer_divcomp").html(data).fadeIn('slow');
        }
 


 }
 })



 }




	
  

  

	
  
