<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conect_rec = "localhost";
$database_conect_rec = "toke";
$username_conect_rec = "root";
$password_conect_rec = "smartjiwo";
$conect_rec = mysql_pconnect($hostname_conect_rec, $username_conect_rec, $password_conect_rec) or trigger_error(mysql_error(),E_USER_ERROR); 
?>