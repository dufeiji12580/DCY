<?php require_once('Connections/myconn.php'); ?>
<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php 
session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
$oldpassword = trim($_POST[old_password]);
$password = trim($_POST[S_Password]);
$oldpassword = md5($oldpassword);

$sql=mysql_query("select S_Password from student where S_Username='".$_SESSION[S_Username]."'",$myconn);
$info=mysql_fetch_array($sql);
if($info[S_Password] != $oldpassword)
{
	echo "<script>alert('密码输入错误！'); history.back();</script>";
	exit;
}
else{
	$sql=mysql_query("update student set S_Password = '".md5($password)."' where S_Username = '".$_SESSION[S_Username]."'",$myconn);
	session_destroy();
	echo "<script>alert('设置成功!');window.location='stulogin.php';</script>";
}

?>