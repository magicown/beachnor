<?php
include_once('./_common.php');

$count = count($_POST['chk_wr_id']);

if(!$count) {
    alert($_POST['btn_submit'].' 하실 항목을 하나 이상 선택하세요.');
}

if($_POST['btn_submit'] == '선택삭제') {
    include './delete_all.php';
} else if($_POST['btn_submit'] == '선택복사') {
    $sw = 'copy';
    include './move.php';
} else if($_POST['btn_submit'] == '선택이동') {
    $sw = 'move';
    include './move.php';
} else if($_POST['btn_submit'] == '메일보내기') {
   
    include './email_all_form.php';
	
} else if($_POST['btn_submit'] == '문자보내기') {
   
    include './sns_all_form.php';
	
}else {
    alert('올바른 방법으로 이용해 주세요.');
}
?>