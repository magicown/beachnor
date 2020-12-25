<?php
include_once('./_common.php');
$filename = '파견인력 현황 보고서'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);

$sql = "select * from g5_write_a_1 where wr_is_comment = 0 ";

$s_subject = urldecode($s_subject);
$s_content = urldecode($s_content);
$s_link1 = urldecode($s_link1);
$s_1 = urldecode($s_1);
$s_2 = urldecode($s_2);
$s_homepage = urldecode($s_homepage);
$sdate1 = urldecode($sdate1);
$edate1 = urldecode($edate1);
$sdate2 = urldecode($sdate2);
$edate2 = urldecode($edate2);


$sql .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
$sql .= $s_content?" and `wr_content` = '".$s_content."'":'';
$sql .= $s_link1?" and `wr_link1` like '%".$s_link1."%'":'';
$sql .= $s_1?" and `wr_1` like '%".$s_1."%'":'';
$sql .= $s_2?" and `wr_2` like '%".$s_2."%'":'';
$sql .= $s_homepage?" and `wr_homepage` like '%".$s_homepage."%'":'';
$sql .= $sdate1?" and `wr_3`>='{$sdate1}' ":'';
$sql .= $edate1?" and `wr_3`<='{$edate1}' ":'';
$sql .= $sdate2?" and `wr_4`>='{$sdate2}' ":'';
$sql .= $edate2?" and `wr_4`<='{$edate2}' ":'';

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
        <td>성명</td>
        <td>성별</td>
        <td>년령</td>
        <td>기관(업체)</td>
        <td>지역</td>
        <td>업무</td>
        <td>파견일</td>
        <td>파견종료일</td>
        <td>상태</td>
    </tr>
    <?php while($arr=sql_fetch_array($res)){ ?>
    <tr>
        <td><?php echo $arr['wr_subject'] ?></td>
        <td><?php echo $arr['wr_content'] ?></td>
        <td><?php echo $arr['wr_link1'] ?></td>
        <td><?php echo $arr['wr_1'] ?></td>
        <td><?php echo $arr['wr_homepage'] ?></td>
        <td><?php echo $arr['wr_2'] ?></td>
        <td><?php echo $arr['wr_3'] ?></td>
        <td><?php echo $arr['wr_4'] ?></td>
        <td><?php echo $arr['ca_name'] ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
