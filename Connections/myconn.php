<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_myconn = "localhost";
$database_myconn = "s_t_management";
$username_myconn = "root";
$password_myconn = "dufeiji";
$myconn = mysql_pconnect($hostname_myconn, $username_myconn, $password_myconn) or trigger_error(mysql_error(),E_USER_ERROR);
/*mysql_query("set names 'utf8'");*/
mysql_set_charset('utf8',$myconn);
mysql_select_db($database_myconn, $myconn);
?>