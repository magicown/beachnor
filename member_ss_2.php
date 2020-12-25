<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');


if(!$is_admin && $member['mb_level']!=9) alert('권한부족');

if($_POST['mb_name']){

$sql = " SELECT * FROM  `g5_member` WHERE  `mb_name` LIKE  '%".$_POST['mb_name']."%'";
$list = sql_query($sql);


$board = sql_fetch($sql);

}

 
?>

<?

if($_GET['input']){ $input_h=$_GET['input'];}else{  $input_h=$_POST['input']; }
if($_GET['input_1']){ $input_1_h=$_GET['input_1'];}else{  $input_1_h=$_POST['input_1']; }
/*if($_GET['input_2']){ $input_2_h=$_GET['input_2'];}else{  $input_2_h=$_POST['input_2']; }
if($_GET['input_3']){ $input_3_h=$_GET['input_3'];}else{  $input_3_h=$_POST['input_3']; }
if($_GET['input_4']){ $input_4_h=$_GET['input_4'];}else{  $input_4_h=$_POST['input_4']; }
if($_GET['input_5']){ $input_5_h=$_GET['input_5'];}else{  $input_5_h=$_POST['input_5']; }
if($_GET['input_6']){ $input_6_h=$_GET['input_6'];}else{  $input_6_h=$_POST['input_6']; }*/

?>

<div class="name_ss_box">
<h1>회원검색</h1>

<div>
<form id="name_ss" action="?" method="post">
<input type="hidden" name="input" value="<?=$input_h?>">
<input type="hidden" name="input_1" value="<?=$input_1_h?>">
<input type="text" name="mb_name" required value="<?=$_POST['mb_name']?>" class="frm_input required">
<input type="submit" value="검색" class="button blue">
</form>
</div>
<p>회원 이름으로 검색하세요</p>


<div class="ss_list">

<table>
<?
 for ($i=0; $row = sql_fetch_array($list); $i++) {
 
		?>
	 
    <td><a href="javascript:;" onclick="find_zip('<?=$row['mb_name']?>', '<?=$row['mb_sex']?>', '<?=$row['mb_birth']?>', '<?=$row['mb_hp']?>', '<?=$row['mb_email']?>', '<?=$row['mb_addr1']?> <?=$row['mb_addr2']?>', '<?=$row['mb_id']?>');"><?=$row['mb_name']?>(<?=$row['mb_id']?>)</a></td>
<? }?>

 <?
  if(!$board['mb_id']){
 ?>
 
 <td>검색된 회원이 없습니다.</td>
 <? }?>

</table>
</div>
</div>

<script type="text/javascript">
function find_zip(a, b, c, d, e, f, g)
{
    var of = opener.document.fwrite;

    of.<?=$_POST['input']?>.value  = g;
	
	<?
	if($_POST['input_1']){
	?>
 	of.<?=$_POST['input_1']?>.value  = a;
	<?
	}
	?>
  //  of.mb_addr2.focus();
    window.close();
    return false;
}
</script>



<?
include_once(G5_PATH.'/tail.sub.php');
?>