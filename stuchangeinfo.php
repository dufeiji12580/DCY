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
<title>修改资料</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
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
      <td width="638" rowspan="2" valign="top" align="center"><form id="form2" name="form2" method="post" action="">
        <table width="458" border="0">
          <tr>
            <td colspan="3"><div align="center">请填写用户信息</div></td>
          </tr>
          <tr>
            <td width="95">密码：*</td>
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
              女 </label></td>
          </tr>
          <tr>
            <td>班级：*</td>
            <td colspan="2"><label for="textfield2"></label>
              <input name="S_Class" type="text" id="textfield2" maxlength="7" /></td>
          </tr>
          <tr>
            <td>学号：*</td>
            <td colspan="2"><label for="S_Number"></label>
              <input name="S_Number" type="text" id="S_Number" maxlength="10" /></td>
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
            <td><div align="center">
              其他：
              <input name="S_Question2" type="text" size="15" maxlength="50"  /></td>
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