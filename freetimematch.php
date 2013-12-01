<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[S_Username]){
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>空闲时间匹配</title>
</head>
<style type="text/css">
body {
	background-color: #CCCCCC;
}
</style>
<script language="javascript">
function chkuserinput(form){
	if( (form.mon.value==2 ||form.mon.value==4 || form.mon.value==6 || form.mon.value==9 || form.mon.value==11) && (form.day.value == 31)){
		alert("该月没有31日!");
		return(false);
	}	
	if(form.hours.value==""||form.hours.value<7 ||form.hours.value>=22 || isNaN(form.hours.value)){
		alert("小时数不符合规范!");
		form.hours.select();
		return(false);
	}	
	if(form.minutes.value==""||form.minutes.value<0||form.minutes.value>59||isNaN(form.minutes.value)){
		alert("分钟数不符合规范!");
		form.minutes.select();
		return(false);
	}		
	return(true);			 
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
      <td width="638" rowspan="2" valign="top" align="center"><form id="form2" name="form2" method="post" action="checkfreetimematch.php" onSubmit="return chkuserinput(this)">
        <table width="376" border="0">
          <tr>
            <td width="370">&nbsp;</td>
            </tr>
          <tr>
            <td>请输入您想预约的时间，系统将为您自动匹配教师！</td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="center"> <p>
              <label for="select"></label>
              <select name="yea" id="select">
                <?php $nowyea = date('Y');
				for($yea=2013; $yea<=2020; $yea++) {
            	$selected = ($yea == $nowyea) ? 'selected' : '';
            	echo '<option '.$selected.' value="'.$yea.'">'.$yea.'</option>';
       		 }?>
              </select>
              年
              <label for="select2"></label>
              <select name="mon" id="select2">
                <?php $nowmon = date('m');
				for($mon=1; $mon<=12; $mon++) {
            	$selected = ($mon == $nowmon) ? 'selected' : '';
            	echo '<option '.$selected.' value="'.$mon.'">'.$mon.'</option>';
       		 }?>
              </select>
              月
              <label for="select3"></label>
              <select name="day" id="select3">
                <?php
				$today = date('j');
				for($day=1; $day<=31; $day++) {
            	$selected = ($day == $today) ? 'selected' : '';
            	echo '<option '.$selected.' value="'.$day.'">'.$day.'</option>';
       		 }?>
              </select>
              日</p>
              <p><label for="textfield2"></label>
                  <input name="hours" type="text" id="textfield2" size="2" maxlength="2" />
时
<label for="textfield3"></label>
<input name="minutes" type="text" id="textfield3" size="2" maxlength="2" />
分 (早7点至晚10点)</p></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><input type="submit" name="button" id="button" value="确定" /></td>
            </tr>
        </table>
        <input type="hidden" value="<?php echo $stuorderteaname[T_Username];?>" name="tusername">
      </form></td>
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