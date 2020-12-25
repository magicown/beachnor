<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//핸드폰
$hp = $_POST['hp_1']."-".$_POST['hp_2']."-".$_POST['hp_3'];
sql_query(" update $write_table 
		set `wr_link2` = '$hp'
		 where wr_id = '$wr_id' ");


?>