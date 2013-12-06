<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
	  echo "<script language='javascript'>alert('请先以学生登录！');window.location='index.php'</script>";
}
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
<?php include("Connections/myconn.php");
$freeftid = $_GET[ftid];
$result = mysql_query("select T_Username,T_Name from teacher where FT_ID = ".$freeftid,$myconn);
$freeinfo = mysql_fetch_array($result);
$sql = "select * from freetime where T_Username = '".$freeinfo[T_Username]."'";
$result = mysql_query($sql,$myconn);
$teafreetimein = mysql_fetch_array($result);
if($teafreetimein)
{
	$monday = $teafreetimein[Monday];
	$tuesday = $teafreetimein[Tuesday];
	$wednesday = $teafreetimein[Wednesday];
	$thursday = $teafreetimein[Thursday];
	$friday = $teafreetimein[Friday];
	$saturday = $teafreetimein[Saturday];
	$sunday = $teafreetimein[Sunday];
	$flag = array();
	for($i = 0;$i<9;$i++){
		for($j = 0;$j<9;$j++){
			$flag[$i][$j] = "";
		}
	}
	for($i = 0;$i<8;$i++){
		if($monday[$i] == 1)
			$flag[$i+1][1] = "繁忙";
		if($tuesday[$i] == 1)
			$flag[$i+1][2] = "繁忙";
		if($wednesday[$i] == 1)
			$flag[$i+1][3] = "繁忙";
		if($thursday[$i] == 1)
			$flag[$i+1][4] = "繁忙";
		if($friday[$i] == 1)
			$flag[$i+1][5] = "繁忙";
		if($saturday[$i] == 1)
			$flag[$i+1][6] = "繁忙";
		if($sunday[$i] == 1)
			$flag[$i+1][7] = "繁忙";
	}
}
?>
<?php
	$nowyea = date('Y');
	$nowmon = date('m');
	$today = date('j');
	$weekday = date('w');
	$dayday = array();
	$monthday = array();
	$dayday[$weekday] = $today;
	$nowday = array();
	$nowday[$weekday] = "class = \"di\"";
    for($i = 0;$i < 7;$i++)
	{
		if($i != $weekday)
		{
			$nowday[$i] = "";
		}
	}
	for($i = 0;$i < 7;$i++)
	{
		$monthday[$i] = $nowmon;
	}
	for($i = 0;$i < 7;$i++)
	{
		if($i > $weekday)
		{
			$dayday[$i] = $today + $i - $weekday;
		}
		else if($i < $weekday)
		{
			$dayday[$i] = $today + 7 + $i - $weekday;
		}
		if($nowmon == 1 ||$nowmon == 3||$nowmon == 5|$nowmon == 7||$nowmon == 8||$nowmon == 10||$nowmon == 12 )
		{
			if($dayday[$i]>31)
			{
				$dayday[$i] = $dayday[$i] - 31;
				$monthday[$i] = ($nowmon+1)%12;
			}
		}
		else if($nowmon == 2)
		{
			if($nowyea % 4 == 0 && $nowyea % 400 != 0)
			{
				if($dayday[$i]>29)
				{
					$dayday[$i] = $dayday[$i] - 29;
					$monthday[$i] = $nowmon+1;
				}
			}
			else
			{
				if($dayday[$i]>28)
				{
					$dayday[$i] = $dayday[$i] - 28;
					$monthday[$i] = $nowmon+1;
				}
			}
		}
		else
		{
			if($dayday[$i]>30)
			{
				$dayday[$i] = $dayday[$i] - 30;
				$monthday[$i] = $nowmon+1;
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教师空闲时间</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
</style>
<style type="text/css">
#CheckBoxList1{border-collapse:collapse;}
#CheckBoxList1 td{border:1px solid #F0F8FF;padding-left:5px}
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
      <td width="638" rowspan="2" valign="top" align="center">
		<table width = "493">
			<tr>
				<td width="485" height = "30" align="center"><p>教师空闲时间表——<?php echo $freeinfo[T_Name];?></p>
			    <p>(于<?php echo $teafreetimein[Lastedit];?>最后修改)</p></td>
			</tr>
          </table>
        <table id="CheckBoxList1" width="600" border="1">
          <tr class="di">
            <td height="28" align="center">日期</td>
            <td align="center"><?php echo $monthday[1] ?>月<?php echo $dayday[1] ?>日</td>
            <td align="center"><?php echo $monthday[2] ?>月<?php echo $dayday[2] ?>日</td>
            <td align="center"><?php echo $monthday[3] ?>月<?php echo $dayday[3] ?>日</td>
            <td align="center"><?php echo $monthday[4] ?>月<?php echo $dayday[4] ?>日</td>
            <td align="center"><?php echo $monthday[5] ?>月<?php echo $dayday[5] ?>日</td>
            <td align="center"><?php echo $monthday[6] ?>月<?php echo $dayday[6] ?>日</td>
            <td align="center"><?php echo $monthday[0] ?>月<?php echo $dayday[0] ?>日</td>
          </tr>
          <tr>
            <td width="80" height="28" align="center">&nbsp;</td>
            <td <?php echo $nowday[1]; ?> width="70" align="center">周一</td>
            <td <?php echo $nowday[2]; ?> width="70" align="center">周二</td>
            <td <?php echo $nowday[3]; ?> width="70" align="center">周三</td>
            <td <?php echo $nowday[4]; ?> width="70" align="center">周四</td>
            <td <?php echo $nowday[5]; ?> width="70" align="center">周五</td>
            <td <?php echo $nowday[6]; ?> width="70" align="center">周六</td>
            <td <?php echo $nowday[0]; ?> width="70" align="center">周日</td>
          </tr>
          <tr>
            <td height="28" align="center">早7-8点</td>
            <td align="center"><?php echo $flag[1][1];?></td>
            <td align="center"><?php echo $flag[1][2];?></td>
            <td align="center"><?php echo $flag[1][3];?></td>
            <td align="center"><?php echo $flag[1][4];?></td>
            <td align="center"><?php echo $flag[1][5];?></td>
            <td align="center"><?php echo $flag[1][6];?></td>
            <td align="center"><?php echo $flag[1][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">1-2节课</td>
            <td align="center"><?php echo $flag[2][1];?></td>
            <td align="center"><?php echo $flag[2][2];?></td>
            <td align="center"><?php echo $flag[2][3];?></td>
            <td align="center"><?php echo $flag[2][4];?></td>
            <td align="center"><?php echo $flag[2][5];?></td>
            <td align="center"><?php echo $flag[2][6];?></td>
            <td align="center"><?php echo $flag[2][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">3-4节课</td>
            <td align="center"><?php echo $flag[3][1];?></td>
            <td align="center"><?php echo $flag[3][2];?></td>
            <td align="center"><?php echo $flag[3][3];?></td>
            <td align="center"><?php echo $flag[3][4];?></td>
            <td align="center"><?php echo $flag[3][5];?></td>
            <td align="center"><?php echo $flag[3][6];?></td>
            <td align="center"><?php echo $flag[3][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">午间</td>
            <td align="center"><?php echo $flag[4][1];?></td>
            <td align="center"><?php echo $flag[4][2];?></td>
            <td align="center"><?php echo $flag[4][3];?></td>
            <td align="center"><?php echo $flag[4][4];?></td>
            <td align="center"><?php echo $flag[4][5];?></td>
            <td align="center"><?php echo $flag[4][6];?></td>
            <td align="center"><?php echo $flag[4][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">5-6节课</td>
            <td align="center"><?php echo $flag[5][1];?></td>
            <td align="center"><?php echo $flag[5][2];?></td>
            <td align="center"><?php echo $flag[5][3];?></td>
            <td align="center"><?php echo $flag[5][4];?></td>
            <td align="center"><?php echo $flag[5][5];?></td>
            <td align="center"><?php echo $flag[5][6];?></td>
            <td align="center"><?php echo $flag[5][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">7-8节课</td>
            <td align="center"><?php echo $flag[6][1];?></td>
            <td align="center"><?php echo $flag[6][2];?></td>
            <td align="center"><?php echo $flag[6][3];?></td>
            <td align="center"><?php echo $flag[6][4];?></td>
            <td align="center"><?php echo $flag[6][5];?></td>
            <td align="center"><?php echo $flag[6][6];?></td>
            <td align="center"><?php echo $flag[6][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">9-11节课</td>
            <td align="center"><?php echo $flag[7][1];?></td>
            <td align="center"><?php echo $flag[7][2];?></td>
            <td align="center"><?php echo $flag[7][3];?></td>
            <td align="center"><?php echo $flag[7][4];?></td>
            <td align="center"><?php echo $flag[7][5];?></td>
            <td align="center"><?php echo $flag[7][6];?></td>
            <td align="center"><?php echo $flag[7][7];?></td>
          </tr>
          <tr>
            <td height="28" align="center">晚9-10点</td>
            <td align="center"><?php echo $flag[8][1];?></td>
            <td align="center"><?php echo $flag[8][2];?></td>
            <td align="center"><?php echo $flag[8][3];?></td>
            <td align="center"><?php echo $flag[8][4];?></td>
            <td align="center"><?php echo $flag[8][5];?></td>
            <td align="center"><?php echo $flag[8][6];?></td>
            <td align="center"><?php echo $flag[8][7];?></td>
          </tr>
        </table>
        <table width="200" border="0">
          <tr>
            <td><a href="stuordertea.php?ftid=<?php echo $freeftid; ?>">预约该教师</a></td>
            <td height = "30">&nbsp;</td>
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
      </table></td>
    </tr>
    <tr>
      <td  colspan="3"><?php include("bottom.php");?></td>
    </tr>
  </table>
</div>

</html>