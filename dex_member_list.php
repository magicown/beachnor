<?php
include_once('./_common.php');
$filename = '회원관리'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);



function lever_str($level){
	if($level==10){
	$member_label = "슈퍼관리자";
	}else if($level==9){
	$member_label = "본사담당자";
	}else if($level==8){
	$member_label = "기관회원";
	}else if($level==7){
	$member_label = "지점회원";
	}else if($level==6){
	$member_label = "근로자";
	}else if($level==5){
	$member_label = "대근자";
	}else{
		continue;
	}
	return $member_label;
}








$sql_common = " from `g5_member` ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


$sql_search .= $slevel?" and `mb_level`=".$slevel:'';

if ($is_admin != 'super')
    //$sql_search .= " and mb_level <= '{$member['mb_level']}' ";
	$sql_search .= " and mb_level = '6' and mb_recommend = '{$member[mb_id]}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";


$result = sql_query($sql);
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<table border="1">
    <tr>
      <th scope="col" id="mb_list_id">아이디</th>
      <th id="mb_list_mobile" scope="col">이름</th>
      <th id="mb_list_name" scope="col">연령(만)</th>
      <th id="mb_list_mobile" scope="col">휴대폰</th>
      <th id="mb_list_mobile" scope="col">전화번호</th>
       <th id="mb_list_name" scope="col">E-mail</th>
       <th id="mb_list_name" scope="col">주소</th>
      <th id="mb_list_auth" scope="col">권한</th>
      <th id="mb_list_auth" scope="col">그룹</th>
    </tr>
    <?php while($row=sql_fetch_array($result)){ ?>
    <tr>
      <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['mb_id'] ?></td>
      <td class="td_mbname" headers="mb_list_name"><?php echo get_text($row['mb_name']); ?>  </td>
       <td class="mb_list_name" headers="mb_list_name">
       
		<?
		$mb_birth_ex = explode("-",$row['mb_birth']);
		$nianling = date("Y")-$mb_birth_ex[0];
		if($mb_birth_ex[1]){
		?>
		<?=$nianling?>세 (<?php echo get_text($row['mb_birth']); ?>)  
		<? }?>
       
       
       </td>
      <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_hp']; ?></td>
      
    <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_tel']; ?></td>  
    
     <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_email']; ?></td>  
      
      <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_addr1']; ?> <?php echo $row['mb_addr2']; ?> <?php echo $row['mb_addr3']; ?></td> 
      
      <td class="td_mbstat" headers="mb_list_auth"> <?php echo lever_str($row['mb_level'])?></td>
      <td class="td_mbstat" headers="mb_list_auth"><?=$row['mb_3']?></td>
    </tr>
	<?php } ?>
</table>
</body>
</html>
