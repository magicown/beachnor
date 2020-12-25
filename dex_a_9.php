<?php
include_once('./_common.php');
$filename = '배송업체_'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);

$sql = "select * from g5_write_a_9 where wr_is_comment = 0 ";

$s_subject = urldecode($s_subject);
$s_content = urldecode($s_content);
$s_4 = urldecode($s_4);
$sdate1 = urldecode($sdate1);
$edate1 = urldecode($edate1);

$sql .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
$sql .= $s_4?" and `wr_4` like '%".$s_4."%'":'';
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
        <td>번호</td>
        <td>배송업체명</td>
    </tr>
    <?php
        $i = 1;
        while($arr=sql_fetch_array($res)){
            ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $arr['wr_subject'] ?></td>
        </tr>
    <?php $i++; } ?>
</table>
</body>
</html>
