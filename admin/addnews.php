<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新闻</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
.di {
	background-color: #09F;
}
</style>
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
      <td align="center"><form id="form1" name="form1" method="post" action="saveaddnews.php" onSubmit="return chkuserinput(this)" >
        <table width="982" border="0">
          <tr>
            <td width="96" align="center">时间</td>
            <td width="96" align="center">标签</td>
            <td width="236" align="center">标签链接</td>
            <td width="238" align="center">新闻主题</td>
            <td width="294" align="center">新闻链接</td>
          </tr>
          <tr>
            <td align="center" ><input name="time[]" type="text" id="textfield13" size="15" /></td>
            <td align="center"><input name="label[]" type="text" id="textfield" size="8" /></td>
            <td align="center">
              <input name="labelurl[]" type="text" id="textfield2" size="30" /></td>
            <td align="center"><input name="news[]" type="text" id="textfield3" size="30" /></td>
            <td align="center"><input name="newsurl[]" type="text" id="textfield4" size="40" /></td>
          </tr>
          <tr>
            <td align="center"><input name="time[]" type="text" id="textfield14" size="15" /></td>
            <td align="center">
              <input name="label[]" type="text" id="textfield2" size="8" /></td>
            <td align="center">
              <input name="labelurl[]" type="text" id="textfield3" size="30" /></td>
            <td align="center"><input name="news[]" type="text" id="textfield5" size="30" /></td>
            <td align="center"><input name="newsurl[]" type="text" id="textfield6" size="40" /></td>
          </tr>
          <tr>
            <td align="center"><input name="time[]" type="text" id="textfield15" size="15" /></td>
            <td align="center">
              <input name="label[]" type="text" id="textfield4" size="8" /></td>
            <td align="center"><input name="labelurl[]" type="text" id="textfield5" size="30" /></td>
            <td align="center"><input name="news[]" type="text" id="textfield7" size="30" /></td>
            <td align="center"><input name="newsurl[]" type="text" id="textfield8" size="40" /></td>
          </tr>
          <tr>
            <td align="center"><input name="time[]" type="text" id="textfield16" size="15" /></td>
            <td align="center">
              <input name="label[]" type="text" id="textfield6" size="8" /></td>
            <td align="center">
              <input name="labelurl[]" type="text" id="textfield7" size="30" /></td>
            <td align="center"><input name="news[]" type="text" id="textfield9" size="30" /></td>
            <td align="center"><input name="newsurl[]" type="text" id="textfield10" size="40" /></td>
          </tr>
          <tr>
            <td align="center"><input name="time[]" type="text" id="textfield17" size="15" /></td>
            <td align="center">
              <input name="label[]" type="text" id="textfield8" size="8" /></td>
            <td align="center">
              <input name="labelurl[]" type="text" id="textfield9" size="30" /></td>
            <td align="center"><input name="news[]" type="text" id="textfield11" size="30" /></td>
            <td align="center"><input name="newsurl[]" type="text" id="textfield12" size="40" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center"><input type="submit" name="button" id="button" value="确认加入" /></td>
            <td align="center"><input type="reset" name="button2" id="button2" value="重置" /></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>
</html>