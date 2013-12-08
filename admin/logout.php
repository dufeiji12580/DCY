<?php header("Content-Type:text/html; charset=utf-8"); ?>
<?php
session_start();
session_destroy();
echo "<script language='javascript'>alert('注销成功！');window.location = '../index.php'</script>";
?>