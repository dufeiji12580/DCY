<?php require_once('Connections/myconn.php'); ?>
<?php session_start();
if(!$_SESSION[S_Username] && !$_SESSION[T_Username]){
	 echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
else if($_SESSION[S_Username]){
	$sql=mysql_query("select S_Name from student where S_Username='".$_SESSION[S_Username]."'",$myconn);
	$info=mysql_fetch_array($sql);
	$username = "<a class=\"SelectedLeftMenu\" href = \"stuindex.php\">$info[S_Name]</a>";
	$pathtoview = "<a class=\"SelectedLeftMenu\" href = \"stuviewpersonal.php\">个人信息</a>";
	$pathtochangepass = "<a class=\"SelectedLeftMenu\" href = \"stuchangepassword.php\">修改密码</a>";
	$pathtochange = "<a class=\"SelectedLeftMenu\" href = \"stuchangeinfo.php\">修改资料</a>";
}
else{
	$sql=mysql_query("select T_Name from teacher where T_Username='".$_SESSION[T_Username]."'",$myconn);
	$info=mysql_fetch_array($sql);
	$username = "<a class=\"SelectedLeftMenu\" href = \"teaindex.php\">$info[T_Name]</a>";
	$pathtoview = "<a class=\"SelectedLeftMenu\" href = \"teaviewpersonal.php\">个人信息</a>";
	$pathtochangepass = "<a class=\"SelectedLeftMenu\" href = \"teachangepassword.php\">修改密码</a>";
	$pathtochange = "<a class=\"SelectedLeftMenu\" href = \"teachangeinfo.php\">修改资料</a>";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="style/link.css">
<style type="text/css">

.di {
	background-color: #09F;
}
</style>
<table width="200" border="0">
  <tr>
    <td width="194" height="150"><table width="194" border="0">
      <tr>
        <td height="45" colspan="2" class = "di">欢迎您：</td>
      </tr>
      <tr>
        <td height="45" colspan="2" class = "di"><p align="center"> <?php echo $username ?></p></td>
      </tr>
      <tr>
        <td height="30" class = "di" align="center"><?php echo $pathtoview; ?></td>
        <td class = "di" align="center"><?php echo $pathtochangepass; ?></td>
      </tr>
      <tr>
        <td width="84" height="30" class = "di"><div align="center"> <?php echo $pathtochange; ?></div></td>
        <td width="85" class = "di"><div align="center"><a class="SelectedLeftMenu" href="logout.php">注销</a></div></td>
      </tr>
  </table></td>
  </tr>
</table>