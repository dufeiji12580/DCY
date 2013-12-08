<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php
include("Connections/myconn.php");
if($_POST[yea]){
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
else
{
	echo "<script> window.location = 'freetimematchresult.php?y=$year&m=$month&d=$day&h=$hours&mi=$minutes' ;</script>";
}
}
?>