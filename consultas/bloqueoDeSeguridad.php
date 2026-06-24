<?php
//Inicio la sesión
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
//COMPRUEBA QUE EL USUARIO ESTA AUTENTICADO
if (!isset($_SESSION['cedula'])) {
	//si no existe, va a la página de autenticacion
	header("HTTP/1.1 302 Moved Temporarily"); 
	header("Location: index.html");
	//salimos de este script
	exit();
}
?>