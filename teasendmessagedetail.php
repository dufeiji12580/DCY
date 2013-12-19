<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$teamessagedetailfttid = trim($_GET[fttid]);
$sql = "select FS_ID,S_Name,S_Major,Ttos_Topic,Ttos_Info,Ttos_Time from ttosmessage natural join student where FTT_ID = ".$teamessagedetailfttid;
$result = mysql_query($sql,$myconn); 
$teamessagedetailinfo = mysql_fetch_array($result);
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
      <td width="638" rowspan="2" valign="top" align="center"><table width="433" border="0">
        <tr>
          <td colspan="3" align="center">已发送留言详情：</td>
          </tr>
        <tr>
          <td colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="53">学生：</td>
          <td colspan="2" class="di"><a href="stuinfo.php?fsid=<?php echo $teamessagedetailinfo[FS_ID]; ?>"><?php echo $teamessagedetailinfo[S_Name];?></a>&nbsp;&nbsp;&nbsp;&nbsp;(点击查看信息)</td>
          </tr>
        <tr>
          <td>专业：</td>
          <td colspan="2" class="di"><?php echo $teamessagedetailinfo[S_Major];?></td>
          </tr>
        <tr>
          <td>时间：</td>
          <td colspan="2" class="di"><?php echo $teamessagedetailinfo[Ttos_Time];?></td>
        </tr>
        <tr>
          <td valign="top">主题：</td>
          <td colspan="2" valign="top" class="di"><?php echo $teamessagedetailinfo[Ttos_Topic];?></td>
        </tr>
        <tr>
          <td valign="top">内容：</td>
          <td colspan="2" valign="top" class="di"><?php echo $teamessagedetailinfo[Ttos_Info];?></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="166" align="center"><a href="tealeavemessage.php?fsid=<?php echo $teamessagedetailinfo[FS_ID];?>">再次留言</a></td>
          <td width="200" align="center"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a></td>
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