<?php require_once('Connections/myconn.php'); ?>
<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php 
$username=trim($_POST[T_Username]);
if($_POST[T_Username] != ""){
$answer=trim($_POST[T_Answer]);
$password = trim($_POST[T_Password]);
$sql=mysql_query("select * from teacher where T_Username='".$username."'",$myconn);
$info=mysql_fetch_array($sql);
if($answer != $info[T_Answer]){
	echo "<script>alert('问题回答错误!请重新输入或联系管理员！'); history.back();</script>";
	exit;
}
else{
	$sql=mysql_query("update teacher set T_Password = '".md5($password)."' where T_Username = '".$username."'",$myconn);
	echo "<script>alert('设置成功!');window.location='index.php';</script>";
}
}
?>