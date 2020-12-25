<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

 
sql_query(" update $write_table 
		set 
		`wr_homepage`= '{$_POST[wr_homepage]}'
		 where wr_id = '$wr_id' ");


?>