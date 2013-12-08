<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<?php
include("../Connections/myconn.php");
$fsid = $_POST[fsid];
$S_Email = trim($_POST[S_Email]);
$S_Name = trim($_POST[S_Name]);
$S_Phone = trim($_POST[S_Phone]);
$S_Number = trim($_POST[S_Number]);
$S_Class = trim($_POST[S_Class]);
$S_Academy = trim($_POST[S_Academy]);
$S_Major = trim($_POST[S_Major]);
$S_Answer = trim($_POST[S_Answer]);
$S_Sex = trim($_POST[S_Sex]);
if($_POST[S_Question] == "1")
	$S_Question = trim($_POST[S_Question2]);
else
	$S_Question = trim($_POST[S_Question]);
    mysql_query("update student set S_Name = '$S_Name',S_Phone = '$S_Phone',S_Sex = '$S_Sex',S_Class = '$S_Class',S_Number = '$S_Number',S_Email = '$S_Email',S_Academy = '$S_Academy',S_Major = '$S_Major',S_Question = '$S_Question',S_Answer = '$S_Answer' where FS_ID = '$fsid'",$myconn);
    echo "<script>alert('修改成功!');window.location='stulist.php';</script>";
?>