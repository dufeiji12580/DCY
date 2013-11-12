<?php require_once('Connections/myconn.php'); ?>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教师登录</title>
</head>

<script language="javascript">
function chkuserinput(form){
	if(form.T_Username.value==""){
		alert("请输入用户名!");
		form.T_Username.select();
		return(false);
	}		
	if(form.T_Password.value==""){
		alert("请输入用户密码!");
		form.T_Password.select();
		return(false);
	}	
	if(form.verify.value==""){
		alert("请输入验证码!");
		form.verify.select();
		return(false);
	}	
	return(true);				 
}
</script>

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
      <td width="626" rowspan="2"><form id="loginform" name="loginform" method="post" action="teacheckuser.php" onSubmit="return chkuserinput(this)">
  <div align="center">
    <table width="244" border="0">
      <tr>
        <td colspan="5">教师登录</td>
      </tr>
      <tr>
        <td width="71">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td>用户名：</td>
        <td colspan="4"><label for="S_Username"></label>
          <label for="T_Username"></label>
          <input name="T_Username" type="text" id="T_Username" size="20" maxlength="20" /></td>
      </tr>
      <tr>
        <td>密码：</td>
        <td colspan="4"><label for="T_Password"></label>
          <input name="T_Password" type="password" id="T_Password" size="20" maxlength="20" /></td>
      </tr>
      <tr>
        <td>验证码：</td>
        <td colspan="3"><label for="verify"></label>
          <label for="verify"></label>
          <input name="verify" type="text" id="verify" size="6" />
          <?php
									   $num=intval(mt_rand(1000,9999));
									   for($i=0;$i<4;$i++){
										echo "<img src=images/code/".substr(strval($num),$i,1).".gif>";
									   }
									?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <input type="hidden" value="<?php echo $num;?>" name="num" />
        <td><input type="submit" name="button1" id="button1" value="登录" /></td>
        <td><input type="reset" name="button2" id="button2" value="重置" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="45"><a href="tearegister.php">注册</a></td>
        <td width="72"><a href="tealostpassword.php">忘记密码</a></td>
        <td width="6">&nbsp;</td>
        <td width="28">&nbsp;</td>
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
    <td  colspan="3" height="100" valign="bottom"><?php include("bottom.php")?></td>
    </tr>
  </table>
</div>
</html>