<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
include("Connections/myconn.php");
$S_Username = trim($_POST[S_Username]);
$S_Password = md5(trim($_POST[S_Password]));
$S_Email = trim($_POST[S_Email]);
$S_Name = trim($_POST[S_Name]);
$S_Phone = trim($_POST[S_Phone]);
$S_Number = trim($_POST[S_Number]);
$S_Academy = trim($_POST[S_Academy]);
$S_Major = trim($_POST[S_Major]);
$S_Answer = trim($_POST[S_Answer]);
$S_Sex = trim($_POST[S_Sex]);
if($_POST[S_Question] == "1")
	$S_Question = trim($_POST[S_Question2]);
else
	$S_Question = trim($_POST[S_Question]);
if($S_Username =="")
{
	echo "<script>alert('请输入用户名!');history.back();</script>";
    exit;
}
$sql=mysql_query("select * from student where S_Username='".$S_Username."'",$myconn);
$info=mysql_fetch_array($sql);
if($info==true)
 {
   echo "<script>alert('该用户名已经存在!');history.back();</script>";
   exit;
 }
 else
 {  
    mysql_query("insert into student (S_Username,S_Password,S_Name,S_Phone,S_Sex,S_Number,S_Email,S_Academy,S_Major,S_Question,S_Answer) values ('$S_Username','$S_Password','$S_Name','$S_Phone','$S_Sex','$S_Number','$S_Email','$S_Academy','$S_Major','$S_Question','$S_Answer')",$myconn);
    echo "<script>alert('恭喜，注册成功!');window.location='stulogin.php';</script>";
 }
?>
