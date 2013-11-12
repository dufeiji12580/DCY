<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
include("Connections/myconn.php");
$T_Username = trim($_POST[T_Username]);
$T_Password = md5(trim($_POST[T_Password]));
$T_Email = trim($_POST[T_Email]);
$T_Name = trim($_POST[T_Name]);
$T_Phone = trim($_POST[T_Phone]);
$T_Academy = trim($_POST[T_Academy]);
$T_Major = trim($_POST[T_Major]);
$T_Answer = trim($_POST[T_Answer]);
$T_Sex = trim($_POST[T_Sex]);
if($_POST[T_Question] == "1")
	$T_Question = trim($_POST[T_Question2]);
else
	$T_Question = trim($_POST[T_Question]);
if($T_Username =="")
{
	echo "<script>alert('请输入用户名!');history.back();</script>";
    exit;
}
$sql=mysql_query("select * from teacher where T_Username='".$T_Username."'",$myconn);
$info=mysql_fetch_array($sql);
if($info==true)
 {
   echo "<script>alert('该用户名已经存在!');history.back();</script>";
   exit;
 }
 else
 {  
    mysql_query("insert into teacher(T_Username,T_Password,T_Name,T_Phone,T_Sex,T_Email,T_Academy,T_Major,T_Question,T_Answer) values ('$T_Username','$T_Password','$T_Name','$T_Phone','$T_Sex','$T_Email','$T_Academy','$T_Major','$T_Question','$T_Answer')",$myconn);
    echo "<script>alert('恭喜，注册成功!');window.location='tealogin.php';</script>";
 }
?>
<?php
mysql_free_result($sql);
?>