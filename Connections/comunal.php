<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_comunal = "localhost";
$database_comunal = "comunal";
$username_comunal = "root";
$password_comunal = "";
$comunal = mysql_pconnect($hostname_comunal, $username_comunal, $password_comunal) or trigger_error(mysql_error(),E_USER_ERROR); 
?>