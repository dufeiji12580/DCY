<?php require_once('Connections/myconn.php'); ?>
<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php 
session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
$oldpassword = trim($_POST[old_password]);
$password = trim($_POST[T_Password]);
$oldpassword = md5($oldpassword);

$sql=mysql_query("select T_Password from teacher where T_Username='".$_SESSION[T_Username]."'",$myconn);
$info=mysql_fetch_array($sql);
if($info[T_Password] != $oldpassword)
{
	echo "<script>alert('密码输入错误！'); history.back();</script>";
	exit;
}
else{
	$sql=mysql_query("update teacher set T_Password = '".md5($password)."' where T_Username = '".$_SESSION[T_Username]."'",$myconn);
	session_destroy();
	echo "<script>alert('设置成功!');window.location='tealogin.php';</script>";
}

?>