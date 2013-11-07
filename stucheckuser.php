<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
include("Connections/myconn.php");
$username=trim($_POST[S_Username]);
$userpwd=md5(trim($_POST[S_Password]));
$yz=$_POST[verify];
$num=$_POST[num];
if(strval($yz)!=strval($num)){
  echo "<script>alert('验证码输入错误!');history.go(-1);</script>";
  exit;
 }
class chkinput{
   var $name;
   var $pwd;

   function chkinput($x,$y){
     $this->name=$x;
     $this->pwd=$y;
    }

   function checkinput(){
     include("Connections/myconn.php");
	 $sql = "select * from student where S_Username = '".$this->name."'";
     $result =mysql_query($sql,$myconn);
     $row_sql = mysql_fetch_array($result);
     if(!$row_sql){
          echo "<script language='javascript'>alert('用户名不存在！');history.back();</script>";
          exit;
       }
      else{
          if($row_sql[S_Password]==$this->pwd){
  			   session_start();
	           $_SESSION[S_Username]=$row_sql[S_Username];
			   session_register("producelist");
			   $producelist="";
			   session_register("quatity");
			   $quatity="";
               header("location:stuindex.php");
               exit;
            }
          else {
             echo "<script language='javascript'>alert('密码错误！');history.back();</script>";
             exit;
           }

      }    
   }
 }

    $obj=new chkinput(trim($username),trim($userpwd));
    $obj->checkinput();
?>