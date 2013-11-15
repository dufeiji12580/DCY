<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php require_once('Connections/myconn.php'); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php $faid = $_GET[faid];
	if($_GET[ifagree] == "agree")
		$ifagree = "a";
	else
		$ifagree = "d";
	if($_GET[r] == "Y"){
		$reply = $_POST[reply];
		$reply = nl2br($reply);
		$sql = "update apply_form set State = '$ifagree',Reply_Info = '$reply' where FA_ID = $faid";
	}
	else{
		$sql = "update apply_form set State = '$ifagree' where FA_ID = $faid";}
	mysql_query($sql,$myconn);
	echo "<script>alert('处理成功!');window.location='teavieworder.php';</script>";
?>