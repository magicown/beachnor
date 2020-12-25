<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($member['mb_level']==7||$member['mb_level']==8){
    alert("권한이 없습니다.");
}


// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
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
                    <th scope="row"><label for="wr_subject">거래처명<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <div id="autosave_wrapper">
                            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required" size="50" maxlength="255">
                        </div> </td>
                </tr>

                <tr>
                    <th scope="row">대표자명</th>
                    <td class="wr_content">
                        <input type="text" name="wr_1" value="<?=$write['wr_1']?>" id="wr_1" class="frm_input" size="20" maxlength="100">
                    </td>
                </tr>
                <tr>
                    <th scope="row">사업자등록번호</th>
                    <td class="wr_content">
                        <input type="text" name="wr_7" value="<?=$write['wr_7']?>" id="wr_1" class="frm_input" size="20" maxlength="100">
                    </td>
                </tr>


                <tr>
                    <th scope="row"><label for="wr_link1">담당자명</label></th>
                    <td>
                        <input type="text" id="wr_2" name="wr_2"  value="<?php echo $write['wr_2'] ?>" class="frm_input" size="20" >
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_content">전화번호<strong class="sound_only">필수</strong></label></th>
                    <td class="wr_content">
                        <input type="text" name="wr_3" value="<?php echo $write['wr_3'] ?>" id="wr_3" class="frm_input" size="20" >


                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="wr_content">휴대폰번호<strong class="sound_only">필수</strong></label></th>
                    <td class="wr_content">
                        <input type="text" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4" class="frm_input" size="20" >
                </tr>


                <tr>
                    <th scope="row">
                        주소
                        <?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
                    </th>
                    <td>
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
                    <th scope="row">계약일</th>
                    <td>
                        <input type="text" name="wr_5" value="<?=$write['wr_5']?>" id="wr_5" class="frm_input" size="12" maxlength="10">


                    </td>
                </tr>
                <tr>
                    <th scope="row">비고</th>
                    <td>
                        <input type="text" name="wr_6" id="wr_6" value="<?php echo $write['wr_6'];?>" class="frm_input" size="100">
                    </td>
                </tr>
                <tr>
                    <th scope="row">상태</th>
                    <td>

                        <select name="ca_name" id="ca_name" class="frm_input">
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

    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js?autoload=false"></script>
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

        function execPostCode(){
            //load함수를 이용하여 core스크립트의 로딩이 완료된 후, 우편번호 서비스를 실행합니다.
            daum.postcode.load(function(){
                new daum.Postcode({
                    oncomplete: function(data) {
                        console.log(data.zonecode)
                        var of = document.fwrite;

                        if(data.zonecode != ''){
                            of.wr_12.value = data.zonecode;
                        } else {
                            of.wr_12.value = data.postcode1;
                            of.wr_13.value = data.postcode2;
                        }


                        if(data.buildingName!='') {
                            of.wr_14.value = data.buildingName;
                        } else {
                            of.wr_14.value = data.jibunAddress;
                        }
                        of.wr_15.value = '';


                        if(of.wr_17.value != ''){
                            of.wr_17.value = data.jibunAddress
                        }

                        of.wr_15.focus();
                    }
                }).open();
            });
        }
    </script>
    <script>
        $(function(){
            $("#wr_5").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
        });
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->