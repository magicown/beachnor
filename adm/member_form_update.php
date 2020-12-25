<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

//auth_check($auth[$sub_menu], 'w');

check_token();

$mb_id = trim($_POST['mb_id']);

// 휴대폰번호 체크
/*$mb_hp = hyphen_hp_number($_POST['mb_hp']);
if($mb_hp) {
    $result = exist_mb_hp($mb_hp, $mb_id);
    if ($result)
        alert($result);
}*/

// 인증정보처리
if($_POST['mb_certify_case'] && $_POST['mb_certify']) {
    $mb_certify = $_POST['mb_certify_case'];
    $mb_adult = $_POST['mb_adult'];
} else {
    $mb_certify = '';
    $mb_adult = 0;
}

$sql_common = "  mb_name = '{$_POST['mb_name']}',
				mb_sex = '{$_POST['mb_sex']}',
				mb_birth = '{$_POST['mb_birth']}',
                 mb_nick = '{$_POST['mb_nick']}',
                 mb_email = '{$_POST['mb_email']}',
                 mb_homepage = '{$_POST['mb_homepage']}',
                 mb_tel = '{$_POST['mb_tel']}',
                 mb_hp = '{$mb_hp}',
                 mb_certify = '{$mb_certify}',
                 mb_adult = '{$mb_adult}',
                 mb_zip1 = '{$_POST['mb_zip1']}',
                 mb_zip2 = '{$_POST['mb_zip2']}',
                 mb_addr1 = '{$_POST['mb_addr1']}',
                 mb_addr2 = '{$_POST['mb_addr2']}',
                 mb_addr3 = '{$_POST['mb_addr3']}',
                 mb_addr_jibeon = '{$_POST['mb_addr_jibeon']}',
                 mb_signature = '{$_POST['mb_signature']}',
                 mb_leave_date = '{$_POST['mb_leave_date']}',
                 mb_intercept_date='{$_POST['mb_intercept_date']}',
                 mb_memo = '{$_POST['mb_memo']}',
				 mb_recommend = '{$_POST['mb_recommend']}',
                 mb_mailling = '{$_POST['mb_mailling']}',
                 mb_sms = '{$_POST['mb_sms']}',
                 mb_open = '{$_POST['mb_open']}',
                 mb_profile = '{$_POST['mb_profile']}',
                 mb_level = '{$_POST['mb_level']}',
                 mb_1 = '{$_POST['mb_1']}',
                 mb_2 = '{$_POST['mb_2']}',
                 mb_3 = '{$_POST['mb_3']}',
                 mb_4 = '{$_POST['mb_4']}',
                 mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}',
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}' ";

if ($w == '')
{
    $mb = get_member($mb_id);
    if ($mb['mb_id'])
        alert('이미 존재하는 회원아이디입니다.\\nＩＤ : '.$mb['mb_id'].'\\n이름 : '.$mb['mb_name'].'\\n닉네임 : '.$mb['mb_nick'].'\\n메일 : '.$mb['mb_email']);

    // 닉네임중복체크
 //   $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' ";
   // $row = sql_fetch($sql);
  //  if ($row['mb_id'])
   //     alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);

    // 이메일중복체크
   /* $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);*/
		



    sql_query(" insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".sql_password($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} ");
	
	
	
	
	
	
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    if ($_POST['mb_id'] == $member['mb_id'] && $_POST['mb_level'] != $mb['mb_level'])
        alert($mb['mb_id'].' : 로그인 중인 관리자 레벨은 수정 할 수 없습니다.');

    // 닉네임중복체크
   /* $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_nick = '{$_POST['mb_nick']}' and mb_id <> '$mb_id' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 닉네임입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);*/

    // 이메일중복체크
  /*  $sql = " select mb_id, mb_name, mb_nick, mb_email from {$g5['member_table']} where mb_email = '{$_POST['mb_email']}' and mb_id <> '$mb_id' ";
    $row = sql_fetch($sql);
    if ($row['mb_id'])
        alert('이미 존재하는 이메일입니다.\\nＩＤ : '.$row['mb_id'].'\\n이름 : '.$row['mb_name'].'\\n닉네임 : '.$row['mb_nick'].'\\n메일 : '.$row['mb_email']);*/

    $mb_dir = substr($mb_id,0,2);

    // 회원 아이콘 삭제
    if ($del_mb_icon)
        @unlink(G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif');

    // 아이콘 업로드
    if (is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
        if (!preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
            alert($_FILES['mb_icon']['name'] . '은(는) gif 파일이 아닙니다.');
        }

        if (preg_match("/(\.gif)$/i", $_FILES['mb_icon']['name'])) {
            @mkdir(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);
            @chmod(G5_DATA_PATH.'/member/'.$mb_dir, G5_DIR_PERMISSION);

            $dest_path = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif';

            move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);

            if (file_exists($dest_path)) {
                $size = getimagesize($dest_path);
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config['cf_member_icon_width'] || $size[1] > $config['cf_member_icon_height']) {
                    @unlink($dest_path);
                }
            }
        }
    }

    if ($mb_password)
        $sql_password = " , mb_password = '".sql_password($mb_password)."' ";
    else
        $sql_password = "";

    if ($passive_certify)
        $sql_certify = " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    else
        $sql_certify = "";

    $sql = " update {$g5['member_table']}
                set {$sql_common}
                     {$sql_password}
                     {$sql_certify}
                where mb_id = '{$mb_id}' ";
    sql_query($sql);
}
//else
   // alert('제대로 된 값이 넘어오지 않았습니다.');
   
   
   
   
	
	 


/////////////////////회원포토//////////////////////////////////////////////////

if($_FILES['bf_file']['tmp_name'][0]){	//이미지가 있을때만이	
		
			// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
	@mkdir(G5_DATA_PATH.'/member_photo', G5_DIR_PERMISSION);
	@chmod(G5_DATA_PATH.'/member_photo', G5_DIR_PERMISSION);
	$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
	
	
	
	// 가변 파일 업로드
	$file_upload_msg = '';
	$upload = array();
	for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
		$upload[$i]['file']     = '';
		$upload[$i]['source']   = '';
		$upload[$i]['filesize'] = 0;
		$upload[$i]['image']    = array();
		$upload[$i]['image'][0] = '';
		$upload[$i]['image'][1] = '';
		$upload[$i]['image'][2] = '';
	
		// 삭제에 체크가 되어있다면 파일을 삭제합니다.
		if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
			$upload[$i]['del_check'] = true;
	
			$row = sql_fetch(" select `mb_2` from `g5_member` where mb_id = '{$mb_id}' ");
			
			@unlink(G5_DATA_PATH.'/member_photo/'.$row['mb_2']);
			// 썸네일삭제
			if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['mb_2'])) {
				delete_board_thumbnail("member_photo", $row['mb_2']);
			}
		}
		else
			$upload[$i]['del_check'] = false;
	
		$tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
		$filesize  = $_FILES['bf_file']['size'][$i];
		$filename  = $_FILES['bf_file']['name'][$i];
		$filename  = get_safe_filename($filename);
		
	 
	
		// 서버에 설정된 값보다 큰파일을 업로드 한다면
		if ($filename) {
			if ($_FILES['bf_file']['error'][$i] == 1) {
				$file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
				continue;
			}
			else if ($_FILES['bf_file']['error'][$i] != 0) {
				$file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
				continue;
			}
		}
	
		if (is_uploaded_file($tmp_file)) {
			// 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
			if (!$is_admin && $filesize > $board['bo_upload_size']) {
				$file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
				continue;
			}
	
			//=================================================================\
			// 090714
			// 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
			// 에러메세지는 출력하지 않는다.
			//-----------------------------------------------------------------
			$timg = @getimagesize($tmp_file);
			// image type
			if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
				 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
				if ($timg['2'] < 1 || $timg['2'] > 16)
					continue;
			}
			//=================================================================
	
			$upload[$i]['image'] = $timg;
	
			// 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
			if ($w == 'u') {
				// 존재하는 파일이 있다면 삭제합니다.
			   
				$row = sql_fetch(" select `mb_2` from `g5_member` where mb_id = '{$mb_id}' ");
				@unlink(G5_DATA_PATH.'/member_photo/'.$row['mb_2']);
				// 이미지파일이면 썸네일삭제
				if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['mb_2'])) {
					delete_board_thumbnail("member_photo", $row['mb_2']);
				}
			}
	
			// 프로그램 원래 파일명
			$upload[$i]['source'] = $filename;
			$upload[$i]['filesize'] = $filesize;
	
			// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
			$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
	
			shuffle($chars_array);
			$shuffle = implode('', $chars_array);
	
			// 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
			$upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename)));
	
			$dest_file = G5_DATA_PATH.'/member_photo/'.$upload[$i]['file'];
	
			// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);
	
	
			// 올라간 파일의 퍼미션을 변경합니다.
			chmod($dest_file, G5_FILE_PERMISSION);
		}
		
		
		
	
		 $sql = "UPDATE  `g5_member` SET  `mb_2` =  '{$upload[$i]['file']}'  where mb_id = '{$mb_id}' ";
		
		sql_query($sql);
		
		
		
		
		
	}


}

///////////////////////////////////////////////////////////////////////



goto_url("./member_list.php");
//goto_url('./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>