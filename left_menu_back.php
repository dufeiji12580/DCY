<?php session_start();
if(!$_SESSION[S_Username] && !$_SESSION[T_Username]){
	 echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
else if($_SESSION[S_Username]){
	$username = "<a href = \"stuindex.php\">$_SESSION[S_Username]</a>";
	$pathtochange = "<a href = \"stuchangeinfo.php\">修改资料</a>";
}
else{
	$username = "<a href = \"teaindex.php\">$_SESSION[T_Username]</a>";
	$pathtochange = "<a href = \"teachangeinfo.php\">修改资料</a>";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

.di {
	background-color: #09F;
}
}
</style>
<table width="200" border="0">
  <tr>
    <td width="194" height="150"><table width="194" border="0">
      <tr>
        <td height="50" colspan="2" class = "di">欢迎您：</td>
      </tr>
      <tr>
        <td height="50" colspan="2" class = "di"><p align="center"> <?php echo $username ?></p></td>
      </tr>
      <tr>
        <td width="84" height="50" class = "di"><div align="center"> <?php echo $pathtochange; ?></a></div></td>
        <td width="85" class = "di"><div align="center"><a href="logout.php">注销</a></div></td>
      </tr>
  </table></td>
  </tr>
</table>
