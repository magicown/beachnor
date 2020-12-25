<?php
include_once('./_common.php');
include_once('./head.sub.php');
if(!$_GET['code']){
	echo "전화번호를 입력하세요.";
	exit;	
}
?>



<form name="ftelform" id="ftelform" action="?" onsubmit="return ftelform_check(this);" method="post">
<input type="hidden" name="w" value="up">
<input type="hidden" name="ma_id" value="<?php echo $ma['ma_id'] ?>" id="ma_id">
<input type="hidden" name="token" value="<?php echo $token ?>" id="token">
<input type="hidden" name="tel" id="tel" value="<?php echo urldecode($_GET['code']); ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="tel_content">메세지 내용<strong class="sound_only">필수</strong></label></th>
        <td>
			<textarea name="tel_content" id="tel_content"></textarea>
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" class="btn_submit" accesskey="s" value="확인">
</div>
</form>

<script>
function ftelform_check(f)
{
	if(!f.tel_content.value){
		alert("내용을 입력하세요.");
	}else{
		var sendtel = $("#tel").val();
		var tel_contet = $("#tel_content").val();
		//alert(tel_contet);
		$.post("../jqmessage.php",{sendtel:sendtel,tel_content:tel_contet},
			function(data){
				if(data){
					alert("메세지 전송완료 하였습니다.");
					$("#tel_content").val('');
				}
			}
		);
		return false;
	}
	return false;
}

document.ftelform.tel_content.focus();
</script>


<?php
include_once('./tail.sub.php');
?>
