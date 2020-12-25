<?php
 
include_once('./_common.php');

if($_POST['cate']){
	$con_menu = trim($_POST['cate']);
	
	$sql = " select * from `cate` where `fenlei` = '$con_menu' ";
    $cate = sql_fetch($sql);


		
	echo $cate['list'];

}



?>

