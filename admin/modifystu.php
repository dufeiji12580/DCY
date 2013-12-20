<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<?php 
include("../Connections/myconn.php");
$fsid = $_GET[fsid];
$stuchangeinfosql=mysql_query("select * from student where FS_ID='".$fsid."'",$myconn);
$stuchangeinfo=mysql_fetch_array($stuchangeinfosql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../style/link.css">
<title>修改学生信息</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
.di {
	background-color: #09F;
}
</style>
<script language="javascript">
  function chkinput(form)
  {
	if(form.S_Name.value=="")
	 {
	 alert("请输入姓名!");
	 form.S_Name.select();
	 return(false);
	 }
	 if(form.S_Class.value=="")
	 {
	 alert("请输入班级!");
	 form.S_Class.select();
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
<div align="center">

  <table width="1040" border="0">
    <tr>
      <td><?php include("adminhead.php"); ?></td>
    </tr>
    <tr>
      <td height="32" align="center"><table width="418" border="0">
        <tr>
          <td width="100" height="31" class="di"><a class="SelectedLeftMenu" href="tealist.php">管理教师信息</a></td>
          <td width="100" class="di"><a class="SelectedLeftMenu" href="stulist.php">管理学生信息</a></td>
          <td width="100" class="di"><a class="SelectedLeftMenu" href="addnews.php">加入新闻信息</a></td>
          <td width="100" class="di"><a class="SelectedLeftMenu" href="setshow.php">设置主页显示</a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><form id="form2" name="form2" method="post" action="savestuinfo.php" onsubmit="return chkinput(this)" >
      <table width="458" border="0">
        <tr>
          <td colspan="3"><div align="center">管理学生信息</div></td>
        </tr>
        <tr>
          <td width="95">姓名：*</td>
          <td colspan="2"><label for="S_Name"></label>
            <input type="text" name="S_Name" id="S_Name" value="<?php echo $stuchangeinfo[S_Name];?>" /></td>
        </tr>
        <tr>
          <td>性别：*</td>
          <td colspan="2"><label>
            <input name="S_Sex" type="radio" value="男" <?php if($stuchangeinfo[S_Sex]=="男") echo "checked=\"checked\"";?> />
            男
            <input type="radio" name="S_Sex" value="女" <?php if($stuchangeinfo[S_Sex]=="女") echo "checked=\"checked\"";?> />
            女 </label></td>
        </tr>
        <tr>
          <td>班级：*</td>
          <td colspan="2"><label for="textfield2"></label>
            <input name="S_Class" type="text" id="textfield2" value="<?php echo $stuchangeinfo[S_Class];?>" maxlength="7" /></td>
        </tr>
        <tr>
          <td>学号：*</td>
          <td colspan="2"><label for="S_Number"></label>
            <input name="S_Number" type="text" id="S_Number" value="<?php echo $stuchangeinfo[S_Number];?>" maxlength="10" /></td>
        </tr>
        <tr>
          <td>邮箱：*</td>
          <td colspan="2"><label for="S_Email"></label>
            <input type="text" name="S_Email" id="S_Email" value="<?php echo $stuchangeinfo[S_Email];?>" /></td>
        </tr>
        <tr>
          <td>电话：*</td>
          <td colspan="2"><label for="S_Phone"></label>
            <input type="text" name="S_Phone" id="S_Phone" value="<?php echo $stuchangeinfo[S_Phone];?>" /></td>
        </tr>
        <tr>
          <td>学院：*</td>
          <td colspan="2"><label for="S_Academy"></label>
            <input type="text" name="S_Academy" id="S_Academy" value="<?php echo $stuchangeinfo[S_Academy];?>" /></td>
        </tr>
        <tr>
          <td>专业：*</td>
          <td colspan="2"><label for="S_Major"></label>
            <input type="text" name="S_Major" id="S_Major" value="<?php echo $stuchangeinfo[S_Major];?>" /></td>
        </tr>
        <tr>
          <td>密码提示：*</td>
          <td><label for="S_Question"></label>
            <select name="S_Question" id="S_Question">
              <option value="1" <?php if($stuchangeinfo[S_Question] != "您的生日？" && $stuchangeinfo[S_Question] != "您的爱好？" && $stuchangeinfo[S_Question] != "您喜欢的动物？"  && $stuchangeinfo[S_Question] != "您喜欢的食物？"  && $stuchangeinfo[S_Question] != "您父亲的姓名？"  && $stuchangeinfo[S_Question] != "您母亲的姓名？" ) echo "selected";?>>请选择问题</option>
              <option value="您的生日？" <?php if($stuchangeinfo[S_Question] == "您的生日？")echo "selected";?> >您的生日？</option>
              <option value="您的爱好？" <?php if($stuchangeinfo[S_Question] == "您的爱好？")echo "selected";?>>您的爱好？</option>
              <option value="您喜欢的动物？" <?php if($stuchangeinfo[S_Question] == "您喜欢的动物？")echo "selected";?>>您喜欢的动物？</option>
              <option value="您喜欢的食物？" <?php if($stuchangeinfo[S_Question] == "您喜欢的食物？")echo "selected";?>>您喜欢的食物？</option>
              <option value="您父亲的姓名？" <?php if($stuchangeinfo[S_Question] == "您父亲的姓名？")echo "selected";?>>您父亲的姓名？</option>
              <option value="您母亲的姓名？" <?php if($stuchangeinfo[S_Question] == "您母亲的姓名？")echo "selected";?>>您母亲的姓名？</option>
            </select></td>
          <td><div align="center">
            其他：
            <input name="S_Question2" type="text" size="15" maxlength="50" <?php if($stuchangeinfo[S_Question] != "您的生日？" && $stuchangeinfo[S_Question] != "您的爱好？" && $stuchangeinfo[S_Question] != "您喜欢的动物？"  && $stuchangeinfo[S_Question] != "您喜欢的食物？"  && $stuchangeinfo[S_Question] != "您父亲的姓名？"  && $stuchangeinfo[S_Question] != "您母亲的姓名？" ) echo "value = ".$stuchangeinfo[S_Question];?> /></td>
        </tr>
        <tr>
          <td>提示答案：*</td>
          <td><label for="S_Answer"></label>
            <input name="S_Answer" type="text" id="S_Answer" size="20" maxlength="50" value="<?php echo $stuchangeinfo[S_Answer];?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="151"><input type="submit" name="button" id="button" value="确认" /></td>
          <td width="198">&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="fsid" value="<?php echo $fsid;?>" />
      </form></td>
    </tr>
  </table>
</div>
</html>