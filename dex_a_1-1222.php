<?php
include_once('./_common.php');
$filename = '인력파견현황'.date("Y-m-d H:i:s").'.xls';
header("Content-type: application/vnd.ms-excel" );
header("Content-Disposition: attachment; filename=".$filename);

$sql = "select * from g5_write_a_1 where wr_is_comment = 0 ";

$sca = urldecode($sca);
$s_subject = urldecode($s_subject);
$s_content = urldecode($s_content);
$s_link1 = urldecode($s_link1);
$s_4 = urldecode($s_4);
$s_5 = urldecode($s_5);
$s_6 = urldecode($s_6);
$sdate1 = urldecode($sdate1);
$edate1 = urldecode($edate1);
$sdate2 = urldecode($sdate2);
$edate2 = urldecode($edate2);


$sql .= $sca?" and `ca_name`='{$sca}' ":'';
$sql .= $s_subject?" and `wr_subject` like '%".$s_subject."%' ":'';
$sql .= $s_content?" and `wr_content` = '".$s_content."' ":'';
$sql .= $s_link1?" and `wr_link1` like '%".$s_link1."%' ":'';
$sql .= $s_4?" and `wr_4` like '%".$s_4."%' ":'';
$sql .= $s_5?" and `wr_5` like '%".$s_5."%' ":'';
$sql .= $s_6?" and `wr_6` like '%".$s_6."%' ":'';
$sql .= $sdate1?" and `wr_7`>='{$sdate1}' ":'';
$sql .= $edate1?" and `wr_7`<='{$edate1}' ":'';
$sql .= $sdate2?" and `wr_8`>='{$sdate2}' ":'';
$sql .= $edate2?" and `wr_8`<='{$edate2}' ":'';

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
        <td><?php echo $arr['wr_4'] ?></td>
        <td><?php echo $arr['wr_5'] ?></td>
        <td><?php echo $arr['wr_6'] ?></td>
        <td><?php echo $arr['wr_7'] ?></td>
        <td><?php echo $arr['wr_8'] ?></td>
        <td><?php echo $arr['ca_name'] ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
