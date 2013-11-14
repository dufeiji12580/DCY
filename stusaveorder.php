<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
include("Connections/myconn.php");
$susername = $_POST[susername];
$tusername = $_POST[tusername];
$year = $_POST[yea];
$month = $_POST[mon];
$day = $_POST[day];
$hours = $_POST[hours];
$minutes = $_POST[minutes];
$time = $year."-".$month."-".$day." ".$hours.":".$minutes;
$nowtime = date('Y-m-j H:i:s',time());
if(strtotime($time)<strtotime($nowtime)){
	echo "<script>alert('输入时间小于当前时间!');history.back();</script>";
    exit;
}
$orderinfo = $_POST[orderinfo];
$orderinfo = nl2br($orderinfo);
$stusaveorder = mysql_query("insert into apply_form(S_Username,T_Username,Apply_Time,order_Info,State) values('$susername','$tusername','$time','$orderinfo','w')",$myconn);
echo "<script>alert('恭喜，预约成功!');window.location='stuindex.php';</script>";
?>