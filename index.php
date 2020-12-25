<?php
include_once('./_common.php');


 if($is_member || $is_admin == 'super'){

 	header("location:/bbs/board.php?bo_table=a_1&type=1");
 }else{
 	header("location:/bbs/login.php");	

 }
?>