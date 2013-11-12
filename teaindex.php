<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
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
require_once 'calendar.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教师主页</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<div align="center">
  <table width="1040" border="0">
    <tr>
      <td colspan="3"><?php include("head.php") ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200" rowspan="2" valign="top"><?php include("left_menu_back.php") ?></td>
      <td width="638">你好</td>
      <td width="188" rowspan="3" valign="top"><?php include("right_menu_stu.php") ?></td>
    </tr>
    <tr>
      <td rowspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td rowspan="2" valign="top"><table width="200" border="0">
        <tr>
          <td width="194"><?php
                $cal = new Calendar($params);
                $cal->display();
            ?></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td width="188"></td>
    </tr>
    <tr>
      <td  colspan="3" height="100" valign="bottom"><?php include("bottom.php")?></td>
    </tr>
  </table>
</div>

</html>