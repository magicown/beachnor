<?php
include_once('./_common.php');
$filename = '기관(업체)'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);

$mb_name = urldecode($mb_name);
$mb_5 = urldecode($mb_5);
$mb_6 = urldecode($mb_6);
$mb_7 = urldecode($mb_7);



$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) and `mb_level`=8 and `mb_id` in ( select distinct(wr_13) from `g5_write_a_1`) ";

$sql_search .= $mb_name?" and `mb_name` like '%".$mb_name."%'":'';
$sql_search .= $mb_5?" and `mb_5` like '%".$mb_5."%'":'';
$sql_search .= $mb_6?" and `mb_6` like '%".$mb_6."%'":'';
$sql_search .= $mb_7?" and `mb_7` like '%".$mb_7."%'":'';

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";


$sql = " select * {$sql_common} {$sql_search} {$sql_order}";


//echo $sql;
$res = sql_query($sql);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<table border="1">
    <tr>
        <td>기관(업체)</td>
        <td>담당자</td>
        <td>전화번호</td>
        <td>휴대폰</td>
    </tr>
    <?php while($arr=sql_fetch_array($res)){ ?>
    <tr>
        <td><?php echo $arr['mb_name'] ?></td>
        <td><?php echo $arr['mb_5'] ?></td>
        <td><?php echo $arr['mb_6'] ?></td>
        <td><?php echo $arr['mb_7'] ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
