<?php session_start();
if(!$_SESSION[S_Username] && !$_SESSION[T_Username]){
	 $left = "left_menu.php";
}
else{
	$left = "left_menu_back.php";
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
require_once ('calendar.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主页</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<div align="center">
  <table width="1040" border="0" >
    <tr>
      <td colspan="2"><?php include("head.php") ?>
  <tr>
    <td colspan="2"></td>
    <tr>
    <td colspan="2"></tr>
    <tr>
      <td width="200"><?php include($left) ?></td>
      <td width="830">&nbsp;</td>
    </tr>
    <tr>
      <td><table width="200" border="0">
        <tr>
          <td width="194"> <?php
                $cal = new Calendar($params);
                $cal->display();
            ?></td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
</html>