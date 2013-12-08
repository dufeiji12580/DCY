<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php include("Connections/myconn.php");
$savepreferftid = trim($_GET[ftid]);
$sql = "select * from teacher where FT_ID = ".$savepreferftid;
$result = mysql_query($sql,$myconn); 
$savepreferinfo = mysql_fetch_array($result);
if(isset($_GET[pre]) && $_GET[pre] == "pre")
{
	$sql = "select * from prefer where T_Username = '".$savepreferinfo[T_Username]."' and S_Username = '".$_SESSION[S_Username]."'";
	$result = mysql_query($sql,$myconn);
	$preinfo = mysql_fetch_array($result);
	if($preinfo != true)
	{
		mysql_query("insert into prefer(S_Username,T_Username) values('$_SESSION[S_Username]','$savepreferinfo[T_Username]')" );
		echo "<script>alert('关注成功!'); history.back(); </script>";
	}
	else
	{
		echo "<script>alert('您已关注!'); history.back();</script>";
	}
}
?>