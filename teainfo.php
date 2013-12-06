<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username] && !$_SESSION[T_Username]){
	 $left = "left_menu.php";
}
else{
	$left = "left_menu_back.php";
}
if($_SESSION[S_Username])
	$rflag = 2;
else if($_SESSION[T_Username])
	$rflag = 1;
else
	$rflag = 0;
?>
<?php include("Connections/myconn.php");
$serchteaftid = trim($_GET[ftid]);
$sql = "select * from teacher where FT_ID = ".$serchteaftid;
$result = mysql_query($sql,$myconn); 
$serchteauserinfo = mysql_fetch_array($result);
if(isset($_GET[pre]) && $_GET[pre] == "pre")
{
	$sql = "select * from prefer where T_Username = '".$serchteauserinfo[T_Username]."' and S_Username = '".$_SESSION[S_Username]."'";
	$result = mysql_query($sql,$myconn);
	$preinfo = mysql_fetch_array($result);
	if($preinfo != true)
	{
		mysql_query("insert into prefer(S_Username,T_Username) values('$_SESSION[S_Username]','$serchteauserinfo[T_Username]')" );
		echo "<script>alert('关注成功!');</script>";
	}
	else
	{
		echo "<script>alert('您已关注!');</script>";
	}
}
if($serchteauserinfo[T_Sex] == "女")
	$ta = "给她留言";
else
	$ta = "给他留言";
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
<title>教师信息</title>
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
      <td width="200" valign="top"><?php include($left); ?></td>
      <td width="638" rowspan="2" valign="top" align="center"><table width="400" border="0">
          <tr>
            <td colspan="2" align="center">教师信息</td>
          </tr>
          <tr >
            <td width="85">姓名：</td>
            <td width="305" class = "di"><?php echo $serchteauserinfo[T_Name]; ?></td>
          </tr>
          <tr>
            <td >学院：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Academy]; ?></td>
          </tr>
          <tr>
            <td>专业：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Major]; ?></td>
          </tr>
          <tr>
            <td>电话：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Phone]; ?></td>
          </tr>
          <tr>
            <td>Email：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Email]; ?></td>
          </tr>
          <tr>
            <td>基本信息：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Basic_Info]; ?></td>
          </tr>
          <tr>
            <td>研究方向：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Research_Derection]; ?></td>
          </tr>
          <tr>
            <td>研究成果：</td>
            <td class = "di"><?php echo $serchteauserinfo[T_Research_Achievement]; ?></td>
          </tr>
      </table>
      <?php if($_SESSION[S_Username])
        echo "<table id=\"Table1\"  width=\"400\" border=\"0\">
          <tr>
			<td width=\"95\" align=\"center\"><a href=\"teainfo.php?ftid=$serchteaftid&pre=pre\">关注该教师</a></td>
            <td width=\"95\" align=\"center\"><a href=\"stuordertea.php?ftid=$serchteaftid\">预约该教师</a></td>
            <td width=\"100\" align=\"center\"><a href=\"stusearchteafreetime.php?ftid=$serchteaftid\">查看空闲时间</a></td>
            <td width=\"88\" align=\"center\"><a href=\"stuleavemessage.php?ftid=$serchteaftid\">$ta</a></td>
          </tr>
      </table>";?>
      </td>
      <td width="188" rowspan="2" valign="top"><?php 
	  if($rflag == 2)
	  	include("right_menu_stu.php"); 
		 else if($rflag == 1)
		 include("right_menu_tea.php");?></td>
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