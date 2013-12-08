<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<?php
include("../Connections/myconn.php");
			mysql_query("update news set N_Show = 0 where N_Show = 1",$myconn);
			echo "<script language='javascript'>alert('重置成功！');window.location='setshow.php'</script>";
?>