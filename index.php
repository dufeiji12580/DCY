<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username] && !$_SESSION[T_Username]){
	 $left = "left_menu.php";
}
else{
	$left = "left_menu_back.php";
}
?>
<?php
include("Connections/myconn.php");
$newsresult = mysql_query("select * from news order by N_Show desc ,N_time desc limit 0,10",$myconn);
$newsinfo = mysql_fetch_assoc($newsresult);
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
<link type="text/css" rel="stylesheet" href="style/link.css">
<title>主页</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
.di {
	background-color: #09F;
}
</style>
<style type="text/css">
#table1{border-collapse:collapse;}
#table1 td{
	border: 2px solid #09f;
	padding-left: 5px
}
</style>
<div align="center">
  <table width="1040" border="0" >
    <tr>
      <td colspan="2"><?php include("head.php"); ?>
  <tr>
    <td colspan="2"></td>
    <tr>
    <td colspan="2"></tr>
    <tr>
      <td width="200" valign="top"><?php include($left); ?></td>
      <td width="830" rowspan="2" valign="top" align="center"><p>&nbsp;</p>
        <table width="701" border="1" id = "table1">
        <tr>
          <td colspan="2" align="center">最新快讯</td>
          </tr>
          <?php do { ?>
        <tr>
          <td width="120" align="center" height="30">[<a class="SelectedLeftMenu" href="<?php echo $newsinfo[N_Label_Url];?>" target="_blank"><?php echo $newsinfo[N_Label]; ?></a>]</td>
          <td width="565" ><a class="SelectedLeftMenu" href="<?php echo $newsinfo[N_News_Url];?>" target="_blank"><?php echo $newsinfo[N_News]; ?></a></td>
        </tr>
        <?php } while ($newsinfo = mysql_fetch_assoc($newsresult)); ?>
      </table></td>
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
      <td  colspan="2"><?php include("bottom.php");?></td>
    </tr>
  </table>
</div>
</html>