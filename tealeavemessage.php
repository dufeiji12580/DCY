<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$tealeavemessafefsid = $_GET[fsid];
$sql = "select S_Username,S_Name from student where FS_ID = ".$tealeavemessafefsid;
$result = mysql_query($sql,$myconn); 
$tealeavemessageinfo = mysql_fetch_array($result);
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$message = nl2br($_POST[leavemessage]);
		$nowtime = date('Y-m-j H:i:s',time());
		$topic = trim($_POST[topic]);
		$sql = "insert into ttosmessage(S_Username,T_Username,Ttos_Topic,Ttos_Info,Ttos_Time) values ('".$tealeavemessageinfo[S_Username]."','".$_SESSION[T_Username]."','".$topic."','".$message."','".$nowtime."')";
		mysql_query($sql,$myconn);
		echo "<script>alert('留言成功!');window.location='teaindex.php';</script>";
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
require_once 'calendar.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言</title>
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
<script language="javascript">
function chkuserinput(form){
	if(form.topic.value==""){
		alert("请输入主题");
		form.topic.select();
		return(false);
	}	
	if(form.leavemessage.value==""){
		alert("请输入留言!");
		form.leavemessage.select();
		return(false);
	}	
	return(true);			 
}
</script>
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
      <td width="638" rowspan="2" valign="top" align="center"><table width="121" border="0">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="48">姓名：</td>
          <td width="63" class = "di"><?php echo $tealeavemessageinfo[S_Name];?></td>
        </tr>
      </table>
        <form id="form2" name="form2" method="post" action="" onSubmit="return chkuserinput(this)">
          <table width="338" border="0">
            <tr>
              <td colspan="2">输入主题：</td>
            </tr>
            <tr>
              <td colspan="2"><p>
                <label for="textfield2"></label>
                <input name="topic" type="text" id="textfield2" size="50" maxlength="50" />
              </p></td>
            </tr>
            <tr>
              <td colspan="2">输入留言：</td>
            </tr>
            <tr>
              <td height="21" colspan="2"><label for="textarea"></label>
                <textarea name="leavemessage" id="textarea" cols="45" rows="10"></textarea></td>
            </tr>
            <tr>
              <td width="173" height="21"><input type="submit" name="button" id="button" value="确认" /></td>
              <td width="173"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>">返回</a></td>
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
      <td  colspan="3"><?php include("bottom.php");?></td>
    </tr>
  </table>
</div>

</html>