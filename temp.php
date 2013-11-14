<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
 $zero1=date('Y-m-j H:i:s',time());
 $zero2="2013-11-14 9:18";
 echo "zero1的时间为：".$zero1."<br>";
 echo "zero2的时间为：".$zero2."<br>";
  echo strtotime($zero1);
 echo strtotime($zero2);
 if(strtotime($zero1)<strtotime($zero2)){
  echo "zero1早于zero2";
 }else{
  echo "zero2早于zero1";
 }
 ?>