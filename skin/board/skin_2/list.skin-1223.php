<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 8;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>
<script type="text/javascript">
$(function(){
    $("#datetime1, #datetime2").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "2015:2020", maxDate: "+5y" });
});
</script>

<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
    
    
  <!--  <div class="sso">
<a href="javascript:;" onclick="dis('bo_fx');">검색</a>
</div>-->




    <div class="bo_fx" id="bo_fx" <? if($_GET['sso']==1){?> <? }?>  style="display:block !important">
      <fieldset id="bo_sch">
      <legend>게시물 검색</legend>
      <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        원근무자:
        <input type="text" name="s_subject" value="<?=$s_subject?>" size="15">
        
        기관(업체):
        <input type="text" name="s_1" value="<?=$s_1?>" size="15">
        
        대근자:
        <input type="text" name="s_link1" value="<?=$s_link1?>" size="15">
        
        반:
        <input type="text" name="s_content" value="<?=$s_content?>" size="15">
        
        대근일 : 
        <input type="text" name="sdate1" id="datetime1" style="width:75px;" value="<?=$sdate1?>">
        -
        <input type="text" name="edate1" id="datetime2" style="width:75px;" value="<?=$edate1?>">

        <input type="image" src="/img/btn_search.jpg">
      </form>
      </fieldset>
      <!-- } 게시판 검색 끝 --> 
    </div>


    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col">원근무자</th>
            <th scope="col">기관(업체)</th>
            
            <th scope="col">대근자</th>
            <th scope="col">반</th>
            <th scope="col">대근일</th>
            <th scope="col">결과</th>
            
             <?
            if($typ!=1 && $member['mb_level']!="8" && $member['mb_level']!="7" && $member['mb_level']!="6" && $member['mb_level']!="5"){
			?>
             <th scope="col">문자메세지</th>
              <th scope="col">메일</th>
           <?
			}
		   ?>
           
           
            <th scope="col">상세보기</th>
            
           
           
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
         
         
         <input type="hidden" name="mb_id_w[]" value="<?php echo $list[$i]['wr_3'] ?>">
         
         
         
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
             ?>
             
             
            </td>
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td>
                <?php
                echo $list[$i]['icon_reply'];
                ?>

               
                    <?php echo $list[$i]['subject'] ?>
                  
               

                <?php
                // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                //if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                //if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                //if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                //if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];

                 ?>
            </td>
            <td><?php echo $list[$i]['wr_1'] ?></td>
            <td><?php echo $list[$i]['wr_link1'] ?></td>
            <td><?php echo $list[$i]['wr_content'] ?></td>
            
             <td><?php echo $list[$i]['wr_2'] ?></td>
              <td><?php echo $list[$i]['ca_name'] ?></td>
              
             <?
            if($typ!=1 && $member['mb_level']!="8" && $member['mb_level']!="7" && $member['mb_level']!="6" && $member['mb_level']!="5"){
			?>
                  <td><a href="/tel_form.php?code=<?=urlencode($list[$i]['wr_link2'])?>" target="_blank"  class="button white  small win_memo">문자보내기</a></td>
                   <td><a href="/email_form.php?mb_id=<?=$list[$i]['wr_3']?>"  class="button white  small win_memo" target="_blank" id="ol_after_memo">메일보내기</a></td>
                    <?  }?>
                    
                    
      
                  <td> <a href="<?php echo $list[$i]['href'] ?>"><strong style="color:#FF575A">보기</strong></a></td>
             
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx" style="display:block">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
             
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        	<?php if ($write_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="javascript:;" class="button white" onclick="dis_html('bo_sms_email','sns');">문자보내기</a></li><?php } ?>
        	 <?php if ($write_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="javascript:;" class="button white" onclick="dis_html('bo_sms_email','email');">메일보내기</a></li><?php } ?>
            <?php if ($write_href&&$member['mb_level']!=8) { ?><li><a href="/dex_a_2.php?sca=<?=$sca.$search_lk?>" class="button blue">엑셀다운</a></li><?php } ?>
            <?php if ($list_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="<?php echo $list_href ?>" class="button black">목록</a></li><?php } ?>
            <?php if ($write_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="<?php echo $write_href ?>" class="button black">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    
    
    
    <div id="bo_sms_email"></div>
    
    
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>
 

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
