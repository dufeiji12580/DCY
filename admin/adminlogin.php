<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php include("../Connections/myconn.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$A_Username = $_POST[A_Username];
	$A_Password = $_POST[A_Password];
	$sql = "select * from admin where A_Username = '".$A_Username."'";
	$result =mysql_query($sql,$myconn);
    $row_sql = mysql_fetch_array($result);
    if(!$row_sql){
          echo "<script language='javascript'>alert('用户名不存在！');</script>";
          exit;
       }
      else{
          if($row_sql[A_Password] == md5($A_Password)){
  			   session_start();
	           $_SESSION[A_Username]=$row_sql[A_Username];
               header("location:adminindex.php");
               exit;
            }
          else {
             echo "<script language='javascript'>alert('密码错误！');history.back();</script>";
             exit;
           }
      }    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
<style type="text/css">
@import url("../webfonts/华文楷体/stylesheet.css");

body {
	background-color: #CCCCCC;
}

.log {
	font-family: "华文楷体";
	font-size: 30px;
	font-weight: bold;	
}
.log2 {
	font-family: "华文楷体";
	font-size: 20px;	
}
</style>
<script language="javascript">
function chkuserinput(form){
	if(form.A_Username.value==""){
		alert("请输入管理员账号!");
		form.A_Username.select();
		return(false);
	}		
	if(form.A_Password.value==""){
		alert("请输入管理员密码!");
		form.A_Password.select();
		return(false);
	}	
	return(true);				 
}
</script>
</head>
<div align="center">

  <table width="1040" border="0">
    <tr>
      <td><?php include("adminhead.php"); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><form id="form1" name="form1" method="post" action="" onSubmit="return chkuserinput(this)">
        <table width="375" border="0" background = "..\images\top.jpg">
          <tr>
            <td colspan="3" align="center" class = "log">管理员登录</td>
            </tr>
          <tr>
            <td width="127" height="30" class = "log2">管理员账号：</td>
            <td colspan="2"><label for="textfield"></label>
              <input type="text" name="A_Username" id="textfield" /></td>
          </tr>
          <tr>
            <td height="31" class = "log2">管理员密码：</td>
            <td colspan="2"><input type="Password" name="A_Password" id="textfield2" /></td>
          </tr>
          <tr>
            <td height="33">&nbsp;</td>
            <td width="83"><input type="submit" name="button" id="button" value="确认" /></td>
            <td width="151"><input type="reset" name="button2" id="button2" value="重置" /></td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>

</html>