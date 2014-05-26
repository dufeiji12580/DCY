<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<?php 
include("../Connections/myconn.php");
$ftid = $_GET[ftid];
$teachangeinfosql=mysql_query("select * from teacher where FT_ID = ".$ftid,$myconn);
$teachangeinfo=mysql_fetch_array($teachangeinfosql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理教师信息</title>
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
	if(form.T_Name.value=="")
	 {
	 alert("请输入姓名!");
	 form.T_Name.select();
	 return(false);
	 }
    if(form.T_Email.value=="")
	 {
	 alert("请输入电子邮箱地址!");
	 form.T_Email.select();
	 return(false);
	 }
	if(form.T_Email.value.indexOf('@')<0)
	 {
	 alert("请输入正确的电子邮箱地址!");
	 form.T_Email.select();
	 return(false);
	 }
    if(form.T_Phone.value=="")
	 {
	 alert("请输入联系电话!");
	 form.T_Phone.select();
	 return(false);
	 }
    if(form.T_Academy.value=="")
	 {
	 alert("请输入学院信息!");
	 form.T_Academy.select();
	 return(false);
	 }
    if(form.T_Major.value=="")
	{
	 alert("请输入专业信息!");
	 form.T_Major.select();
	 return(false);
	} 
	if(form.T_Info.value=="")
	{
	 alert("请输入基本信息!");
	 form.T_Info.select();
	 return(false);
	} 
	if(form.T_Research.value=="")
	{
	 alert("请输入研究方向!");
	 form.T_Research.select();
	 return(false);
	} 
	if(form.T_Achievement.value=="")
	{
	 alert("请输入研究成果!");
	 form.T_Achievement.select();
	 return(false);
	} 
	if(form.T_Question.value=="1" && form.T_Question2.value=="")
	{
	 alert("请选择密码提示!");
	 return(false);
	}
	if(form.T_Answer.value=="")
	{
	 alert("请输入问题答案!");
	 form.T_Answer.select();
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
          <td width="100" height="31" class="di"><a href="tealist.php">管理教师信息</a></td>
          <td width="100" class="di"><a href="stulist.php">管理学生信息</a></td>
          <td width="100" class="di"><a href="addnews.php">加入新闻信息</a></td>
          <td width="100" class="di"><a href="setshow.php">设置主页显示</a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><form id="form2" name="form2" method="post" action="saveteainfo.php" onsubmit="return chkinput(this)">
      <table width="458" border="0">
        <tr>
          <td colspan="3"><div align="center">管理教师信息</div></td>
        </tr>
        <tr>
          <td width="95">姓名：*</td>
          <td colspan="2"><label for="T_Name"></label>
            <input type="text" name="T_Name" id="T_Name" value="<?php echo $teachangeinfo[T_Name];?>" /></td>
        </tr>
        <tr>
          <td>性别：*</td>
          <td colspan="2"><label>
            <input name="T_Sex" type="radio" value="男" <?php if($teachangeinfo[T_Sex]=="男") echo "checked=\"checked\"";?> />
            男
            <input type="radio" name="T_Sex" value="女" <?php if($teachangeinfo[T_Sex]=="女") echo "checked=\"checked\"";?> />
            女 </label></td>
        </tr>
        <tr>
          <td>邮箱：*</td>
          <td colspan="2"><label for="T_Email"></label>
            <input type="text" name="T_Email" id="T_Email" value="<?php echo $teachangeinfo[T_Email];?>" /></td>
        </tr>
        <tr>
          <td>电话：*</td>
          <td colspan="2"><label for="T_Phone"></label>
            <input type="text" name="T_Phone" id="T_Phone" value="<?php echo $teachangeinfo[T_Phone];?>" /></td>
        </tr>
        <tr>
          <td>学院：*</td>
          <td colspan="2"><label for="T_Academy"></label>
            <input type="text" name="T_Academy" id="T_Academy" value="<?php echo $teachangeinfo[T_Academy];?>" /></td>
        </tr>
        <tr>
          <td>专业：*</td>
          <td colspan="2"><label for="T_Major"></label>
            <input type="text" name="T_Major" id="T_Major" value="<?php echo $teachangeinfo[T_Major];?>" /></td>
        </tr>
        <tr>
          <td>简介：*</td>
          <td colspan="2"><label for="textarea"></label>
            <textarea name="T_Info" id="textarea" cols="46" rows="5" ><?php echo $teachangeinfo[T_Basic_Info];?></textarea></td>
        </tr>
        <tr>
          <td>研究方向：*</td>
          <td colspan="2"><textarea name="T_Research" id="textarea3" cols="46" rows="2"><?php echo $teachangeinfo[T_Research_Derection];?></textarea></td>
        </tr>
        <tr>
          <td>研究成果：*</td>
          <td colspan="2"><textarea name="T_Achievement" id="textarea2" cols="46" rows="3"><?php echo $teachangeinfo[T_Research_Achievement];?></textarea></td>
        </tr>
        <tr>
          <td>密码提示：*</td>
          <td><label for="T_Question"></label>
            <select name="T_Question" id="T_Question">
              <option value="1" <?php if($teachangeinfo[T_Question] != "您的生日？" && $teachangeinfo[T_Question] != "您的爱好？" && $teachangeinfo[T_Question] != "您喜欢的动物？"  && $teachangeinfo[T_Question] != "您喜欢的食物？" ) echo "selected";?> >请选择问题</option>
              <option value="您的生日？" <?php if($teachangeinfo[T_Question] == "您的生日？") echo "selected";?> >您的生日？</option>
              <option value="您的爱好？" <?php if($teachangeinfo[T_Question] == "您的爱好？") echo "selected";?> >您的爱好？</option>
              <option value="您喜欢的动物？"<?php if($teachangeinfo[T_Question] == "您喜欢的动物？") echo "selected";?> >您喜欢的动物？</option>
              <option value="您喜欢的食物？" <?php if($teachangeinfo[T_Question] == "您喜欢的食物？") echo "selected";?> >您喜欢的食物？</option>
            </select></td>
          <td><div align="center">
            其他：
            <input name="T_Question2" type="text" size="15" maxlength="50"  <?php if($teachangeinfo[T_Question] != "您的生日？" && $teachangeinfo[T_Question] != "您的爱好？" && $teachangeinfo[T_Question] != "您喜欢的动物？"  && $teachangeinfo[T_Question] != "您喜欢的食物？" ) echo "value = ".$teachangeinfo[T_Question];?> /></td>
        </tr>
        <tr>
          <td>提示答案：*</td>
          <td><label for="T_Answer"></label>
            <input name="T_Answer" type="text" id="T_Answer" size="20" maxlength="50" value="<?php echo $teachangeinfo[T_Answer];?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="151"><input type="submit" name="button" id="button" value="确认" /></td>
          <td width="198">&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="ftid" value="<?php echo $ftid;?>" />
      </form></td>
    </tr>
  </table>
</div>
</html>