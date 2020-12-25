<?php
include_once('./_common.php');

$g5['title'] = '기관(업체)';

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) and `mb_level`=8 and `mb_id` in ( select distinct(wr_13) from `g5_write_a_1`) ";



$sql_search .= $mb_name?" and `mb_name` like '%".$mb_name."%'":'';
$sql_search .= $mb_5?" and `mb_5` like '%".$mb_5."%'":'';
$sql_search .= $mb_6?" and `mb_6` like '%".$mb_6."%'":'';
$sql_search .= $mb_7?" and `mb_7` like '%".$mb_7."%'":'';

$links = "&mb_name=".$mb_name."&mb_5=".$mb_5."&mb_6=".$mb_6."&mb_7=".$mb_7."";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함



include_once('./_head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";


//echo $sql;
$result = sql_query($sql);


?>
<link rel="stylesheet" href="./css/lev8.css">
<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">
<!--<div class="sso">
<a href="javascript:;" onclick="dis('bo_fx');">검색</a>
</div>

-->
    <div class="bo_fx" id="bo_fx" style="display:block !important">
      <fieldset id="bo_sch">
      <legend>게시물 검색</legend>
      <form name="fsearch" method="get">
        
        기관(업체):
        <input type="text" name="mb_name" value="<?=$mb_name?>" size="15">
        
        담당자:
        <input type="text" name="mb_5" value="<?=$mb_5?>" size="15">
        
        전화번호:
        <input type="text" name="mb_6" value="<?=$mb_6?>" size="15">

        휴대폰:
        <input type="text" name="mb_7" value="<?=$mb_7?>" size="15">

        <input type="image" src="/img/btn_search.jpg">
      </form>
      </fieldset>
      <!-- } 게시판 검색 끝 --> 
    </div>

    <form name="fboardlist" id="fboardlist" action="?" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">



    <div class="tbl_head01 tbl_wrap">
        <table>
        <thead>
        <tr>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
            </th>
            <th scope="col">기관(업체)</th>
            <th scope="col">담당자</th>
            <th scope="col">전화번호</th>
            <th scope="col">휴대폰</th>
            
           
        </tr>
        </thead>
        <tbody>
        <?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {
						
         ?>
         
        <tr>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $row['subject'] ?></label>
                <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                
                <input type="hidden" name="mb_id_w[]" value="<?php echo $row['mb_id'] ?>">
                
                
            </td>
            <td><?php echo $row['mb_name'] ?></td>
            
             <td><?php echo $row['mb_5'] ?></td>
              <td><?php echo $row['mb_hp'] ?></td>
               <td><?php echo $row['mb_tel'] ?></td>
                 
        </tr>
        <?php } ?>
        </tbody>
        </table>
        
        
      
        
        
    </div>

    <div class="bo_fx" style="display:block">
        <ul class="btn_bo_user">
        	<?php if ($member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="javascript:;" class="button white" onclick="dis_html('bo_sms_email','sns');">문자보내기</a></li><?php } ?>
        	 <?php if ($member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="javascript:;" class="button white" onclick="dis_html('bo_sms_email','email');">메일보내기</a></li><?php } ?>
            <?php if ($member['mb_level']!=8) { ?><li><a href="/dex_lev8.php?1=1<?=$links?>" class="button blue">엑셀다운</a></li><?php } ?>
            <?php if ($member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="<?php echo $list_href ?>" class="button black">목록</a></li><?php } ?>
        </ul>
    </div>
    
    



<div id="bo_sms_email"></div>




       
       
       
       
    </form>
</div>




<script type="text/javascript">


</script>




<!-- 페이지 -->
<?php echo get_paging(5, $page, $total_page, '?'.$qstr.'&amp;page='); ?> 
 

<script>

function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}


function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk[]" && f.elements[i].checked)
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
	
	
	 if(document.pressed == "문자보내기") {
        if (!confirm("문자메세지가 보내집니다."))
            return false;

       // f.removeAttribute("target");
      //  f.action = "./board_list_update.php";
    }
	
	if(document.pressed == "메일보내기") {
        if (!confirm("메일이 보내집니다."))
            return false;

       // f.removeAttribute("target");
      //  f.action = "./board_list_update.php";
    }
	
	
	

    return true;
}


</script>
<!-- } 게시판 목록 끝 -->
