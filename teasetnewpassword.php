<?php require_once('Connections/myconn.php'); ?>
<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php 
if($_POST[select] == "T_Username"){
	$sql=mysql_query("select * from teacher where T_Username='".trim($_POST[nameoremail])."'",$myconn);
	$info=mysql_fetch_array($sql);
	if($info == false){
		echo "<script>alert('该用户名不存在!');history.back();</script>";
        exit;
	}
}
else{
	$sql=mysql_query("select * from teacher where T_Email='".trim($_POST[nameoremail])."'",$myconn);
	$info=mysql_fetch_array($sql);
	if($info == false){
		echo "<script>alert('该邮箱不存在!');history.back();</script>";
        exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>忘记密码</title>
</head>

<script language="javascript">
function chkuserinput(form){
	if(form.T_Password.value==""){
		alert("请输入密码!");
		return(false);
	}		
	if(form.T_Password2.value==""){
		alert("请输入确认密码!");
		return(false);
	}	
	if(form.T_Password.value.length<6)
	 {
	 alert("密码长度应大于等于6位!");
	 form.T_Password.select();
	 return(false);
	 }
	if(form.T_Password.value.length>20)
	 {
	 alert("密码长度应小于等于20位!");
	 form.T_Password.select();
	 return(false);
	 }
	if(form.T_Password.value!=form.T_Password2.value)
	 {
	 alert("密码与重复密码不同!");
	 return(false);
	 }
	 if(form.T_Answer.value == "")
	 {
	 alert("请输入问题答案!");
	 form.T_Answer.select();
	 return(false);
	 }
	return(true);				 
}
</script>

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
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>

<div align="center">
  <table width="1040" border="0" >
    <tr>
      <td colspan="3"><?php include("head.php") ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200" valign="top"><?php include("left_menu.php") ?></td>
      <td width="626" rowspan="2"><form id="setnewform" name="setnewform" method="post" action="teachecknewpassword.php" onSubmit="return chkuserinput(this)">
      <div align="center">
  <table width="290" border="0">
      <tr>
        <td>重设密码：</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="124">&nbsp;</td>
        <td width="156">&nbsp;</td>
      </tr>
      <tr>
        <td>用户名:</td>
        <td> <?php echo $info[T_Username]; ?> </td>
      </tr>
      <tr>
        <td>邮箱:</td>
        <td> <?php echo $info[T_Email]; ?> </td>
      </tr>
      <tr>
        <td>新的密码：</td>
        <td><label for="textfield2"></label>
        <input name="T_Password" type="password" id="textfield2" size="20" /></td>
      </tr>
      <tr>
        <td>确认密码：</td>
        <td><input name="T_Password2" type="password" id="textfield3" size="20" /></td>
      </tr>
      <tr>
        <td>提示问题：</td>
        <td><?php echo $info[T_Question]; ?></td>
      </tr>
      <tr>
        <td>问题答案：</td>
        <td><label for="textfield3"></label>
        <input name="T_Answer" type="text" id="textfield3" size="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="button" id="button" value="确定" /></td>
        <td>
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="button2" id="button2" value="重置" />
        </td>
      </tr>
    </table></div>
    <input type="hidden" value="<?php echo $info[T_Username];?>" name="T_Username">
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
    <td  colspan="3" height="100" valign="bottom"><?php include("bottom.php")?></td>
    </tr>
  </table>
</div>

</html>
