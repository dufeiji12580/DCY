<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php session_start();
if(!$_SESSION[A_Username]){
	  echo "<script language='javascript'>alert('请先登录！');window.location='../index.php';</script>";
}
?>
<?php
include("../Connections/myconn.php");
$flag = 0;
		if(trim($_POST[time]) && trim($_POST[label]) && trim($_POST[labelurl]) && trim($_POST[newsurl]) && trim($_POST[news]))											
		{
			for($i = 0;$i<5;$i++)
			{
				if(trim($_POST[time][$i]) && trim($_POST[label][$i]) && trim($_POST[labelurl][$i]) && trim($_POST[newsurl][$i]) && trim($_POST[news][$i]))
				{
					$flag = 1;
					$N_time = trim($_POST[time][$i]);
					$N_label = trim($_POST[label][$i]);
					$N_label_url = trim($_POST[labelurl][$i]);
					$N_news = trim($_POST[news][$i]);
					$N_news_url = trim($_POST[newsurl][$i]);
					mysql_query("insert into news(N_time,N_Label,N_Label_Url,N_News,N_News_Url) values ('$N_time','$N_label','$N_label_url','$N_news','$N_news_url')",$myconn);
				}
			}
			if($flag!=0)
				echo "<script language='javascript'>alert('加入成功！');window.location='addnews.php';</script>";
			else
				echo "<script language='javascript'>alert('您未输入完整的信息！');window.location='addnews.php';</script>";
		}
?>