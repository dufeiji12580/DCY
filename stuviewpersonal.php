<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$sql = "select * from student where S_Username = '$_SESSION[S_Username]'";
$result = mysql_query($sql,$myconn); 
$stupersonalinfo = mysql_fetch_array($result);
?>
<?php
$params = array();
if (isset($_GET['year']) && isset($_GET['month'])) {
    $params = array(
        'year' => $_GET['year'],
        'month' => $_GET['month'],
    );
}
require_once ('calendar.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人信息</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<style type="text/css">

.di {
	background-color: #09F;
}
</style>
<div align="center">
  <table width="1040" border="0" >
    <tr>
      <td colspan="3"><?php include("head.php"); ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200" valign="top"><?php include("left_menu_back.php"); ?></td>
      <td width="638" rowspan="2" valign="top" align="center"><table width="400" border="0">
          <tr>
            <td colspan="2" align="center">个人信息</td>
          </tr>
          <tr >
            <td>用户名：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Username]; ?></td>
          </tr>
          <tr >
            <td>姓名：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Name]; ?></td>
          </tr>
          <tr >
            <td>性别：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Sex]; ?></td>
          </tr>
          <tr >
            <td>班级：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Class]; ?></td>
          </tr>
          <tr >
            <td width="85">学号：</td>
            <td width="305" class = "di"><?php echo $stupersonalinfo[S_Number]; ?></td>
          </tr>
          <tr>
            <td >学院：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Academy]; ?></td>
          </tr>
          <tr>
            <td>专业：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Major]; ?></td>
          </tr>
          <tr>
            <td>电话：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Phone]; ?></td>
          </tr>
          <tr>
            <td>Email：</td>
            <td class = "di"><?php echo $stupersonalinfo[S_Email]; ?></td>
          </tr>
      </table></td>
      <td width="188" rowspan="2" valign="top"><?php 
	  	include("right_menu_stu.php"); ?></td>
    </tr>
    <tr>
      <td valign="top"><table width="200" border="0">
        <tr>
          <td width="194"> <?php
                $cal = new Calendar($params);
                $cal->display();
            ?></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td  colspan="3"><?php include("bottom.php");?></td>
    </tr>
  </table>
</div>
</html>