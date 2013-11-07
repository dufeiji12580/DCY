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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript">
  function chknc(table,name)
  {
    window.open("checkuserable.php?name="+name+"&table="+table,"newframe","width=200,height=10,left=500,top=200,menubar=no,toolbar=no,location=no,scrollbars=no,location=no");
  }
</script>
<script language="javascript">
  function chkinput(form)
  {
    if(form.S_Username.value=="")
	{
	 alert("请输入用户名!");
	 form.S_Username.select();
	 return(false);
	}
	if(form.S_Password.value=="")
	{
	 alert("请输入密码!");
	 form.S_Password.select();
	 return(false);
	}
    if(form.S_Password1.value=="")
	{
	 alert("请输入确认密码!");
	 form.S_Password1.select();
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
	if(form.S_Password.value!=form.S_Password1.value)
	 {
	 alert("密码与重复密码不同!");
	 return(false);
	 }
	if(form.S_Name.value=="")
	 {
	 alert("请输入姓名!");
	 form.S_Name.select();
	 return(false);
	 }
	 
	 if(form.S_Number.value=="")
	 {
	 alert("请输入学号!");
	 form.S_Number.select();
	 return(false);
	 }
    if(form.S_Email.value=="")
	 {
	 alert("请输入电子邮箱地址!");
	 form.S_Email.select();
	 return(false);
	 }
	if(form.S_Email.value.indexOf('@')<0)
	 {
	 alert("请输入正确的电子邮箱地址!");
	 form.S_Email.select();
	 return(false);
	 }
    if(form.S_Phone.value=="")
	 {
	 alert("请输入联系电话!");
	 form.S_Phone.select();
	 return(false);
	 }
    if(form.S_Academy.value=="")
	 {
	 alert("请输入学院信息!");
	 form.S_Academy.select();
	 return(false);
	 }
    if(form.S_Major.value=="")
	{
	 alert("请输入专业信息!");
	 form.S_Major.select();
	 return(false);
	} 
	if(form.S_Question.value=="1" && form.S_Question2.value=="")
	{
	 alert("请选择密码提示!");
	 return(false);
	}
	if(form.S_Answer.value=="")
	{
	 alert("请输入问题答案!");
	 form.S_Answer.select();
	 return(false);
	}
    return(true);
  }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>学生注册</title>
</head>

<div align="center">
  <table width="1040" border="0" >
    <tr>
      <td colspan="3"><?php include("head.php") ?>
  <tr>
    <td colspan="3"></td>
    <tr>
    <td colspan="3"></tr>
    <tr>
      <td width="200"><?php include("left_menu.php") ?></td>
      <td width="626" rowspan="2"><form id="form1" name="form1" method="POST" action="stusavereg.php" onSubmit="return chkinput(this)">
  <div align="center">
    <table width="458" border="0">
      <tr>
        <td colspan="3"><div align="center">请填写用户信息</div></td>
      </tr>
      <tr>
        <td width="95">用户名：*</td>
        <td colspan="2"><p>
          <label for="S_Username"></label>
          <input type="text" name="S_Username"  id="S_Username" />
          <input type="button" name="button3" id="button3" onClick="chknc('student',form1.S_Username.value)" value="检查是否可用" />
        </p></td>
      </tr>
      <tr>
        <td>密码：*</td>
        <td colspan="2"><label for="S_Password"></label>
          <input type="password" name="S_Password" id="S_Password" />
        密码6到20位</td>
      </tr>
      <tr>
        <td>确认密码：*</td>
        <td colspan="2"><label for="S_Password1"></label>
          <input type="password" name="S_Password1" id="S_Password1" />
        再次输入密码！</td>
      </tr>
      <tr>
        <td>姓名：*</td>
        <td colspan="2"><label for="S_Name"></label>
        <input type="text" name="S_Name" id="S_Name" /></td>
      </tr>
      <tr>
        <td>性别：*</td>
        <td colspan="2"><label>
          <input name="S_Sex" type="radio" value="男" checked="checked" />
          男
          <input type="radio" name="S_Sex" value="女" />
          女 
          
        </label></td>
      </tr>
      <tr>
        <td>学号：*</td>
        <td colspan="2"><label for="S_Number"></label>
        <input type="text" name="S_Number" id="S_Number" /></td>
      </tr>
      <tr>
        <td>邮箱：*</td>
        <td colspan="2"><label for="S_Email"></label>
        <input type="text" name="S_Email" id="S_Email" /></td>
      </tr>
      <tr>
        <td>电话：*</td>
        <td colspan="2"><label for="S_Phone"></label>
        <input type="text" name="S_Phone" id="S_Phone" /></td>
      </tr>
      <tr>
        <td>学院：*</td>
        <td colspan="2"><label for="S_Academy"></label>
        <input type="text" name="S_Academy" id="S_Academy" /></td>
      </tr>
      <tr>
        <td>专业：*</td>
        <td colspan="2"><label for="S_Major"></label>
        <input type="text" name="S_Major" id="S_Major" /></td>
      </tr>
      <tr>
        <td>密码提示：*</td>
        <td><label for="S_Question"></label>
          <select name="S_Question" id="S_Question">
            <option value="1">请选择问题</option>
            <option value="您的生日？">您的生日？</option>
            <option value="您的爱好？">您的爱好？</option>
            <option value="您喜欢的动物？">您喜欢的动物？</option>
            <option value="您喜欢的食物？">您喜欢的食物？</option>
            <option value="您父亲的姓名？">您父亲的姓名？</option>
            <option value="您母亲的姓名？">您母亲的姓名？</option>
        </select></td>
        <td> <div align="center">其他：
          <input name="S_Question2" type="text" size="15" maxlength="50"  />
  </td>
      </tr>
      <tr>
        <td>提示答案：*</td>
        <td><label for="S_Answer"></label>
        <input name="S_Answer" type="text" id="S_Answer" size="20" maxlength="50" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="151"><input type="submit" name="button" id="button" value="注册" /></td>
        <td width="198"><input type="reset" name="button2" id="button2" value="重置" /></td>
      </tr>
    </table>
  </div>
</form></td>
      <td width="200" rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><table width="200" border="0">
        <tr>
          <td width="194"> <?php
                $cal = new Calendar($params);
                $cal->display();
            ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
</html>