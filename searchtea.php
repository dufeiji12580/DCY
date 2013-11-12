<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username] && !$_SESSION[T_Username]){
	 $left = "left_menu.php";
}
else{
	$left = "left_menu_back.php";
}
if($_SESSION[S_Username])
	$rflag = 1;
else
	$rflag = 0;
?>
<?php include("Connections/myconn.php");
$username = trim($_GET[username]);
$sql = "select * from teacher where T_Username = '".$username."'";
$result = mysql_query($sql,$myconn); 
$teainfo = mysql_fetch_array($result);
?>
<?php
$params = array();
if (isset($_GET['year']) && isset($_GET['month'])) {
    $params = array(
        'year' => $_GET['year'],
        'month' => $_GET['month'],
    );
}
$params['url']  = 'index.php';
require_once ('calendar.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教师查询</title>
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
      <td colspan="3"><?php include("head.php") ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200" valign="top"><?php include($left) ?></td>
      <td width="638" rowspan="2" valign="top" align="center"><table width="400" border="0">
          <tr>
            <td colspan="2" align="center">教师信息</td>
          </tr>
          <tr >
            <td width="85">姓名：</td>
            <td width="305" class = "di"><?php echo $teainfo[T_Name]; ?></td>
          </tr>
          <tr>
            <td >学院：</td>
            <td class = "di"><?php echo $teainfo[T_Academy]; ?></td>
          </tr>
          <tr>
            <td>专业：</td>
            <td class = "di"><?php echo $teainfo[T_Major]; ?></td>
          </tr>
          <tr>
            <td>电话：</td>
            <td class = "di"><?php echo $teainfo[T_Phone]; ?></td>
          </tr>
          <tr>
            <td>Email：</td>
            <td class = "di"><?php echo $teainfo[T_Email]; ?></td>
          </tr>
          <tr>
            <td>基本信息：</td>
            <td class = "di"><?php echo $teainfo[T_Basic_Info]; ?></td>
          </tr>
          <tr>
            <td>研究方向：</td>
            <td class = "di"><?php echo $teainfo[T_Research_Derection]; ?></td>
          </tr>
          <tr>
            <td>研究成果：</td>
            <td class = "di"><?php echo $teainfo[T_Research_Achievement]; ?></td>
          </tr>
      </table>
        <table width="400" border="0">
          <tr>
            <td width="183" height="34" align="center"><input name="button" type="button"  class = "buttoncss" id="button" value="预约该教师" /></td>
            <td width="207" align="center"><input type="button" name="button2" id="button2"  class = "buttoncss" value="给他（她）留言" /></td>
          </tr>
      </table></td>
      <td width="188" rowspan="2" valign="top"><?php 
	  if($rflag == 1)
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
      <td  colspan="3" height="100" valign="bottom"><?php include("bottom.php")?></td>
    </tr>
  </table>
</div>
</html>