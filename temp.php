<?php 
$sql = "dufeiji?year=2012";
echo stripos($sql,"year=");
echo substr($sql,0,stripos($sql,"year="));
?> 