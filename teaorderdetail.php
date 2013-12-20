<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$orderdetailfaid = trim($_GET[faid]);
mysql_query("update apply_form set View = 1 where FA_ID = ".$orderdetailfaid,$myconn);
$sql = "select FS_ID,S_Name,S_Major,Apply_Time,Order_Time,Order_Info,Reply_Info,State from apply_form natural join student where FA_ID = ".$orderdetailfaid;
$result = mysql_query($sql,$myconn); 
$orderdetailinfo = mysql_fetch_array($result);
$nowtime = date('Y-m-j H:i:s',time());
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
<title>预约详情</title>
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
          <td width="91">学生：</td>
          <td colspan="2" class="di"><a class="SelectedLeftMenu" href="stuinfo.php?fsid=<?php echo $orderdetailinfo[FS_ID]; ?>"><?php echo $orderdetailinfo[S_Name];?></a>&nbsp;&nbsp;&nbsp;&nbsp;(点击查看信息)</td>
          </tr>
        <tr>
          <td>专业：</td>
          <td colspan="2" class="di"><?php echo $orderdetailinfo[S_Major];?></td>
          </tr>
        <tr>
          <td>申请时间：</td>
          <td colspan="2" class="di"><?php echo $orderdetailinfo[Apply_Time];?></td>
        </tr>
        <tr>
          <td>预约时间：</td>
          <td colspan="2" class="di"><?php echo $orderdetailinfo[Order_Time];?></td>
        </tr>
        <tr>
          <td valign="top">状态：</td>
          <td colspan="2" valign="top" class="di">
          <?php if($orderdetailinfo[State] == "w")
					$state = "等待处理";
			else if($orderdetailinfo[State] == "p")
					$state = "时间已过";
			else if($orderdetailinfo[State] == "a")
					$state = "同意请求";
			else if($orderdetailinfo[State] == "d")
					$state = "拒绝请求";
			?>
			<?php echo $state; ?>
          </td>
        </tr>
        <tr>
          <td valign="top">预约请求：</td>
          <td colspan="2" valign="top" class="di"><?php echo $orderdetailinfo[Order_Info];?></td>
        </tr>
        <tr>
          <td valign="top">预约反馈：</td>
          <td colspan="2" valign="top" class="di"><?php echo $orderdetailinfo[Reply_Info];?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td><a class="SelectedLeftMenu" href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a></td>
          <td width="147"><?php if($orderdetailinfo[State]!="p"&&strtotime($orderdetailinfo[Order_Time]) > strtotime($nowtime)){?>
          <a class="SelectedLeftMenu" href="teareplyorder.php?faid=<?php echo $orderdetailfaid;?>&ifagree=agree">同意请求</a><?php }?>
          </td>
          <td width="168"><?php if($orderdetailinfo[State]!="p"&&strtotime($orderdetailinfo[Order_Time]) > strtotime($nowtime)){?>
          <a class="SelectedLeftMenu" href="teareplyorder.php?faid=<?php echo $orderdetailfaid;?>&ifagree=disagree">拒绝请求</a><?php }?>
          </td>
        </tr>
      </table></td>
      <td width="188" rowspan="2" valign="top"><?php include("right_menu_tea.php"); ?></td>
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