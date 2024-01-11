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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO actividades (fecha, descripcion, estatus) VALUES (%s, %s, %s)",
                     
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['estatus'], "text"));

  mysql_select_db($database_comunal, $comunal);
  $Result1 = mysql_query($insertSQL, $comunal) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='fondo.html' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='fondo.html' </script>";
  exit;
  }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="jscalendar-1.0/calendar.js"></script>
    <script type="text/javascript" src="jscalendar-1.0/calendar-setup.js"></script>
    <script type="text/javascript" src="jscalendar-1.0/lang/calendar-es.js"></script>
    <style type="text/css"> 
    @import url("jscalendar-1.0/calendar-win2k-cold-1.css"); 
    </style>
		<script type="text/JavaScript" language="javascript" src="calendario/calendar-setup.js"></script>
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
<form method="post" name="form1" onsubmit="return validar()" action="<?php echo $editFormAction; ?>">
  <table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><div align="center"><strong>REGISTRO DE ACTIVIDADES </strong></div></td>
    </tr>
    <tr valign="baseline">
      <td width="192" align="right" nowrap><strong>Fecha de la Actividad:</strong></td>
      <td width="368"><input name="fecha" type="text" id="fecha" value="" size="20" maxlength="10" readonly="readonly">
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
      <td nowrap align="right" valign="middle"><strong>Descripcion:</strong></td>
      <td><textarea name="descripcion" cols="45" rows="5" onKeyDown="if(this.value.length &gt;= 300){ alert('Has superado el tama&ntilde;o m&aacute;ximo permitido de este campo'); return false; }"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Estatus:</strong></td>
      <td><input name="estatus" type="radio" value="Realizada" />
        Realizada
      <label>
      <input name="estatus" type="radio" value="Cancelada" />
      Cancelada 
       <input name="estatus" type="radio" checked="checked" value="Por realizar" />
      Por Realizar      </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><div align="center">
        <input type="submit" value="GUARDAR DATOS">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
