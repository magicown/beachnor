<?php
 
include_once('./_common.php');

//if(!$is_admin) exit;


if($_POST['typ']){
	$con_menu = trim($_POST['con_menu']);
	$con_menu = get_safe_filename($con_menu);//특수문자제거
	sql_query(" update `cate` set `list` = '$con_menu' where `fenlei` = '{$_POST[typ]}' ");
	echo "ok";

}



?>