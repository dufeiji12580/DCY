<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$stuorderteaftid = trim($_GET[ftid]);
$sql = "select T_Name, T_Username from teacher where FT_ID = '".$stuorderteaftid."'";
$result = mysql_query($sql,$myconn); 
$stuorderteaname = mysql_fetch_array($result);
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
<title>预约教师</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<script language="javascript">
function chkuserinput(form){
	if(form.orderinfo.value==""){
		alert("必须输入预约信息!");
		form.orderinfo.select();
		return(false);
	}		
	return(true);				 
}
</script>
<div align="center">
  <table width="1040" border="0">
    <tr>
      <td colspan="3"><?php include("head.php") ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200" valign="top"><?php include("left_menu_back.php") ?></td>
      <td width="638" rowspan="2" valign="top" align="center"><table width="121" border="0">
        <tr>
          <td colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td width="48">教师：</td>
          <td width="63" class = "di"><?php echo $stuorderteaname[T_Name];?></td>
        </tr>
      </table>
        <form id="orderform" name="orderform" method="post" action="stusaveorder.php" onSubmit="return chkuserinput(this)">
          <table width="338" border="0">
            <tr>
              <td width="332" colspan="2">输入预约请求：</td>
            </tr>
            <tr>
              <td height="21" colspan="2">
                <label for="textarea"></label>
                <textarea name="orderinfo" id="textarea" cols="45" rows="10"></textarea>
              </td>
            </tr>
            <tr>
              <td height="21"><input type="submit" name="button" id="button" value="确认预约" /></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <input type="hidden" value="<?php echo $stuorderteaname[T_Username];?>" name="uername">
      </form></td>
      <td width="188" rowspan="2" valign="top"><?php include("right_menu_stu.php") ?></td>
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