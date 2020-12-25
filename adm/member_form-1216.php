<?php
$sub_menu = "200100";
include_once('./_common.php');

//auth_check($auth[$sub_menu], 'w');

$token = get_token();

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';

if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>


<link type="text/css" href="/css/jquery-ui.css" rel="stylesheet" />
<style>
.ui-datepicker {
	font: 12px dotum;
}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
	width: 70px;
}
.ui-datepicker-trigger {
	margin: 0 0 -5px 2px;
}
</style>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script>
jQuery(function($){
    $.datepicker.regional["ko"] = {
        closeText: "닫기",
        prevText: "이전달",
        nextText: "다음달",
        currentText: "오늘",
        monthNames: ["1월(JAN)","2월(FEB)","3월(MAR)","4월(APR)","5월(MAY)","6월(JUN)", "7월(JUL)","8월(AUG)","9월(SEP)","10월(OCT)","11월(NOV)","12월(DEC)"],
        monthNamesShort: ["1월","2월","3월","4월","5월","6월", "7월","8월","9월","10월","11월","12월"],
        dayNames: ["일","월","화","수","목","금","토"],
        dayNamesShort: ["일","월","화","수","목","금","토"],
        dayNamesMin: ["일","월","화","수","목","금","토"],
        weekHeader: "Wk",
        dateFormat: "yymmdd",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        yearSuffix: ""
    };
	$.datepicker.setDefaults($.datepicker.regional["ko"]);
});
</script>



<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">
<input type="hidden" name="mb_nick" value="<?php echo $mb['mb_name'] ?>">
<input type="hidden" name="mb_2" value="<?=$mb['mb_2']?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">  
            
            
            <!--<input type="checkbox" name="mb_8" value="정규직" <? if($mb['mb_8']=="정규직"){?> checked <? }?>> 정규직-->
            
            </td>
       <th scope="row">소속</th>
        <td>
        
        
        <?
        if($mb['mb_recommend']){
		?>
         <input type="hidden" name="mb_recommend" value="<?=$member['mb_id']?>">
       <?php /*?> <select name="mb_recommend">
        
        <?
        $sql = " SELECT * FROM  `g5_member` WHERE  `mb_level` =7 ";
		$result = sql_query($sql);
		 for ($i=0; $row=sql_fetch_array($result); $i++) {
		?>
        <option value="<?=$row['mb_id']?>"><?=$row['mb_name']?></option>
        <? }?>
        
        </select>  <?php */?>    
        
        지점
        <? }else{?>
        
        <?
        if($member['mb_level']==7){
		?>
         <input type="hidden" name="mb_recommend" value="<?=$member['mb_id']?>">
        지점회원
        
        <? }else{?>
        
       		본사
        <? }?>
        
        
        <? }?>
        
        
        
        
        
        
        </td>
        <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">이름(기관명)<strong class="sound_only">필수</strong></label></th>
        <td colspan="3"><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" minlength="2" maxlength="20"></td>
        <th scope="row">회원 권한</th>
        <td>
		
		<?
        if($is_admin){
		?>
		<?php echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level'],"onchange=\"selchange();\"") ?>
        <? }else{?>
        
        <select name="mb_level">
        <option value="6">근로자</option>
        </select>
        
        <? }?>
        
        </td>
    </tr>
    
    
    <tr>
        <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <td colspan="3"><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
        <th scope="row"><label for="mb_tel">전화번호</label></th>
        <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
    </tr>
    
    
    
     <tr>
        <th scope="row">반</th>
        <td colspan="3"><input type="text" name="mb_1" value="<?php echo $mb['mb_1'] ?>" id="mb_1" class="frm_input" size="15" maxlength="20"></td>
       <th scope="row"><label for="mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100" required class="required frm_input email" size="30"></td>
    </tr>
    
    
    
    
      <tr>
        <th scope="row">성별</th>
        <td colspan="3">
        
         <select name="mb_sex">
         
            	<option value="남" <? if($mb['mb_sex'] =="남"){?> selected<? }?>>남</option>
                <option value="여" <? if($mb['mb_sex'] =="여"){?> selected<? }?>>여</option>
            </select>
        
        </td>
       <th scope="row">생년월일</th>
        <td>
        <?php /*?><select name="mb_birth" required>
        <option value="">선택</option>
        <? for($i=2015; $i>1950; $i--){?>
            	<option value="<?=$i?>" <? if($mb['mb_birth'] ==$i){?> selected<? }?>><?=$i?></option>
          <? }?>     
            </select><?php */?>
       
       
       
       <input type="text" name="mb_birth" value="<?=$mb['mb_birth']?>" id="mb_birth" class="frm_input" size="13" maxlength="10">
       
       
       
       </td>
    </tr>
    
    
    
    <tr class="lev8">
        <th scope="row">담당자</th>
        <td colspan="5">
        <input type="text" name="mb_5" value="<?php echo $mb['mb_5'] ?>" id="mb_5" class="frm_input" size="30" maxlength="40">
        </td>
    </tr>
    <tr class="lev9">
        <th scope="row">전화번호</th>
        <td colspan="5">
        <input type="text" name="mb_6" value="<?php echo $mb['mb_6'] ?>" id="mb_6" class="frm_input" size="30" maxlength="40">
        </td>
    </tr>
    <tr class="lev10">
        <th scope="row">휴대폰번호</th>
        <td colspan="5">
        <input type="text" name="mb_7" value="<?php echo $mb['mb_7'] ?>" id="mb_7" class="frm_input" size="30" maxlength="40">
        </td>
    </tr>
    <script type="text/javascript">
		
		function selchange(){
			var mb_lv = $("#mb_level").val();
			if(mb_lv==8){
				$(".lev8").show();
			}else{
				$(".lev8").hide();
				$(".lev9").hide();
				$(".lev10").hide();
			}
		}
		selchange();

	
	</script>
    
    
    
    <tr>
        <th scope="row"><label for="bf_file">회원사진</label></th>
        <td colspan="5">
        <? if($mb['mb_2']){?>
             <img src="/data/member_photo/<?=$mb['mb_2']?>" width="120" height="100">
             <? }?>
            <input type="file" name="bf_file[]"  id="bf_file">
            
             <?php if($w == 'u' && $mb['mb_2']) { ?>
                <input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1"> <label for="bf_file_del0"><?php echo $mb_2['mb_2']; ?> 파일 삭제</label>
                <?php } ?>
         
        </td>
    </tr>

    <tr>
        <th scope="row">FAX</th>
        <td colspan="5">
        <input type="text" name="mb_4" value="<?php echo $mb['mb_4'] ?>" id="mb_4" class="frm_input" size="30" maxlength="40">
        </td>
    </tr>
    
    
    
    <tr>
        <th scope="row"><label for="mb_zip1">주소</label></th>
        <td colspan="5" class="td_addr_line">
            <label for="mb_zip1" class="sound_only">우편번호 앞자리</label>
            <input type="text" name="mb_zip1" value="<?php echo $mb['mb_zip1'] ?>" id="mb_zip1" class="frm_input readonly" size="3" maxlength="3"> -
            <label for="mb_zip2" class="sound_only">우편번호 뒷자리</label>
            <input type="text" name="mb_zip2" value="<?php echo $mb['mb_zip2'] ?>" id="mb_zip2" class="frm_input readonly" size="3" maxlength="3">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
    </tr>
    
    
    <tr>
      <th scope="row"><label for="mb_memo">메모</label></th>
      <td colspan="5"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
    </tr>


    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>
function fmember_submit(f)
{
/*    if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
        alert('아이콘은 gif 파일만 가능합니다.');
        return false;
    }

    return true;*/
}
</script>
  <script>
$(function(){
    $("#mb_birth").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});
</script> 
<?php
include_once('./admin.tail.php');
?>
