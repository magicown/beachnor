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
    
    <div class="f_left box_1">
    <p>기본정보</p>
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
            <th scope="row"><label for="wr_subject">성명<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="16" maxlength="100">
                    <input type="text" id="wr_12" name="wr_12"  value="<?php echo $write['wr_12'] ?>" class="frm_input" size="16"  >
                   
                   <a href="/member_ss_1.php?input=wr_subject&input_1=wr_content&input_2=wr_link1&input_3=wr_link2&input_4=wr_email&input_5=wr_homepage&input_6=wr_12" class="win_member button white small">찾기</a>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">성별<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
            
            <input type="radio" name="wr_content" value="남" id="nan" <? if($content=="남"||!$content){?> checked <? }?> > 남
            
            <input type="radio" name="wr_content" value="여" id="nv" <? if($content=="여"){?> checked <? }?> > 여
            
            
           <?php /*?> <input type="text" name="wr_content" value="<?php echo $content ?>" id="wr_content" required class="frm_input required" size="4" maxlength="1"><?php */?>
            
       
              
            </td>
        </tr>

        
        <tr>
            <th scope="row"><label for="wr_link1">생년월일</label></th>
            <td><input type="text" name="wr_link1" value="<?php if($w=="u"){echo$write['wr_link1'];} ?>" id="wr_link1" class="frm_input" size="13" maxlength="10"></td>
        </tr>
        
        
           <tr>
            <th scope="row"><label for="wr_link2">휴대폰</label></th>
            <td>
            
            <input type="text" name="wr_link2" id="wr_link2" value="<?php if($w=="u"){ echo $write['wr_link2'];} ?>" class="frm_input" size="16" maxlength="20">
            
            
            </td>
        </tr>
        
        
         <tr>
            <th scope="row"><label for="wr_email">메일</label></th>
            <td><input type="text" name="wr_email" value="<?=$write['wr_email']?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
        </tr>
        
        
         <tr>
            <th scope="row"><label for="wr_homepage">주소</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>
        
        
 
 

        </tbody>
        </table>
        
        
        
        
        <p>급여정보</p>
        <table>
        <tbody>
       
       

      
        <tr>
            <th scope="row">월급여액</th>
            <td>
               <input type="text" name="wr_1" class="frm_input" value="<?=$write['wr_1']?>"> 
               원
            </td>
        </tr>
       

        <tr>
            <th scope="row">공제액</th>
            <td> <input type="text" name="wr_2" class="frm_input" value="<?=$write['wr_2']?>"> 
            원
            </td>
        </tr>

        <tr>
            <th scope="row">월수령액 </th>
            <td class="wr_content">
            <input type="text" name="wr_3" class="frm_input"  value="<?=$write['wr_3']?>"> 
            원
              
            </td>
        </tr>

      
 

        </tbody>
        </table>
        
        
        
       </div>
       <div class="f_left box_1">
        <p>근무정보</p>
       <table>
        <tbody>
       
       

      
        <tr>
            <th scope="row">기관(업체) </th>
            <td>
                <input type="text" name="wr_4" class="frm_input" value="<?=$write['wr_4']?>" size="16" maxlength="50"> <input type="text" id="wr_13" name="wr_13"  value="<?php echo $write['wr_13'] ?>" class="frm_input" size="16"  > <a href="/member_ss.php?input=wr_4&input_2=wr_13&input_4=wr_14&input_5=wr_15&input_6=wr_16" class="win_member button white small">찾기</a>
            </td>
        </tr>
   

        <tr>
            <th scope="row">지역</th>
            <td>
            
				<? $categoli = list_cate("a1지역");?>
                <select name="wr_5" id="">
                
                <?
                for($i=0;$i<count($categoli); $i++){
                ?>
                    <option value="<?=$categoli[$i]?>" <? if(trim($categoli[$i])==trim($write['wr_5'])){?> selected<? }?>><?=$categoli[$i]?></option>
                <? }?>	
                    
                </select>
                <?=edt_cate("a1지역")?>  
                          
            </td>
        </tr>

        <tr>
            <th scope="row">업무</th>
            <td class="wr_content">
				<? $categoli = list_cate("a1업무");?>
                <select name="wr_6" id="">
            
                <?
                for($i=0;$i<count($categoli); $i++){
                ?>
                    <option value="<?=$categoli[$i]?>" <? if(trim($categoli[$i])==trim($write['wr_6'])){?> selected<? }?>><?=$categoli[$i]?></option>
                <? }?>	
                    
                </select>
                <?=edt_cate("a1업무")?>            
            </td>
        </tr>

        
        <tr>
            <th scope="row">파견일</th>
            <td><input type="text" name="wr_7" id="wr_7" class="frm_input"  value="<?=$write['wr_7']?>"></td>
        </tr>
        
        <tr>
            <th scope="row">파견종료일</th>
            <td><input type="text" name="wr_8" id="wr_8" class="frm_input"  value="<?=$write['wr_8']?>"></td>
        </tr>
        
        
        
     <?php /*?>     <tr>
            <th scope="row">구분</th>
            <td>
                <select name="wr_9" required>
                <option value="">선택</option>
            	<option value="근로자" <? if($write['wr_9']=="근로자"){?> selected<? }?>>근로자</option>
                <option value="기관" <? if($write['wr_9']=="기관"){?> selected<? }?>>기관</option>
                <option value="지점" <? if($write['wr_9']=="지점"){?> selected<? }?>>지점</option>
                <option value="본사" <? if($write['wr_9']=="본사"){?> selected<? }?>>본사</option>
            </select>
              
              
              </td>
        </tr><?php */?>
    
 
 
  <tr>
            <th scope="row">직책</th>
            <td>
				<? $categoli = list_cate("a1직책");?>
                <select name="wr_10" id="">
          
                <?
                for($i=0;$i<count($categoli); $i++){
                ?>
                    <option value="<?=$categoli[$i]?>" <? if(trim($categoli[$i])==trim($write['wr_10'])){?> selected<? }?>><?=$categoli[$i]?></option>
                <? }?>	
                    
                </select>
                <?=edt_cate("a1직책")?>            
            </td>
        </tr>
        
        
        <tr>
            <th scope="row">주 근무</th>
            <td>
            주
               <select name="wr_11" required>
            	<option value="2" <? if($write['wr_11']=="2"){?> selected<? }?>>2</option>
                <option value="3" <? if($write['wr_11']=="3"){?> selected<? }?>>3</option>
                <option value="4" <? if($write['wr_11']=="4"){?> selected<? }?>>4</option>
            </select>
          회
          
          </td>
        </tr>
        
        
           <tr>
            <th scope="row">상태</th>
            <td> <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select></td>
        </tr>
        
        

        </tbody>
        </table>
        
        
        
        <p>담당자정보</p>
        <table>
        <tbody>
       
       

      
        <tr>
            <th scope="row">담당자</th>
            <td>
               <input type="text" name="wr_14" id="wr_14" class="frm_input" value="<?=$write['wr_14']?>">
            </td>
        </tr>
       

        <tr>
            <th scope="row">전화번호</th>
            <td> <input type="text" name="wr_15" id="wr_15" class="frm_input" value="<?=$write['wr_15']?>">
            </td>
        </tr>

        <tr>
            <th scope="row">휴대폰</th>
            <td class="wr_content">
            <input type="text" name="wr_16" id="wr_16" class="frm_input"  value="<?=$write['wr_16']?>">
            </td>
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