<?
include_once('./_common.php');
if(!$is_admin) exit;
include dirname(__FILE__)."/api.class.php";

//API 객체생성
// sms.gabia.com 로그인 id와 로그인 후에 환경설정에서 생성한 api key
//id : sonyjs3   pw : good_114444
$api = new gabiaSmsApi('sonyjs2','b8b343231e846b77313f480bc66b788d');


$mb_tel = $_POST['sendtel'];
$content = $_POST['tel_content'];

$cheg = explode("-",$mb_tel);
if(!$cheg[1]){
	$tel_1 = substr($mb_tel,0,3);
	$tel_2 = substr($mb_tel,3,4);
	$tel_3 = substr($mb_tel,7,4);
	
	$mb_tel = $tel_1."-".$tel_2."-".$tel_3;
}

$oBuffer = $mb_tel;	


$titl = '시니어인력뱅크';
$meseg = $content;

//$oBuffer = array("010-9619-0114");	

//echo("남은건수 : " . $api->getSmsCount()."<br>");


/************************************한건씩 보낼수 있는 SMS_API***************************************************************************/

/*
foreach($oBuffer as $p)
{
	// 발송시에 _REF_KEY_는 나중에 개별적인 발송 결과를 확인하고자 할 때 사용되는 값입니다.
	// 고객 내부의 규칙에 따른 40byte 이내의 unique한 값을 넣어주시면 됩니다.
	//$r = $api->sms_send($p, "_CALL_BACK_","_MESSAGE_","_REF_KEY_","_RESERVE_DATE_");

	$r = $api->lms_send($p, "_CALL_BACK_", "_TITLE_", "_MESSAGE_", "_REF_KEY_", "_RESERVE_DATE_");

	if ($r == gabiaSmsApi::$RESULT_OK)
	{
		echo($p . " : " . $api->getResultMessage() . "<br>");
		echo("이전 : " . $api->getBefore() . "<br>");
		echo("이후 : " . $api->getAfter() . "<br>");
	}
	else echo("error : " . $p . " - " . $api->getResultCode() . " - " . $api->getResultMessage() . "<br>");
}
*/
// 발송 결과 값을 알고자 하는 ref key 값 설정.

$r = $api->lms_send($oBuffer, "_CALL_BACK_", $titl, $meseg, "_REF_KEY_", "_RESERVE_DATE_");

//$result = $api->get_status_by_ref("_REF_KEY_");
$result = $api->getResultCode ();
echo $result;//SUCC



/*********************************한번에 여러건 보낼 수 잇는 SMS_API***********************************************************************/
//$r = $api->multi_lms_send($oBuffer, "_CALL_BACK_", "_TITLE_", "_MESSAGE_", "_REF_KEY_", "_RESERVE_DATE_");

/*$r = $api->multi_sms_send($oBuffer,"_CALL_BACK_","_MESSAGE_","_REF_KEY_","_RESERVE_DATE_");
if($r == gabiaSmsApi::$RESULT_OK){

	$success_cnt = $api->get_success_cnt();
	$fail_list = $api->get_fail_list();
	echo "성공 : $success_cnt 개\n<br>";
	echo "실패 목록 : $fail_list\n<br>";
	echo "이전갯수 ".$api->getBefore()."\n<br>";
	echo "남은갯수 ".$api->getAfter()."\n<br>";

}else{
	echo("SEND FAIL – " . $api->getResultCode() . " : " . $api->getResultMessage());
}

$get_result = $api->get_status_by_ref_all('_REF_KEY_');

if($get_result){
	for($i=0; $i < count($get_result); $i++){
			echo ("전송 번호: ".$get_result[$i]["PHONE"]." 결과 : ".$get_result[$i]["MESG"]."<br>\n");
	}
}else{
	echo "검색 결과가 없습니다.";
}
*/

/*********************************예약취소***********************************************************************/
/*if($api->reservationCancel('_REF_KEY_', '_SEND_TYPE_', array('_CANCEL_PHONENUM'))){
	echo "예약이 취소되었습니다.";
}else{
	echo("error : ". $api->getResultCode() . " - " . $api->getResultMessage() . "<br>");
}*/

?>

