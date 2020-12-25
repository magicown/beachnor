<?php
include_once('./_common.php');
include_once('./head.sub.php');

$wr_subject = '부천지점';

?>
  <style>
 body{   font-size: 18px;}
 
 </style>
<div id="pint_box">
<table   border="0" cellspacing="0" cellpadding="0">
  <caption style="font-size:20px;">지점별 정산 현황 보고서(년간)</caption>
  <tr align="center">
    <th scope="row">지점명:</th>
    <td>부천지점</td>
    <td>기간:</td>
    <td colspan="2"><?=date('Y')?>년 01월 01일 ~ <?=date('Y')?>년 12월 31일</td>
  </tr>
  <tr align="center">
    <th scope="row">년/월</th>
    <td>입금액</td>
    <td>파견인원</td>
    <td>입금일</td>
    <td>상태</td>
  </tr>
  
  <?
  for($i=1;$i<13;$i++){
	  
	  
	$sql = "select SUM(wr_4) as tal1,SUM(wr_content) as tal2 from g5_write_a_5 where wr_is_comment = 0 and `wr_datetime`>='".date('Y')."-0".$i."-01 00:00:00"."' and  `wr_datetime`<'".date('Y')."-0".($i+1)."-01 00:00:00"."'";
	$row = sql_fetch($sql);
	
	if($row['tal1']){
		$yuan_1 = $row['tal1'];
		
	}else{
		$yuan_1 = 0;
	}
	 
	 
	 if($row['tal2']){
		$renshu = $row['tal2'];
		
	}else{
		$renshu = 0;
	}
	 
	 
	 $yuan_heji[] =  $yuan_1;
  ?>
  
  <tr align="center">
    <th scope="row"><?=date('Y')?>년<?=$i?>월</th>
    <td><?=number_format($yuan_1);?> 원</td>
    <td><?=$renshu?> 명</td>
    <td></td>
    <td></td>
  </tr>
  <?
  }
  ?>
  <tr>
  	<td colspan="5" align="right">합계 : <span style="font-size:14px; font-weight:bold; color:#FF3135"><?=number_format(array_sum($yuan_heji));?></span> 원</td>
  </tr>
</table>
<div style="margin-top:50px;"><button onClick="window.print()" style="color:#900;">프린트</button></div>
</div>

<?
include_once('./tail.sub.php');
?>

