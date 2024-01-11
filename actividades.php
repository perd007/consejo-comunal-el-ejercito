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


 if( $_POST['opcion']=="registro"){
 
 $ruta="registro_actividad.php";
   header(sprintf("Location: %s", $ruta));


 }else{
 if( $_POST['opcion']=="consulta"){
 
  $ruta="consulta_actividad.php";
   header(sprintf("Location: %s", $ruta));

 }
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


<body>
<form id="form1" name="form1" method="post"   action="<?php echo $editFormAction; ?>">
  <table width="407" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><strong>SELECCIONE UNA OPCION </strong></div></td>
    </tr>
    <tr valign="baseline">
      <td width="81" align="right" nowrap="nowrap"><strong>Opciones:</strong></td>
      <td width="320"><input name="opcion" checked="checked"  type="radio" value="registro" />
        Registrar Actividad
        <label>
        <input name="opcion" type="radio" value="consulta" />
      Consultar Actividad </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
          <input name="submit" type="submit" value="IR" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
