<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php require_once('Connections/myconn.php'); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先以学生登录！');window.location='index.php'</script>";
}
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST')						
	{
		if($_POST['check'])											
		{
			foreach($_POST['check'] as $id)								
			{
				mysql_query("update apply_form set studelete = 1 where FA_ID = ".$id,$myconn);
				mysql_query("delete from apply_form where FA_ID = ".$id." and teadelete = 1",$myconn);
			}
		}
	}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$query_Recordset1 = "SELECT FA_ID,FT_ID,T_Username,T_Name,Apply_Time,S_Username,State,View FROM teacher natural join apply_form where S_Username = '".$_SESSION[S_Username]."' and studelete = 0 order by State desc,Apply_Time desc";
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
<title>查看</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<style type="text/css">

.di {
	background-color: #09F;
}
</style>
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
		document.form2.submit();
	}
}
</script>
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
      <td width="638" rowspan="2" valign="top" align="center"><form name="form2" action="" method = "post">
      <?php if($totalRows_Recordset1!=0){?><table width="494" border="0" >
          <tr>
            <td colspan="5" align="center">预约列表：</td>
            </tr>
            <tr>
            <td colspan="5"><div align="right">共有<?php echo $totalRows_Recordset1; ?>条记录</div></td>
            </tr>
            <tr>
              <td align="center" width="30"><input type="checkbox" name="allbox" id="allbox" onclick = javascript:CA() />
              <label for="checkbox2"></label></td>
              <td align="center" width="143">教师姓名</td>
              <td align="center" width="179">预约请求时间</td>
              <td align="center" width="80">状态</td>
              <td align="center" width="40">&nbsp;</td>
            </tr>
            <?php do { ?>
            <tr>
              <td class = "di" align="center" width="30"><input type="checkbox" name="check[]" id="checkbox" value = "<?php echo $row_Recordset1['FA_ID']; ?>"/>
			</td>
            <td height = "30" class = "di" align="center" width="143"><a href="teainfo.php?ftid=<?php echo $row_Recordset1['FT_ID']; ?>"><?php echo $row_Recordset1['T_Name']; ?></a></td>
            <td class = "di" align="center" width="179"><?php echo $row_Recordset1['Apply_Time']; ?></td>
            <td class = "di" align="center" width="80">
            <?php if($row_Recordset1['State'] == "w")
					$state = "等待处理";
			else if($row_Recordset1['State'] == "p")
					$state = "时间已过";
			else if($row_Recordset1['State'] == "a")
					$state = "同意请求";
			else if($row_Recordset1['State'] == "d")
					$state = "拒绝请求";
			?>
			<?php echo $state; ?>
            </td>
            <td align="center" width="40">
              <a href="stuorderdetail.php?faid=<?php echo $row_Recordset1['FA_ID']; ?>">详细</a>
              </td>
            </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table>
        <table width="419" border="0">
          <tr>
            <td width="65"><input id=cmdAdd onclick=javascript:deldata(); type=button value="删除" name=cmdDel></td>
            <td width="65"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">[第一页]</a>
              <?php } // Show if not first page ?></td>
            <td width="65"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">[上一页]</a>
              <?php } // Show if not first page ?></td>
            <td width="65"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">[下一页]</a>
              <?php } // Show if not last page ?></td>
            <td width="137"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">[最后一页]</a>
              <?php } // Show if not last page ?></td>
          </tr>
      </table><?php } else echo "当前没有预约！"; ?></form></td>
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