<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
include("Connections/myconn.php");
ignore_user_abort();
//即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.

set_time_limit(0);

$interval=60*5;

do{
$nowtime = date('Y-m-j H:i:s',time());
$result = mysql_query("select FA_ID,Order_Time,State from Apply_Form where State = 'w'",$myconn);
$autoinfo = mysql_fetch_array($result);
if($autoinfo)
{
	do{
		if(strtotime($autoinfo[Order_Time])<strtotime($nowtime))
		{
			mysql_query("update Apply_Form set State = 'p' where FA_ID = ".$autoinfo[FA_ID],$myconn);
		}
	}while($autoinfo = mysql_fetch_array($result));
}
sleep($interval);

}while(true);
?>