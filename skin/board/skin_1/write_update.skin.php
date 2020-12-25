<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//핸드폰
//$hp = $_POST['hp_1']."-".$_POST['hp_2']."-".$_POST['hp_3'];

sql_query(" update $write_table 
		set 
		`wr_email` = '$_POST[wr_email]',
		`wr_homepage`= '{$_POST[wr_homepage]}', 
		`wr_11` = '{$_POST[wr_11]}',
		`wr_12` = '{$_POST[wr_12]}',
		`wr_13` = '{$_POST[wr_13]}',
		`wr_14` = '{$_POST[wr_14]}',
		`wr_15` = '{$_POST[wr_15]}',
		`wr_16` = '{$_POST[wr_16]}'
		 where wr_id = '$wr_id' ");



?>