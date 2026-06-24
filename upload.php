<?php
//comprobamos que sea una petición ajax
   session_start();     $ced=$_SESSION['cedula'];
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
 
    //obtenemos el archivo a subir
    $file = $_FILES['archivo']['name'];
 
    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir("fotoperfil/")) 
        mkdir("fotoperfil/", 0777);
     
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"fotoperfil/".$file))
    {
       sleep(3);//retrasamos la petición 3 segundos
       echo $file;//devolvemos el nombre del archivo para pintar la imagen
     


       $dbconn = pg_connect("host=localhost port=5432 dbname=proyecto user=postgres password=gustavo");



        $query="UPDATE usuario SET fotousuario = '$file' WHERE rifcedula='$ced'";
        $resultado = pg_query($dbconn,$query) or die("almacenando foto");

    }
}else{
    throw new Exception("Error Processing Request", 1);   
}




?>