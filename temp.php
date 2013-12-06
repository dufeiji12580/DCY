<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
 include("../Connections/myconn.php");
 $result = mysql_query("select FA_ID,Order_Time,State from Apply_Form where State = 'w'",$myconn);
$autoinfo = mysql_fetch_array($result);
if($autoinfo)
{
	do{
		echo $autoinfo[FA_ID];
	}while($autoinfo = mysql_fetch_array($result));
}
 ?>