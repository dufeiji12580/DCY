<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<?php
include("../Connections/myconn.php");
$FT_ID = $_POST[ftid];
$T_Email = trim($_POST[T_Email]);
$T_Name = trim($_POST[T_Name]);
$T_Phone = trim($_POST[T_Phone]);
$T_Academy = trim($_POST[T_Academy]);
$T_Major = trim($_POST[T_Major]);
$T_Answer = trim($_POST[T_Answer]);
$T_Sex = trim($_POST[T_Sex]);
$T_Research = trim($_POST[T_Research]);
$T_Achievement = trim($_POST[T_Achievement]);
$T_Info = trim($_POST[T_Info]);
if($_POST[T_Question] == "1")
	$T_Question = trim($_POST[T_Question2]);
else
	$T_Question = trim($_POST[T_Question]);
    mysql_query("update teacher set T_Name = '$T_Name',T_Phone = '$T_Phone',T_Sex = '$T_Sex',T_Email = '$T_Email',T_Academy = '$T_Academy',T_Major = '$T_Major',T_Question = '$T_Question',T_Answer = '$T_Answer',T_Basic_Info = '$T_Info',T_Research_Derection = '$T_Research',T_Research_Achievement = '$T_Achievement',Modify = 1 where FT_ID = '$FT_ID'",$myconn);
    echo "<script>alert('修改成功!');window.location='tealist.php';</script>";
?>