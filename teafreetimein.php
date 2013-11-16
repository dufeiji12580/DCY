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
	$teafreetimein[monday];
	$teafreetimein[tuesday];
	$teafreetimein[wednesday];
	$teafreetimein[Thursday];
	$teafreetimein[Friday];
	$teafreetimein[Saturday];
	$teafreetimein[Sunday];
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
            <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" checked /></td>
            <td align="center"><input type="checkbox" name="checkbox16" id="checkbox16" /></td>
            <td align="center"><input type="checkbox" name="checkbox17" id="checkbox17" /></td>
            <td align="center"><input type="checkbox" name="checkbox32" id="checkbox32" /></td>
            <td align="center"><input type="checkbox" name="checkbox33" id="checkbox33" /></td>
            <td align="center"><input type="checkbox" name="checkbox48" id="checkbox48" /></td>
            <td align="center"><input type="checkbox" name="checkbox49" id="checkbox49" /></td>
          </tr>
          <tr>
            <td height="28" align="center">1-2节课</td>
            <td align="center"><input type="checkbox" name="checkbox" id="checkbox" />
              <label for="checkbox"></label></td>
            <td align="center"><input type="checkbox" name="checkbox15" id="checkbox15" /></td>
            <td align="center"><input type="checkbox" name="checkbox18" id="checkbox18" /></td>
            <td align="center"><input type="checkbox" name="checkbox31" id="checkbox31" /></td>
            <td align="center"><input type="checkbox" name="checkbox34" id="checkbox34" /></td>
            <td align="center"><input type="checkbox" name="checkbox47" id="checkbox47" /></td>
            <td align="center"><input type="checkbox" name="checkbox50" id="checkbox50" /></td>
          </tr>
          <tr>
            <td height="28" align="center">3-4节课</td>
            <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
            <td align="center"><input type="checkbox" name="checkbox14" id="checkbox14" /></td>
            <td align="center"><input type="checkbox" name="checkbox19" id="checkbox19" /></td>
            <td align="center"><input type="checkbox" name="checkbox30" id="checkbox30" /></td>
            <td align="center"><input type="checkbox" name="checkbox35" id="checkbox35" /></td>
            <td align="center"><input type="checkbox" name="checkbox46" id="checkbox46" /></td>
            <td align="center"><input type="checkbox" name="checkbox51" id="checkbox51" /></td>
          </tr>
          <tr>
            <td height="28" align="center">午间</td>
            <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
            <td align="center"><input type="checkbox" name="checkbox13" id="checkbox13" /></td>
            <td align="center"><input type="checkbox" name="checkbox20" id="checkbox20" /></td>
            <td align="center"><input type="checkbox" name="checkbox29" id="checkbox29" /></td>
            <td align="center"><input type="checkbox" name="checkbox36" id="checkbox36" /></td>
            <td align="center"><input type="checkbox" name="checkbox45" id="checkbox45" /></td>
            <td align="center"><input type="checkbox" name="checkbox52" id="checkbox52" /></td>
          </tr>
          <tr>
            <td height="28" align="center">5-6节课</td>
            <td align="center"><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
            <td align="center"><input type="checkbox" name="checkbox12" id="checkbox12" /></td>
            <td align="center"><input type="checkbox" name="checkbox21" id="checkbox21" /></td>
            <td align="center"><input type="checkbox" name="checkbox28" id="checkbox28" /></td>
            <td align="center"><input type="checkbox" name="checkbox37" id="checkbox37" /></td>
            <td align="center"><input type="checkbox" name="checkbox44" id="checkbox44" /></td>
            <td align="center"><input type="checkbox" name="checkbox53" id="checkbox53" /></td>
          </tr>
          <tr>
            <td height="28" align="center">7-8节课</td>
            <td align="center"><input type="checkbox" name="checkbox6" id="checkbox6" /></td>
            <td align="center"><input type="checkbox" name="checkbox11" id="checkbox11" /></td>
            <td align="center"><input type="checkbox" name="checkbox22" id="checkbox22" /></td>
            <td align="center"><input type="checkbox" name="checkbox27" id="checkbox27" /></td>
            <td align="center"><input type="checkbox" name="checkbox38" id="checkbox38" /></td>
            <td align="center"><input type="checkbox" name="checkbox43" id="checkbox43" /></td>
            <td align="center"><input type="checkbox" name="checkbox54" id="checkbox54" /></td>
          </tr>
          <tr>
            <td height="28" align="center">9-11节课</td>
            <td align="center"><input type="checkbox" name="checkbox7" id="checkbox7" /></td>
            <td align="center"><input type="checkbox" name="checkbox10" id="checkbox10" /></td>
            <td align="center"><input type="checkbox" name="checkbox23" id="checkbox23" /></td>
            <td align="center"><input type="checkbox" name="checkbox26" id="checkbox26" /></td>
            <td align="center"><input type="checkbox" name="checkbox39" id="checkbox39" /></td>
            <td align="center"><input type="checkbox" name="checkbox42" id="checkbox42" /></td>
            <td align="center"><input type="checkbox" name="checkbox55" id="checkbox55" /></td>
          </tr>
          <tr>
            <td height="28" align="center">晚9-10点</td>
            <td align="center"><input type="checkbox" name="checkbox8" id="checkbox8" /></td>
            <td align="center"><input type="checkbox" name="checkbox9" id="checkbox9" /></td>
            <td align="center"><input type="checkbox" name="checkbox24" id="checkbox24" /></td>
            <td align="center"><input type="checkbox" name="checkbox25" id="checkbox25" /></td>
            <td align="center"><input type="checkbox" name="checkbox40" id="checkbox40" /></td>
            <td align="center"><input type="checkbox" name="checkbox41" id="checkbox41" /></td>
            <td align="center"><input type="checkbox" name="checkbox56" id="checkbox56" /></td>
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