<?php
include_once('./_common.php');
$filename = '대근관리'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);

$sql = "select * from g5_write_a_2 where wr_is_comment = 0 ";

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
        <td>지점명</td>
        <td>정산기간</td>
        <td>입금일</td>
        <td>입금액</td>
        <td>파견인원</td>
        <td>상태</td>
    </tr>
    <?php while($arr=sql_fetch_array($res)){ ?>
    <tr>
        <td><?php echo $arr['wr_subject'] ?></td>
        <td><?php echo $arr['wr_1'] ?>-<?php echo $arr['wr_2'] ?></td>
        <td><?php echo $arr['wr_3'] ?></td>
        <td><?php echo $arr['wr_4'] ?>만원</td>
        <td><?php echo $arr['wr_content'] ?></td>
        <td><?php echo $arr['ca_name'] ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
