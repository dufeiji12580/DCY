<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$father = $_SERVER['HTTP_REFERER'];
$fsid = $_GET[fsid];
$sql = "select * from student where FS_ID = ".$fsid;
$result = mysql_query($sql,$myconn);
$stuinfo = mysql_fetch_array($result);
if($stuinfo[S_Sex] == "女")
	$ta = "她";
else
	$ta = "他";
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
<title>学生信息</title>
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
      <td width="638" rowspan="2" valign="top" align="center"><table width="370" border="0">
        <tr>
          <td colspan="3" align="center">学生信息：</td>
          </tr>
        <tr>
          <td width="63">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>姓名：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Name]; ?></td>
        </tr>
        <tr>
          <td>学院：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Academy]; ?></td>
        </tr>
        <tr>
          <td>专业：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Major]; ?></td>
        </tr>
        <tr>
          <td>班级：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Class]; ?></td>
        </tr>
        <tr>
          <td>学号：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Number]; ?></td>
        </tr>
        <tr>
          <td>邮箱：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Email]; ?></td>
        </tr>
        <tr>
          <td>电话：</td>
          <td colspan="2" class="di"><?php echo $stuinfo[S_Phone]; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><a href="tealeavemessage.php?fsid=<?php echo $fsid;?>">给<?php echo $ta;?>留言</a></td>
          <td width="185" align="center"><a href="<?php echo $father;?>">返回</a></td>
        </tr>
      </table></td>
      <td width="188" rowspan="2" valign="top"><?php include("right_menu_tea.php"); ?></td>
    </tr>
        <tr>
          <td width="194"><table width="200" border="0">
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