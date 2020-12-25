<?php
include_once('./_common.php');
include_once('./head.sub.php');

$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 ";
$row1 = sql_fetch($sql);

$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_6`='경비'";
$row2 = sql_fetch($sql);
$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_6`='야간당직'";
$row3 = sql_fetch($sql);
$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_6`='청소'";
$row4 = sql_fetch($sql);
$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_6`='기타'";
$row5 = sql_fetch($sql);

$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_content`='남'";
$row6 = sql_fetch($sql);
$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_content`='여'";
$row7 = sql_fetch($sql);


$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_11`='2'";
$row8 = sql_fetch($sql);
$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_11`='3'";
$row9 = sql_fetch($sql);

/*   대근자  정규직 부분 */
$sql = "SELECT count(*) as tal  FROM g5_write_a_1 inner JOIN g5_member ON g5_write_a_1.wr_12 = g5_member.mb_id and g5_member.mb_level=6 and g5_write_a_1.ca_name ='근무중'";
$row10 = sql_fetch($sql);

$sql = "SELECT count(*) as tal  FROM g5_write_a_1 inner JOIN g5_member ON g5_write_a_1.wr_12 = g5_member.mb_id and g5_member.mb_level=5 and g5_write_a_1.ca_name ='근무중'";
$row11 = sql_fetch($sql);


/*  월평균급여액 */
$sql = "SELECT count(*) as tal, sum(wr_1) as heji  FROM g5_write_a_1 inner JOIN g5_member ON g5_write_a_1.wr_12 = g5_member.mb_id and (g5_member.mb_level=5 or g5_member.mb_level=6) and g5_write_a_1.ca_name ='근무중'";
$row14 = sql_fetch($sql);


$now = date('Y');
$age60 = $now-60;
$year60 = $age60."-".date('m-d');

$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_link1`<'".$year60."'";
$row12 = sql_fetch($sql);
$sql = "select count(*) as tal from g5_write_a_1 where wr_is_comment = 0 and `wr_link1`>='".$year60."'";
$row13 = sql_fetch($sql);



?>
 <style>
 body{   font-size: 18px;}
 
 </style>
 <div id="pint_box">
<table   border="0" cellspacing="0" cellpadding="0">
  <caption style="font-size:20px;">파견인력 현황 보고서(년간)</caption>
  <tr align="center">
    <th colspan="2" scope="row">기간:</th>
    <td colspan="2"><?=date('Y')?>년 01월 01일 ~ <?=date('Y')?>년 12월 31일</td>
    <td colspan="2">파견기관(업체) 수:</td>
    <td colspan="2"><?=$row1['tal']?></td>
  </tr>
  <tr align="center">
    <th scope="row" align="right">야간당직:</th>
    <td><?=$row3['tal']?>명</td>
    <td align="right">경비:</td>
    <td><?=$row2['tal']?>명</td>
    <td align="right">청소:</td>
    <td><?=$row4['tal']?>명</td>
    <td align="right">기타:</td>
    <td><?=$row5['tal']?>명</td>
  </tr>
  <tr align="center">
    <th scope="row" align="right">남:</th>
    <td><?=$row6['tal']?>명</td>
    <td align="right">여:</td>
    <td><?=$row7['tal']?>명</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <th scope="row" align="right">주2회 근무:</th>
    <td><?=$row8['tal']?>명</td>
    <td align="right">주3회 근무:</td>
    <td><?=$row9['tal']?>명</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <th scope="row" align="right">정규직:</th>
    <td><?=$row10['tal']?>명</td>
    <td align="right">대근직:</td>
    <td><?=$row11['tal']?>명</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <th scope="row" align="right">만60세 이상:</th>
    <td><?=$row12['tal']?>명</td>
    <td align="right">만60세 이하:</td>
    <td><?=$row13['tal']?>명</td>
    <td align="right">월평균 급여액:</td>
    <td colspan="3">
	<?
    //월급여액 * 인원수 / 인원수
	echo number_format($row14['heji']/$row14['tal']);
	?>
   
    원
    </td>
    </tr>
</table>
<div style="margin-top:50px;"><button onClick="window.print()" style="color:#900;">프린트</button></div>
</div>

<?
include_once('./tail.sub.php');
?>
