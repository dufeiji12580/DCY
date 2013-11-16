<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$stumessagedetailfttid = trim($_GET[fttid]);
$sql = "select FT_ID,T_Name,T_Academy,Ttos_Topic,Ttos_Info,Ttos_Time from ttosmessage natural join teacher where FTT_ID = ".$stumessagedetailfttid;
$result = mysql_query($sql,$myconn); 
$stumessagedetailinfo = mysql_fetch_array($result);
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
      <td width="200" valign="top"><?php include("left_menu_back.php"); ?></td>
      <td width="638" rowspan="2" valign="top" align="center"><table width="433" border="0">
        <tr>
          <td colspan="3" align="center">留言详情：</td>
        </tr>
        <tr>
          <td colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="53">姓名：</td>
          <td colspan="2" class="di"><a href="teainfo.php?ftid=<?php echo $stumessagedetailinfo[FT_ID]; ?>"><?php echo $stumessagedetailinfo[T_Name];?></a>&nbsp;&nbsp;&nbsp;&nbsp;(点击查看信息)</td>
        </tr>
        <tr>
          <td>学院：</td>
          <td colspan="2" class="di"><?php echo $stumessagedetailinfo[T_Academy];?></td>
        </tr>
        <tr>
          <td>时间：</td>
          <td colspan="2" class="di"><?php echo $stumessagedetailinfo[Ttos_Time];?></td>
        </tr>
        <tr>
          <td valign="top">主题：</td>
          <td colspan="2" valign="top" class="di"><?php echo $stumessagedetailinfo[Ttos_Topic];?></td>
        </tr>
        <tr>
          <td valign="top">内容：</td>
          <td colspan="2" valign="top" class="di"><?php echo $stumessagedetailinfo[Ttos_Info];?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="166" align="center"><a href="stuleavemessage.php?ftid=<?php echo $stumessagedetailinfo[FT_ID];?>">回复留言</a></td>
          <td width="200" align="center"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a></td>
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