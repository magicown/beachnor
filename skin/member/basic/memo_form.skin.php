<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 보내기 시작 { -->
 <style>
 #container_title{ margin:0 auto; width:980px;}
 </style>
<div id="bo_w">

<div id="memo_write" class="new_win mbskin">
   



    <form name="fmemoform" action="<?php echo $memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="bo_table" value="memo_form_up_file">
    
    
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>업무쓰기</caption>
        <tbody>
        <tr>
            <th scope="row"><label for="me_recv_mb_id">받는 회원아이디<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" required class="frm_input required" size="47">
               여러 회원에게 보낼때는 컴마(,)로 구분하세요. 
            </td>
        </tr>
        
        
         <tr>
            <th scope="row">제목</th>
            <td>
                <input type="text" name="me_recv_subjet" value="<?php echo $me_recv_subjet ?>" id="me_recv_subjet" required class="frm_input required" size="47">
               
            </td>
        </tr>
        
        
        
        <tr>
            <th scope="row">첨부파일<? print_r($file);?></th>
            <td>
              <input type="file" name="bf_file[]"  id="bf_file">
            
             <?php if($w == 'u' && $mb['mb_2']) { ?>
                <input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1"> <label for="bf_file_del0"><?php echo $mb_2['mb_2']; ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        
        
        
        
        <tr>
            <th scope="row"><label for="me_memo">내용</label></th>
            <td><textarea name="me_memo" id="me_memo" required class="required"><?php echo $content ?></textarea></td>
        </tr>
        
        </tbody>
        </table>
    </div>

    <div class="win_btn">
        <input type="submit" value="보내기" id="btn_submit" class="button blue">
        <a href='/bbs/memo.php' class="button black">목록</a>
    </div>
    </form>
</div>

</div>
<script>
function fmemoform_submit(f)
{
    <?php echo chk_captcha_js();  ?>

    return true;
}
</script>
<!-- } 쪽지 보내기 끝 -->