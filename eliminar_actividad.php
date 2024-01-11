<?php require_once('Connections/comunal.php'); ?>
<?php


$id=$_GET["id"];

$sql="delete from actividades where id='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='consulta_actividad.php' </script>";
}
else{
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='consulta_actividad.php' </script>";
	
}
?>