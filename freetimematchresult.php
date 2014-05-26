<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
}
?>
<?php
include("Connections/myconn.php");
$year = $_GET[y];
$month = $_GET[m];
$day = $_GET[d];
$hours = $_GET[h];
$minutes = $_GET[mi];
$weekday = date("l",mktime($hours,$minutes,0,$month,$day,$year));

if($hours == 7 && $minutes <= 45)
	$keypoint = 0;
else if($hours == 8 || ($hours == 9 && $minutes <= 45) || ($hours == 7 && $minutes > 45))
	$keypoint = 1;
else if($hours == 10 || ($hours == 9 && $minutes > 45) || ($hours == 11 && $minutes <= 45))
	$keypoint = 2;
else if($hours == 12 || ($hours == 11 && $minutes > 45) || ($hours == 13 && $hours <= 30))
	$keypoint = 3;
else if(($hours == 13 && $hours > 30)|| $hours == 14 || ($hours == 15 && $hours <= 30))
	$keypoint = 4;
else if(($hours == 15 && $hours > 30) || $hours == 16 || ($hours == 17 && $hours <= 30))
	$keypoint = 5;
else if(($hours == 17 && $hours > 30) ||$hours == 18 || $hours == 19 || $hours == 20)
	$keypoint = 6;
else if($hours == 21)
	$keypoint = 7;
$keyresult =  "00000000";
for($i = 0;$i <8;$i++)
{
	if($i != $keypoint)
		$keyresult[$i] = '_';
	else
		$keyresult[$i] = '0';
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
$query_Recordset1 = "select FT_ID,T_Username,T_Name,T_Academy from freetime natural join teacher where $weekday like '$keyresult'";
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
<title>匹配结果</title>
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
      <td width="638" rowspan="2" valign="top" align="center"><?php if($totalRows_Recordset1!=0){?><table width="560" border="0" >
          <tr>
            <td colspan="4" align="center">匹配教师列表：</td>
            </tr>
            <tr>
            <td colspan="4"><div align="right">共有<?php echo $totalRows_Recordset1; ?>条记录</div></td>
            </tr>
            <tr>
              <td align="center" width="143">姓名</td>
              <td align="center" width="229">学院</td>
              <td align="center" width="85">&nbsp;</td>
              <td align="center" width="50">&nbsp;</td>
            </tr>
            <?php do { ?>
            <tr>
            <td height = "30" class = "di" align="center" width="143"><a href="teainfo.php?ftid=<?php echo $row_Recordset1['FT_ID']; ?>"><?php echo $row_Recordset1['T_Name']; ?></a></td>
            <td class = "di" align="center" width="229"><?php echo $row_Recordset1['T_Academy']; ?></td>
            <td align="center" width="85"><a href="stusearchteafreetime.php?ftid=<?php echo $row_Recordset1['FT_ID'];?>">空闲时间</a></td>
            <td align="center" width="50"><a href="stuordertea.php?ftid=<?php echo $row_Recordset1['FT_ID']; ?>&y=<?php echo $year; ?>&m=<?php echo $month; ?>&d=<?php echo $day; ?>&h=<?php echo $hours; ?>&mi=<?php echo $minutes; ?>">预约</a></td>
            </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table>
        <table width="350" border="0">
          <tr>
            <td width="65"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">[第一页]</a>
              <?php } // Show if not first page ?></td>
            <td width="65"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">[上一页]</a>
              <?php } // Show if not first page ?></td>
            <td width="65"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">[下一页]</a>
              <?php } // Show if not last page ?></td>
            <td width="137"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">[最后一页]</a>
              <?php } // Show if not last page ?></td>
          </tr>
        </table></td>
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
      </table><?php } else echo "没有匹配结果！";?></td>
    </tr>
    <tr>
      <td  colspan="3"><?php include("bottom.php");?></td>
    </tr>
  </table>
</div>

</html>