<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员主页</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
.di {
	background-color: #09F;
}
</style>
<div align="center">

  <table width="1040" border="0">
    <tr>
      <td><?php include("adminhead.php"); ?></td>
    </tr>
    <tr>
      <td height="32" align="center"><table width="418" border="0">
        <tr>
          <td width="100" height="31" class="di"><a href="tealist.php">管理教师信息</a></td>
          <td width="100" class="di"><a href="stulist.php">管理学生信息</a></td>
          <td width="100" class="di"><a href="addnews.php">加入新闻信息</a></td>
          <td width="100" class="di"><a href="setshow.php">设置主页显示</a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
</div>
</html>