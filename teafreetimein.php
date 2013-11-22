<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[T_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='index.php'</script>";
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
<?php 
include("Connections/myconn.php");
$sql = "select * from freetime where T_Username = '".$_SESSION[T_Username]."'";
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
			$flag[$i+1][1] = "checked";
		if($tuesday[$i] == 1)
			$flag[$i+1][2] = "checked";
		if($wednesday[$i] == 1)
			$flag[$i+1][3] = "checked";
		if($thursday[$i] == 1)
			$flag[$i+1][4] = "checked";
		if($friday[$i] == 1)
			$flag[$i+1][5] = "checked";
		if($saturday[$i] == 1)
			$flag[$i+1][6] = "checked";
		if($sunday[$i] == 1)
			$flag[$i+1][7] = "checked";
	}
}
$newmonday = "00000000";
$newtuesday = "00000000";
$newwednesday = "00000000";
$newthursday = "00000000";
$newfriday = "00000000";
$newsaturday = "00000000";
$newsunday = "00000000";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$value = $_POST['check'];
	for($i = 0;$i<count($value);$i++){
		if($value[$i][1] == 1){
			$newmonday[$value[$i][0]-1] = 1;
		}
		if($value[$i][1] == 2){
			$newtuesday[$value[$i][0]-1] = 1;
		}
		if($value[$i][1] == 3){
			$newwednesday[$value[$i][0]-1] = 1;
		}
		if($value[$i][1] == 4){
			$newthursday[$value[$i][0]-1] = 1;
		}
		if($value[$i][1] == 5){
			$newfriday[$value[$i][0]-1] = 1;
		}
		if($value[$i][1] == 6){
			$newsaturday[$value[$i][0]-1] = 1;
		}
		if($value[$i][1] == 7){
			$newsunday[$value[$i][0]-1] = 1;
		}
	}
	mysql_query("update freetime set Monday = '$newmonday',Tuesday = '$newtuesday',Wednesday = '$newwednesday', Thursday = '$newthursday', Friday = '$newfriday', Saturday = '$newsaturday' , Sunday = '$newsunday' where T_Username = '".$_SESSION[T_Username]."'",$myconn);
	echo "<script>alert('录入成功!');window.location='teaindex.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>空闲时间录入</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
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
      <td width="638" rowspan="2" valign="top" align="center"><form id="form2" name="form2" method="post" action="">
        <p>请在繁忙的时间段上打钩</p>
        <table id="CheckBoxList1" width="600" border="1">
          <tr>
            <td height="28" align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td width="80" height="28" align="center">&nbsp;</td>
            <td width="70" align="center">周一</td>
            <td width="70" align="center">周二</td>
            <td width="70" align="center">周三</td>
            <td width="70" align="center">周四</td>
            <td width="70" align="center">周五</td>
            <td width="70" align="center">周六</td>
            <td width="70" align="center">周日</td>
          </tr>
          <tr>
            <td height="28" align="center">早7-8点</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox2" value = "11" <?php echo $flag[1][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox16" value = "12" <?php echo $flag[1][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox17" value = "13" <?php echo $flag[1][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox32" value = "14" <?php echo $flag[1][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox33" value = "15" <?php echo $flag[1][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox48" value = "16" <?php echo $flag[1][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox49" value = "17" <?php echo $flag[1][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">1-2节课</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox" value = "21" <?php echo $flag[2][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox15" value = "22" <?php echo $flag[2][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox18" value = "23" <?php echo $flag[2][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox31" value = "24" <?php echo $flag[2][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox34" value = "25" <?php echo $flag[2][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox47" value = "26" <?php echo $flag[2][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox50" value = "27" <?php echo $flag[2][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">3-4节课</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox3" value = "31" <?php echo $flag[3][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox14" value = "32" <?php echo $flag[3][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox19" value = "33" <?php echo $flag[3][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox30" value = "34" <?php echo $flag[3][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox35" value = "35" <?php echo $flag[3][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox46" value = "36" <?php echo $flag[3][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox51" value = "37" <?php echo $flag[3][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">午间</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox4" value = "41" <?php echo $flag[4][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox13" value = "42" <?php echo $flag[4][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox20" value = "43" <?php echo $flag[4][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox29" value = "44" <?php echo $flag[4][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox36" value = "45" <?php echo $flag[4][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox45" value = "46" <?php echo $flag[4][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox52" value = "47" <?php echo $flag[4][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">5-6节课</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox5" value = "51" <?php echo $flag[5][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox12" value = "52" <?php echo $flag[5][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox21" value = "53" <?php echo $flag[5][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox28" value = "54" <?php echo $flag[5][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox37" value = "55" <?php echo $flag[5][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox44" value = "56" <?php echo $flag[5][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox53" value = "57" <?php echo $flag[5][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">7-8节课</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox6" value = "61" <?php echo $flag[6][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox11" value = "62" <?php echo $flag[6][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox22" value = "63" <?php echo $flag[6][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox27" value = "64" <?php echo $flag[6][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox38" value = "65" <?php echo $flag[6][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox43" value = "66" <?php echo $flag[6][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox54" value = "67" <?php echo $flag[6][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">9-11节课</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox7" value = "71" <?php echo $flag[7][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox10" value = "72" <?php echo $flag[7][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox23" value = "73" <?php echo $flag[7][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox26" value = "74" <?php echo $flag[7][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox39" value = "75" <?php echo $flag[7][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox42" value = "76" <?php echo $flag[7][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox55" value = "77" <?php echo $flag[7][7];?>/></td>
          </tr>
          <tr>
            <td height="28" align="center">晚9-10点</td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox8" value = "81" <?php echo $flag[8][1];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox9" value = "82" <?php echo $flag[8][2];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox24" value = "83" <?php echo $flag[8][3];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox25" value = "84" <?php echo $flag[8][4];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox40" value = "85" <?php echo $flag[8][5];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox41" value = "86" <?php echo $flag[8][6];?>/></td>
            <td align="center"><input type="checkbox" name="check[]" id="checkbox56" value = "87" <?php echo $flag[8][7];?>/></td>
          </tr>
        </table>
        <table width="200" border="0">
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="button" id="button" value="确认" /></td>
          </tr>
        </table>
      </form></td>
      <td width="188" rowspan="2" valign="top"><?php include("right_menu_tea.php"); ?></td>
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