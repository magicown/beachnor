<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');


if(!$is_admin && $member['mb_level']!=9 && $member['mb_level']!=8 && $member['mb_level']!=7) alert('권한부족');

if($_POST['mb_name']){

$sql = " SELECT * FROM  `g5_member` WHERE `mb_level`='8' and `mb_name` LIKE  '%".$_POST['mb_name']."%'";
$list = sql_query($sql);


$board = sql_fetch($sql);

}

 
?>

<?

if($_GET['input']){ $input_h=$_GET['input'];}else{  $input_h=$_POST['input']; }
if($_GET['input_1']){ $input_1_h=$_GET['input_1'];}else{  $input_1_h=$_POST['input_1']; }
if($_GET['input_2']){ $input_2_h=$_GET['input_2'];}else{  $input_2_h=$_POST['input_2']; }
if($_GET['input_3']){ $input_3_h=$_GET['input_3'];}else{  $input_3_h=$_POST['input_3']; }
if($_GET['input_4']){ $input_4_h=$_GET['input_4'];}else{  $input_4_h=$_POST['input_4']; }
if($_GET['input_5']){ $input_5_h=$_GET['input_5'];}else{  $input_5_h=$_POST['input_5']; }
if($_GET['input_6']){ $input_6_h=$_GET['input_6'];}else{  $input_6_h=$_POST['input_6']; }

?>
<div class="name_ss_box">
<h1>기관(업체)검색</h1>

<div>
<form id="name_ss" action="?" method="post">
<input type="hidden" name="input" value="<?=$input_h?>">
<input type="hidden" name="input_1" value="<?=$input_1_h?>">
<input type="hidden" name="input_2" value="<?=$input_2_h?>">
<input type="hidden" name="input_3" value="<?=$input_3_h?>">
<input type="hidden" name="input_4" value="<?=$input_4_h?>">
<input type="hidden" name="input_5" value="<?=$input_5_h?>">
<input type="hidden" name="input_6" value="<?=$input_6_h?>">
<input type="text" name="mb_name" required value="<?=$_POST['mb_name']?>" class="frm_input required">
<input type="submit" value="검색" class="button blue">
</form>
</div>
<p>기관(업체)명으로 검색하세요</p>


<div class="ss_list">

<table>
<?
 for ($i=0; $row = sql_fetch_array($list); $i++) {
 
		?>
	 
    <td><a href="javascript:;" onclick="find_zip('<?=$row['mb_name']?>', '<?=$row['mb_1']?>', '<?=$row['mb_id']?>', '<?=$row['mb_hp']?>', '<?=$row['mb_5']?>', '<?=$row['mb_hp']?>', '<?=$row['mb_tel']?>');"><?=$row['mb_name']?>(<?=$row['mb_id']?>)</a></td>
<? }?>

 <?
  if(!$board['mb_id']){
 ?>
 
 <td>검색된 자료가 없습니다.</td>
 <? }?>

</table>
</div>
</div>

<script type="text/javascript">
function find_zip(a, b, c, d,e,f,g)
{
    var of = opener.document.fwrite;

    of.<?=$_POST['input']?>.value  = a;
	
	<?
	if($_POST['input_1']){
	?>
 	of.<?=$_POST['input_1']?>.value  = b;
	<?
	}
	?>
	
	<?
	if($_POST['input_2']){
	?>
	of.<?=$_POST['input_2']?>.value  = c;
	<?
	}
	?>
	
	
	<?
	if($_POST['input_3']){
	?>
	of.<?=$_POST['input_3']?>.value  = d;
	<?
	}
	?>


	<?
	if($_POST['input_4']){
	?>
	of.<?=$_POST['input_4']?>.value  = e;
	<?
	}
	?>

	<?
	if($_POST['input_5']){
	?>
	of.<?=$_POST['input_5']?>.value  = f;
	<?
	}
	?>

	<?
	if($_POST['input_6']){
	?>
	of.<?=$_POST['input_6']?>.value  = g;
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