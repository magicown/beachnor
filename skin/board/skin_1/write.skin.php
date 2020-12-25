<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
/*
if($member['mb_level']==7||$member['mb_level']==8){
	alert("권한이 없습니다.");
}*/

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>


<link type="text/css" href="/css/jquery-ui.css" rel="stylesheet" />
                                                                <style>
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month,
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
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


<div id="left_pop">
<form method="post" id="cateform" onsubmit="return mo_cate();">
<input type="hidden" name="typ" id="typ" value="">
<textarea name="con_menu" id="con_menu"></textarea>
<div class="bt"><input type="image" src="/img/modi_btn_big1.png" ></div>
<div class="bt"><a href="javascript:;" onClick="pop_out(-500)"><img src="/img/close_btn_big1.png" ></a></div>
</form>
<div>
<p style="color:#FF8C8E">엔터로 구분을합니다.</p>

<p>예:</p>
<p>메뉴1</p>
<p>메뉴2</p>
<p>메뉴3</p>
</div>
</div>


<section id="bo_w">
    <h2 id="container_title"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
   

    <div class="tbl_frm01 tbl_wrap">
    
    <div class="f_left" style="border:#bab9b9 solid 1px;">
    <p style="margin:5px; padding:10px;">기본정보</p>
        <table>
        <tbody>
       
       

     <?php /*?>
        <tr>
            <th scope="row">사진</th>
            <td>
               <input type="file" name="bf_file[]" title="파일첨부 1 : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
               
                <?php if($w == 'u' && $file[0]['file']) { ?>
                <input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1"> <label for="bf_file_del0"><?php echo $file[0]['source'].'('.$file[0]['size'].')';  ?> 사진삭제</label>
                <?php } ?>
                
                
            </td>
        </tr>
       <?php */?>

        <tr>
            <th scope="row"><label for="wr_subject">주문처<strong class="sound_only">필수</strong></label></th>
            <td colspan="5">
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="16" maxlength="100">
                   <a href="/order_list.php?input=wr_subject&input_1=wr_content&input_2=wr_link1&input_3=wr_link2&input_4=wr_email&input_5=wr_homepage&input_6=wr_12" class="win_member button white small">찾기</a>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">주문번호</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
            <th scope="row">상품명</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
            <th scope="row"><label for="wr_content">상품분류<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <input type="radio" name="wr_content" value="남" id="nan" <? if($content=="남"||!$content){?> checked <? }?> > 남
                <input type="radio" name="wr_content" value="여" id="nv" <? if($content=="여"){?> checked <? }?> > 여
            </td>
        </tr>

        <tr>

        </tr>

        <tr>

        </tr>

        <tr>
            <th scope="row">상품사진</th>
            <td colspan="5"><input type="file" name="wr_8" id="wr_8" class="frm_input"  value=""></td>

        </tr>


        <tr>
            <th scope="row">옵션</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
            <th scope="row">수량</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
            <th scope="row">금액</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
        </tr>


        <tr>

        </tr>

        <tr>

        </tr>

        <tr>
            <th scope="row">주문일</th>
            <td><input type="text" name="wr_7" id="wr_7" class="frm_input"  value="<?=$write['wr_7']?>"></td>
            <th scope="row">주문자명</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
            <th scope="row">수취자명</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>
        </tr>

         <tr>
            <th scope="row"><label for="wr_homepage">배송지</label></th>
             <td colspan="5">
                 <label for="reg_mb_zip1" class="sound_only">우편번호 앞자리<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                 <input type="text" name="wr_12" value="<?php echo $write['wr_12'] ?>" id="wr_12" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="9" maxlength="3">
                 -
                 <label for="reg_mb_zip2" class="sound_only">우편번호 뒷자리<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                 <input type="text" name="wr_13" value="<?php echo $write['wr_13'] ?>" id="reg_mb_zip2" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="9" maxlength="3">
                 <button type="button" class="btn_frmline" onclick="execPostCode('fwrite', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                 <input type="text" name="wr_14" value="<?php echo $write['wr_14'] ?>" id="wr_14" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="50">
                 <label for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label><br>
                 <input type="text" name="wr_15" value="<?php echo $write['wr_15'] ?>" id="reg_mb_addr2" class="frm_input frm_address" size="50">
                 <label for="reg_mb_addr2">상세주소</label>
                 <br>
                 <input type="text" name="wr_16" value="<?php echo $write['wr_16'] ?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly">
                 <label for="reg_mb_addr3">참고항목</label>
                 <input type="hidden" name="wr_17" value="<?php echo $write['wr_17']; ?>">
             </td>
        </tr>

        <tr>
            <th scope="row">배송업체명</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value=""></td>

            <th scope="row">배송일</th>
            <td><input type="text" name="wr_7" id="wr_7" class="frm_input"  value="<?=$write['wr_7']?>"></td>
        
            <th scope="row">전화번호</th>
            <td> <input type="text" name="wr_15" id="wr_15" class="frm_input" value="<?=$write['wr_15']?>">
            </td>
        </tr>

        <tr>
            <th scope="row">휴대폰</th>
            <td class="wr_content">
                <input type="text" name="wr_16" id="wr_16" class="frm_input"  value="<?=$write['wr_16']?>">
            </td>
            <th scope="row">발주확인</th>
            <td class="wr_content">
                <input type="text" name="wr_16" id="wr_16" class="frm_input"  value="<?=$write['wr_16']?>">
            </td>
            <th scope="row">작업자</th>
            <td class="wr_content">
                <input type="text" name="wr_16" id="wr_16" class="frm_input"  value="<?=$write['wr_16']?>">
            </td>
        </tr>

        <tr>
            <th scope="row">여분</th>
            <td colspan="5">
                <input type="text" name="wr_8" id="wr_8" class="frm_input" size="50"  value="">
            </td>
        </tr>
     <tr>
         <th scope="row">비고</th>
         <td colspan="5">
             <input type="text" name="wr_8" id="wr_8" class="frm_input" size="50"  value="">
         </td>

     </tr>
           <tr>
            <th scope="row">상태</th>
            <td colspan="5"> <select name="ca_name" id="ca_name" class="frm_input" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select></td>
        </tr>
 



        </tbody>
        </table>
        
        
       </div>
 
        
        
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="button blue">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="button white">취소</a>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
    
    
      <script>
$(function(){
    $("#wr_7, #wr_8").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});
</script>


</section>
<!-- } 게시물 작성/수정 끝 -->