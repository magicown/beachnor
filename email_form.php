<?php
include_once('./_common.php');
include_once('./head.sub.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');

if(!$is_admin) exit;


$sql = " select `mb_email`,`mb_name` from `g5_member` where mb_id = '".$_GET['mb_id']."' ";
$list = sql_fetch($sql);

 
 
if($_POST['w']=="up"){
	
	
	
mailer('시니어인력뱅크', $config['cf_admin_email'], $_POST['mb_email'], $_POST['ma_subject'], '<span style="font-size:9pt;">[시니어인력뱅크] '.$_POST[ma_content].'</span>', 1);

 	echo "<script type=\"text/javascript\">alert('메일을 정상적으로 보냈습니다'); window.close();</script>";
}
?>



<form name="fmailform" id="fmailform" action="?" onsubmit="return fmailform_check(this);" method="post">
<input type="hidden" name="w" value="up">
<input type="hidden" name="mb_email" value="<?=$list['mb_email']?>">


<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption>메일보내기</caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">받는사람</th>
        <td><?=$list['mb_name']?>(<?=$list['mb_email']?>)</td>
    </tr>
    
    
    <tr>
        <th scope="row"><label for="ma_subject">메일 제목<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="ma_subject" value="" id="ma_subject" required class="required frm_input" size="60"></td>
    </tr>
    <tr>
        <th scope="row"><label for="ma_content">메일 내용<strong class="sound_only">필수</strong></label></th>
        <td>
			<textarea name="ma_content" style="height:250px"></textarea>
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit"  class="button blue" accesskey="s" value="보내기">
</div>
</form>

<script>
function fmailform_check(f)
{
    errmsg = "";
    errfld = "";

    check_field(f.ma_subject, "제목을 입력하세요.");
    //check_field(f.ma_content, "내용을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    
    return true;
}

document.fmailform.ma_subject.focus();
</script>


<?php
include_once('./tail.sub.php');
?>
