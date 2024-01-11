<?php require_once('Connections/comunal.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_ac = 15;
$pageNum_ac = 0;
if (isset($_GET['pageNum_ac'])) {
  $pageNum_ac = $_GET['pageNum_ac'];
}
$startRow_ac = $pageNum_ac * $maxRows_ac;

mysql_select_db($database_comunal, $comunal);
$query_ac = "SELECT * FROM actividades";
$query_limit_ac = sprintf("%s LIMIT %d, %d", $query_ac, $startRow_ac, $maxRows_ac);
$ac = mysql_query($query_limit_ac, $comunal) or die(mysql_error());
$row_ac = mysql_fetch_assoc($ac);

if (isset($_GET['totalRows_ac'])) {
  $totalRows_ac = $_GET['totalRows_ac'];
} else {
  $all_ac = mysql_query($query_ac);
  $totalRows_ac = mysql_num_rows($all_ac);
}
$totalPages_ac = ceil($totalRows_ac/$maxRows_ac)-1;

$queryString_ac = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ac") == false && 
        stristr($param, "totalRows_ac") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ac = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ac = sprintf("&totalRows_ac=%d%s", $totalRows_ac, $queryString_ac);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
-->
</style>
</head>
<script>
function validar(){

			var valor=confirm('¿Esta seguro de Eliminar esta Actividad?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}
//-->
</script>
<body>
<table width="670" border="1" align="center">
  <tr>
    <th colspan="5" bgcolor="bbbbbb" scope="col">CONSULTA DE ACTIVIDADES </th>
  </tr>
  <tr>
    <td width="97" bgcolor="bbbbbb"><div align="center"><strong>FECHA</strong></div></td>
    <td width="268" bgcolor="bbbbbb"><div align="center"><strong>DESCRIPCION</strong></div></td>
    <td width="74" bgcolor="bbbbbb"><div align="center"><strong>ESTATUS</strong></div></td>
    <th width="78" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="bbbbbb" class="Estilo1" scope="col"><div align="center"><strong>Modificar</strong></div></th>
    <th width="70" align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="bbbbbb" class="Estilo1" scope="col"><div align="center"><strong>Eliminar</strong></div></th>
  </tr>
  <?php do { ?>
    <tr>
      <td bgcolor="#f2f0f0"><?php echo $row_ac['fecha']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_ac['descripcion']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_ac['estatus']; ?></td>
      <td bordercolor="#FFFFFF" bgcolor="#f2f0f0" class="bordes"><div align="center"><? echo "<a href='modificar_actividad.php?id=$row_ac[id]'>IR</a>" ?></div></td>
      <td bordercolor="#FFFFFF" bgcolor="#f2f0f0" class="bordes"><div align="center"><? echo "<a href='eliminar_actividad?modificar_actividad.php?id=$row_ac[id]'>IR</a>" ?></div></td>
    </tr>
    <?php } while ($row_ac = mysql_fetch_assoc($ac)); ?>
</table>
<p>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_ac > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_ac=%d%s", $currentPage, 0, $queryString_ac); ?>">Primero</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_ac > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_ac=%d%s", $currentPage, max(0, $pageNum_ac - 1), $queryString_ac); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_ac < $totalPages_ac) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_ac=%d%s", $currentPage, min($totalPages_ac, $pageNum_ac + 1), $queryString_ac); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_ac < $totalPages_ac) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_ac=%d%s", $currentPage, $totalPages_ac, $queryString_ac); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($ac);
?>
