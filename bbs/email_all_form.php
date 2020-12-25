<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
if(!$is_admin) exit;


$tmp_array = array();
if ($wr_id) 
    $tmp_array[0] = $wr_id;
else 
    $tmp_array = $_POST['chk_wr_id'];
	 

for ($i=count($tmp_array)-1; $i>=0; $i--)
{
	
	$mb_id = $_POST['mb_id_w'][$i];
		
	$sql = " select `mb_email`,`mb_name` from `g5_member` where mb_id = '".$mb_id."' ";
	$list = sql_fetch($sql);
	
	mailer('시니어인력뱅크', $config['cf_admin_email'], $list['mb_email'], $_POST['ma_subject'], '<span style="font-size:9pt;">[시니어인력뱅크] '.$_POST['ma_content'].'</span>', 1);
	
	
	
}

echo "<script type=\"text/javascript\">alert('메일을 정상적으로 보냈습니다'); </script>";

goto_url('./board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);
?>
