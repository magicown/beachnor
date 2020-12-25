<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
ini_set('display_errors',1)
?>
<link type="text/css" href="/css/jquery-ui.css" rel="stylesheet" />
<style>
.ui-datepicker {
	font: 12px dotum;
}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
	width: 70px;
}
.ui-datepicker-trigger {
	margin: 0 0 -5px 2px;
}
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
      <table>
        <tbody>
          
          
          <tr>
            <th scope="row">상품코드</th>
            <td>
                <input type="text" name="wr_1" id="wr_1" class="frm_input" value="<?php echo $write['wr_1']; ?>">
            </td>
          </tr>
          
          
          
          <tr>
            <th scope="row">상품분류</th>
            <td>

				<? $categoli = list_cate("a3지역");?>
                <select name="wr_subject" id="wr_subject"  required class="frm_input">
                <?
                for($i=0;$i<count($categoli); $i++){
                ?>
                    <option value="<?=$categoli[$i]?>" <? if(trim($categoli[$i])==trim($write['wr_subject'])){?> selected<? }?>><?=$categoli[$i]?></option>
                <? }?>	
                    
                </select>
                <?=edt_cate("a3지역")?>
            </td>
          </tr>
          
          

             <tr>
            <th scope="row">상품명</th>
            <td>
            
        <input type="text" name="wr_2" value="<?=$write['wr_2']?>" id="wr_2" class="frm_input" size="12" maxlength="11">
            
            
            </td>
          </tr>		  


             <tr>
            <th scope="row">가격</th>
            <td>
            
        <input type="text" name="wr_3" value="<?=$write['wr_3']?>" id="wr_3" class="frm_input" size="12" maxlength="11"> 원
            
            
            </td>
          </tr>



          <tr>
            <th scope="row">공장거래처</th>
            <td>
            
           <select name="wr_5" id="wr_5" class="frm_input" >
               <option value="">선택하세요</option>
               <?php
                $que = "SELECT * FROM g5_write_a_5 WHERE 1";

                $res = sql_query($que);
                while($arr = sql_fetch_array($res)){
               ?>
                    <option value="<?php echo $arr['wr_subject']; ?>" <?php echo ($write['wr_5']==$arr['wr_subject'])?'selected':'';?>><?php echo $arr['wr_subject']; ?></option>
               <?php } ?>
                </select>
            
            
            </td>
          </tr>


             <tr>
            <th scope="row">상태</th>
            <td>

                <select name="ca_name" id="wr_4" class="frm_input">
                    <option value="판매중" <?php echo ($write['ca_name']=='판매중')?'selected':'';?>>판매중</option>
                    <option value="판매대기" <?php echo ($write['ca_name']=='판매대기')?'selected':'';?>>판매대기</option>
                    <option value="보류" <?php echo ($write['ca_name']=='보류')?'selected':'';?>>보류</option>
                </select>

            
            
            </td>
          </tr>


          

           
        </tbody>
      </table>
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

</script> 
</section>
<!-- } 게시물 작성/수정 끝 -->