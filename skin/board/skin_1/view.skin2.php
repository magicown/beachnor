<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<style>
#box_view{ width:980px; margin:0 auto;  position: relative;}

</style>


<!-- 게시물 읽기 시작 { -->

<div id="box_view">
<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>


<div class="tbl_frm01 tbl_wrap">
  <div class="f_left box_1">
    <p>기본정보</p>
    <table>
      <tbody>
        <tr>
          <th scope="row">사진</th>
          <td align="center">
          <?
          $row = sql_fetch(" select `mb_2` from `g5_member` where mb_id = '{$view['wr_12']}' ");
		  if($row['mb_2']){
		  ?>
          <img src="/data/member_photo/<?=$row['mb_2']?>" width="150">
          <? }else{?>
     		이미지없음
            <? }?>
          
          </td>
        </tr>
        <tr>
          <th scope="row">성명</th>
          <td><?php echo $view['wr_subject'] ?></td>
        </tr>
        <tr>
          <th scope="row">성별</th>
          <td class="wr_content"><?php
			
			if($view['wr_content']=="M"){
				echo "남";
			}else{
				
				echo "여";
			}
			
			
			 ?></td>
        </tr>
        <tr>
          <th scope="row">생년월일</th>
          <td>
		  <?
		  
		  $mb_birth_ex = explode("-",$view['wr_link1']);
		  $nianling = date("Y")-$mb_birth_ex[0];
	
	
		  ?>
		  <?=$view['wr_link1']?> (만<?=$nianling?>세)
          
          </td>
        </tr>
        <tr>
          <th scope="row">휴대폰</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>
        <tr>
          <th scope="row">메일</th>
          <td><?=$view['wr_email']?></td>
        </tr>
        <tr>
          <th scope="row">주소</th>
          <td><?php echo $view['wr_homepage'] ?></td>
        </tr>
      </tbody>
    </table>
    <p>급여정보</p>
    <table>
      <tbody>
        <tr>
          <th scope="row">월급여액</th>
          <td><?=number_format($view['wr_1'])?> 원</td>
        </tr>
        <tr>
          <th scope="row">공제액</th>
          <td><?=number_format($view['wr_2'])?> 원</td>
        </tr>
        <tr>
          <th scope="row">월수령액 </th>
          <td class="wr_content"><?=number_format($view['wr_3'])?> 원</td>
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
          <td><?=$view['wr_4']?></td>
        </tr>
        <tr>
          <th scope="row">지역</th>
          <td><?=$view['wr_5']?></td>
        </tr>
        <tr>
          <th scope="row">업무</th>
          <td class="wr_content"><?=$view['wr_6']?></td>
        </tr>
        <tr>
          <th scope="row">파견일</th>
          <td><?=$view['wr_7']?></td>
        </tr>
        <tr>
          <th scope="row">파견종료일</th>
          <td><?=$view['wr_8']?></td>
        </tr>
       <?php /*?> <tr>
          <th scope="row">구분</th>
          <td><?=$view['wr_9']?></td>
        </tr><?php */?>
        <tr>
          <th scope="row">직책</th>
          <td><?=$view['wr_10']?></td>
        </tr>
        <tr>
          <th scope="row">주 근무</th>
          <td> 주<?=$view['wr_11']?>
            회 </td>
        </tr>
        <tr>
          <th scope="row">상태</th>
          <td><?=$view['ca_name']?></td>
        </tr>
      </tbody>
    </table>
    <p>담당자정보</p>
    <table>
      <tbody>
        <tr>
          <th scope="row">담당자</th>
          <td><?=$view['wr_14']?></td>
        </tr>
        <tr>
          <th scope="row">전화번호</th>
          <td><?=$view['wr_15']?></td>
        </tr>
        <tr>
          <th scope="row">휴대폰</th>
          <td><?=$view['wr_16']?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div id="bo_v_top">
 <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>&type=<?=$type?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?> 
 
            <li><a href="<?php echo $list_href ?>&type=<?=$type?>" class="btn_b01">목록</a></li>
           
            <?php if ($write_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        </div>
</div>