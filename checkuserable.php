<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
 $name = trim($_GET[name]);
 $table = trim($_GET[table]);
?>
<?php
 include("Connections/myconn.php");
?>
<html>
<head>
<title>
用户名检测
</title>
<style type="text/css">
body {
	background-color: #CCCCCC;
	margin-top: 0px;
}
</style>
</head>
<body topmargin="0" leftmargin="0" bottommargin="0">
<table width="200" height="100" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#eeeeee">
  <tr>
    <td height="50"><div align="center">
	
	<?php
	  if($name == "")
	  {
	    echo "请输入用户名!";
	  }
	  else
	  {
		if($table == "student")
			$column = "S_Username";
		else
			$column = "T_Username";
	    $sql=mysql_query("select * from ".$table." where ".$column." = '".$name."'",$myconn);  
	    $info=mysql_fetch_array($sql);
		if($info==true)
		{
		  echo "对不起,该用户名已存在!";
		}
		else
		{
		   echo "恭喜,用户名可用!";
		} 
	  }
	?>
	</div></td>
  </tr>
  <tr>
    <td height="50"><div align="center"><input type="button" value="确定" class="buttoncss" onClick="window.close()"></div></td>
  </tr>
</table>
<?php
mysql_free_result($sql);
?>