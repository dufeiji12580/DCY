<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php require_once('Connections/myconn.php'); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先以学生登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$stuorderdetailfaid = trim($_GET[faid]);
mysql_query("update apply_form set View = 1 where FA_ID = ".$stuorderdetailfaid,$myconn);
$sql = "select FT_ID,T_Name,T_Academy,Apply_Time,Order_Time,Order_Info,Reply_Info,State from apply_form natural join teacher where FA_ID = ".$stuorderdetailfaid;
$result = mysql_query($sql,$myconn); 
$stuorderdetailinfo = mysql_fetch_array($result);
?>
<?php
$params = array();
if (isset($_GET['year']) && isset($_GET['month'])) {
    $params = array(
        'year' => $_GET['year'],
        'month' => $_GET['month'],
    );
}
require_once 'calendar.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看</title>
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
  <table width="1040" border="0">
    <tr>
      <td colspan="3"><?php include("head.php"); ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200" valign="top"><?php include("left_menu_back.php"); ?></td>
      <td width="638" rowspan="2" valign="top" align="center"><table width="420" border="0">
        <tr>
          <td colspan="3" align="center">预约详情：</td>
        </tr>
        <tr>
          <td colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="91">教师：</td>
          <td colspan="2" class="di"><a href="teainfo.php?ftid=<?php echo $stuorderdetailinfo[FT_ID]; ?>"><?php echo $stuorderdetailinfo[T_Name];?></a>&nbsp;&nbsp;&nbsp;&nbsp;(点击查看信息)</td>
        </tr>
        <tr>
          <td>学院：</td>
          <td colspan="2" class="di"><?php echo $stuorderdetailinfo[T_Academy];?></td>
        </tr>
        <tr>
          <td>申请时间：</td>
          <td colspan="2" class="di"><?php echo $stuorderdetailinfo[Apply_Time];?></td>
        </tr>
        <tr>
          <td valign="top">预约时间：</td>
          <td colspan="2" valign="top" class="di"><?php echo $stuorderdetailinfo[Order_Time];?></td>
        </tr>
        <tr>
          <td valign="top">状态：</td>
          <td colspan="2" valign="top" class="di">
           <?php if($stuorderdetailinfo[State] == "w")
					$state = "等待处理";
			else if($stuorderdetailinfo[State] == "p")
					$state = "时间已过";
			else if($stuorderdetailinfo[State] == "a")
					$state = "同意请求";
			else if($stuorderdetailinfo[State] == "d")
					$state = "拒绝请求";
			?>
			<?php echo $state; ?>
          </td>
        </tr>
        <tr>
          <td>预约回复：</td>
          <td colspan="2" class="di"><?php echo $stuorderdetailinfo[Reply_Info];?></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="147"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a></td>
          <td width="168">&nbsp;</td>
        </tr>
      </table></td>
      <td width="188" rowspan="2" valign="top"><?php include("right_menu_stu.php"); ?></td>
    </tr>
    <tr>
      <td valign="top"><table width="200" border="0">
        <tr>
          <td width="194"><?php
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