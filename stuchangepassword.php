<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
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
require_once 'calendar.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<script language="javascript">
function chkuserinput(form){
	if(form.old_password.value==""){
		alert("请输入原密码!");
		return(false);
	}	
	if(form.S_Password.value==""){
		alert("请输入新密码!");
		return(false);
	}		
	if(form.S_Password2.value==""){
		alert("请输入确认密码!");
		return(false);
	}	
	if(form.S_Password.value.length<6)
	 {
	 alert("密码长度应大于等于6位!");
	 form.S_Password.select();
	 return(false);
	 }
	if(form.S_Password.value.length>20)
	 {
	 alert("密码长度应小于等于20位!");
	 form.S_Password.select();
	 return(false);
	 }
	if(form.S_Password.value!=form.S_Password2.value)
	 {
	 alert("密码与重复密码不同!");
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
      <td width="638" rowspan="2" valign="top" align="center"><form id="form2" name="form2" method="post" action="stusavechangepassword.php" onSubmit="return chkuserinput(this)">
        <table width="290" border="0">
          <tr>
            <td colspan="2"><div align="center">修改密码： </div></td>
          </tr>
          <tr>
            <td width="124">&nbsp;</td>
            <td width="156">&nbsp;</td>
          </tr>
          <tr>
            <td>旧密码：</td>
            <td><input name="old_password" type="password" id="textfield4" size="20" maxlength="20" /></td>
          </tr>
          <tr>
            <td>新的密码：</td>
            <td><label for="textfield2"></label>
              <input name="S_Password" type="password" id="textfield2" size="20" maxlength="20" /></td>
          </tr>
          <tr>
            <td>确认密码：</td>
            <td><input name="S_Password2" type="password" id="textfield3" size="20" maxlength="20" /></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" name="button" id="button" value="确定" /></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="reset" name="button2" id="button2" value="重置" /></td>
          </tr>
        </table>
      </form></td>
      <td width="188" rowspan="2" valign="top"><?php include("right_menu_stu.php"); ?></td>
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