<?php require_once('Connections/comunal.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE actividades SET fecha=%s, descripcion=%s, estatus=%s WHERE id=%s",
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['estatus'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_comunal, $comunal);
  $Result1 = mysql_query($updateSQL, $comunal) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Cambiados');  location.href='fondo.html' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='fondo.html' </script>";
  exit;
  }
}
$id=$_GET["id"];
mysql_select_db($database_comunal, $comunal);
$query_actividades = "SELECT * FROM actividades where id=$id";
$actividades = mysql_query($query_actividades, $comunal) or die(mysql_error());
$row_actividades = mysql_fetch_assoc($actividades);
$totalRows_actividades = mysql_num_rows($actividades);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>
<script language="javascript">

function validar(){

	
			
				if(document.form1.fecha.value==""){
						alert("Debe Ingresar una fecha");
						return false;
				}
			
				if(document.form1.descripcion.value==""){
						alert("Debe Ingresar una descripcion");
						return false;
				}
				
				
			
		}
</script>
<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><strong>ACTUALIZACION  DE ACTIVIDADES </strong></div></td>
    </tr>
    <tr valign="baseline">
      <td width="192" align="right" nowrap="nowrap"><strong>Fecha de la Actividad:</strong></td>
      <td width="368"><input name="fecha" type="text" id="fecha" value="<?php echo $row_actividades['fecha']; ?>" size="20" maxlength="10" readonly="readonly" />
          <button type="submit" id="cal-button-1" title="Clic Para Escoger la fecha">Fecha</button>
        <script type="text/javascript">
							Calendar.setup({
							  inputField    : "fecha",
							  ifFormat   : "%Y-%m-%d",
							  button        : "cal-button-1",
							  align         : "Tr"
							});
						  </script></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="middle"><strong>Descripcion:</strong></td>
      <td><textarea name="descripcion" cols="45" rows="5" onkeydown="if(this.value.length &gt;= 300){ alert('Has superado el tama&ntilde;o m&aacute;ximo permitido de este campo'); return false; }"><?php echo $row_actividades['descripcion']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Estatus:</strong></td>
      <td><input name="estatus" type="radio" value="Realizada" <?php if($row_actividades['estatus']=="Realizada") echo "checked=checked";?> />
        Realizada
        <label>
        <input name="estatus" type="radio" value="Cancelada" <?php if($row_actividades['estatus']=="Cancelada") echo "checked=checked";?>/>
          Cancelada
          <input name="estatus" type="radio"  value="Por realizar" <?php if($row_actividades['estatus']=="Por realizar") echo "checked=checked";?>/>
          Por Realizar </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
          <input name="submit" type="submit" value="CAMBIAR DATOS" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_actividades['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($actividades);
?>
