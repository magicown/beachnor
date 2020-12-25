<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $is_category = true;
    $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table;

    $category_option .= '<li><a href="'.$category_href.'"';
    if ($sca=='')
        $category_option .= ' id="bo_cate_on"';
    $category_option .= '>전체</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
    for ($i=0; $i<count($categories); $i++) {
        $category = trim($categories[$i]);
        if ($category=='') continue;
        $category_option .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
        $category_msg = '';
        if ($category==$sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            $category_msg = '<span class="sound_only">열린 분류 </span>';
        }
        $category_option .= '>'.$category_msg.$category.'</a></li>';
    }
}

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';


//검색시 추가
$search_or = false;	
if($sca || $stx || $s_subject || $s_content || $s_homepage || $s_link1 || $s_link2 || $s_1 || $s_2 || $s_4 || $s_5 || $s_6 || $s_14 || $s_15 || $s_16 || $sdate1 || $edate1 || $sdate2 || $edate2 || ($bo_table=='a_8'&&$member['mb_level']<10)|| ($bo_table=='a_1'&&$member['mb_level']<10) || ($bo_table=='a_2'&&$member['mb_level']<10)){
	$search_or = true;
	$search_lk = '&amp;s_subject='.$s_subject.'&amp;s_content='.$s_content.'&amp;s_homepage='.$s_homepage.'&amp;s_link1='.$s_link1.'&amp;s_link2='.$s_link2.'&amp;s_1='.$s_1.'&amp;s_2='.$s_2.'&amp;s_4='.$s_4.'&amp;s_5='.$s_5.'&amp;s_6='.$s_6.'&amp;s_14='.$s_14.'&amp;s_15='.$s_15.'&amp;s_16='.$s_16.'&amp;sdate1='.$sdate1.'&amp;edate1='.$edate1.'&amp;sdate2='.$sdate2.'&amp;edate2='.$edate2;
}

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($search_or) {

    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);
    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];
	if(!$sca) $sql_search = 1;
    if (!$spt) $spt = $min_spt;
    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";
	
	
	
	//인력파견현황 검색
	if($bo_table=='a_1'){
		$sql_search .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
		$sql_search .= $s_content?" and `wr_content` = '".$s_content."'":'';
		$sql_search .= $s_link1?" and `wr_link1` like '%".$s_link1."%'":'';
		$sql_search .= $s_4?" and `wr_4` like '%".$s_4."%'":'';
		$sql_search .= $s_5?" and `wr_5` like '%".$s_5."%'":'';
		$sql_search .= $s_6?" and `wr_6` like '%".$s_6."%'":'';
		$sql_search .= $sdate1?" and `wr_7`>='{$sdate1}' ":'';
		$sql_search .= $edate1?" and `wr_7`<='{$edate1}' ":'';
		$sql_search .= $sdate2?" and `wr_8`>='{$sdate2}' ":'';
		$sql_search .= $edate2?" and `wr_8`<='{$edate2}' ":'';
		//자기지점만 나오게 관리자빼고
		if(!$is_admin){
		$sql_search = $member['mb_level']<10?$sql_search." and `mb_id`='".$member['mb_id']."'":$sql_search;
		
		}else{
		$sql_search = $sql_search;	
		}
	}
	
	
	
	//대근관리 검색
	if($bo_table=='a_2'){
		$sql_search .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
		$sql_search .= $s_1?" and `wr_1` like '%".$s_1."%'":'';
		$sql_search .= $s_link1?" and `wr_link1` like '%".$s_link1."%'":'';
		$sql_search .= $s_content?" and `wr_content` like '%".$s_content."%'":'';
		$sql_search .= $sdate1?" and `wr_2`>='{$sdate1}' ":'';
		$sql_search .= $edate1?" and `wr_2`<='{$edate1}' ":'';
		//해당 기관 인력만 나오게 하기
		$sql_search = $sql_search." and `wr_1`='".$member['mb_name']."' ";
	}
	
	//실적현황 검색
	if($bo_table=='a_3'){
		$sql_search .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
		$sql_search .= $s_1?" and `wr_1` like '%".$s_1."%'":'';
		$sql_search .= $s_2?" and `wr_2` like '%".$s_2."%'":'';
		$sql_search .= $s_4?" and `wr_1` like '%".$s_1."%'":'';
		$sql_search .= $s_link2?" and `wr_link1` like '%".$s_link1."%'":'';
		$sql_search .= $s_content?" and `wr_content` like '%".$s_content."%'":'';
		$sql_search .= $sdate1?" and `wr_3`>='{$sdate1}' ":'';
		$sql_search .= $edate1?" and `wr_3`<='{$edate1}' ":'';
	}
	
	//파견인력 현황 보고서 검색
	if($bo_table=='a_4'){
		$sql_search .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
		$sql_search .= $s_content?" and `wr_content` = '".$s_content."'":'';
		$sql_search .= $s_link1?" and `wr_link1` like '%".$s_link1."%'":'';
		$sql_search .= $s_1?" and `wr_1` like '%".$s_1."%'":'';
		$sql_search .= $s_2?" and `wr_2` like '%".$s_2."%'":'';
		$sql_search .= $s_homepage?" and `wr_homepage` like '%".$s_homepage."%'":'';
		$sql_search .= $sdate1?" and `wr_3`>='{$sdate1}' ":'';
		$sql_search .= $edate1?" and `wr_3`<='{$edate1}' ":'';
		$sql_search .= $sdate2?" and `wr_4`>='{$sdate2}' ":'';
		$sql_search .= $edate2?" and `wr_4`<='{$edate2}' ":'';
	}
	
	//지점별 정산 현황 보고서 검색
	if($bo_table=='a_5'){
		$sql_search .= $s_subject?" and `wr_subject` like '%".$s_subject."%'":'';
		$sql_search .= $s_4?" and `wr_4` like '%".$s_4."%'":'';
		$sql_search .= $s_content?" and `wr_content` like '%".$s_content."%'":'';
		$sql_search .= $sdate1?" and `wr_3`>='{$sdate1}' ":'';
		$sql_search .= $edate1?" and `wr_3`<='{$edate1}' ":'';
	}
	
	
	//1:1게시판
	if($bo_table=='a_8'){
		$sql_search = $sql_search." and (`mb_id`='".$member['mb_id']."' or `wr_1`='".$member['mb_id']."' ";
		if($member['mb_3']){
			$sql_search .= " or `wr_2`='".$member['mb_3']."')";
		}else{
			
			$sql_search .= " )";
		}
		
	}
	
	
	
    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.co.kr/bbs/board.php?bo_table=g5_bug&wr_id=2922
    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
	

    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = mysql_num_rows($result);
    */
} else {
    $sql_search = "";

    $total_count = $board['bo_count_write'];
}

if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

// 공지 처리
if (!$sca && !$stx) {
    $arr_notice = explode(',', trim($board['bo_notice']));
    $from_notice_idx = ($page - 1) * $page_rows;
    if($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' ");

        if (!$row['wr_id']) continue;

        $notice_array[] = $row['wr_id'];

        if($k < $from_notice_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if($notice_count >= $list_page_rows)
            break;
    }
}

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    $from_record -= count($notice_array);

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

if ($search_or) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
	
	/////////////////////////인력파견현황일때 파견종료된것 관리자만 보이게
	if($is_admin && $bo_table=="a_1"){
    	$sql = " select * from {$write_table} where wr_is_comment = 0 ";
	}else{
		
		if($bo_table=="a_1"){
			$sql = " select * from {$write_table} where wr_is_comment = 0 and (to_days( now() ) - to_days(wr_8)) <30 ";
		}else{
		
			$sql = " select * from {$write_table} where wr_is_comment = 0 ";
		}
	}
	//////////////////////////////////////////////////////////////////
	
	
    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}


//echo $sql;

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if($page_rows > 0) {
    $result = sql_query($sql);

    $k = 0;

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($search_or)
            $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.$search_lk.'&amp;page=');

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx) {
    $list_href = './board.php?bo_table='.$bo_table;

    $patterns = array('#&amp;page=[0-9]*#', '#&amp;spt=[0-9\-]*#');

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $prev_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$prev_spt.'&amp;page=1';
        $write_pages = page_insertbefore($write_pages, '<a href="'.$prev_part_href.'" class="pg_page pg_prev">이전검색</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $next_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$next_spt.'&amp;page=1';
        $write_pages = page_insertafter($write_pages, '<a href="'.$next_part_href.'" class="pg_page pg_end">다음검색</a>');
    }
}


$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = './write.php?bo_table='.$bo_table;
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = './rss.php?bo_table='.$bo_table;
}

$stx = get_text(stripslashes($stx));
include_once($board_skin_path.'/list.skin.php');
?>
