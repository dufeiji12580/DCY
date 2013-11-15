<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$ifagree = $_GET[ifagree];
$orderdetailfaid = trim($_GET[faid]);
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
      <td width="638" rowspan="2" valign="top" align="center"><form id="form2" name="form2" method="post" action = "teasavereplyorder.php?r=Y&ifagree=<?php echo $ifagree; ?>&faid=<?php echo $orderdetailfaid;?>">
        <table width="321" border="0">
          <tr>
            <td colspan="3" align="center">预约反馈</td>
          </tr>
          <tr>
            <td width="164">&nbsp;</td>
            <td width="81" align="center">状态：</td>
            <td width="81" class = "di" align="center"><?php if($ifagree == "agree")
		  echo "同意请求";
		  else
		  echo "拒绝请求";
		  ?></td>
          </tr>
          <tr>
            <td>输入反馈：</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><label for="textarea"></label>
              <textarea name="reply" id="textarea" cols="45" rows="10"><?php if($ifagree == "agree")
		  echo "同意你的预约！";
		  else
		  echo "对不起，时间上有冲突！";
		  ?></textarea></td>
          </tr>
          <tr>
            <td align="center"><input type="submit" name="button" id="button" value="反馈" /></td>
            <td colspan="2" align="center"><a href="teasavereplyorder.php?r=N&ifagree=<?php echo $ifagree; ?>&faid=<?php echo $orderdetailfaid;?>"><input type="button" name="button2" id="button2" value="不反馈" /></a></td>
          </tr>
        </table>
      </form></td>
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
      <td  colspan="3"><?php include("bottom.php")?></td>
    </tr>
  </table>
</div>

</html>