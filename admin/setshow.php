<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php'</script>";
}
?>
<?php
include("../Connections/myconn.php");
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$query_Recordset1 = "SELECT * FROM news order by N_ID";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $myconn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置新闻</title>
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
function chkuserinput(form){
	if(form.searchstu.value==""){
		alert("请输入搜索信息!");
		form.searchstu.select();
		return(false);
	}		
	return(true);				 
}
</script>
<script language="JavaScript">
/**
 * 实现全选功能
 */
function CA(){
	for(var i=0;i<document.form2.elements.length;i++){
		var e=document.form2.elements[i];
		if(e.name!='allbox') e.checked=document.form2.allbox.checked;
	}
}
/**
 * 实现删除确认
 */
function deldata()
{
	if(confirm("真的要删除吗?"))
	{
		document.form2.action = "delnews.php";
		document.form2.submit();
	}
}
function resetdata()
{
	if(confirm("确认重置?"))
	{
		document.form2.action = "resetshow.php";
		document.form2.submit();
	}
}
function setdata()
{
	if(confirm("确认设置?"))
	{
		document.form2.action = "setnews.php";
		document.form2.submit();
	}
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
      <td align="center"><form name="form2" action="" method = "post"><table width="654" border="0" >
        <tr>
          <td colspan="3" align="center">新闻列表：</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" align="right">共有<?php echo $totalRows_Recordset1; ?>条记录</td>
          </tr>
        <tr>
          <td align="center" width="37"><input type="checkbox" name="allbox" id="checkbox" onclick = javascript:CA() />
            <label for="checkbox"></label></td>
          <td align="center" width="143">标签</td>
          <td align="center" width="460">新闻</td>
        </tr>
        <?php do { ?>
        <tr>
          <td class = "di" align="center" width="37">
            <input type="checkbox" name="check[]" id="checkbox2" value = "<?php echo $row_Recordset1['N_ID'];?>" />
            <label for="checkbox2"></label>
          </td>
          <td height = "30" class = "di" align="center" width="143"><a href="<?php echo $row_Recordset1['N_Label_Url'];?>" target="_blank"><?php echo $row_Recordset1['N_Label']; ?></a></td>
          <td class = "di" align="center" width="460"><a href="<?php echo $row_Recordset1['N_News_Url'];?>" target="_blank"><?php echo $row_Recordset1['N_News']; ?></a></td>
        </tr>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
        <table width="533" border="0">
          <tr>
            <td width="99"><input type="submit" name="button3" id="button3" value="重置主页显示" onclick = resetdata() /></td>
            <td width="69"><input type="submit" name="show" id="button" onclick=javascript:setdata(); value="设置显示" /></td>
            <td width="44"><input type="submit" name="del" id="button2" onclick=javascript:deldata(); value="删除" /></td>
            <td width="69"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">[第一页]</a>
              <?php } // Show if not first page ?></td>
            <td width="69"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">[上一页]</a>
              <?php } // Show if not first page ?></td>
            <td width="69"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">[下一页]</a>
              <?php } // Show if not last page ?></td>
            <td width="84"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">[最后一页]</a>
              <?php } // Show if not last page ?></td>
          </tr>
      </table></form></td>
    </tr>
  </table>
</div>
</html>