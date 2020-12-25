<?php
include_once('./_common.php');
$filename = '상품'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);

$sql = "select * from g5_write_a_3 where wr_is_comment = 0 ";

$sca = urldecode($sca);
$s_subject = urldecode($s_subject);
$s_content = urldecode($s_content);
$s_link2 = urldecode($s_link2);
$s_1 = urldecode($s_1);
$s_2 = urldecode($s_2);
$s_4 = urldecode($s_4);
$sdate1 = urldecode($sdate1);
$edate1 = urldecode($edate1);

$sql .= $sca?" and `ca_name`='{$sca}' ":'';
$sql .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
$sql .= $s_1?" and `wr_1` like '%".$s_1."%'":'';
$sql .= $s_2?" and `wr_2` like '%".$s_2."%'":'';
$sql .= $s_4?" and `wr_1` like '%".$s_1."%'":'';
$sql .= $s_link2?" and `wr_link1` like '%".$s_link1."%'":'';
$sql .= $s_content?" and `wr_content` like '%".$s_content."%'":'';
$sql .= $sdate1?" and `wr_3`>='{$sdate1}' ":'';
$sql .= $edate1?" and `wr_3`<='{$edate1}' ":'';

$order= " order by wr_num, wr_reply";

$res = sql_query($sql.$order);
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<table border="1">
    <tr>
        <td>상품코드</td>
        <td>상품분류</td>
        <td>상품명</td>
        <td>가격</td>
        <td>공장거래처</td>
        <td>상태</td>
    </tr>
    <?php while($arr=sql_fetch_array($res)){ ?>
    <tr>
        <td><?php echo $arr['wr_1'] ?></td>
        <td><?php echo $arr['wr_subject'] ?></td>
        <td><?php echo $arr['wr_2'] ?></td>
        <td><?php echo $arr['wr_3'] ?></td>
        <td><?php echo $arr['wr_5'] ?></td>
        <td><?php echo $arr['ca_name'] ?></td>

    </tr>
    <?php } ?>
</table>
</body>
</html>
