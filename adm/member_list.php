<?php
$sub_menu = "200100";
include_once('./_common.php');

//auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


$sql_search .= $slevel?" and `mb_level`=".$slevel:'';

if ($is_admin != 'super')
    //$sql_search .= " and mb_level <= '{$member['mb_level']}' ";
	$sql_search .= " and (mb_level = '6'||mb_level = '5') and mb_recommend = '{$member[mb_id]}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['PHP_SELF'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

//echo $sql;
$result = sql_query($sql);

$colspan = 16;
?>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
  <label for="sfl" class="sound_only">검색대상</label>
  <select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>성명</option>
  </select>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "   "); ?>>상호</option>
  </select>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "   "); ?>>담당자휴대폰</option>
  </select>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "   "); ?>>업체전화</option>
  </select>      
  <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
  <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
  <input type="submit" class="btn_submit" value="검색">
</form>
<div class="local_desc01 local_desc">
  <p> 회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다. </p>
</div>



<?php if ($is_admin == 'super' || $member['mb_level']==7) { ?>
<div class="btn_add01 btn_add"> <a href="./member_list.php" id="member_add">전체</a>  <? if($member['mb_level']>7){?><a href="./member_list.php?slevel=8" id="member_add">기관(업체)</a><? }?>  <a href="/dex_member_list.php?slevel=<?=$slevel?>&sfl=<?=$sfl?>&stx=<?=$stx?>" id="member_add">엑셀저장</a>  <a href="./member_form.php" id="member_add">회원추가</a> </div>
<?php } ?>
<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
  <input type="hidden" name="sst" value="<?php echo $sst ?>">
  <input type="hidden" name="sod" value="<?php echo $sod ?>">
  <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
  <input type="hidden" name="stx" value="<?php echo $stx ?>">
  <input type="hidden" name="page" value="<?php echo $page ?>">
  <div class="tbl_head02 tbl_wrap">
    <table>
      <caption>
      <?php echo $g5['title']; ?> 목록
      </caption>
      <thead>
        <tr>
          <th scope="col" id="mb_list_chk"> <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
          </th>
          <th scope="col" id="mb_list_id"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
          <th id="mb_list_mobile" scope="col">성명</th>
          <th id="mb_list_name" scope="col">상호</th>
          <th id="mb_list_mobile" scope="col">담당자휴대폰</th>
          <th id="mb_list_mobile" scope="col">업체전화</th>
          <th id="mb_list_name" scope="col">E-mail</th>
          <th id="mb_list_name" scope="col">주소</th>
          <th id="mb_list_name" scope="col">등록일</th>
          <th id="mb_list_name" scope="col">메모</th>
          <th id="mb_list_name" scope="col">상태</th>                                
          <th id="mb_list_auth" scope="col">회원구분</th>
          <th id="mb_list_auth" scope="col">그룹</th>
          <th scope="col" id="mb_list_mng">관리</th>
        </tr>
      </thead>
      <tbody>
        <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
            $s_del = '';
        } else {
            $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'">수정</a>';
            //$s_del = '<a href="javascript:post_delete(\'member_delete.php\', \''.$row['mb_id'].'\');">삭제</a>';
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
		
		
		$mb_birth_ex = explode("-",$row['mb_birth']);
		$nianling = date("Y")-$mb_birth_ex[0];
    ?>
        <tr class="<?php echo $bg; ?>">
          <td headers="mb_list_chk" class="td_chk"><input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo $row['mb_nick']; ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>"></td>
          <td headers="mb_list_id" class="td_name sv_use" style="width:60px !important"><?php echo $mb_id ?></td>
          <td class="td_mbname" headers="mb_list_name"><?php echo get_text($row['mb_name']); ?>  </td>
           <td class="mb_list_name" headers="mb_list_name">
		   
		   <?
           if($mb_birth_ex[1]){
		   ?>
		   <?=$nianling?>세 (<?php echo get_text($row['mb_birth']); ?>)  
           <? }?>
           
           
           </td>
          <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_hp']; ?></td>
          
        <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_tel']; ?></td>  
        
         <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_email']; ?></td>  
          
          <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_addr1']; ?> <?php echo $row['mb_addr2']; ?> <?php echo $row['mb_addr3']; ?></td> 

         <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['mb_4']; ?></td>  
         <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['']; ?></td>  
         <td class="mb_list_name" headers="mb_list_mobile"><?php echo $row['']; ?></td>                              
          
          <td class="td_mbstat" headers="mb_list_auth"> <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?></td>
          <td class="td_mbstat" headers="mb_list_auth">
		  
          <select id="mb_g[<?=$i?>]" name="mb_3[<?=$i?>]">
          <option value="">선택</option>
<option value="근로자" <? if($row['mb_3']=="근로자"){?> selected <? }?>>근로자</option>
<option value="기관" <? if($row['mb_3']=="기관"){?> selected <? }?>>기관(업체)</option>
</select>
	
          
          </td>
          <td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?></td>
        </tr>
        <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
      </tbody>
    </table>
  </div>
  <div class="btn_list01 btn_list">
  <!--	<input type="submit" name="act_button" value="선택메일보내기" onclick="document.pressed=this.value">
    <input type="submit" name="act_button" value="선택문자보내기" onclick="document.pressed=this.value">-->
    
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">
    
    <?
    if($is_admin||$member['mb_level']==7){
	?>
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
    <? }?>
    
  </div>
</form>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?> 
<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
	
 
	
	

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>
<?php
include_once ('./admin.tail.php');
?>
