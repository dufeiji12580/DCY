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
<title>忘记密码</title>
</head>

<script language="javascript">
function chkuserinput(form){
	if(form.nameoremail.value=="" && form.select.value == "T_Username"){
		alert("请输入用户名!");
		return(false);
	}		
	if(form.nameoremail.value=="" && form.select.value == "T_Email"){
		alert("请输入邮箱!");
		return(false);
	}	
	return(true);				 
}
</script>

<style type="text/css">
body {
	background-color: #CCCCCC;
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
      <td width="200" valign="top"><?php include("left_menu.php"); ?></td>
      <td width="626" rowspan="2"><form id="lostform" name="lostform" method="get" action="teasetnewpassword.php" onSubmit="return chkuserinput(this)">
  <div align="center">
    <table width="307" border="0">
      <tr>
        <td width="129">忘记密码</td>
        <td width="168">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>信息字段选择：</td>
        <td><label for="select"></label>
          <select name="select" id="select">
            <option value="T_Username">用 户 名</option>
            <option value="T_Email">邮    箱</option>
        </select></td>
      </tr>
      <tr>
        <td>用户名或邮箱：</td>
        <td><input name="nameoremail" type="text" id="textfield" size="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="确认" /></td>
      </tr>
    </table>
  </div>
</form></td>
      <td width="200" rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><table width="200" border="0">
        <tr>
          <td width="194" valign="top"> <?php
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