<?php require_once('Connections/myconn.php'); ?>
<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php 
$username=trim($_POST[S_Username]);
if($_POST[S_Username] != ""){
$answer=trim($_POST[S_Answer]);
$password = trim($_POST[S_Password]);
$sql=mysql_query("select * from student where S_Username='".$username."'",$myconn);
$info=mysql_fetch_array($sql);
if($answer != $info[S_Answer]){
	echo "<script>alert('问题回答错误!请重新输入或联系管理员！'); history.back();</script>";
	exit;
}
else{
	$sql=mysql_query("update student set S_Password = '".md5($password)."' where S_Username = '".$username."'",$myconn);
	echo "<script>alert('设置成功!');window.location='index.php';</script>";
}
}
?>