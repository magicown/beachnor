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
          <th scope="row">주문처</th>
          <td><?php echo $view['wr_subject'] ?></td>
        </tr>

		<tr>
          <th scope="row">상품명</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">상품분류</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">상품사진</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

        <tr>
          <th scope="row">옵션</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">수량</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">수량</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">금액</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">주문일</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">주문자명</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">수취자명</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">배송지</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">배송업체명</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">배송일</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">전화번호</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">휴대폰</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr>

		<tr>
          <th scope="row">비고</th>
          <td><?=$view['wr_link2']?>
         </td>
        </tr> 

        <tr>
          <th scope="row">상태</th>
          <td><?=$view['ca_name']?></td>
        </tr>

 


      </tbody>
    </table>
 
  </div>
 
</div>

<div id="bo_v_top">
 <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01 button black">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01 button black" onclick="del(this.href); return false;">삭제</a></li><?php } ?> 
 
            <li><a href="<?php echo $list_href ?>" class="btn_b01 button black">목록</a></li>
           
            <?php if ($write_href&&$member['mb_level']!=7&&$member['mb_level']!=8) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 button black">등록하기</a></li><?php } ?>
        </ul>
        </div>
</div>